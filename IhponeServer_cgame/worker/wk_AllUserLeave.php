<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/5/30
 * Time: 10:47
 */
class wk_AllUserLeave extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ObjectId,GameServerUnid,NetUrl,DBPort,DBUser,DBPassword,DBGameName,DBLogName,ServerTitle");

        $this->assign('serverS',$serverS);
        @$StartDay_f=$cookie['AllUserLeaveStartDay']?$cookie['AllUserLeaveStartDay']:date("Y-m-d 00:00:00",time()-24*3600);
        @$EndDay=$cookie['AllUserLeaveEndDay']?$cookie['AllUserLeaveEndDay']:date("Y-m-d 23:59:59",time()-24*3600);
        $this->assign("startDay",$StartDay_f);
        $this->assign("endDay",$EndDay);

        $StartDayTime=strtotime($StartDay_f);
        $EndDayTime=strtotime($EndDay);
        $dayLeng=($EndDayTime-$StartDayTime)/(24*3600);
        $data=[];
        for($i=0;$i<$dayLeng;$i++) {
            $StartDay_s=$StartDayTime+$i*24*3600;
            $StartDayTableName = date("Y_m_d", $StartDay_s);
            $data[$StartDayTableName]['date']=$StartDayTableName;
            $StartDayTableName_s = date("Y-m-d 00:00:00", $StartDay_s);
            $StartDayTableName_e = date("Y-m-d 00:00:00", $StartDay_s + 24 * 3600);
            //当如用户数
            $user_result=[];
            $jsNewUser_o_sum=0;
            foreach($serverS as $server ) {
                $dblink=new cl_gamedb($server['NetUrl'],$server['DBPort'],$server['DBUser'],$server['DBPassword'],$server['DBGameName'],$this->rd);
                $sql = "select aa.Schrname,aa.sAccount from {$server['DBGameName']}.dbo.mir_hum_info as aa where dcreateDate >= '{$StartDayTableName_s}' and   dcreateDate < '{$StartDayTableName_e}' and isFirstChar=1 ";
                $user_result_data=$dblink->query($sql);
                $user_result[$server['id']]=$user_result_data;
                $jsNewUser_o_sum+=count($user_result_data);
            }

            $jsNewUser_o=[];      //当天新的用户

            foreach($user_result as $vv){
                foreach($vv as $v){
                    if(!in_array($v['sAccount'],$jsNewUser_o)){
                        $jsNewUser_o[]=$v['sAccount'];
                    }
                }
            }

            //$data[$StartDayTableName]['jsNewUserSum']=count($jsNewUser_o);
            $data[$StartDayTableName]['jsNewUserSum']=$jsNewUser_o_sum;

            //次日留存
            $crUserJoin_count = 0;           //次日登入数
            $CDayUserResult=[];
            $jstime = $StartDay_s + 24 * 3600;
            if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {
                $StartDayTableName_CDay = date("Y_m_d", $StartDay_s + 24 * 3600);
                foreach($serverS as $server ) {
                    $dblink=new cl_gamedb($server['NetUrl'],$server['DBPort'],$server['DBUser'],$server['DBPassword'],$server['DBGameName'],$this->rd);
                    $DBLogName=$server['DBLogName'];
                    if ($StartDayTableName_CDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 300);
                    } else {
                        $sql = "select  aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_CDay} as aa where msgId=100  GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 24 * 3600);
                    }
                }
                if($CDayUserResult) {
                    foreach ($CDayUserResult as $key => $item) {
                        if($item) {
                            foreach ($item as $kk => $vv) {
                                if (in_array($vv['PlayerID'], $jsNewUser_o)) {
                                    $crUserJoin_count++;
                                }
                            }
                        }
                    }

                    $data[$StartDayTableName]['CDayUserSumLV'] = $data[$StartDayTableName]['jsNewUserSum'] ? sprintf("%.4f", $crUserJoin_count / $data[$StartDayTableName]['jsNewUserSum']) * 100 : "0";
                }else{
                    $data[$StartDayTableName]['CDayUserSumLV']=0;
                }
            } else {
                $data[$StartDayTableName]['CDayUserSumLV'] = "NUN";
            }



            //+2日留存
            $CDayUserDataArray_and_thisUserDataArray_count = 0;
            $CDayUserResult=[];
            $jstime = $StartDay_s + 24 * 3600 * 2;
            if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {
                $StartDayTableName_CDay = date("Y_m_d", $StartDay_s + 24 * 3600 * 2);
                foreach($serverS as $server ) {
                    $dblink=new cl_gamedb($server['NetUrl'],$server['DBPort'],$server['DBUser'],$server['DBPassword'],$server['DBGameName'],$this->rd);
                    $DBLogName=$server['DBLogName'];
                    if ($StartDayTableName_CDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_CDay} as aa where msgId=100  GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 24 * 3600);
                    }

                }
                foreach ($CDayUserResult as $key => $item) {
                    foreach ($item as $kk => $vv) {
                        if (in_array($vv['PlayerID'],  $jsNewUser_o)) {
                            $CDayUserDataArray_and_thisUserDataArray_count++;
                        }
                    }
                }
                $data[$StartDayTableName]['SDayUserSumLV'] = $data[$StartDayTableName]['jsNewUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count / $data[$StartDayTableName]['jsNewUserSum']) * 100 : "0";
            } else {
                $data[$StartDayTableName]['SDayUserSumLV'] = "NUN";
            }

            //+3日留存

            $CDayUserDataArray_and_thisUserDataArray_count = 0;
            $CDayUserResult=[];
            $jstime = $StartDay_s + 24 * 3600 * 3;
            if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {
                $StartDayTableName_CDay = date("Y_m_d", $StartDay_s + 24 * 3600 * 3);
                foreach($serverS as $server ) {
                    $dblink = new cl_gamedb($server['NetUrl'], $server['DBPort'], $server['DBUser'], $server['DBPassword'], $server['DBGameName'], $this->rd);
                    $DBLogName = $server['DBLogName'];
                    if ($StartDayTableName_CDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_CDay} as aa where msgId=100  GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 24 * 3600);
                    }
                }
                foreach ($CDayUserResult as $key => $item) {
                    foreach ($item as $kk => $vv) {
                        if (in_array($vv['PlayerID'], $jsNewUser_o)) {
                            $CDayUserDataArray_and_thisUserDataArray_count++;
                        }
                    }
                }
                $data[$StartDayTableName]['DDayUserSumLV'] = $data[$StartDayTableName]['jsNewUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count /$data[$StartDayTableName]['jsNewUserSum']) * 100 : "0";
            } else {
                $data[$StartDayTableName]['DDayUserSumLV'] = "NUN";
            }


            //+4留存率
            $CDayUserDataArray_and_thisUserDataArray_count = 0;
            $CDayUserResult=[];
            $jstime = $StartDay_s + 4 * 24 * 3600;
            if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {

                $StartDayTableName_WDay = date("Y_m_d", $StartDay_s + 24 * 3600 * 4);
                foreach($serverS as $server ) {
                    $dblink = new cl_gamedb($server['NetUrl'], $server['DBPort'], $server['DBUser'], $server['DBPassword'], $server['DBGameName'], $this->rd);
                    $DBLogName = $server['DBLogName'];
                    if ($StartDayTableName_WDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_WDay} as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 24 * 3600);
                    }
                }
                foreach ($CDayUserResult as $key => $item) {
                    foreach ($item as $kk => $vv) {
                        if (in_array($vv['PlayerID'], $jsNewUser_o)) {
                            $CDayUserDataArray_and_thisUserDataArray_count++;
                        }
                    }
                }
                $data[$StartDayTableName]['WDayUserSumLV'] = $data[$StartDayTableName]['jsNewUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count /  $data[$StartDayTableName]['jsNewUserSum']) * 100 : "0";
            } else {
                $data[$StartDayTableName]['WDayUserSumLV'] = "NUN";
            }
            //+5留存率
            $CDayUserDataArray_and_thisUserDataArray_count = 0;
            $CDayUserResult=[];
            $jstime = $StartDay_s + 5 * 24 * 3600;
            if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {

                $StartDayTableName_WDay = date("Y_m_d", $StartDay_s + 24 * 3600 * 5);
                foreach($serverS as $server ) {
                    $dblink = new cl_gamedb($server['NetUrl'], $server['DBPort'], $server['DBUser'], $server['DBPassword'], $server['DBGameName'], $this->rd);
                    $DBLogName = $server['DBLogName'];
                    if ($StartDayTableName_WDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_WDay} as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 24 * 3600);
                    }
                }
                foreach ($CDayUserResult as $key => $item) {
                    foreach ($item as $kk => $vv) {
                        if (@in_array($vv['PlayerID'], $jsNewUser_o)) {
                            $CDayUserDataArray_and_thisUserDataArray_count++;
                        }
                    }
                }
                $data[$StartDayTableName]['EDayUserSumLV'] = $data[$StartDayTableName]['jsNewUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count / $data[$StartDayTableName]['jsNewUserSum']) * 100 : "0";
            } else {
                $data[$StartDayTableName]['EDayUserSumLV'] = "NUN";
            }

            //+6留存率
            $CDayUserDataArray_and_thisUserDataArray_count = 0;
            $CDayUserResult=[];
            $jstime = $StartDay_s + 6 * 24 * 3600;
            if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {

                $StartDayTableName_WDay = date("Y_m_d", $StartDay_s + 24 * 3600 * 6);
                foreach($serverS as $server ) {
                    $dblink = new cl_gamedb($server['NetUrl'], $server['DBPort'], $server['DBUser'], $server['DBPassword'], $server['DBGameName'], $this->rd);
                    $DBLogName = $server['DBLogName'];
                    if ($StartDayTableName_WDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_WDay} as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 24 * 3600);
                    }
                }
                foreach ($CDayUserResult as $key => $item) {
                    foreach ($item as $kk => $vv) {
                        if (in_array($vv['PlayerID'], $jsNewUser_o)) {
                            $CDayUserDataArray_and_thisUserDataArray_count++;
                        }
                    }
                }
                $data[$StartDayTableName]['ZDayUserSumLV'] = $data[$StartDayTableName]['jsNewUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count / $data[$StartDayTableName]['jsNewUserSum']) * 100 : "0";
            } else {
                $data[$StartDayTableName]['ZDayUserSumLV'] = "NUN";
            }


            //15日
            $CDayUserDataArray_and_thisUserDataArray_count = 0;
            $CDayUserResult=[];
            $jstime = $StartDay_s + 14 * 24 * 3600;
            if ($jstime < strtotime(date("Y-m-d 23:59:59"))) {

                $StartDayTableName_WDay = date("Y_m_d", $jstime);
                foreach($serverS as $server ) {
                    $dblink = new cl_gamedb($server['NetUrl'], $server['DBPort'], $server['DBUser'], $server['DBPassword'], $server['DBGameName'], $this->rd);
                    $DBLogName = $server['DBLogName'];
                    if ($StartDayTableName_WDay == date("Y_m_d")) {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.LogMsg as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 300);
                    } else {
                        $sql = "select aa.PlayerID from {$DBLogName}.dbo.ChartLog_{$StartDayTableName_WDay} as aa where msgId=100 GROUP BY aa.PlayerID";
                        $CDayUserResult[$server['id']] = $dblink->query($sql, 24 * 3600);
                    }
                }
                foreach ($CDayUserResult as $key => $item) {
                    foreach ($item as $kk => $vv) {
                        if (in_array($vv['PlayerID'],$jsNewUser_o )) {
                            $CDayUserDataArray_and_thisUserDataArray_count++;
                        }
                    }
                }
                $data[$StartDayTableName]['SWDayUserSumLV'] = $data[$StartDayTableName]['jsNewUserSum'] ? sprintf("%.4f", $CDayUserDataArray_and_thisUserDataArray_count / $data[$StartDayTableName]['jsNewUserSum']) * 100 : "0";
            } else {
                $data[$StartDayTableName]['SWDayUserSumLV'] = "NUN";
            }
        }
        $this->assign("data",$data);

        $this->display("Data/AllUserLeave.html");
    }
}

?>