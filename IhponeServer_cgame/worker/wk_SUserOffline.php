<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/12
 * Time: 16:36
 */
class wk_SUserOffline extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);
        foreach($serverS as $vv){
            $serverS_cl[$vv['id']]=$vv['GameServerUnid'];
        }
        $this->display("Service/SUserOffline.html");

    }
}


?>