<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/8/19
 * Time: 11:45
 */
class wk_ObjectNoticeSetGet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $notice_content=trim($this->get['notice_content']);
        $key=$this->main['cookieName']."Object_Notice_Content";
        $this->rd->set($key,$notice_content);
        $this->response->end(json_encode(array("status" => "10002", "message" => "操作成功")));
    }
}

?>