<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/4
 * Time: 14:28
 */
class wk_DUserPayTableGet extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $className=$this->get['className'];
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        $startDayTime=strtotime($startDay);
        $endDayTime=strtotime($endDay);
        if($startDayTime<time() && $startDayTime <= $endDayTime && $className){
            $cookieName=$this->main['cookieName'];
            $cookie['serverIndex']=$serverIndex;
            $cookie[$className.'StartDay']= $startDay;
            $cookie[$className.'EndDay']=$endDay;
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}



?>