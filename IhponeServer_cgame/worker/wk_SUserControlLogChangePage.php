<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/15
 * Time: 13:59
 */
class wk_SUserControlLogChangePage extends e_ServiceWorker{
    function  Admin($cookie,$cookieKey){
        $showId=$this->get['showId'];
        $className=$this->get['className'];
         if($showId && $className){
             $cookie[$className.'ShowPage']=$showId;
             $cookieName=$this->main['cookieName'];
             $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
             $this->response->end('{"status":"2000"}');
         }else{
             $this->response->end('{"status":"2001","message":"参数错误！"}');
         }
    }
}




?>