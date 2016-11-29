<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/29
 * Time: 16:54
 */
class wk_OAllCreateReportGet extends  e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $startDay=$this->get['startDay'];

        $startDayTime=strtotime($startDay);

        if($startDayTime){
            $cookieName=$this->main['cookieName'];
            $cookie['DayReportStartDay']= $startDay;

            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}
