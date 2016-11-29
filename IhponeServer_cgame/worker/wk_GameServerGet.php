<?php
/**
 *区服提交
 */
class wk_GameServerGet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $isModify=$this->get['isModify'];
        $ObjectId= $this->get["ObjectId"];
        $Style=$this->get['Style'];
        $GameServerUnid=$this->get["GameServerUnid"];
        $ServerTitle=$this->get['ServerTitle'];
        $OpenTime=$this->get['OpenTime'];
        $NetUrl=$this->get['NetUrl'];
        $GamePort=$this->get['GamePort'];
        $DBType=$this->get['DBType'];
        $DBPort=$this->get['DBPort'];
        $DBUser=$this->get['DBUser'];
        $DBPassword=$this->get['DBPassword'];
        $DBGameName=$this->get['DBGameName'];
        $DBLogName=$this->get['DBLogName'];
        $TelnetPort=$this->get['TelnetPort'];
        $ChatPort=$this->get['ChatPort'];
        $FileServerId=$this->get['FileServerId'];
        $OpenType=$this->get['OpenType'];
        $PayType=$this->get['PayType'];
        $PayLogName=$this->get['PayLogName'];
        $serverId=$this->get['serverId'];
        $serverRunState=$this->get['serverRunState'];
        $serverState=$this->get['serverState'];

        if($ObjectId && $Style && $GameServerUnid && $ServerTitle && $OpenTime && $NetUrl && $GamePort && $DBType && $DBPort && $DBUser && $DBPassword && $DBGameName && $DBLogName && $TelnetPort && $ChatPort && $FileServerId && $OpenType && $PayType){
            if($isModify==1){
                $result=$this->DBinsert("gameServer","ObjectId,Style,GameServerUnid,ServerTitle,OpenTime,NetUrl,GamePort,DBType,DBPort,DBUser,DBPassword,DBGameName,DBLogName,TelnetPort,ChatPort,FileServerId,OpenType,PayType,DBPayName,DBPayId,serverRunState,serverState","'{$ObjectId}','{$Style}','{$GameServerUnid}','{$ServerTitle}','{$OpenTime}','{$NetUrl}','{$GamePort}','{$DBType}','{$DBPort}','{$DBUser}','{$DBPassword}','{$DBGameName}','{$DBLogName}','{$TelnetPort}','{$ChatPort}','{$FileServerId}','{$OpenType}','{$PayType}','{$PayLogName}','{$GameServerUnid}','{$serverRunState}','{$serverState}'");
            }elseif($isModify==2){
                $result=$this->DBupdate("gameServer","ObjectId='{$ObjectId}',Style='{$Style}',GameServerUnid='{$GameServerUnid}',ServerTitle='{$ServerTitle}',OpenTime='{$OpenTime}',NetUrl='{$NetUrl}',GamePort='{$GamePort}',DBType='{$DBType}',DBPort='{$DBPort}',DBUser='{$DBUser}',DBPassword='{$DBPassword}',DBGameName='{$DBGameName}',DBLogName='{$DBLogName}',TelnetPort='{$TelnetPort}',ChatPort='{$ChatPort}',FileServerId='{$FileServerId}',OpenType='{$OpenType}',PayType='{$PayType}',DBPayName='{$PayLogName}',DBPayId='{$GameServerUnid}',serverRunState='{$serverRunState}',serverState='{$serverState}'","id='{$serverId}'");
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