<?php
/**
 * 日表报提交
 */
class wk_UserLoginLogGet extends   e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        @$whereKey=$this->get['whereKey'];
        $startDayTime=strtotime($startDay);
        $endDayTime=strtotime($endDay);
        $className=$this->get['className'];
        if($startDayTime<=$endDayTime){
            if(($endDayTime-$startDayTime)/(24*3600) < 2) {
                $cookieName = $this->main['cookieName'];
                $cookie['serverIndex'] = $serverIndex;
                $cookie['DayReportStartDayS'] = $startDay;
                $cookie['DayReportEndDayS'] = $endDay;
                $cookie['whereKey'] = $whereKey;
                $serverS = $this->DBselectAll("gameServer", "ObjectId='{$cookie['objectGround']}'", "id,GameServerUnid");
                foreach ($serverS as $vv) {
                    if ($serverIndex == $vv['id']) {
                        $cookie['serverUnid'] = $vv['GameServerUnid'];
                    }
                }
                unset($cookie['UserLoginLogChangePageInt']);
                unset($cookie[$className.'BlurClassUNID']);
                unset($cookie[$className.'BlurValue']);
                $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
                $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
            }else{
                $this->response->end(json_encode(array("status" => "10002", "message" => "超过查询天数！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}