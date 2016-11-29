<?php
/**
 * 玩结束
 */
class wk_ResourceServer extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $data=$this->DBselectAll("fileServer");
        $this->assign('data',$data);
        $this->display("Admin/ResourceServer.html");
    }
}
?>