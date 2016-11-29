<?php
/**
元宝审核提交
 */

class wk_AcerInspectGet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $objectIndex=$this->get['objectIndex'];
        $serverIndex=$this->get['serverIndex'];
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        $startDayTime=strtotime($startDay);
        $endDayTime=strtotime($endDay);
        if($objectIndex && $startDayTime<$endDayTime) {
            $cookieName = $this->main['cookieName'];
            $cookie['objectIndex']=$objectIndex;

            $cookie['serverIndex'] = $serverIndex;
            $cookie['DayReportStartDay']= $startDay;
            $cookie['DayReportEndDay']=$endDay;

            unset($cookie['AcerInspectBlurIndex']);
            unset($cookie['AcerInspectBlurValues']);

            $serverS = $this->DBselectAll("gameServer", "ObjectId='{$objectIndex}'", "id,GameServerUnid");
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