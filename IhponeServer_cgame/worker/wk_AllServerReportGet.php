<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/9/5
 * Time: 17:22
 */
class wk_AllServerReportGet extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        $className=$this->get['className'];
        if($startDay && $endDay){
            $cookieName=$this->main['cookieName'];
            $cookie[$className.'StartDay']= $startDay;
            $cookie[$className.'EndDay']= $endDay;
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}


?>