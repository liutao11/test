<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/28
 * Time: 9:21
 */
class wk_AcerApplyList extends e_OperatorsWorker{
    function  Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}'","id,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);

        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $serverIndex=$cookie['serverIndex'];
        }else{
            $serverIndex=0;

        }

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
        @$index=$cookie['AcerApplyListBlurIndex']?$cookie['AcerApplyListBlurIndex']:0;
        @$value=$cookie['AcerApplyListBlurValues']?$cookie['AcerApplyListBlurValues']:0;
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

        $data=$this->DBselectAll('AcerApply',"ApplyTime >= '{$startDayTime}' and ApplyTime <= '{$endDayTime}' and objectId='{$cookie['objectGround']}' {$sql_butter_b} ",'*',"order by id desc",'limit 0,100');
        $this->assign("data",$data);
        $pagelength=20;
        $this->assign("pageSum",ceil(count($data)/$pagelength));
        $this->assign('pagelength',$pagelength);
        $this->assign('serverIndex',$serverIndex);
        $this->display("Operators/AcerApplyList.html");
    }
}



?>