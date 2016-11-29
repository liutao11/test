<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/2
 * Time: 15:36
 */
class wk_changePasswordGet extends worker{
    function GET_FUN(){
        $cookie=$this->cookie['swooleCookie'];
        $cookieHeard=$this->main['cookieName'];
        $oldPassword=$this->get['oldPassword'];
        $newPassword=$this->get['newPassword'];
        $cookieName=$this->main['cookieName'];
        if($cookie && $oldPassword && $newPassword){
            $rdresult=$this->rd->get($cookieHeard.$cookie);
            $rdresult_array=json_decode($rdresult,true);
            $userId=$rdresult_array['unid'];
            $result=$this->DBselect("userList","id='{$userId}'",'password');
            if(md5($oldPassword)==$result['password']){
                $result=$this->DBupdate("userList","password='".md5($newPassword)."'","id='{$userId}'");
                if($result){
                    $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
                    $this->rd->setex($cookieName. $cookie,1800,'');
                }else{
                    $this->response->end(json_encode(array("status" => "10002", "message" => "操作失败！")));
                }
            }else{
                $this->response->end(json_encode(array("status" => "10002", "message" => "当前密码错误！")));
            }

        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}




?>