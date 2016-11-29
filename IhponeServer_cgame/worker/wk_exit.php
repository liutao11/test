<?php
/**
 * Created by PhpStorm.
 * User: 019
 * Date: 2015/11/12
 * Time: 15:06
 */
class wk_exit extends worker{
    function GET_FUN(){
        $cookie=$this->cookie['swooleCookie'];
        $cookieName=$this->main['cookieName'];
        $this->rd->del( $cookieName.$cookie);
        $this->display("Admin/joinInto.html");
    }
}




?>