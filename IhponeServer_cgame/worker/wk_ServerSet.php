<?php
/**
 * 玩结束
 */
class wk_ServerSet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $this->assign('data','');
        $this->display("Admin/ServerSet.html");
    }
}
?>