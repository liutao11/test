<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/9/20
 * Time: 13:53
 */
class wk_AllUserRepeat extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $objectGround=$cookie['objectGround'];
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$objectGround}' and isClose=1","id,ObjectId,GameServerUnid,NetUrl,DBPort,DBUser,DBPassword,DBGameName,DBLogName,DBPayName,ServerTitle");
        $data=[];
        $dataAllUser=[];
        $bufferKey=$this->main['cookieName']."::Buffer::".__CLASS__."::".$objectGround;
        $ExchangeRate=$this->main['ExchangeRate'];
        $bufferData=$this->rd->get($bufferKey);
        if($bufferData) {
            $data_cl=json_decode($bufferData,true);
        }else{
            if (is_array($serverS)) {
                foreach ($serverS as $server) {
                    $serverIndex = $server['id'];
                    $serverName = $server['ServerTitle'];
                    $DBGameName = $server['DBGameName'];
                    $DBPayName=$server['DBPayName'];
                    $GameServerUnid=$server['GameServerUnid'];
                    $dblink = new cl_gamedb($server['NetUrl'], $server['DBPort'], $server['DBUser'], $server['DBPassword'], $DBGameName, $this->rd);
                    $sql = "select sAccount from {$DBGameName}.dbo.MIR_HUM_INFO GROUP BY sAccount";
                    $result_one = $dblink->query($sql);
                    $dataAllUser[$serverIndex]['data'] = $result_one;
                    $dataAllUser[$serverIndex]['name'] = $serverName;
                    $dataAllUser[$serverIndex]['DBPayName']=$DBPayName;
                    $dataAllUser[$serverIndex]['GameServerUnid']=$GameServerUnid;
                    $dataAllUser[$serverIndex]['NetUrl']=$server['NetUrl'];
                    $dataAllUser[$serverIndex]['DBPort']=$server['DBPort'];
                    $dataAllUser[$serverIndex]['DBUser']= $server['DBUser'];
                    $dataAllUser[$serverIndex]['DBPassword']= $server['DBPassword'];
                }
            }
            foreach ($dataAllUser as $serIndex => $dataOneUser) {
                $data[$serIndex]['title'] = $dataOneUser['name'];
                $data[$serIndex]['userSum'] = count($dataOneUser['data']);
                $data[$serIndex]['newUserSum'] = 0;
                $data[$serIndex]['otherServerOldUserSum'] = 0;
                $DBPayName=$dataOneUser['DBPayName'];
                $GameServerUnid=$dataOneUser['GameServerUnid'];
                $dataAllUser_cl = $dataAllUser;
                $NetUrl=$dataOneUser['NetUrl'];
                $DBPort=$dataOneUser['DBPort'];
                $DBUser=$dataOneUser['DBUser'];
                $DBPassword=$dataOneUser['DBPassword'];
                unset($dataAllUser_cl[$serIndex]);
                $sqlwhere='';
                foreach ($dataOneUser['data'] as $useidInfo) {
                    $useid=$useidInfo['sAccount'];
                    $useidState = 1;             //默认渠道新用户
                    foreach ($dataAllUser_cl as $otherServerUser) {
                        if (in_array($useidInfo, $otherServerUser['data'])) {
                            $useidState = 2;
                        }
                    }
                    if ($useidState == 1) {
                        $data[$serIndex]['newUserSum']++;
                        if($sqlwhere){
                           $sqlwhere.= "or UserID='{$useid}' ";
                        }else{
                            $sqlwhere="UserID='{$useid}' ";
                        }
                    } else {
                        $data[$serIndex]['otherServerOldUserSum']++;
                    }
                }
                $sql="select sum(nNumber)/{$ExchangeRate} as amount from {$DBPayName}.dbo.Pay_{$GameServerUnid} where {$sqlwhere}";
                $dblink = new cl_gamedb($NetUrl, $DBPort, $DBUser, $DBPassword, $DBPayName, $this->rd);
                $result_Pay_one=$dblink->query($sql);
                $data[$serIndex]["newUserPaySum"]=$result_Pay_one[0]['amount'];
            }
            $data_cl = [];
            foreach ($data as $vv) {
                $vv['newUserSumLv'] = $vv['userSum'] ? sprintf("%.4f", $vv['newUserSum'] / $vv['userSum']) * 100 : 0;
                $data_cl[] = $vv;
            }
            $this->rd->setex($bufferKey,600,json_encode($data_cl));
        }
        $this->assign("data",$data_cl);
        $this->display("Data/AllUserRepeat.html");
    }
}




?>