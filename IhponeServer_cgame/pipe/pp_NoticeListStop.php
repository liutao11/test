<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/9/14
 * Time: 14:42
 */
class pp_NoticeListStop extends pipe{
    function exe(){
        echo "111";
        $noticeListId=$this->data['noticeListId'];
        try {
            swoole_timer_clear($this->data['timerTickId']);
        }catch (Exception $e){

        }

        $this->DBupdate("NoticeList","state=3","id={$noticeListId}");
    }
}


?>