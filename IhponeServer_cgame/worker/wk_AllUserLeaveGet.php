<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/4
 * Time: 14:28
 */
class wk_AllUserLeaveGet extends e_DataWorker{
    function Admin($cookie,$cookieKey){

        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        $startDayTime=strtotime($startDay);

        if($startDayTime<time() && $startDay < $endDay){
            $cookieName=$this->main['cookieName'];
            $cookie['AllUserLeaveStartDay']= $startDay;
            $cookie['AllUserLeaveEndDay']=$endDay;
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}



?>