<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/15
 * Time: 17:58
 */
class wk_ObjectSet extends  e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $this->assign("groundId",$cookie['groundId']);
        $this->assign("data",$this->DBselectAll('objectS'));
        $this->display('Admin/ObjectSet.html');
    }
}