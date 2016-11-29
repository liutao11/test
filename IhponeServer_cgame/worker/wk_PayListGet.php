<?php
/**
 * 日表报提交
 */
class wk_PayListGet extends   e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        $roleKey0=$this->get['roleKey0'];
        $roleKey1=$this->get['roleKey1'];
        $startDayTime=strtotime($startDay);
        $endDayTime=strtotime($endDay);
        $class=$this->get['class']?$this->get['class']:"";

        if($startDayTime<=$endDayTime){
            $cookieName=$this->main['cookieName'];
            $cookie['serverIndex']=$serverIndex;
            $cookie['DayReportStartDay']= $startDay;
            $cookie['DayReportEndDay']=$endDay;
            $cookie[$class.'roleKey0']=$roleKey0;
            $cookie[$class.'roleKey1']=$roleKey1;
            $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}'","id,GameServerUnid");
            foreach($serverS as $vv){
                if($serverIndex==$vv['id']){
                    $cookie['serverUnid']=$vv['GameServerUnid'];
                }
            }
            if($class){
                unset($cookie[$class.'ShowPage']);
            }
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}