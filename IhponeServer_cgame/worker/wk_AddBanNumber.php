<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/1
 * Time: 18:27
 */
class wk_AddBanNumber extends  e_ServiceWorker{
    function  Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);


        $this->display("Service/AddBanNumber.html");
    }
}




?>