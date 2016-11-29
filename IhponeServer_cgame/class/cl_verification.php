<?php
/** 验证是否有效*/

class cl_verification{
    private $client;
    private $url;
    private $token;
    private $path_info;
    private $port;
    private $result_array;
    function __construct($url,$path_info,$token,$port='80'){
        $this->url=$url;
        $this->token=$token;
        $this->path_info=$path_info;
        $this->port=$port;

        $client=new swoole_client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_ASYNC);
        $client->on("connect",array($this,"onconnect"));
        $client->on("receive",array($this,"onreceive"));
        $client->on("close",array($this,"onclose"));
        $client->on("error",array($this,"onerror"));
        $client->connect($this->url,$this->port);
        $this->client=$client;
    }
    function is_rev(){
        var_dump($this->result_array);
        return $this->result_array;
    }
    function onconnect(swoole_client $cli){
        $cli->send("GET {$this->path_info} HTTP/1.1\r\nhost:{$this->url}\r\n\r\n");
    }
    function onreceive(swoole_client $cli, $data){
        $data_array=explode("\r\n\r\n",$data);
        $this->result_array=json_decode($data_array[1],true);

    }

    function onclose(swoole_client $cli){
        echo "close";
    }
    function onerroe(swoole_client $cli){
        echo "error";
    }
}


?>