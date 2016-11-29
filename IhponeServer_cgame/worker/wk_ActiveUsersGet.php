<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/23
 * Time: 19:13
 */
class wk_ActiveUsersGet extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $className=$this->get['className'];
        $serverIndex=$this->get['serverIndex'];
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        if(strtotime($endDay)>=strtotime($startDay) && $serverIndex && $className){
            $cookieName=$this->main['cookieName'];
            $cookie['serverIndex']=$serverIndex;
            $cookie[$className.'startDay']= $startDay;
            $cookie[$className.'endDay']=$endDay;
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}


?>