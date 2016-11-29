<?php
/**
工会列表
 */
class wk_UserOrganize extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}'","id,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $serverIndex=$cookie['serverIndex'];
        }else{
            $serverIndex=$serverS[0]['id'];

        }

        $this->assign('serverIndex',$serverIndex);
        $data='';

        $this->assign("data",$data);
        $pagelength=20;
        $this->assign("pageSum",ceil(count($data)/$pagelength));
        $this->assign('pagelength',$pagelength);
        $this->display("Service/UserOrganize.html");
    }
}


?>