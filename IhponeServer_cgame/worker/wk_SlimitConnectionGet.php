<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/11/25
 * Time: 15:08
 */
class wk_SlimitConnectionGet extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex']?$this->get['serverIndex']:0;
        $ipUrl=trim($this->get['ipUrl']);
        $setType=$this->get['setType']?$this->get['setType']:1;
        $message=$this->get['message']?$this->get['message']:"";
        $username=$cookie['username'];
        if($ipUrl && $ipUrl!=''){
            $sendState=1;
            $Ctime=time();
            $DBid=$this->DBinsert('SlimitConnectionList',"ipUrl,setType,serverIndex,CTime,userName,message,sendStatus","'{$ipUrl}','{$setType}','{$serverIndex}','{$Ctime}','{$username}','{$message}','{$sendState}'",'1');
            $arg=array("serverIndex"=>$serverIndex,"ipUrl"=>$ipUrl,"setType"=>$setType,"message"=>$message,"username"=>$username,'DBId'=>$DBid);
            $this->server->task(json_encode(["TaskClass"=>"SlimitConnectionGet","data"=>$arg]));
            $this->response->end('{"status":2001,"message":"ok！"}');
        }else{
            $this->response->end('{"status":2001,"message":"参数错误！"}');
        }

    }
}


?>