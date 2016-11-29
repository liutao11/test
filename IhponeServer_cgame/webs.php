<?php
ini_set("memory_limit","256M");
/**登入服务*/
include __DIR__."/conf/setup.php";                                         //配置文件
include __DIR__."/conf/requestinto.php";                                  //请求转移配置
include __DIR__."/smarty/Smarty.class.php";                               //加入smarty框架
include __DIR__."/conf/main.php";                                         //配置文件

$class_array=scandir(__DIR__."/code/");
foreach($class_array as $vv){
    if($vv != '.' and $vv != ".." && preg_match('/bank/Uis',$vv) != 1){
        include_once __DIR__."/code/".$vv;
    }
}

$class_array=scandir(__DIR__."/class/");
foreach($class_array as $vv){
    if($vv != '.' and $vv != ".." && preg_match('/bank/Uis',$vv) != 1){
        include_once __DIR__."/class/".$vv;
    }
}

$worker_array=scandir(__DIR__."/worker/");
foreach($worker_array as $vv){
    if($vv != '.' and $vv != ".." && preg_match('/bank/Uis',$vv) != 1){
        $name=__DIR__."/worker/".$vv;
        if(is_file($name)) {
            include_once $name;
        }else{
            $name_array=scandir($name);
            foreach($name_array as $item){
                if($item != '.' and $item != ".." && preg_match('/bank/Uis',$item) != 1){
                     $fileUrl=__DIR__."/worker/".$vv.'/'.$item;
                     if(is_file($fileUrl)){
                         include_once $fileUrl;
                     }
                }
            }
        }
    }
}
class webserver{
    public $user_class;
    public $read_db;
    public $update_db;
    public $rd;
    public $my_friends;
    public $tables;
    public $homeUrl;
    public $main;
    public $webserver;


    public $read_data_pool_host;
    public $update_data_pool_host;
    function __construct(){
        global $user_class ,$my_friends,$read_data_pool_host,$update_data_pool_host,$main;
        $this->user_class=$user_class;
        $this->my_friends=$my_friends;
        $this->main=$main;
        $this->read_data_pool_host=$read_data_pool_host;
        $this->update_data_pool_host=$update_data_pool_host;
        $this->homeUrl=__DIR__;                                                                        //设置跟目录
        date_default_timezone_set("PRC");                                                            //设置时区

        $this->tables=new swoole_table(100);                                                         //table表
        $this->tables->column('values',swoole_table::TYPE_STRING,255);
        $this->tables->create();

        $webserver=new swoole_http_server(LIENSON_IP,LIENSON_POST);

        $this->webserver=$webserver;
        echo "---------------------------           webServer       --------------------------\n";
        echo "worker                       listen                                  status\n";
        echo "webServer                    tcp://".LIENSON_IP.":".LIENSON_POST."*".LIENSON_SPOST."                     [ok] \n";
        echo "--------------------------------------------------------------------------------\n";
        echo "swoole_web_server start succes ....\n";
        $webserver->on("workerStart",array($this,"onWorker"));
        $webserver->on("request",array($this,'onRequest'));
        $webserver->on("pipeMessage",array($this,"onPipeMessage"));
        $webserver->on("task",array($this,"onTask"));
        $webserver->on("finish",array($this,"onFinish"));
        if(defined(LIENSON_SPOST) &&  LIENSON_SPOST!='' && LIENSON_SPOST!=0000) {
            $webserver->addlistener('0.0.0.0', LIENSON_SPOST, SWOOLE_SOCK_TCP);
        }
        $webserver->set(array(
            "worker_num"=>WORKER_NUM,                                                       //worker 数目
            "task_worker_num"=>TASK_WORKER_NUM,                                            //配置task数目，
            "daemonize"=>DAEMONIZE,
            "log_file"=>LOGFILE,
            "user"=>"nobody",
            "group"=>"nobody"
        ));
        $webserver->setGlobal(HTTP_GLOBAL_ALL);
        $webserver->start();
    }
    function onWorker($server,$wid){
        if($wid < (WORKER_NUM)){
            $style=DB_STYLE;
            $port=DB_PORT;
            $use=DB_USER;
            $pwd=DB_PWD;
            $dbname=DB_DATA;
            $num=DB_LINK_INT;
            //读写分离
            $this->update_db=new cl_dbLink($style,$this->update_data_pool_host,$port,$use,$pwd,$dbname,$num);
            if($this->read_data_pool_host) {
                $this->read_db = new cl_dbLink($style, $this->read_data_pool_host, $port, $use, $pwd, $dbname, $num);
            }else{              //当付的数据没有时；
                $this->read_db=$this->update_db;
            }
            if(REDIS_STATIC==1) {
                $this->rd = new redis();
                $this->rd->pconnect(REDIS_HOST, REDIS_PORT);
                if(defined("REDIS_PASS")) {                        //当redis_pass存在时
                    $this->rd->auth(REDIS_PASS);
                }
                $this->rd->select(REDIS_DB_NO);
            }
            swoole_timer_tick(1000*60*60*3, array($this, 'DBlinkKeep'),$wid);               //保存数据库连接有效性
        }
        if($wid==0) {                                            //预处理数据
            //swoole_timer_after(100*10,array($this, 'Pretreatment_doing_one'),'3242');
           // swoole_timer_tick(1000*10, array($this, 'Pretreatment_doing'),array("aa"=>'ss','qwr'=>3243));
        }
        if($wid==1) {

             //swoole_timer_tick(1000*10, array($this, 'Pretreatment_doing'),array("aa"=>'ss','qwr'=>3243));
            //swoole_timer_tick(1000*60*60*8, array($this, 'reload_doing'),array());              //8小时重新启动work进程和task进程
        }
    }

    final  function DBlinkKeep($tickId,$wid){

        echo "启动数据库连接心疼线程{$wid}:".date("Y-m-d H:i:s")."\n";
        //修改数据库连接发送
        $DBUPLinkPools=$this->update_db->pool;
        foreach($DBUPLinkPools as $DBlink){
            $re= $DBlink->query("select @@version");

        }
        //读数据库连接发送
        $DBRELinkPools=$this->read_db->pool;
        foreach($DBRELinkPools as $DBlink){
            $re= $DBlink->query("select @@version");
        }
        $this->rd->ping();
    }


    //重新启动
    final function Pretreatment_doing_one($argS){
        $className="tr_Pretreatment_doing_one";
        $timeRFile = __DIR__ . "/timer/" .$className . ".php";
        if(is_file($timeRFile)){
            include_once $timeRFile;
            if(class_exists($className)){
                $update_db=$this->update_db;
                $rd=$this->rd;
                $object=new $className($update_db,$rd);
                $object->start();
            }
        }
    }



    //预处理调用的方法
    final function Pretreatment_doing($interval,$params){
        $className="tr_Pretreatment_doing";
        $timeRFile = __DIR__ . "/timer/" .$className . ".php";
        if(is_file($timeRFile)){
            include_once $timeRFile;
            if(class_exists($className)){
                $style=DB_STYLE;
                $port=DB_PORT;
                $use=DB_USER;
                $pwd=DB_PWD;
                $dbname=DB_DATA;
                if(REDIS_STATIC==1) {
                    $rd = new redis();
                    $rd->pconnect(REDIS_HOST, REDIS_PORT);
                    if(defined("REDIS_PASS")) {                        //当redis_pass存在时
                        $rd->auth(REDIS_PASS);
                    }
                    $rd->select(REDIS_DB_NO);
                }else{
                    $rd=null;
                }
                $update_db = new PDO("{$style}:host={$this->update_data_pool_host[0]};dbname={$dbname};port={$port};charset=UTF8", $use, $pwd);

                $object=new $className($update_db,$rd,$this->main,__DIR__);
                $object->start();
            }else{
                echo "this is not find class: '{$className}'";
            }
        }else{
            echo "this is not find file :'{$timeRFile}'";
        }
    }


    final function error_doing($interval,$params){
         $result=$this->rd->hGetAll("DanceExeErrorList");
         if($result) {
             foreach ($result as $kk => $vv) {
                 $vvArray = json_decode($vv, true);
                 try {
                     $client = new swoole_client(SWOOLE_SOCK_TCP);
                     if (!$client->connect($vvArray['ip'], $vvArray['port'])) {
                         exit("connect failed. Error: {$client->errCode}\n");
                     }
                     $endString = json_encode($vvArray['endString']);
                     $length = strlen($endString) + 2;
                     $client->send(pack('s', $length) . pack('s', '1') . pack('s', $vvArray['key']) . $endString);
                     @$result = $client->recv();
                     $client->close();
                     if ($result) {
                         $this->rd->hDel("DanceExeErrorList", $kk);
                     }else{
                         echo "Timer is still not sent successfully\n";
                     }
                 } catch (Exception $e) {
                     echo $e->getMessage();
                 }
             }
         }else{
             echo "this is not ErrorList\n";
         }
    }
    final function  onPipeMessage($server,$from_worker_id,$message){
        $data=json_decode($message,true);
        $workerDoing=$data['workerDoing'];
        $workerClassName="pp_".$workerDoing;
        $fileurl = __DIR__ . "/pipe/" . $workerClassName . ".php";
        if(is_file($fileurl)){
            include_once($fileurl);
            $style=DB_STYLE;
            $port=DB_PORT;
            $use=DB_USER;
            $pwd=DB_PWD;
            $dbname=DB_DATA;
            if(REDIS_STATIC==1) {
                $rd = new redis();
                $rd->pconnect(REDIS_HOST, REDIS_PORT);
                if(defined("REDIS_PASS")) {                        //当redis_pass存在时
                    $rd->auth(REDIS_PASS);
                }
                $rd->select(REDIS_DB_NO);
            }else{
                $rd=null;
            }
            $read_db = new PDO("{$style}:host={$this->read_data_pool_host[0]};dbname={$dbname};port={$port};charset=UTF8", $use, $pwd);
            $update_db = new PDO("{$style}:host={$this->update_data_pool_host[0]};dbname={$dbname};port={$port};charset=UTF8", $use, $pwd);
            $workerObject= new $workerClassName($read_db,$update_db,$rd,$data['data'],$this->main);
            $workerObject->start();
        }else{
            echo "[{$fileurl}]this file is not here.....";
        }
    }

    final function onRequest($request, $response){
        $url=$request->server['path_info'];
        echo "连接id:{$response->fd};url:{$url}\n";
        $pregResult=preg_match("/(\.jpeg$|\.jpg$|\.png$|\.gif$)/Ui",$url);
        $jsResult=preg_match("/\.js/Ui",$url);
        $cssResult=preg_match("/\.css/Ui",$url);
        if($pregResult) {                                                                   //图片请求
            $imgRequest = new wk_imgRequest($request, $response, $this->homeUrl, $url);
            $imgRequest->start();
        }elseif($jsResult) {
            $jsRequest = new wk_jsRequest($request, $response, $this->homeUrl, $url);
            $jsRequest->start();
        }elseif($cssResult){
            $cssRequest = new wk_cssRequest($request, $response, $this->homeUrl, $url);
            $cssRequest->start();
        }else{                                                                            //逻辑处理
            $urllen = strlen($url);
            if ($urllen == 1 || $urllen == 0) {
                $object_string = $this->user_class['/default/'];
                if ($object_string) {
                    $object_name = "wk_" . $object_string;
                    $fileurl = __DIR__ . "/worker/" . $object_name . ".php";
                    if (is_file($fileurl)) {
                        $wk_object = new $object_name($this->webserver,$request, $response, $this->homeUrl, $this->my_friends, $this->tables, $this->read_db, $this->update_db, $this->rd,$this->main,$this->update_data_pool_host);
                        $wk_object->start();
                    } else {
                        $response->header("Content-Type", "text/html;charset=utf-8");
                        $response->status(404);
                        $response->header("Access-Control-Allow-Origin", "*");
                        $response->end("this file is not here ......");
                    }
                } else {
                    $response->header("Content-Type", "text/html;charset=utf-8");
                    $response->status(404);
                    $response->header("Access-Control-Allow-Origin", "*");
                    $response->end("this index isn't find ......");
                }
            } else {
                @$object_string = $this->user_class[$url];
                if ($object_string) {
                    if(is_array($object_string)){
                        $object_name=$object_string['dirName']."/wk_".$object_string['fileName'];
                    }else {
                        $object_name = "wk_" . $object_string;
                    }
                    $clienurl = __DIR__ . "/worker/" . $object_name . ".php";
                    if (is_file($clienurl)) {
                        $wk_object = new $object_name($this->webserver,$request, $response, $this->homeUrl, $this->my_friends, $this->tables, $this->read_db, $this->update_db, $this->rd,$this->main,$this->update_data_pool_host);
                        $wk_object->start();
                    } else {
                        $response->header("Content-Type", "text/html;charset=utf-8");
                        $response->status(404);
                        $response->header("Access-Control-Allow-Origin", "*");
                        $response->end("this file is not here ......");
                    }
                } else {
                    $response->header("Content-Type", "text/html;charset=utf-8");
                    $response->status(404);
                    $response->header("Access-Control-Allow-Origin", "*");
                    $response->end("this index isn't find ......");
                }
            }
        }
    }
    final public function onTask($serv,$task_id,$from_id,$data){
        if($data) {
            $data_a=json_decode($data,true);
            $className="tk_".$data_a['TaskClass'];
            $taskFile = __DIR__ . "/task/" .$className . ".php";
            if(is_file($taskFile)){
                include_once($taskFile);
                $style=DB_STYLE;
                $port=DB_PORT;
                $use=DB_USER;
                $pwd=DB_PWD;
                $dbname=DB_DATA;
                if(REDIS_STATIC==1) {
                    $rd = new redis();
                    $rd->pconnect(REDIS_HOST, REDIS_PORT);
                    if(defined("REDIS_PASS")) {                        //当redis_pass存在时
                        $rd->auth(REDIS_PASS);
                    }
                    $rd->select(REDIS_DB_NO);
                }else{
                    $rd=null;
                }
                $read_db = new PDO("{$style}:host={$this->read_data_pool_host[0]};dbname={$dbname};port={$port};charset=UTF8", $use, $pwd);
                $update_db = new PDO("{$style}:host={$this->update_data_pool_host[0]};dbname={$dbname};port={$port};charset=UTF8", $use, $pwd);
                $taskObject=new $className($read_db,$update_db,$rd,$data_a['data'],$this->main);
                $taskObject->start();
            }else{
               echo "this is not find file '{$taskFile}'";
            }
        }
    }
    final public function onFinish($serv,$task_id,$data){
        var_dump($task_id,$data);
    }
}

new webserver();                                                               //启动主程


?>