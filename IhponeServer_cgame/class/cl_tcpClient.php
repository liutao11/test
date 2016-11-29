<?php
/**
 * Created by PhpStorm.
 * User: 019
 * Date: 2015/11/12
 * Time: 10:30
 *
 *
$client = new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);//设置事件回调函数
$client->on("connect", function($cli) {
if($Uname){

}
$end='{"sss":"hello world"}';
$length=strlen($end)+2;
$cli->send(pack('s',$length).pack('s','1').pack('s','2531').$end);
});
$client->on("receive", function($cli, $data){
echo "Received: ".$data."\n";
});
$client->on("error", function($cli){
echo "Connect failed\n";
});
$client->on("close", function($cli){
echo "Connection close\n";
});
//发起网络连接
$client->connect('10.2.19.27',8002, 0.5);
 */
class cl_tcpClient {

    public $key;
    public $endString;
    private $tcpclient;
    public $resultData;
    function  __construct($ip,$port,$key,$endString){
        $this->key=$key;
        $this->endString=$endString;
        $this->tcpclient=new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
        $this->tcpclient->on("connect",array($this,'OnConnect'));
        $this->tcpclient->on("receive",array($this,'OnReceive'));
        $this->tcpclient->on("error",array($this,"OnError"));
        $this->tcpclient->on('close',array($this,"OnClose"));
        $this->tcpclient->connect($ip,$port, 0.5);
    }
    function OnConnect($cli){
        $end=$this->endString;
        $length=strlen($end)+2;
        $cli->send(pack('s',$length).pack('s','1').pack('s',$this->key).$end);
        echo "***********";
        var_dump($end);
    }
    function OnReceive($cli,$data){
        $this->resultData=$data;
    }
    function OnError($cli){
        echo "error";
    }
    function OnClose($cli){
        echo "close";
    }
    function data(){
        return $this->resultData;
    }
}


?>