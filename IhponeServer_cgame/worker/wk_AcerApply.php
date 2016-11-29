<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/27
 * Time: 19:12
 */
class wk_AcerApply extends e_OperatorsWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and IsClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);

        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $serverIndex=$cookie['serverIndex'];
        }else{
            $serverIndex=$serverS[0]['id'];

        }
        $this->assign('serverIndex',$serverIndex);
        $this->display("Operators/AcerApply.html");

    }
}


?>