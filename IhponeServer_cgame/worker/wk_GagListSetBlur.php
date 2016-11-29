<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/1
 * Time: 16:17
 */
class wk_GagListSetBlur extends e_ServiceWorker{
    function  Admin($cookie,$cookieKey){
        $GagListSetBlurIndex=$this->get['index']+1;
        $GagListSetBlurValue=$this->get['value'];
        if($GagListSetBlurIndex){
            $cookieName = $this->main['cookieName'];
            $cookie['GagListSetBlurIndex']=$GagListSetBlurIndex;
            $cookie['GagListSetBlurValue']=$GagListSetBlurValue;
            $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "2001", "message" => "确实参数！")));
        }
    }
}





?>