<?php
/**
 * 日表报提交
 */
class wk_HoursReportGet extends   e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $startDay=$this->get['startDay'];;
        $cookieName=$this->main['cookieName'];
        $cookie['serverIndex']=$serverIndex;
        $cookie['HoursReportDay']= $startDay;
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}'","id,GameServerUnid");
        foreach($serverS as $vv){
            if($serverIndex==$vv['id']){
                $cookie['serverUnid']=$vv['GameServerUnid'];
            }
        }
        $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
        $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));

    }
}