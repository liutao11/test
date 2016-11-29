<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/28
 * Time: 19:18
 */
class wk_GagListSet extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $this->assign('serverIndex',$cookie['serverIndex']);
            $sql_where_serverinde="serverIndex='{$cookie['serverIndex']}'";
        }else{
            $sql_where_serverinde='1=1';
            $this->assign('serverIndex',0);
        }

        if(@$cookie['GagListSetBlurIndex'] && $cookie['GagListSetBlurValue']){
            $this->assign('index',$cookie['GagListSetBlurIndex']);
            $this->assign('value',$cookie['GagListSetBlurValue']);
            if($cookie['GagListSetBlurIndex']==1){
                $sql_where_like="and roleS like '%{$cookie['GagListSetBlurValue']}%'";
            }elseif($cookie['GagListSetBlurIndex']==2){
                $sql_where_like="and message like '%{$cookie['GagListSetBlurValue']}%'";
            }elseif($cookie['GagListSetBlurIndex']==3){
                $sql_where_like="and userName = '{$cookie['GagListSetBlurValue']}'";
            }
        }else{
            $this->assign('index','');
            $this->assign('value','');
            $sql_where_like='';
        }
        $data=$this->DBselectAll("GagList","{$sql_where_serverinde} {$sql_where_like}",'*','order by id desc','limit 0,100');
        $pagelength=20;
        $this->assign("pageSum",ceil(count($data)/$pagelength));
        $this->assign('pagelength',$pagelength);
        $this->assign('data',$data);


        $this->display("Service/GagListSet.html");
    }
}


?>