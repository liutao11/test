<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/26
 * Time: 16:01
 */
class wk_UserLoginLog extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $this->assign('serverIndex',$cookie['serverIndex']);
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex'],'2');
        }else{
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],'','2');
            $this->assign('serverIndex',0);
        }
        if(@$cookie['DayReportStartDayS'] && $cookie['DayReportEndDayS']){
            $StartDay=$cookie['DayReportStartDayS'];
            $EndDay=$cookie['DayReportEndDayS'];
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");
        }
        if(@$cookie['UserLoginLogChangePageInt']){
            $showPageInt=$cookie['UserLoginLogChangePageInt'];
        }else{
            $showPageInt=1;
        }
        $this->assign('showPageInt',$showPageInt);
        @$whereKey=$cookie['whereKey']?$cookie['whereKey']:'';
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);
        $this->assign("whereKey",$whereKey);
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);
        foreach($serverS as $vv){
            $serverS_cl[$vv['id']]=$vv['GameServerUnid'];
        }
        $gameDBName=$serverS[0]['DBGameName'];
        $logDBName=$serverS[0]['DBLogName'];
        $className="UserLoginLog";
        $startDayTime=strtotime($StartDay);
        $endDayTime=strtotime($EndDay)+24*3600;

        $DayS=($endDayTime-$startDayTime)/(24*3600);

        if(@$cookie[$className.'BlurValue'] && @$cookie[$className.'BlurClassUNID']){
            if($cookie[$className.'BlurClassUNID']==1){
                $sql_blur_where="PlayerID LIKE '{$cookie[$className.'BlurValue']}%'";
            }elseif($cookie[$className.'BlurClassUNID']==2){
                $sql_blur_where="PlayerName LIKE  '{$cookie[$className.'BlurValue']}%'";
            }else{
                $sql_blur_where='1=1';
            }
        }else{


            $sql_blur_where='1=1';
        }


        $sql='';
        for($i=1;$i<=$DayS;$i++){
            $jsDayTime=$startDayTime+($i-1)*24*3600;
            $DBNameDay=date("Y_m_d",$jsDayTime);
            if($i!=$DayS) {
                if (date("Y_m_d") == $DBNameDay) {
                    if ($whereKey) {
                        $sql .= "select PlayerID,PlayerName,SendIP,SendTime,NeTCardSN,MsgID from dbo.LogMsg where {$sql_blur_where} UNION ";
                    } else {
                        $sql .= "select PlayerID,PlayerName,SendIP,SendTime,NeTCardSN,MsgID from dbo.LogMsg where {$sql_blur_where} UNION ";
                    }
                } else {
                    if ($whereKey) {
                        $sql .= "select PlayerID,PlayerName,SendIP,SendTime,NeTCardSN,MsgID from dbo.ChartLog_{$DBNameDay} where {$sql_blur_where} UNION ";
                    } else {
                        $sql .= "select PlayerID,PlayerName,SendIP,SendTime,NeTCardSN,MsgID from dbo.ChartLog_{$DBNameDay} where {$sql_blur_where} UNION ";
                    }
                }
            }else{
                if (date("Y_m_d") == $DBNameDay) {
                    if ($whereKey) {
                        $sql .= "select PlayerID,PlayerName,SendIP,SendTime,NeTCardSN,MsgID from dbo.LogMsg where {$sql_blur_where}";
                    } else {
                        $sql .= "select PlayerID,PlayerName,SendIP,SendTime,NeTCardSN,MsgID from dbo.LogMsg where {$sql_blur_where}";
                    }
                } else {
                    if ($whereKey) {
                        $sql .= "select PlayerID,PlayerName,SendIP,SendTime,NeTCardSN,MsgID from dbo.ChartLog_{$DBNameDay} where {$sql_blur_where}";
                    } else {
                        $sql .= "select PlayerID,PlayerName,SendIP,SendTime,NeTCardSN,MsgID from dbo.ChartLog_{$DBNameDay} where {$sql_blur_where}";
                    }
                }
            }
        }
        $result=$dblink->query($sql,600);
        $IP_array=array();
        $CardSN_array=array();
        foreach($result as $key=>$item){
            foreach($item as $kk=>$vv){
                $vv['GameServerUnid']=$serverS_cl[$key];
                $data[]=$vv;
                if(!in_array($vv['SendIP'],$IP_array)){
                    $IP_array[]=$vv['SendIP'];
                }
                if(!in_array($vv['NeTCardSN'],$CardSN_array)){
                    $CardSN_array[]=$vv['NeTCardSN'];
                }
            }
        }
        $pagelength=40;
        $data_s=array();
        foreach($data as $kk=>$vv){
            if((($showPageInt-1)*$pagelength-1) <= $kk && $kk <= ($showPageInt*$pagelength-1)){
                $data_s[]=$vv;
            }
        }

        $this->assign('data',$data_s);
        $pageSum=ceil(count($data)/$pagelength);
        $this->assign("pageSum",$pageSum);
        $this->assign("pageSumTo5",$pageSum-5);
        $this->assign("pageSumTo11",$pageSum-11);

        $this->assign("showPageIntS5",$showPageInt-5);
        $this->assign("showPageIntA5",$showPageInt+5);
        $this->assign("pageSum_11",$pageSum-11);
        $this->assign('pagelength',$pagelength);
        $this->assign("IPSum",count($IP_array));
        $this->assign("CardSNSum",count($CardSN_array));


        $this->assign('className',$className);

        $this->assign("blurIndex",@$cookie[$className.'BlurClassUNID']?$cookie[$className.'BlurClassUNID']:0);
        $this->assign("blurValue",@$cookie[$className.'BlurValue']?$cookie[$className.'BlurValue']:"");


        $this->display("Service/UserLoginLog.html");
    }
}

?>