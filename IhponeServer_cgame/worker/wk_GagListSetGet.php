<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/1
 * Time: 15:48
 */
class wk_GagListSetGet extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $cookieName = $this->main['cookieName'];
        $cookie['serverIndex']=$serverIndex;

        unset($cookie['GagListSetBlurIndex']);
        unset($cookie['GagListSetBlurValue']);
        unset($cookie['BanNumberSetBlurIndex']);
        unset($cookie['BanNumberSetBlurValue']);
        $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
        $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
    }
}




?>