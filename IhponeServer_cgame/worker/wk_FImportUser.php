<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/22
 * Time: 14:08
 */
class wk_FImportUser extends e_FromWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,NetUrl,DBPort,DBUser,DBPassword,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
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
        if(@$cookie['DayReportStartDay'] && $cookie['DayReportEndDay']){
            $StartDay=date("Y-m-d",strtotime($cookie['DayReportStartDay']));
            $EndDay=date("Y-m-d",strtotime($cookie['DayReportEndDay']));
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");
        }
        $this->assign('StartDay',$StartDay);
        $this->assign("EndDay",$EndDay);
        $startDayTime=strtotime($StartDay);
        $endDayTime=strtotime($EndDay);
        $data_x=array();
        $data=[];
        $daySum=($endDayTime-$startDayTime)/(3600*24)+1;
        for($i=0;$i<24*$daySum;$i++){
            $keys=date("Y-m-d H:00:00",$startDayTime+$i*3600);
            $data_x[]=$keys;
            $data[$keys]=0;
        }
        $this->assign('data_x',json_encode($data_x));

        $sqlStartDay=$StartDay;
        $sqlEndDay=date("Y-m-d H:i:s",$endDayTime+24*3600);
        if($cookie['fromIdsId']) {
            $sql = "select aa.sAccount,aa.dCreateDate,bb.fromIdm,bb.fromIds from MIR_HUM_INFO as aa LEFT JOIN MIR_HUM_SDKID as bb on aa.sAccount=bb.sAccount where aa.dCreateDate >= '{$sqlStartDay}' and aa.dCreateDate < '{$sqlEndDay}' and aa.isFirstChar=1 and bb.fromIds='{$cookie['fromIdsId']}'";
        }else {
            $sql = "select aa.sAccount,aa.dCreateDate,bb.fromIdm,bb.fromIds from MIR_HUM_INFO as aa LEFT JOIN MIR_HUM_SDKID as bb on aa.sAccount=bb.sAccount where aa.dCreateDate >= '{$sqlStartDay}' and aa.dCreateDate < '{$sqlEndDay}' and aa.isFirstChar=1 and bb.fromIdm='{$cookie['fromIdmId']}'";
        }

        $useLogin_result=$mssqlLink->query($sql);

        foreach($useLogin_result as $vv){
            $hoursIndex=date("Y-m-d H:00:00",strtotime($vv['dCreateDate']));
            $data[$hoursIndex]++;
        }

        foreach($data as $vv){
           $data_cl[]=$vv;
        }
        $this->assign('data_cl',json_encode($data_cl));
        $houre=date("H");
        if($houre<=6){
            $showIconStart=0;
            $showIconEnd=25;
        }elseif($houre>18 && $houre < 24){
            $showIconStart=75;
            $showIconEnd=100;
        }else{
            $showIconStart=(25+4.25*($houre-6))-12.5;
            $showIconEnd=(25+4.25*($houre-6))+12.5;;
        }

        $this->assign('showIconStart',$showIconStart);
        $this->assign("showIconEnd",$showIconEnd);

        $this->display("From/FImportUser.html");
    }
}

?>