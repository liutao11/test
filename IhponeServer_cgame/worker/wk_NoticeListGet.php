<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/9/14
 * Time: 11:37
 */
class wk_NoticeListGet extends e_OperatorsWorker{
    function  Admin($cookie,$cookieKey){
        $noticeListId=$this->get['noticeListId'];
        $workerId=$this->get['workerId'];
        $timerTickId=$this->get['timerTickId'];
        $myWorkerId=$this->server->worker_id;
        if($noticeListId) {
            if($myWorkerId==$workerId){
                var_dump(222);
                try {
                    swoole_timer_clear($timerTickId);
                }catch (Exception $e){

                }
                $this->DBupdate("NoticeList","state=3","id={$noticeListId}");
            }else {
                $this->server->sendMessage('{"workerDoing":"NoticeListStop","data":{"noticeListId":'.$noticeListId.',"timerTickId":'.$timerTickId.'}}', $workerId);
            }
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "数据非法！")));
        }
    }
}




?>