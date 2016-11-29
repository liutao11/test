<?php
/**
 * 客服最晚间信息查询
 */
class wk_ServiceSelectUserInfo extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName,ServerTitle");
        $this->assign('serverS',$serverS);
        foreach($serverS as $vv){
            $serverS_cl[$vv['id']]=$vv['GameServerUnid'];
        }
        $this->display("Service/ServiceSelectUserInfo.html");
    }
}


?>