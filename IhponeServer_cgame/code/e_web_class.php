<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/7
 * Time: 11:54
 */
abstract class c_web extends worker{
    function GET_FUN(){
        $cookie=$this->cookie['swooleCookie'];
        $cookieName=$this->main['cookieName'];
        if($cookie){
            $cookieKey=$cookie;
            $rdresult=$this->rd->get($cookieName.$cookie);
            $rdresult_array=json_decode($rdresult,true);
            $this->Admin($rdresult_array,$cookieKey);
        }else{
            $cookieKey=md5(time());
            $this->response->header("Set-Cookie","swooleCookie={$cookieKey};path=/;");
            $this->rd->setex($cookieName. $cookieKey,1800*4,json_encode(array('joinState'=>'0')));
        }
    }
    function POST_FUN(){
        $cookie=$this->cookie['swooleCookie'];
        $cookieName=$this->main['cookieName'];
        if($cookie){
            $cookieKey=$cookie;
            $rdresult=$this->rd->get($cookieName.$cookie);
            $rdresult_array=json_decode($rdresult,true);
            $this->Admin($rdresult_array,$cookieKey);
        }else{
            $cookieKey=md5(time());
            $this->response->header("Set-Cookie","swooleCookie={$cookieKey};path=/;");
            $this->rd->setex($cookieName. $cookieKey,1800*4,json_encode(array('joinState'=>'0')));
        }
    }
    abstract function Admin($cookie,$cookieKey);
}



?>