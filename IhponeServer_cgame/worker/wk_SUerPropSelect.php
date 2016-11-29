<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/9/27
 * Time: 11:59
 */
class wk_SUerPropSelect extends e_ServiceWorker{
    function  Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName,ServerTitle");
        $this->assign('serverS',$serverS);
        $ExchangeRate=$this->main['ExchangeRate'];
        $this->assign("ExchangeRate",$ExchangeRate);
        $this->display("Service/SUerPropSelect.html");
    }
}



?>