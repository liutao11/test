<?php
/**
 * Created by PhpStorm.
 */
class wk_UserLoginLogChangePage extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $showId=$this->get['showId'];

        if($showId){
            $cookieName = $this->main['cookieName'];
            $cookie['UserLoginLogChangePageInt'] = $showId;
            $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}

?>