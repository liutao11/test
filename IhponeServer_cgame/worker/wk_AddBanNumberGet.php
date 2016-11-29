<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/2
 * Time: 9:58
 */
class wk_AddBanNumberGet extends e_ServiceWorker {
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $roleS=$this->get['roleS'];
        $message=$this->get['message'];
        if($serverIndex && $roleS && $message ){
            $result= $this->DBselect("gameServer","id={$serverIndex}",'GameServerUnid');
            $GameServerUnid=$result['GameServerUnid'];
            $cTime=time();
            $state=1;
            $result=$this->DBinsert("BanNumber","serverIndex,roleS,message,CTime,sendState,serverUnid,userName","'{$serverIndex}','{$roleS}','{$message}','{$cTime}','{$state}','{$GameServerUnid}','{$cookie['username']}'");
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