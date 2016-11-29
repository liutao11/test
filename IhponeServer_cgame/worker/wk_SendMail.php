<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/2
 * Time: 16:16
 */
class wk_SendMail extends e_OperatorsWorker{
    function  Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and IsClose=1","id,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $serverIndex=$cookie['serverIndex'];
        }else{
            $serverIndex=$serverS[0]['id'];
        }
        $this->assign('serverIndex',$serverIndex);
        $this->display("Operators/SendMail.html");


    }
}


?>