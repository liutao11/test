<?php
/**
 * 玩结束
 */
class wk_favicion extends worker{
    function GET_FUN(){
        $this->response->end(file_get_contents($this->homeUrl."/views/img/favicon.ico"));
    }
}
?>