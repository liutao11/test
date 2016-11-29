<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/28
 * Time: 13:56
 */
class wk_AcreInspect extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $objectS=$this->DBselectAll('objectS');
        if(@$cookie['objectIndex']){
            $objectIndex=$cookie['objectIndex'];
            $serverIndex=$cookie['serverIndex']?$cookie['serverIndex']:0;
        }else{
            $objectIndex=$objectS[0]['id'];
            $serverIndex=0;
        }
        $this->assign('objectIndex',$objectIndex);


        $serverS=$this->DBselectAll("gameServer","isClose=1","id,GameServerUnid,ObjectId,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);
        $objectServer=array();
        foreach($serverS as $key=>$values){
            $objectServer[$values['ObjectId']][$values['id']]=$values['GameServerUnid'];
        }
        $this->assign('objectServer',$objectServer);
        $this->assign("serverS",$serverS);

        $this->assign('serverIndex',$serverIndex);
        $this->assign("objectServer",json_encode($objectServer));
        $this->assign("dServerS", $objectServer[$objectIndex]);
        if(@$cookie['DayReportStartDay'] && $cookie['DayReportEndDay']){
            $StartDay=$cookie['DayReportStartDay'];
            $EndDay=$cookie['DayReportEndDay'];
        }else{
            $StartDay=date("Y-m-d 00:00:00");
            $EndDay=date("Y-m-d 23:59:59");
        }
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);
        $startDayTime=strtotime($StartDay);
        $endDayTime=strtotime($EndDay);
        @$index=$cookie['AcerInspectBlurIndex']?$cookie['AcerInspectBlurIndex']:0;
        @$value=$cookie['AcerInspectBlurValues']?$cookie['AcerInspectBlurValues']:0;
        if($index && $value){
            if($index==1){
                $sql_butter_b=" and state='{$value}'";
            }elseif($index==2){
                $sql_butter_b=" and roleS like '%{$value}%'";
            }elseif($index==3){
                $sql_butter_b=" and number='{$value}'";
            }elseif($index==4){
                $sql_butter_b=" and isReward='{$value}'";
            }elseif($index==5){
                $sql_butter_b="and ApplyName='{$value}'";
            }elseif($index==6){
                $sql_butter_b="and inspectName='{$value}'";
            }
        }else{
            $sql_butter_b='';
        }
        $this->assign('index',$index);
        $this->assign("value",$value);

        $data=$this->DBselectAll('AcerApply',"ApplyTime >= '{$startDayTime}' and ApplyTime <= '{$endDayTime}' and objectId='{$objectIndex}' {$sql_butter_b} ",'*',"order by id desc",'limit 0,100');

        $this->assign("data",$data);
        $pagelength=20;
        $this->assign("pageSum",ceil(count($data)/$pagelength));
        $this->assign('pagelength',$pagelength);

        $this->display("Admin/AcerInspect.html");
    }
}





?>