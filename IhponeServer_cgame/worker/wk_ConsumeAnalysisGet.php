<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/16
 * Time: 20:47
 */
class wk_ConsumeAnalysisGet extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        $serverIndex=$this->get['serverIndex'];
        $DoingIndex=$this->get['DoingIndex'];
        $className=$this->get['className'];
        if($startDay && $endDay && strtotime($startDay)<=strtotime($endDay) ) {
            if ((strtotime($endDay)-strtotime($startDay))/(24*3600)<=7){
                $cookieName = $this->main['cookieName'];
                $cookie[$className . 'StartDay'] = $startDay;
                $cookie[$className . 'EndDay'] = $endDay;
                $cookie['DoingIndex'] = $DoingIndex;
                @$cookie['serverIndex'] = $serverIndex ? $serverIndex : "0";
                unset($cookie['ConsumeRankingShowPage']);
                $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
                $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
           }else{
                $this->response->end(json_encode(array("status" => "10002", "message" => "超过了查询天数！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}



?>