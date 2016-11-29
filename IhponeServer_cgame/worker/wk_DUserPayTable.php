<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/8/9
 * Time: 13:54
 */
class wk_DUserPayTable extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName,ServerTitle,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        $className=__CLASS__;
        $this->assign('className',$className);
        $data_x=[];
        $day_pay_data=[];
        for($i=0;$i<30;$i++){
            $data_x[]=$i;
            $day_pay_data[$i]=0;
        }
        $this->assign('data_x',$data_x);
        $ExchangeRate=$this->main['ExchangeRate'];
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $dblinkS=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex'],'3');
            $serverIndex=$cookie['serverIndex'];
            @$StartDay_f=$cookie[$className.'StartDay']?$cookie[$className.'StartDay']:date("Y-m-d",time()-24*3600);
            @$EndDay=$cookie[$className.'EndDay']?$cookie[$className.'EndDay']:date("Y-m-d",time()-24*3600);
            $this->assign("startDay",$StartDay_f);
            $this->assign("endDay",$EndDay);
            foreach($serverS as $vv){
                if($vv['id']==$cookie['serverIndex']){
                    $DBLogName=$vv['DBLogName'];
                    $DBGameName=$vv['DBGameName'];
                    $DBPayName=$vv['DBPayName'];
                    $DBPayId=$vv['DBPayId'];
                    break;
                }
            }
            $StartDayTime=strtotime($StartDay_f);
            $EndDayTime=strtotime($EndDay)+24*3600;
            $dayLeng=($EndDayTime-$StartDayTime)/(24*3600);
            $data=[];
            for($i=0;$i<$dayLeng;$i++) {
                $StartDay_s=$StartDayTime+$i*24*3600;
                $StartDayTableName = date("Y_m_d", $StartDay_s);
                foreach ($serverS as $vv) {
                    if ($vv['id'] == $serverIndex) {
                        $data[$StartDayTableName] = array('serverName' => $vv['GameServerUnid'], 'date' => $StartDayTableName, "DayPayInfo"=>$day_pay_data);
                    }
                }

                $StartDayTableName_s = date("Y-m-d 00:00:00", $StartDay_s);
                $StartDayTableName_e = date("Y-m-d 00:00:00", $StartDay_s + 24 * 3600);
                //当如用户数
                $sql = "select aa.sAccount from {$DBGameName}.dbo.mir_hum_info as aa where dcreateDate >= '{$StartDayTableName_s}' and   dcreateDate < '{$StartDayTableName_e}' and IsFirstChar=1 ";

                $thisUserResult = $dblinkS->query($sql, 24 * 3600);
                if($thisUserResult) {
                    $SQLWhere='';
                    foreach ($thisUserResult as $key => $item) {
                        foreach ($item as $kk => $vv) {
                            if($SQLWhere) {
                                $SQLWhere .= " or UserID='{$vv['sAccount']}'";
                            }else{
                                $SQLWhere .= " UserID='{$vv['sAccount']}'";
                            }
                        }
                        $data[$StartDayTableName]['thisUserSum'] = count($item);
                    }
                    if($SQLWhere) {
                        $sql = "select nNumber,createTimes from {$DBPayName}.dbo.Pay_{$DBPayId} where {$SQLWhere}";
                        $result_Pay_info=$dblinkS->query($sql);
                        foreach($result_Pay_info as $key=>$item){
                            foreach($item as $kk=>$vv){
                                $dayKey=floor((strtotime($vv['createTimes'])-strtotime($StartDayTableName_s))/(24*3600));
                                if($dayKey<=30){
                                    $data[$StartDayTableName]['DayPayInfo'][$dayKey]+=$vv['nNumber']/$ExchangeRate;
                                }else{
                                    $data[$StartDayTableName]['DayPayInfo']['30']+=$vv['nNumber']/$ExchangeRate;
                                }
                            }
                        }
                    }
                }
            }
            $this->assign("data",$data);
        }else{
            $serverIndex=0;
            $this->assign("data",'');
            @$StartDay=$cookie['DayReportStartDay']?$cookie['DayReportStartDay']:date("Y-m-d",time()-24*3600);
            @$EndDay=$cookie['DayReportEndDay']?$cookie['DayReportEndDay']:date("Y-m-d",time()-24*3600);
            $this->assign("startDay",$StartDay);
            $this->assign("endDay",$EndDay);
        }
        $this->assign('serverIndex',$serverIndex);
        $this->display("Data/DUserPayTable.html");
    }
}



?>