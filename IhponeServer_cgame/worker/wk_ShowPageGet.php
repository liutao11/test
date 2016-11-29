<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/17
 * Time: 12:56
 */
class wk_ShowPageGet extends c_web{
    function Admin($cookie,$cookieKey){
        $class=$this->get['class'];
        $pageInt=$this->get['pageInt'];
        if($class && $pageInt){
            $cookieName=$this->main['cookieName'];
            $cookie[$class.'ShowPage']= $pageInt;
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        } else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}




?>