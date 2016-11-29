<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/28
 * Time: 9:34
 */
class wk_AcerApplyListGet extends e_OperatorsWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        $startDayTime=strtotime($startDay);
        $endDayTime=strtotime($endDay);
        if($startDayTime<$endDayTime) {
            $cookieName = $this->main['cookieName'];
            $cookie['serverIndex'] = $serverIndex;
            $cookie['DayReportStartDay']= $startDay;
            $cookie['DayReportEndDay']=$endDay;
            unset($cookie['AcerApplyListBlurIndex']);
            unset($cookie['AcerApplyListBlurValues']);
            $serverS = $this->DBselectAll("gameServer", "ObjectId='{$cookie['objectGround']}'", "id,GameServerUnid");
            if ($serverIndex) {
                foreach ($serverS as $vv) {
                    if ($serverIndex == $vv['id']) {
                        $cookie['serverUnid'] = $vv['GameServerUnid'];
                    }
                }
            } else {
                $cookie['serverUnid'] = '全服';
            }
            $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}



?>