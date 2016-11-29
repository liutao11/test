<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/7/27
 * Time: 14:25
 */
class wk_OVirtualPayListGet extends e_OperatorsWorker{
    function  Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $roles=$this->get['roles'];
        $Amount=$this->get['Amount'];
        $ExchangeRate=$this->main['ExchangeRate'];
        if($Amount && $serverIndex && $roles){
            $gameServerInfo=$this->DBselect('gameServer',"id='{$serverIndex}'");
            $NetUrl=$gameServerInfo['NetUrl'];
            $DBPort=$gameServerInfo['DBPort'];
            $DBUser=$gameServerInfo['DBUser'];
            $DBPassword=$gameServerInfo['DBPassword'];
            $ServerTitle=$gameServerInfo['ServerTitle'];
            $TelnetPort=$gameServerInfo['TelnetPort'];
            $DBPayName=$gameServerInfo['DBPayName'];
            $DBGameName=$gameServerInfo['DBGameName'];
            $DBPayId=$gameServerInfo['DBPayId'];
            try {
                $mssqlLink = new PDO ("dblib:host={$NetUrl}:{$DBPort};dbname={$DBPayName}", $DBUser, $DBPassword);
                $sql="select sAccount from  {$DBGameName}.dbo.MIR_HUM_INFO WHERE  sChrName='{$roles}'";
                $result_userId=$mssqlLink->query($sql);
                $userId_array=$result_userId->fetch(PDO::FETCH_ASSOC);
                $UserID=$userId_array['sAccount'];
                if($result_userId && $UserID) {
                    $sPayId = "testOrder:" . time() . '_' . rand(1000, 9999);
                    $nNumber = $Amount * $ExchangeRate;
                    $createTimes = date("Y-m-d H:i:s");
                    $sql = "insert into {$DBPayName}.dbo.Pay_{$DBPayId}_v (UserID,sPayId,nNumber,createTimes,drawout,drawouttime,fromIdm,sChrname) VALUES ('{$UserID}','{$sPayId}','{$nNumber}','{$createTimes}','1','{$createTimes}','9991','{$roles}')";
                    $insert_result = $mssqlLink->query($sql);
                    $mssqlError = $mssqlLink->errorInfo();
                    if ($insert_result && $mssqlError['0'] == '00000') {
                        $this->response->end(json_encode(array("status" => "10002", "message" => "操作成功！")));
                        $CTime=time();
                        $this->DBinsert('VirtualPayList',"serverName ,serverId,UserName,Userid,Amount,CTime","'{$ServerTitle}','{$serverIndex}','{$roles}','{$UserID}','{$nNumber}','{$CTime}'");
                    } else {
                        $this->response->end(json_encode(array("status" => "10002", "message" => "发送失败！")));
                    }
                }else{
                    $this->response->end(json_encode(array("status" => "10002", "message" => "角色名:[{$roles}]不存在！")));
                }
            }catch (PDOException $e){
                $this->response->end(json_encode(array("status" => "10002", "message" => "插入数据库失败！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}

?>