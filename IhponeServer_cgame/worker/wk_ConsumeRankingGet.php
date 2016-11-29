<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/16
 * Time: 20:47
 */
class wk_ConsumeRankingGet extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $startDay=$this->get['startDay'];
        $serverIndex=$this->get['serverIndex'];
        if($startDay){
            $cookieName=$this->main['cookieName'];
            $cookie['ConsumeRankingStartDay']= $startDay;
            if(@$serverIndex) {
                $cookie['serverIndex'] = $serverIndex;
            }else{
                $cookie['serverIndex'] = 0;
            }
            unset($cookie['ConsumeRankingShowPage']);
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}



?>