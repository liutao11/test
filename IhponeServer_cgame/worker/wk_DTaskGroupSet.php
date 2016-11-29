<?php
/**
 * 玩结束
 */
class wk_DTaskGroupSet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $className=$this->get['className'];
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        if($serverIndex && $className && $startDay && $endDay && strtotime($startDay)<= strtotime($endDay)){
            $cookieName=$this->main['cookieName'];
            $cookie['serverIndex']= $serverIndex;
            $cookie[$className.'startDay']=$startDay;
            $cookie[$className.'endDay']=$endDay;
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}
?>