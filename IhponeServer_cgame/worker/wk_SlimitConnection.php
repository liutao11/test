<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/11/25
 * Time: 14:46
 */
class wk_SlimitConnection extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);
        foreach($serverS as $vv){
            $serverS_cl[$vv['id']]=$vv['GameServerUnid'];
        }
        $this->display("Service/SlimitConnection.html");

    }
}