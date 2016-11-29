<?php
/**
 * 游戏数据库连接
 */
class cl_gamedb{
    private $mydbLink;            //php程序自身所带的数据库索引
    private $redisLink;
    private $netUrl;            //拥有的平台
    private $port;                //是否选择区服号
    private $user;               //数据名，1 游戏库，2，日志库，3，不指定数据
    private $password;                //redis链接指针
    private $dbname;
    private $redisTime;           //redis保持时间

    function __construct($netUrl,$port,$user,$password,$dbname,$redisLink,$redisTime='300'){

        $this->netUrl=$netUrl;
        $this->port=$port;
        $this->user=$user;
        $this->password=$password;
        $this->dbname=$dbname;
        $this->redisLink=$redisLink;
        $this->redisTime=$redisTime;
    }
    function query($sql,$Time=''){
        $bufferKey="GMDB::" . $this->netUrl.'::'.$this->dbname."::".md5($sql);
        $rdResult=$this->redisLink->get($bufferKey);
        if($rdResult){
            return json_decode($rdResult,true);
        }else {
            echo "没有缓冲数据{$sql}\n";
            $msdb=new PDO ("dblib:host={$this->netUrl}:{$this->port};dbname={$this->dbname}",$this->user,$this->password);
            $result =$msdb->query($sql);
            if(!$result){
                return false;
            }else {
                $row_array = $result->fetchAll(PDO::FETCH_ASSOC);
                $resultdb= $row_array;
                $rdTime = $Time ? $Time : $this->redisTime;
                $this->redisLink->setex($bufferKey, $rdTime, json_encode($resultdb));
                return $resultdb;
            }
        }
    }
}



?>