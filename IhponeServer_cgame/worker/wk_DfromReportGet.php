<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/5/24
 * Time: 20:29
 */
class wk_DfromReportGet extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        $fromId=$this->get['fromId'];
        $startDayTime=strtotime($startDay);
        $endDayTime=strtotime($endDay);
        if($startDayTime < time() && $startDay <= $endDay){
            $cookieName=$this->main['cookieName'];
            $cookie['serverIndex']=$serverIndex;
            $cookie['DayReportStartDay']= $startDay;
            $cookie['DayReportEndDay']=$endDay;
            $cookie['fromInfoId']=$fromId;
            $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}'","id,GameServerUnid");
            foreach($serverS as $vv){
                if($serverIndex==$vv['id']){
                    $cookie['serverUnid']=$vv['GameServerUnid'];
                }
            }
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}


?>