<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/1
 * Time: 14:05
 */
class wk_AddGagGet extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $roleS=$this->get['roleS'];
        $message=$this->get['message'];
        $time=$this->get['time'];
        if($serverIndex && $roleS && $message ){
            $result= $this->DBselect("gameServer","id={$serverIndex}",'GameServerUnid');
            $GameServerUnid=$result['GameServerUnid'];
            $cTime=time();
            $state=1;
            $result=$this->DBinsert("GagList","serverIndex,roleS,message,time,CTime,sendState,serverUnid,userName","'{$serverIndex}','{$roleS}','{$message}','{$time}','{$cTime}','{$state}','{$GameServerUnid}','{$cookie['username']}'");
            if($result){
                $this->response->end(json_encode(array("status" => "10002", "message" => "操作成功！")));
            }else{
                $this->response->end(json_encode(array("status" => "10002", "message" => "操作失败！")));
            }

        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }


    }
}




?>