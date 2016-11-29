<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/21
 * Time: 20:25
 */

class wk_FIndexFromGet extends e_FromWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $cookieName = $this->main['cookieName'];
        $cookie['serverIndex']=$serverIndex;
        $this->rd->setex($cookieName.$cookieKey, 1800, json_encode($cookie));
        $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
    }
}



?>