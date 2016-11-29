<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/17
 * Time: 10:08
 */
class wk_ConsumeRankingPageGet extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $pageInt=$this->get['pageInt'];
        if($pageInt){
            $cookieName=$this->main['cookieName'];
            $cookie['ConsumeRankingShowPage']= $pageInt;
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}





?>