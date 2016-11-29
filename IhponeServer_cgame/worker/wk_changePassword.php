<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/2
 * Time: 14:37
 */
class wk_changePassword extends worker{
    function GET_FUN(){
        $cookie=$this->cookie['swooleCookie'];
        $cookieHeard=$this->main['cookieName'];
        if($cookie){
            $rdresult=$this->rd->get($cookieHeard.$cookie);
            $rdresult_array=json_decode($rdresult,true);
            if($rdresult_array['joinState']){
                $this->display("Admin/changePassword.html");
            }else{
                $this->display('Admin/joinInto.html');
            }
        }else{
            $cookieKey=md5(time());
            $this->response->header("Set-Cookie","swooleCookie={$cookieKey};path=/;");
            $this->rd->setex($cookieHeard.$cookieKey,1800,json_encode(array('joinState'=>'0')));
            $this->display('Admin/joinInto.html');
        }
    }
}





?>