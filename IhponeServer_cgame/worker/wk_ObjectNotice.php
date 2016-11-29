<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/8/19
 * Time: 14:06
 */
class wk_ObjectNotice extends worker{
    function GET_FUN(){
        $this->response->header("Content-Type", "text/html;charset=utf-8");
        $key=$this->main['cookieName']."Object_Notice_Content";
        $notice_content=$this->rd->get($key);
        $this->response->end('{"loginBulltin":"'.$notice_content.'"}');
    }
}

?>