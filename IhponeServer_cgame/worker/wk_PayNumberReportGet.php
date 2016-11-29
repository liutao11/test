<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/9/21
 * Time: 17:51
 */
class wk_PayNumberReportGet extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        $startDayTime=strtotime($startDay);
        $endDayTime=strtotime($endDay);
        $className=$this->get['className'];
        $styleValues=$this->get['styleValues'];

        if($startDayTime<=$endDayTime && $className && $styleValues && $serverIndex){
            $cookieName=$this->main['cookieName'];
            $cookie['serverIndex']=$serverIndex;
            $cookie[$className.'StartDay']= $startDay;
            $cookie[$className.'EndDay']=$endDay;
            $cookie[$className."style"]=$styleValues;
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}


?>