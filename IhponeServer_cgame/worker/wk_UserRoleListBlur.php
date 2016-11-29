<?php
/**
 * Created by PhpStorm.
 */
class wk_UserRoleListBlur extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $index=$this->get['index']+1;
        $value=$this->get['value'];
        if(true){
            if($index==3) {
                if ($value == '男' || $value == '女') {
                    $cookieName = $this->main['cookieName'];
                    $cookie['UserRoleListBlurIndex'] = $index;
                    $cookie['UserRoleListBlurValues'] = $value;
                    $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
                    $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
                } else {
                    $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
                }
            }elseif($index==4){
                if ($value == '战士' || $value == '法师' || $value == '道士') {
                    $cookieName = $this->main['cookieName'];
                    $cookie['UserRoleListBlurIndex'] = $index;
                    $cookie['UserRoleListBlurValues'] = $value;
                    $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
                    $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
                } else {
                    $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
                }

            } else {
                $cookieName = $this->main['cookieName'];
                $cookie['UserRoleListBlurIndex'] = $index;
                $cookie['UserRoleListBlurValues'] = $value;
                $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
                $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}

?>