<?php
/**
 * 玩结束
 */
class wk_DeleteUserGet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $userId=$this->get['userId'];
        $typeValue=$this->get['typeValue'];
        if($userId){
            if($userId!=1) {
                if ($typeValue == 1) {
                    $result = $this->DBupdate('userList', 'type=2', "id='{$userId}'");
                } elseif ($typeValue == 2) {
                    $result = $this->DBupdate('userList', 'type=1', "id='{$userId}'");
                }
                if ($result) {
                    $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
                } else {
                    $this->response->end(json_encode(array("status" => "10002", "message" => "操作失败！")));
                }
            }else{
                $this->response->end(json_encode(array("status" => "10002", "message" => "root用户不能改变！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}
?>