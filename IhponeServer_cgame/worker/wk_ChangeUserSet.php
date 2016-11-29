<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/15
 * Time: 17:00
 */
class wk_ChangeUserSet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $UserId=$this->post['UserId'];
        $DBtype=$this->post['DBtype'];
        if($UserId && $DBtype){
            if($DBtype==1) {
                $result=$this->DBupdate("userList", 'type=2', "id='{$UserId}'");
            }elseif($DBtype==2){
                $result=$this->DBupdate("userList", 'type=1', "id='{$UserId}'");
            }
            if($result){
                $this->response->end(json_encode(array("status" => "10002", "message" => "操作成功！")));
            }else{
                $this->response->end(json_encode(array("status" => "10002", "message" => "操作失败！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}


?>