<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/29
 * Time: 15:47
 */
class wk_ServerRelieveGet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $serverId=$this->get['serverId'];
        if($serverId){
            $result=$this->DBupdate("gameServer","MasterServerIndex=null","id='{$serverId}'");
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