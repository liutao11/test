<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/2
 * Time: 10:17
 */
class wk_BanNumberSet extends e_ServiceWorker{
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

        if(@$cookie['BanNumberSetBlurIndex'] && $cookie['BanNumberSetBlurValue']){
            $this->assign('index',$cookie['BanNumberSetBlurIndex']);
            $this->assign('value',$cookie['BanNumberSetBlurValue']);
            if($cookie['BanNumberSetBlurIndex']==1){
                $sql_where_like="and roleS like '%{$cookie['BanNumberSetBlurValue']}%'";
            }elseif($cookie['BanNumberSetBlurIndex']==2){
                $sql_where_like="and message like '%{$cookie['BanNumberSetBlurValue']}%'";
            }elseif($cookie['BanNumberSetBlurIndex']==3){
                $sql_where_like="and userName = '{$cookie['BanNumberSetBlurValue']}'";
            }
        }else{
            $this->assign('index','');
            $this->assign('value','');
            $sql_where_like='';
        }
        $data=$this->DBselectAll("BanNumber","{$sql_where_serverinde} {$sql_where_like}",'*','order by id desc','limit 0,100');
        $pagelength=20;
        $this->assign("pageSum",ceil(count($data)/$pagelength));
        $this->assign('pagelength',$pagelength);
        $this->assign('data',$data);


        $this->display("Service/BanNumberSet.html");
    }
}




?>