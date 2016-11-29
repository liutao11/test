<?php
/**
 * 玩结束
 */
class wk_UserSet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $this->assign("groundId",$cookie['groundId']);
        $this->assign("roleS",$this->main['roleS']);
        $objectS=$this->DBselectAll("objectS");
        $this->assign("objectS",$objectS);
        $this->assign("rolesJson",json_encode($this->main['roleS']));
        $this->assign("fromInfo",$this->main['fromInfo']);
        $this->assign("YJSKIDArray","");
        foreach($objectS as $vv){
            $objectS_b[$vv['id']]=$vv['title'];
        }
        $this->assign('object_b_json',json_encode($objectS_b));
        $this->assign('objectS_b',$objectS_b);
        $this->assign("data",$this->DBselectAll('userList'));
        $this->display('Admin/UserSet.html');
    }
}
?>