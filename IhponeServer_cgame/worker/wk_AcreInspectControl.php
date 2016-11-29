<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/28
 * Time: 17:14
 */
class wk_AcreInspectControl extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $state=$this->get['state'];
        $AcerId=$this->get['AcerId'];
        $isReward=$this->get['isReward'];
        $TimeS=time();
        if($state && $AcerId){
            $result=$this->DBselect("AcerApply","id='{$AcerId}'");
            if($state==1 && $result['state']==1){
                $server=$this->DBselect("gameServer","isClose=1 and id={$result['serverIndex']}","id,NetUrl,GameServerUnid,ObjectId,DBGameName,DBLogName,TelnetPort");
                if($isReward==1){//充值奖励获得
                    $sendString = "{\"ACTION\":\"GAMEADDGOLD\",\"DATA\":{\"roleS\":\"".$result['roleS']."\",\"number\":".$result['number'].",\"state\":1}}\\";           //不需要加vip
                }else {
                    $sendString = "{\"ACTION\":\"GAMEADDGOLD\",\"DATA\":{\"roleS\":\"".$result['roleS']."\",\"number\":".$result['number'].",\"state\":2}}\\";            //需要加vip
                }
                $sendResult=$this->SendToServer($server['NetUrl'],$server['TelnetPort'],$sendString);
                if($sendResult==1) {
                    $result = $this->DBupdate('AcerApply', "inspectName='{$cookie['username']}',inspectTime='{$TimeS}',state=2", "id='{$AcerId}'");
                    $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
                }else{
                    $this->response->end(json_encode(array("status" => "10002", "message" => "玩家不在线！无法操作！")));
                }
            }elseif($state==2 && $result['state']==1){
                $result=$this->DBupdate('AcerApply',"inspectName='{$cookie['username']}',inspectTime='{$TimeS}',state=3","id='{$AcerId}'");
                $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
    function SendToServer($NetUrl, $TelnetPort,$sendString){
        $client = new swoole_client(SWOOLE_SOCK_TCP);
        try {
            $clientState = $client->connect($NetUrl, $TelnetPort, 10);
            var_dump($sendString);
            if ($clientState) {
                $client->send($sendString);
                $result = $client->recv();
                $client->close();
                return $result;
            } else {
                echo "connect failed. Error: {$client->errCode}\n";
                return false;
            }
        }catch (ErrorException $e){
            echo $e->getMessage();
            return false;
        }
    }
}



?>