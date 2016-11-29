<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/8/19
 * Time: 11:07
 */
class wk_ObjectNoticeSet extends  e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $this->assign("groundId",$cookie['groundId']);
        $this->assign("data",$this->DBselectAll('objectS'));
        $key=$this->main['cookieName']."Object_Notice_Content";
        $content=$this->rd->get($key)?$this->rd->get($key):'';
        var_dump($content);
        $this->assign("content",$content);
        $this->display('Admin/ObjectNoticeSet.html');
    }
}
?>