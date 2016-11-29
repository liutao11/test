<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/18
 * Time: 16:46
 */
class wk_OSendPropNumberEmil extends  e_OperatorsWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and IsClose=1","id,GameServerUnid,DBGameName,DBLogName,ServerTitle");
        $this->assign('serverS',$serverS);
        $cookieName=$this->main['cookieName'];
        unset($cookie['SendPropEmilGet_Buffer_serverS']);
        unset($cookie['SendPropEmilGet_Buffer_PropS']);
        $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
        $this->display("Operators/SendPropNumberEmil.html");

    }
}

?>