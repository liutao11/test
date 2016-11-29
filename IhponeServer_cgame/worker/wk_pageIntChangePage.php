<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/7
 * Time: 11:46
 */
class wk_pageIntChangePage extends c_web{
    function Admin($cookie,$cookieKey){
        $className=$this->get['className'];
        $showId=$this->get['showId'];
        if($className && $showId){
            $cookieName=$this->main['cookieName'];
            $cookie[$className.'ChangePageInt']=$showId;
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}


?>