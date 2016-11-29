<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/12
 * 踢人下线提交
 */
class wk_SUserOfflineGet extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $roleS=trim($this->get['roleS']);
        $setType=$this->get['setType'];
        $message=$this->get['message'];
        $username=$cookie['username'];
        $roleSType=$this->get['roleSType'];
        if($roleS && $serverIndex && $setType && $username && $roleSType){

            $result=$this->DBselect('gameServer',"id='{$serverIndex}'",'GameServerUnid,NetUrl,TelnetPort');
            if($roleSType==1) {
                if ($setType == '1') {
                    $sendString = "KICK {$roleS}\\";
                } elseif ($setType == '2') {
                    $sendString = "GAG {$roleS} 0\\";
                } elseif ($setType == '3') {
                    $sendString = "DENYCHRNAMELOGON {$roleS} 1\\";
                } elseif ($setType == '4') {
                    $sendString = "UNGAG {$roleS}\\";
                } elseif ($setType == '5') {
                    $sendString = "DENYCHRNAMELOGON {$roleS} 0\\";
                }
            }elseif($roleSType==2){
                if ($setType == '1') {
                    $sendString = "DENYACCOUNTLOGON {$roleS} 1\\";
                } elseif ($setType == '2') {
                    $sendString = "DENYACCOUNTLOGON {$roleS} 0\\";
                }
            }
            $sendStatus=$this->TelnetSend($result['NetUrl'],$result['TelnetPort'],$sendString);
            if($sendStatus){
                $Ctime=time();
                $this->DBinsert('UserControlLog',"serverUNID,roleS,CTime,message,setType,setUser,sendType","'{$result['GameServerUnid']}','{$roleS}','{$Ctime}','{$message}','{$setType}','{$username}',1");
                $this->response->end('{"status":2001,"message":"ok！"}');
            }else{
                $Ctime=time();
                $this->DBinsert('UserControlLog',"serverUNID,roleS,CTime,message,setType,setUser,sendType","'{$result['GameServerUnid']}','{$roleS}','{$Ctime}','{$message}','{$setType}','{$username}',0");
                $this->response->end('{"status":2001,"message":"操作失败！"}');
            }
        }else{
            $this->response->end('{"status":2001,"message":"参数错误！"}');
        }
    }
}



?>