<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/22
 * Time: 17:16
 */
class wk_FPayListSelectGet extends e_FromWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $roleKey0=$this->get['roleKey0'];
        $roleKey1=$this->get['roleKey1'];
        $className=$this->get['class']?$this->get['class']:"";
        if($serverIndex){
            $cookieName=$this->main['cookieName'];
            $cookie['serverIndex']=$serverIndex;
            $cookie[$className.'roleKey0']=$roleKey0;
            $cookie[$className.'roleKey1']=$roleKey1;
            if($className){
                unset($cookie[$className.'ShowPage']);
            }
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}
?>