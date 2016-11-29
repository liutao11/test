<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/10/9
 * Time: 18:04
 */
class wk_FAllServerPayList extends wk_FAllServerPay{
    function Admin($cookie,$cookieKey){
        if(@$cookie['DayReportStartDay'] && $cookie['DayReportEndDay']){
            $StartDay=$cookie['DayReportStartDay'];
            $EndDay=$cookie['DayReportEndDay'];
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");
        }
        $ExchangeRate=$this->main['ExchangeRate'];
        $this->assign("ExchangeRate",$ExchangeRate);
        $className=__CLASS__;
        $this->assign("className",$className);
        $this->assign('class',$className);
        @$roleKey0=$cookie[$className.'roleKey0']?$cookie[$className.'roleKey0']:'';
        @$roleKey1=$cookie[$className.'roleKey1']?$cookie[$className.'roleKey1']:'';
        $this->assign("roleKey0",$roleKey0);
        $this->assign("roleKey1",$roleKey1);
        $this->assign("StartDay",$StartDay);
        $this->assign("EndDay",$EndDay);
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        $serverKeyValue=array();
        foreach($serverS as $vv){
            $serverKeyValue[$vv['id']]=$vv['GameServerUnid'];
        }
        if($cookie['serverIndex']){
            $serverIndex=$cookie['serverIndex'];

        }else{
            $serverIndex=$serverS[0]['id'];
        }

        $this->assign('serverIndex',$serverIndex);
        if(@$cookie['serverIndex'] && $serverIndex ){
            $data=array();

            $pagelength=30;
            @$showPageInt=$cookie[$className.'ShowPage']?$cookie[$className.'ShowPage']:1;
            $DBGameName="";
            foreach($serverS as $server){
                if($server['id']==$serverIndex){
                    $DBGameName=$server['DBGameName'];
                    break 1;
                }
            }
            $sql="select count(nIndex) as listSum from PayList_v where serverId='{$DBGameName}'";

            $sum_link=$this->DBReadLink();
            $sum_result=$sum_link->query($sql);
            if($sum_result) {
                $sum_array = $sum_result->fetch(PDO::FETCH_ASSOC);
            }
            $ListSum=$sum_array['listSum'];
            $limitStart=($showPageInt-1)*$pagelength;
            $limitEnd=($showPageInt)*$pagelength;
            $sql="select * from PayList_v where serverId='{$DBGameName}' ORDER by Ctime desc limit {$limitStart},{$pagelength}";
            var_dump($sql);
            $data_result=$sum_link->query($sql);
            $data=$data_result->fetchAll(PDO::FETCH_ASSOC);
            $this->assign('data',$data);
            $pageSum = ceil($ListSum / $pagelength);
            $this->assign("pageSum", $pageSum);
            $this->assign("pageSumTo5", $pageSum - 5);
            $this->assign("pageSumTo11", $pageSum - 11);
            $this->assign("showPageInt",$showPageInt);
            $this->assign("showPageIntS5", $showPageInt - 5);
            $this->assign("showPageIntA5", $showPageInt + 5);
            $this->assign("pageSum_11", $pageSum - 11);
            $this->assign('pagelength', $pagelength);
        }else{
            $this->assign('serverIndex',0);
            $this->assign('data','');
            $this->assign("pageSum",0);
            $this->assign("pageSumTo5", 0);
            $this->assign("pageSumTo11",0);
            $this->assign("showPageInt",0);
            $this->assign("showPageIntS5", 0);
            $this->assign("showPageIntA5", 0);
            $this->assign("pageSum_11", 0);
            $this->assign('pagelength',0);

        }


        $this->display("Data/FAllServerPayList.html");
    }
}


?>