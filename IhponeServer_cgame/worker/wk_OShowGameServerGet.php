<?php
/**
 *区服提交
 */
class wk_OShowGameServerGet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $isModify=$this->get['isModify'];
        $ObjectId= $this->get["ObjectId"];
        $Style=$this->get['Style'];
        $ServerTitle=$this->get['ServerTitle'];
        $NetUrl=$this->get['NetUrl'];
        $GamePort=$this->get['GamePort'];
        $OpenType=$this->get['OpenType'];
        $serverId=$this->get['serverId'];
        $serverRunState=$this->get['serverRunState'];
        $serverState=$this->get['serverState'];
        $OpenTime=$this->get['OpenTime'];
        $CTime=strtotime($OpenTime);

        if($ObjectId && $Style && $ServerTitle && $NetUrl && $GamePort  && $OpenType){
            if($CTime) {
                if ($isModify == 1) {
                    $result = $this->DBinsert("ShowGameServer", "ObjectId,Style,ServerTitle,NetUrl,GamePort,ServerState,ServerRunState,OpenType,CTime", "'{$ObjectId}','{$Style}','{$ServerTitle}','{$NetUrl}','{$GamePort}','{$serverRunState}','{$serverState}','{$OpenType}','{$CTime}'");
                } elseif ($isModify == 2) {
                    $result = $this->DBupdate("ShowGameServer", "ObjectId='{$ObjectId}',Style='{$Style}',ServerTitle='{$ServerTitle}',NetUrl='{$NetUrl}',GamePort='{$GamePort}',OpenType='{$OpenType}',serverRunState='{$serverRunState}',serverState='{$serverState}',CTime='{$CTime}'", "id='{$serverId}'");
                } else {
                    $result = false;
                }
                if ($result) {
                    $key=$this->main['cookieName']."Show_Game_Server";
                    $this->rd->del($key);
                    $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
                } else {
                    $this->response->end(json_encode(array("status" => "10002", "message" => "操作失败！")));
                }
            }else{
                $this->response->end(json_encode(array("status" => "10002", "message" => "时间格式错误！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }

    }
}
?>