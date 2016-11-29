<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/7/27
 * Time: 14:03
 */
class wk_OVirtualPayList extends e_OperatorsWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and IsClose=1","id,GameServerUnid,DBGameName,DBLogName,ServerTitle");
        $this->assign('serverS',$serverS);
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $serverIndex=$cookie['serverIndex'];
        }else{
            $serverIndex=$serverS[0]['id'];
        }
        $this->assign('serverIndex',$serverIndex);
        $this->display("Operators/VirtualPayList.html");
    }
}

?>