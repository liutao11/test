<?php
/**
 * 玩结束
 */
class wk_ResourceServerGet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $isModify=$this->get['isModify'];
        $describe= $this->get["describe"];
        $netUrl=$this->get['netUrl'];
        $port=$this->get["port"];
        $serverId=$this->get['serverId'];
        if($describe && $netUrl && $port){
            if($isModify==1){
                $result=$this->DBinsert("fileServer","describeStr,netUrl,port","'{$describe}','{$netUrl}','{$port}'");
            }elseif($isModify==2){
                $result=$this->DBupdate("fileServer","describeStr='{$describe}',netUrl='{$netUrl}',port='{$port}'","id='{$serverId}'");
            }else{
                $result=false;
            }
            if ($result) {
                $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
            } else {
                $this->response->end(json_encode(array("status" => "10002", "message" => "操作失败！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }

    }
}
?>