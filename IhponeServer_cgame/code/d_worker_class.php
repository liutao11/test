<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/9
 * Time: 11:45
 */
abstract class worker implements interWebClass{
    public $get=null;
    public $post=null;
    public $cookie=null;
    public $exeid;                                                    //运行id
    public $tables;
    public $request;
    public $response;
    public $my_friends;
    public $read_db;
    public $update_db;
    public $rd;
    public $smarty;
    public $homeUrl;
    public $main;
    public $server;
    public $update_data_pool_host;
    function __construct(&$server,&$request,&$response,&$homeUrl,&$myfriends,&$tables,&$read_db,&$update_db,&$rd,$main,$update_data_pool_host){
        $this->server=&$server;
        $this->request= &$request;
        $this->response= &$response;
        $this->tables= &$tables;
        $this->my_friends=&$myfriends;
        $this->read_db= &$read_db;
        $this->update_db=&$update_db;
        $this->rd=&$rd;
        $this->homeUrl=&$homeUrl;
        $this->main=&$main;
        $this->update_data_pool_host=$update_data_pool_host;
    }
    function GET_FUN(){
        $this->response->end("Please use the post...");
    }
    function POST_FUN(){
        $this->response->end("Please use the get...");
    }
    function start(){
        if($this->request->server['request_method']=="GET"){                                                    //get的传递方式
            $this->get=@$this->request->get?$this->request->get:null;
            $this->cookie=@$this->request->cookie?$this->request->cookie:null;
            $this->smarty();
            $this->GET_FUN();
        }elseif($this->request->server['request_method']=="POST"){                                                //post传递方式

            $this->post=@$this->request->post?$this->request->post:null;
            $this->cookie=@$this->request->cookie?$this->request->cookie:null;
            $this->smarty();
            $this->POST_FUN();
        }
    }
    final public function responseEnd($reback,$data){
        $this->response->header("Access-Control-Allow-Origin", "*");
        $this->response->header("Content-Type","text/html;charset=utf-8");
        if(is_array($data)){
            $data_str=json_encode($data);
        }elseif(is_string($data)){
            $data_str=$data;
        }
        $back_end='{"type":"'.$reback.'","data":'.$data_str.'}';
        $this->rd->setex($this->exeid,10,$back_end);
        $this->response->end($back_end);
    }
    //得到一个查询数据的索引
    final public function DBReadLink(){
        $dblink=$this->read_db->get_link();
        return $dblink;
    }
    final public function DBUpdateLink(){
        $dblink=$this->update_db->get_link();
        return $dblink;
    }

    //查询一条数据
    final public  function  DBselect($tablename,$where="1=1",$list="*"){
        $sql="select {$list} from {$tablename} where {$where}";
        $dblink=$this->read_db->get_link();
        $result=$dblink->query($sql);
        $this->read_db->reback_link($dblink);
        if($dblink->errorCode()=='00000'){
            if($result && $result->rowCount()>0){
                $resultjgs=$result->fetchAll(PDO::FETCH_ASSOC);
                return $resultjgs[0];
            }elseif($result && $result->rowCount()==0) {
                return 0;
            }
            echo "{$sql}执行成功\n";
        }else{
            echo "********************错误原因：******************\n";
            echo "执行命令：".$sql."\n";
            $error=$dblink->errorInfo();
            echo "mysqli提示:".$error['2']."\n";
        }
    }
    //查询一条数据
    final public  function  DBselectAll($tablename,$where="1=1",$list="*",$ordery='order by id desc',$limit=''){
        $sql="select {$list} from {$tablename} where {$where} {$ordery} {$limit}";
        $dblink=$this->read_db->get_link();
        $result=$dblink->query($sql);
        $this->read_db->reback_link($dblink);
        if($dblink->errorCode()=='00000'){
            if($result && $result->rowCount()>0){
                $resultjgs=$result->fetchAll(PDO::FETCH_ASSOC);
                return $resultjgs;
            }elseif($result && $result->rowCount()==0) {
                return 0;
            }
            echo "{$sql}执行成功\n";
        }else{
            echo "********************错误原因：******************\n";
            echo "执行命令：".$sql."\n";
            $error=$dblink->errorInfo();
            echo "mysqli提示:".$error['2']."\n";
        }

    }
    /**
     * 对数据表的一条数据进行修改，
     * $tablename数据表
     * $set修改的字段和值
     * $where修改条件；
     */
    public final function DBupdate($tablename,$set,$where='1=1'){
        //正式修改一条数据；
        $sql="update {$tablename} set {$set} where {$where}";
        $dblink=$this->update_db->get_link();
        $result= $dblink->exec($sql);
        $this->update_db->reback_link($dblink);
        if($dblink->errorCode()=='00000'){
            if($result){
                return $result;
            }elseif($result==0) {
                return 0;
            }
            echo "{$sql}执行成功\n";
        }else{
            $error=$dblink->errorInfo();
            echo "********************错误原因：******************\n";
            echo "执行命令：".$sql."\n";
            echo "mysqli提示:".$error[2]."\n";
            return 0;
        }
    }
    /**
     * 向数据库表中插入一条数据；
     * 这个方法自动开启锁表功能，
     * $tablename表的名字，
     * $keys表示表的字段，
     * $values是表字段的values，
     */
    final public  function DBinsert($tablename,$keys,$values,$resutState=0){
        $sql="insert into {$tablename} ({$keys}) values ({$values})";
        $dblink=$this->update_db->get_link();
        $result = $dblink->exec($sql);
        $this->update_db->reback_link($dblink);
        if($dblink->errorCode()=='00000'){
            if($resutState==0) {
                return $result;
            }else if($resutState==1){
                return $dblink->lastInsertId('id');
            }else{
                return $result;
            }
        }else{
            echo "********************错误原因：******************\n";
            $error=$dblink->errorInfo();
            echo "执行SQL：".$sql."\n";
            echo "错误提示：".$error['2']."\n";
            return 0;
        }
    }
    final public function DBdelete($tablename,$where="1=1"){
        $sql="delete from {$tablename} where {$where}";
        $dblink=$this->update_db->get_link();
        $result = $dblink->exec($sql);
        if($dblink->errorCode()=='00000'){
            return true;
        }else{
            echo "********************错误原因：******************\n";
            $error=$dblink->errorInfo();
            echo "执行SQL：".$sql."\n";
            echo "错误提示：".$error['2']."\n";
            return 0;

        }
    }

    //检查session是否有效，有效返回值
    function session_vi($session_str){
        $result=$this->rd->get($session_str);
        if($result){
            $this->rd->setex($session_str,SESSION_YX,$result);                           //延长有效时间
            return $result;
        }else{
            return false;
        }
    }
   //修改session的值
    function session_data($session_str,$session_data){
        if(is_array($session_data)){
            $session_data_str=json_encode($session_data);
        }else{
            $session_data_str=$session_data;
        }
        $reuslt_fool=$this->rd->setex($session_str,SESSION_YX, $session_data_str);
        return $reuslt_fool;
    }
    //删除session值
    function session_del($session_str){
        $result_num=$this->rd->del($session_str);
        return $result_num;
    }
    public function assign($key,$value){
        $this->smarty->assign($key,$value);
    }
    //smarty的创建
    function smarty(){
        $this->smarty=new Smarty();
        $this->smarty->setTemplateDir($this->homeUrl."/views/");
        $this->smarty->setCacheDir($this->homeUrl."/smarty/cachedir/");
        $this->smarty->setCompileDir($this->homeUrl."/smarty/compiledir/");
        $this->smarty->setLeftDelimiter("<{");
        $this->smarty->setRightDelimiter("}>");
    }
    public function display($tepUrl){
        ob_start();
        $this->smarty->display($tepUrl);
        $result=ob_get_contents();
        ob_end_clean();
        $this->response->end($result);
    }

    //tcpclient链接
    public function tcpClient($serverIndex,$sendString){
        $dblink=$this->DBReadLink();
        $result=$dblink->query("select aa.NetUrl,aa.TelnetPort,bb.NetUrl as mNetUrl,bb.TelnetPort as mTelnetPort from gameServer as aa LEFT JOIN  gameServer as bb ON aa.MasterServerIndex=bb.id where aa.id='{$serverIndex}'");
        $result_a=$result->fetchAll(PDO::FETCH_ASSOC);
        $ip=$result_a['mNetUrl']?$result_a['mNetUrl']:$result_a['NetUrl'];
        $port=$result_a['mTelnetPort']?$result_a['mTelnetPort']:$result_a['TelnetPort'];
        try {
            $client = new swoole_client(SWOOLE_SOCK_TCP);
            if ($client->connect($ip, $port,3)) {
                $client->send($sendString);
                @$result = $client->recv();
                $client->close();
            }

        }catch (Exception $e){
            echo $e->getMessage();
        }
        return substr($result,5);
    }
    public function TelnetSend($NetUrl,$Port,$sendString){
        try{
            $client = new swoole_client(SWOOLE_SOCK_TCP);
            $clientStatus=$client->connect($NetUrl, $Port,3);
            if($clientStatus){
                $client->send($sendString);
                @$result = $client->recv();
                $client->close();
                return $result;
            }else{
                echo "无法链接服务器！";
                return false;
            }

        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }



    public function requestTransfer($request)
    {
        $wk_object = new $request($this->request, $this->response, $this->homeUrl, $this->my_friends, $this->tables, $this->read_db, $this->update_db, $this->rd,$this->main);
        $wk_object->start();
    }
    final public function DoingLog($user,$className,$parameter,$ip){
        $this->DBinsert();
    }
}
?>