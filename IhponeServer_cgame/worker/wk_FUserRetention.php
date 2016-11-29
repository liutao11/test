<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/4
 * Time: 10:19
 */
class wk_FUserRetention extends e_FromWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName,ServerTitle");
        $this->assign('serverS',$serverS);
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $dblinkS=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex'],'3');
            $serverIndex=$cookie['serverIndex'];
            @$StartDay_f=$cookie['DayReportStartDay']?$cookie['DayReportStartDay']:date("Y-m-d",time()-24*3600);
            @$EndDay=$cookie['DayReportEndDay']?$cookie['DayReportEndDay']:date("Y-m-d",time()-24*3600);
            $this->assign("startDay",$StartDay_f);
            $this->assign("endDay",$EndDay);
            foreach($serverS as $vv){
                if($vv['id']==$cookie['serverIndex']){
                    $DBLogName=$vv['DBLogName'];
                    $DBGameName=$vv['DBGameName'];
                    break;
                }
            }
            $StartDayTime=strtotime($StartDay_f);
            $EndDayTime=strtotime($EndDay)+24*3600;
            $dayLeng=($EndDayTime-$StartDayTime)/(24*3600);
            for($i=0;$i<$dayLeng;$i++) {
                $StartDay_s=$StartDayTime+$i*24*3600;
                $StartDayTableName = date("Y_m_d", $StartDay_s);
                foreach ($serverS as $vv) {
                    if ($vv['id'] == $serverIndex) {
                        $data[$StartDayTableName] = array('serverName' => $vv['GameServerUnid'], 'date' => $StartDayTableName, 'CDayUserSumLV' => "NUN", 'WDayUserSumLV' => "NUN", 'SWDayUserSumLV' => "NUN");
                    }
                }
                $StartDayTableName_s = date("Y-m-d 00:00:00", $StartDay_s);
                $StartDayTableName_e = date("Y-m-d 00:00:00", $StartDay_s + 24 * 3600);
                //当如用户数
                if($cookie['fromIdsId']) {
                    $sql = "select aa.sAccount from {$DBGameName}.dbo.mir_hum_info as aa LEFT JOIN {$DBGameName}.dbo.MIR_HUM_SDKID as bb ON aa.sAccount=bb.sAccount where aa.dcreateDate >= '{$StartDayTableName_s}' and  aa.dcreateDate < '{$StartDayTableName_e}' and aa.IsFirstChar=1 and bb.fromIds='{$cookie['fromIdsId']}'";
                } else {
                    $sql = "select aa.sAccount from {$DBGameName}.dbo.mir_hum_info as aa LEFT JOIN {$DBGameName}.dbo.MIR_HUM_SDKID as bb ON aa.sAccount=bb.sAccount where aa.dcreateDate >= '{$StartDayTableName_s}' and  aa.dcreateDate < '{$StartDayTableName_e}' and aa.IsFirstChar=1 and bb.fromIdm='{$cookie['fromIdmId']}'";
                }
                $thisUserResult = $dblinkS->query($sql, 24 * 3600);
                foreach ($thisUserResult as $key => $item) {
                    foreach ($item as $kk => $vv) {
                        $thisUserDataArray[$StartDayTableName][] = $vv['sAccount'];
                    }
                    $data[$StartDayTableName]['thisUserSum'] = count($item);
                }
                //次日留存
                $CDayUserDataArray_and_thisUserDataArray_count = 0;
                $jstime = $StartDay_s + 24 * 3600;
                if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {
                    $StartDayTableName_CDay = date("Y_m_d", $StartDay_s + 24 * 3600);
                    if ($StartDayTableName_CDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_CDay} as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 24 * 3600);
                    }

                    foreach ($CDayUserResult as $key => $item) {
                        foreach ($item as $kk => $vv) {
                            if (@in_array($vv['PlayerID'], $thisUserDataArray[$StartDayTableName])) {
                                $CDayUserDataArray_and_thisUserDataArray_count++;
                            }
                        }
                    }

                    $data[$StartDayTableName]['CDayUserSumLV'] = $data[$StartDayTableName]['thisUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count / $data[$StartDayTableName]['thisUserSum']) * 100 : "0";
                } else {
                    $data[$StartDayTableName]['CDayUserSumLV'] = "NUN";
                }



                //+2日留存
                $CDayUserDataArray_and_thisUserDataArray_count = 0;
                $jstime = $StartDay_s + 24 * 3600 * 2;
                if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {
                    $StartDayTableName_CDay = date("Y_m_d", $StartDay_s + 24 * 3600 * 2);
                    if ($StartDayTableName_CDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_CDay} as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 24 * 3600);
                    }

                    foreach ($CDayUserResult as $key => $item) {
                        foreach ($item as $kk => $vv) {
                            if (@in_array($vv['PlayerID'], $thisUserDataArray[$StartDayTableName])) {
                                $CDayUserDataArray_and_thisUserDataArray_count++;
                            }
                        }
                    }
                    $data[$StartDayTableName]['SDayUserSumLV'] = $data[$StartDayTableName]['thisUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count / $data[$StartDayTableName]['thisUserSum']) * 100 : "0";
                } else {
                    $data[$StartDayTableName]['SDayUserSumLV'] = "NUN";
                }

                //+3日留存

                $CDayUserDataArray_and_thisUserDataArray_count = 0;
                $jstime = $StartDay_s + 24 * 3600 * 3;
                if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {
                    $StartDayTableName_CDay = date("Y_m_d", $StartDay_s + 24 * 3600 * 3);
                    if ($StartDayTableName_CDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_CDay} as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 24 * 3600);
                    }

                    foreach ($CDayUserResult as $key => $item) {
                        foreach ($item as $kk => $vv) {
                            if (@in_array($vv['PlayerID'], $thisUserDataArray[$StartDayTableName])) {
                                $CDayUserDataArray_and_thisUserDataArray_count++;
                            }
                        }
                    }
                    $data[$StartDayTableName]['DDayUserSumLV'] = $data[$StartDayTableName]['thisUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count / $data[$StartDayTableName]['thisUserSum']) * 100 : "0";
                } else {
                    $data[$StartDayTableName]['DDayUserSumLV'] = "NUN";
                }


                //+4留存率
                $CDayUserDataArray_and_thisUserDataArray_count = 0;
                $jstime = $StartDay_s + 4 * 24 * 3600;
                if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {

                    $StartDayTableName_WDay = date("Y_m_d", $StartDay_s + 24 * 3600 * 4);
                    if ($StartDayTableName_WDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_WDay} as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 24 * 3600);
                    }

                    foreach ($CDayUserResult as $key => $item) {
                        foreach ($item as $kk => $vv) {
                            if (@in_array($vv['PlayerID'], $thisUserDataArray[$StartDayTableName])) {
                                $CDayUserDataArray_and_thisUserDataArray_count++;
                            }
                        }
                    }
                    $data[$StartDayTableName]['WDayUserSumLV'] = $data[$StartDayTableName]['thisUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count / $data[$StartDayTableName]['thisUserSum']) * 100 : "0";
                } else {
                    $data[$StartDayTableName]['WDayUserSumLV'] = "NUN";
                }
                //+5留存率
                $CDayUserDataArray_and_thisUserDataArray_count = 0;
                $jstime = $StartDay_s + 5 * 24 * 3600;
                if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {

                    $StartDayTableName_WDay = date("Y_m_d", $StartDay_s + 24 * 3600 * 5);
                    if ($StartDayTableName_WDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_WDay} as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 24 * 3600);
                    }

                    foreach ($CDayUserResult as $key => $item) {
                        foreach ($item as $kk => $vv) {
                            if (@in_array($vv['PlayerID'], $thisUserDataArray[$StartDayTableName])) {
                                $CDayUserDataArray_and_thisUserDataArray_count++;
                            }
                        }
                    }
                    $data[$StartDayTableName]['EDayUserSumLV'] = $data[$StartDayTableName]['thisUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count / $data[$StartDayTableName]['thisUserSum']) * 100 : "0";
                } else {
                    $data[$StartDayTableName]['EDayUserSumLV'] = "NUN";
                }

                //+6留存率
                $CDayUserDataArray_and_thisUserDataArray_count = 0;
                $jstime = $StartDay_s + 6 * 24 * 3600;
                if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {

                    $StartDayTableName_WDay = date("Y_m_d", $StartDay_s + 24 * 3600 * 6);
                    if ($StartDayTableName_WDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_WDay} as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 24 * 3600);
                    }

                    foreach ($CDayUserResult as $key => $item) {
                        foreach ($item as $kk => $vv) {
                            if (@in_array($vv['PlayerID'], $thisUserDataArray[$StartDayTableName])) {
                                $CDayUserDataArray_and_thisUserDataArray_count++;
                            }
                        }
                    }
                    $data[$StartDayTableName]['ZDayUserSumLV'] = $data[$StartDayTableName]['thisUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count / $data[$StartDayTableName]['thisUserSum']) * 100 : "0";
                } else {
                    $data[$StartDayTableName]['ZDayUserSumLV'] = "NUN";
                }


                //15日
                $CDayUserDataArray_and_thisUserDataArray_count = 0;
                $jstime = $StartDay_s + 14 * 24 * 3600;
                if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {

                    $StartDayTableName_WDay = date("Y_m_d", $jstime);
                    if ($StartDayTableName_WDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_WDay} as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult = $dblinkS->query($sql, 24 * 3600);
                    }

                    foreach ($CDayUserResult as $key => $item) {
                        foreach ($item as $kk => $vv) {
                            if (@in_array($vv['PlayerID'], $thisUserDataArray[$StartDayTableName])) {
                                $CDayUserDataArray_and_thisUserDataArray_count++;
                            }
                        }
                    }
                    $data[$StartDayTableName]['SWDayUserSumLV'] = $data[$StartDayTableName]['thisUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count / $data[$StartDayTableName]['thisUserSum']) * 100 : "0";
                } else {
                    $data[$StartDayTableName]['SWDayUserSumLV'] = "NUN";
                }
            }
            $this->assign("data",$data);
            $data_s=array('CDayUserSumLV_s'=>0,'CDayUserSumLV_s_time'=>0,"WDayUserSumLV_s"=>0,"WDayUserSumLV_s_time"=>0,'SWDayUserSumLV_s'=>0,'SWDayUserSumLV_s_time'=>0,"SDayUserSumLV_s"=>0,"SDayUserSumLV_s_time"=>0,'DDayUserSumLV_s'=>0,'DDayUserSumLV_s_time'=>0,'EDayUserSumLV_s'=>0,'EDayUserSumLV_s_time'=>0,"ZDayUserSumLV_s"=>0,"ZDayUserSumLV_s_time"=>0,);

            foreach($data as $vv){
                if($vv['CDayUserSumLV']!='NUN'){
                    $data_s['CDayUserSumLV_s']+=$vv['CDayUserSumLV'];
                    $data_s['CDayUserSumLV_s_time']++;
                }
                if($vv['WDayUserSumLV']!='NUN'){
                    $data_s['WDayUserSumLV_s']+=$vv['WDayUserSumLV'];
                    $data_s['WDayUserSumLV_s_time']++;
                }
                if($vv['SWDayUserSumLV']!='NUN'){
                    $data_s['SWDayUserSumLV_s']+=$vv['SWDayUserSumLV'];
                    $data_s['SWDayUserSumLV_s_time']++;
                }
                if($vv['SDayUserSumLV']!='NUN'){
                    $data_s['SDayUserSumLV_s']+=$vv['SDayUserSumLV'];
                    $data_s['SDayUserSumLV_s_time']++;
                }
                if($vv['DDayUserSumLV']!='NUN'){
                    $data_s['DDayUserSumLV_s']+=$vv['DDayUserSumLV'];
                    $data_s['DDayUserSumLV_s_time']++;
                }
                if($vv['EDayUserSumLV']!='NUN'){
                    $data_s['EDayUserSumLV_s']+=$vv['EDayUserSumLV'];
                    $data_s['EDayUserSumLV_s_time']++;
                }
                if($vv['ZDayUserSumLV']!='NUN'){
                    $data_s['ZDayUserSumLV_s']+=$vv['ZDayUserSumLV'];
                    $data_s['ZDayUserSumLV_s_time']++;
                }
            }
            @$UserDayLV1=sprintf("%.2f",$data_s['CDayUserSumLV_s']/$data_s['CDayUserSumLV_s_time']);
            @$UserDayLV4=sprintf("%.2f",$data_s['WDayUserSumLV_s']/$data_s['WDayUserSumLV_s_time']);
            @$UserDayLV14=sprintf("%.2f",$data_s['SWDayUserSumLV_s']/$data_s['SWDayUserSumLV_s_time']);
            @$UserDayLV2=sprintf("%.2f",$data_s['SDayUserSumLV_s']/$data_s['SDayUserSumLV_s_time']);
            @$UserDayLV3=sprintf("%.2f",$data_s['DDayUserSumLV_s']/$data_s['DDayUserSumLV_s_time']);
            @$UserDayLV5=sprintf("%.2f",$data_s['EDayUserSumLV_s']/$data_s['EDayUserSumLV_s_time']);
            @$UserDayLV6=sprintf("%.2f",$data_s['ZDayUserSumLV_s']/$data_s['ZDayUserSumLV_s_time']);
            $this->assign('UserDayLV1',$UserDayLV1);
            $this->assign('UserDayLV2',$UserDayLV2);
            $this->assign('UserDayLV3',$UserDayLV3);
            $this->assign('UserDayLV4',$UserDayLV4);
            $this->assign('UserDayLV5',$UserDayLV5);
            $this->assign('UserDayLV6',$UserDayLV6);
            $this->assign('UserDayLV14',$UserDayLV14);

        }else{
            $dblinkS=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],'','3');
            $serverIndex=0;
            $this->assign("data",'');
            @$StartDay=$cookie['DayReportStartDay']?$cookie['DayReportStartDay']:date("Y-m-d",time()-24*3600);
            @$EndDay=$cookie['DayReportEndDay']?$cookie['DayReportEndDay']:date("Y-m-d",time()-24*3600);
            $this->assign("startDay",$StartDay);
            $this->assign("endDay",$EndDay);
            $this->assign('UserDayLV1',0);
            $this->assign('UserDayLV2',0);
            $this->assign('UserDayLV3',0);
            $this->assign('UserDayLV4',0);
            $this->assign('UserDayLV5',0);
            $this->assign('UserDayLV6',0);
            $this->assign('UserDayLV14',0);
        }
        $this->assign('serverIndex',$serverIndex);
        $this->display("From/FUserRetention.html");
    }
}

?>