<?php
/**
 * 玩结束
 */
class wk_test extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $this->display("Admin/joinInto.html");
    }
}
?>