<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/20
 * Time: 16:57
 */
class wk_UserServerSelectGet extends  e_UserWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $cookie['serverIndex']=$serverIndex;
        $cookieName=$this->main['cookieName'];
        $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
        $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
    }
}