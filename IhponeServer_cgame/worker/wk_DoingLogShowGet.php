<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/16
 * Time: 16:46
 */
class wk_DoingLogShowGet extends e_AdminWorker{
    function  Admin($cookie,$cookieKey){
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        if($startDay && $endDay){
            $cookieName=$this->main['cookieName'];
            $cookie['DoingLogShowStartDay']= $startDay;
            $cookie['DoingLogShowEndDay']=$endDay;
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}



?>