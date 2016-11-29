<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/21
 * Time: 17:17
 */
class wk_FIndexFrom extends e_FromWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,NetUrl,DBPort,DBUser,DBPassword,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
       // var_dump($serverS);
        foreach($serverS as $vv){
            $serverS_cl[$vv['id']]=$vv;
        }
        @$serverIndex=$cookie['serverIndex']?$cookie['serverIndex']:$serverS['0']['id'];

        $this->assign("serverIndex",$serverIndex);
        $NetUrl=$serverS_cl[$serverIndex]['NetUrl'];
        $post=$serverS_cl[$serverIndex]['DBPort'];
        $user=$serverS_cl[$serverIndex]['DBUser'];
        $password=$serverS_cl[$serverIndex]['DBPassword'];
        $gameName=$serverS_cl[$serverIndex]['DBGameName'];
        $payName=$serverS_cl[$serverIndex]['DBPayName'];
        $logName=$serverS_cl[$serverIndex]['DBLogName'];
        $payId=$serverS_cl[$serverIndex]['DBPayId'];
        $mssqlLink=new cl_gamedb($NetUrl,$post,$user,$password,$gameName,$this->rd);
        $this->assign('serverTitle',$serverS_cl[$serverIndex]['ServerTitle']);

        $ExchangeRate=$this->main['ExchangeRate'];
        //今天充值；
        $Today_Str=date("Y-m-d 00:00:00");
        if($cookie['fromIdsId']) {
            $sql = "select nNumber,createTimes,sChrName from {$payName}.dbo.Pay_{$payId} where createTimes >='{$Today_Str}' and fromIds='{$cookie['fromIdsId']}' ORDER  BY  nNumber desc";
        }else{
            $sql = "select nNumber,createTimes,sChrName from {$payName}.dbo.Pay_{$payId} where createTimes >='{$Today_Str}' and fromIdm='{$cookie['fromIdmId']}' ORDER  BY  nNumber desc";
        }
        $TadayPaySum_result=$mssqlLink->query($sql);
        $TodaySum=0;
        foreach($TadayPaySum_result as $vv){
            $TodaySum+=$vv['nNumber']/$ExchangeRate;
        }
        $this->assign('todayPaySum',$TodaySum);
        //得到今日充值标
        for($i=0;$i<24;$i++){
            $datestyle[]=$i;
        }
        $this->assign("datestyle",json_encode($datestyle));

        $todayPayInfo=array("00"=>0,"01"=>0,"02"=>0,"03"=>0,"04"=>0,"05"=>0,"06"=>0,"07"=>0,"08"=>0,"09"=>0,"10"=>0,"11"=>0,"12"=>0,"13"=>0,"14"=>0,"15"=>0,"16"=>0,"17"=>0,"18"=>0,"19"=>0,"20"=>0,"21"=>0,"22"=>0,"23"=>0);
        foreach($TadayPaySum_result as $vv){
            $hoursIndex=date("H",strtotime($vv['createTimes']));
            $todayPayInfo[$hoursIndex]+=$vv['nNumber']/$ExchangeRate;
        }
        $NowDayHours=date("H");
        foreach($todayPayInfo as $key=>$vv){
            if($key <= $NowDayHours){
                $todayPayInfo_cl[]=$vv;
            }
        }
        $this->assign('todayPayJson',json_encode($todayPayInfo_cl));
        //今日排名
        $TadayPayPaking=[];
        foreach($TadayPaySum_result as $key=>$vv){
            if($key<=12){
                $vv['mount']=$vv['nNumber']/$ExchangeRate;
                $TadayPayPaking[]=$vv;
            }else{
                break;
            }
        }
        $this->assign('TadayPayPaking',$TadayPayPaking);

        //昨天充值
        $yesDay_str=date("Y-m-d 00:00:00",time()-24*3600);
        if($cookie['fromIdsId']) {
            $sql = "select nNumber,createTimes,sChrName from {$payName}.dbo.Pay_{$payId} where createTimes >='{$yesDay_str}' and createTimes < '{$Today_Str}'  and fromIds='{$cookie['fromIdsId']}'";
        }else{
            $sql = "select nNumber,createTimes,sChrName from {$payName}.dbo.Pay_{$payId} where createTimes >='{$yesDay_str}' and createTimes < '{$Today_Str}'  and fromIdm='{$cookie['fromIdmId']}'";
        }
        $yesPayInfo=array("00"=>0,"01"=>0,"02"=>0,"03"=>0,"04"=>0,"05"=>0,"06"=>0,"07"=>0,"08"=>0,"09"=>0,"10"=>0,"11"=>0,"12"=>0,"13"=>0,"14"=>0,"15"=>0,"16"=>0,"17"=>0,"18"=>0,"19"=>0,"20"=>0,"21"=>0,"22"=>0,"23"=>0);
        $yesDayPay_result=$mssqlLink->query($sql);
        foreach($yesDayPay_result as $vv){
            $hoursIndex=date("H",strtotime($vv['createTimes']));
            $yesPayInfo[$hoursIndex]+=$vv['nNumber']/$ExchangeRate;
        }
        foreach($yesPayInfo as $key=>$vv){
            $yesPayInfo_cl[]=$vv;
        }
        $this->assign('yesPayJson',json_encode($yesPayInfo_cl));

        //本月充值
        $month_Str=date("Y-m-01 00:00:00");
        if($cookie['fromIdsId']) {
            $sql = "select sum(nNumber) as paySum from {$payName}.dbo.Pay_{$payId} where createTimes >='{$month_Str}' and fromIds='{$cookie['fromIdsId']}'";
        }else{
            $sql = "select sum(nNumber) as paySum from {$payName}.dbo.Pay_{$payId} where createTimes >='{$month_Str}' and fromIdm='{$cookie['fromIdmId']}'";
        }
        $monthPaySum_result=$mssqlLink->query($sql);
        $this->assign('monthPaySun',$monthPaySum_result['0']['paySum']/$ExchangeRate);

        //充值总量
        if($cookie['fromIdsId']) {
            $sql="select sum(nNumber) as paySum from {$payName}.dbo.Pay_{$payId} where fromIds='{$cookie['fromIdsId']}'";
        }else{
            $sql="select sum(nNumber) as paySum from {$payName}.dbo.Pay_{$payId} where fromIdm='{$cookie['fromIdmId']}'";
        }

        $paySum_result=$mssqlLink->query($sql);
        $this->assign("PaySum",$paySum_result['0']['paySum']/$ExchangeRate);
        //最新充值
        if($cookie['fromIdsId']) {
            $sql = "select top 11 nNumber/{$ExchangeRate} as mount,createTimes,sChrName from {$payName}.dbo.Pay_{$payId} where fromIds='{$cookie['fromIdsId']}' ORDER  BY createTimes DESC";
        }else{
            $sql = "select top 11 nNumber/{$ExchangeRate} as mount,createTimes,sChrName from {$payName}.dbo.Pay_{$payId} where fromIdm='{$cookie['fromIdmId']}' ORDER  BY createTimes DESC";
        }

        $newPaySum_result=$mssqlLink->query($sql);
        foreach($newPaySum_result as $vv){
            $vv['createTimes_cl']=date("Y-m-d H:i:s",strtotime($vv['createTimes']));
            $newPaySum[]=$vv;
        }
        $this->assign('newPaySum',$newPaySum);
        //导入总用户
        if($cookie['fromIdsId']) {
            $sql="select count(sAccount) as UserIntoSum from MIR_HUM_SDKID where fromIds='{$cookie['fromIdsId']}'";
        }else{
            $sql="select count(sAccount) as UserIntoSum from MIR_HUM_SDKID where fromIdm='{$cookie['fromIdmId']}'";
        }
        $UserIntoSum_result=$mssqlLink->query($sql);
        $this->assign("UserIntoSum",$UserIntoSum_result[0]['UserIntoSum']);
        //今天导入用户
        if($cookie['fromIdsId']) {
            $sql = "select aa.sAccount,aa.dCreateDate from MIR_HUM_INFO as aa LEFT JOIN  MIR_HUM_SDKID as bb ON aa.sAccount=bb.sAccount where  aa.isFirstChar=1 and aa.dCreateDate >= '{$Today_Str}' and bb.fromIds='{$cookie['fromIdsId']}'";
        }else{
            $sql = "select aa.sAccount,aa.dCreateDate from MIR_HUM_INFO as aa LEFT JOIN  MIR_HUM_SDKID as bb ON aa.sAccount=bb.sAccount where  aa.isFirstChar=1 and aa.dCreateDate >= '{$Today_Str}' and bb.fromIdm='{$cookie['fromIdmId']}'";
        }
        $todayNewUser_result=$mssqlLink->query($sql);

        $todayNewUserInfo=array("00"=>0,"01"=>0,"02"=>0,"03"=>0,"04"=>0,"05"=>0,"06"=>0,"07"=>0,"08"=>0,"09"=>0,"10"=>0,"11"=>0,"12"=>0,"13"=>0,"14"=>0,"15"=>0,"16"=>0,"17"=>0,"18"=>0,"19"=>0,"20"=>0,"21"=>0,"22"=>0,"23"=>0);
        foreach($todayNewUser_result as $vv){
            $hoursIndex=date("H",strtotime($vv['dCreateDate']));
            $todayNewUserInfo[$hoursIndex]++;
        }
        foreach($todayNewUserInfo as $vv){
             $todayNewUserInfo_cl[]=$vv;
        }
        $this->assign('todayNewUserInfo',json_encode($todayNewUserInfo_cl));
        //昨日导入用户
        if($cookie['fromIdsId']) {
            $sql = "select aa.sAccount,aa.dCreateDate from MIR_HUM_INFO as aa LEFT JOIN  MIR_HUM_SDKID as bb ON aa.sAccount=bb.sAccount where  aa.isFirstChar=1 and aa.dCreateDate >= '{$yesDay_str}' and aa.dCreateDate < '{$Today_Str}' and bb.fromIds='{$cookie['fromIdsId']}'";
        }else{
            $sql = "select aa.sAccount,aa.dCreateDate from MIR_HUM_INFO as aa LEFT JOIN  MIR_HUM_SDKID as bb ON aa.sAccount=bb.sAccount where  aa.isFirstChar=1 and aa.dCreateDate >= '{$yesDay_str}' and aa.dCreateDate < '{$Today_Str}' and bb.fromIdm='{$cookie['fromIdmId']}'";
        }

        $yesNewUser_result=$mssqlLink->query($sql);

        $yesNewUserInfo=array("00"=>0,"01"=>0,"02"=>0,"03"=>0,"04"=>0,"05"=>0,"06"=>0,"07"=>0,"08"=>0,"09"=>0,"10"=>0,"11"=>0,"12"=>0,"13"=>0,"14"=>0,"15"=>0,"16"=>0,"17"=>0,"18"=>0,"19"=>0,"20"=>0,"21"=>0,"22"=>0,"23"=>0);
        foreach($yesNewUser_result as $vv){
            $hoursIndex=date("H",strtotime($vv['dCreateDate']));
            $yesNewUserInfo[$hoursIndex]++;
        }
        foreach($yesNewUserInfo as $vv){
            $yesNewUserInfo_cl[]=$vv;
        }
        $this->assign('yesNewUserInfo',json_encode($yesNewUserInfo_cl));


        $this->display("From/FIndexFrom.html");
    }
}



?>