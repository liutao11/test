<?php
/**
 *创建日表
 */
class wk_DayReport extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
        if(@$cookie['DayReportStartDay'] && $cookie['DayReportEndDay']){
            $StartDay=$cookie['DayReportStartDay'];
            $EndDay=$cookie['DayReportEndDay'];
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");
        }
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);
        $this->assign('serverS',$serverS);
        $className='DayReport';
        $this->assign("className",$className);
        foreach($this->main['fromInfo'] as $vv_i){
            $fromInfo_cl[$vv_i['fromInfoId']]=$vv_i['fromInfoName'];
        }

        $cookieName=$this->main['cookieName'];

        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0) {
            foreach($serverS as $server){
                if($server['id']==$cookie['serverIndex']){
                    $DBPayName=$server['DBPayName'];
                    $DBPayId=$server['DBPayId'];
                    $DBLogName=$server['DBLogName'];
                    break;
                }
            }
            $this->assign('serverIndex',$cookie['serverIndex']);
            $StartDayTime=strtotime($StartDay);
            $EndDayTime=strtotime($EndDay);
            $DaySum=($EndDayTime-$StartDayTime)/(24*3600)+1;
            $data=[];
            for($i=0;$i<$DaySum;$i++){
                $keyDay=date("Y-m-d",$StartDayTime+24*3600*$i);
                $redis_butter_key=$cookieName.'::Buffer::'.__CLASS__.'::'.$cookie['serverIndex'].'::'.$keyDay;

                $data_day_db=$this->rd->get($redis_butter_key);
                if($data_day_db){
                    $data[$keyDay]=json_decode($data_day_db,true);
                }else {
                    $jsStartDayTime = date("Y-m-d H:i:s", $StartDayTime + 24 * 3600 * $i);
                    $jsStartDayTime_cl = date("Y_m_d", $StartDayTime + 24 * 3600 * $i);
                    $jsEndDayTime = date("Y-m-d H:i:s", $StartDayTime + 24 * 3600 * ($i + 1));
                    $dblink = new cl_gamedbS($this->update_db->get_link(), $this->rd, $cookie['objectGround'], $cookie['serverIndex']);

                    //在线数据

                    $sql = "select OnlineCount,UpdateTime from MIR_ONLINE where UpdateTime >= '{$jsStartDayTime}' and UpdateTime < '{$jsEndDayTime}'";
                    $OnLineDB = $dblink->query($sql);
                    $OnlineSum = 0;                    //总在线
                    $OnlineNo = 0;                     //数据条数
                    $OnlineUp = 0;                     //在线最高值
                    $OnlineDo = 0;                     //在线最低值
                    foreach ($OnLineDB as $key => $values) {
                        foreach ($values as $vv) {
                            $OnlineSum += $vv['OnlineCount'];
                            $OnlineNo++;
                            if ($vv['OnlineCount'] > $OnlineUp) {
                                $OnlineUp = $vv['OnlineCount'];
                            }
                            if ($OnlineDo) {
                                if ($vv['OnlineCount'] < $OnlineDo) {
                                    $OnlineDo = $vv['OnlineCount'];
                                }
                            } else {
                                $OnlineDo = $vv['OnlineCount'];
                            }
                        }
                    }
                    @$data[$keyDay]['Online_jp'] = $OnlineNo ? sprintf("%.2f", $OnlineSum / $OnlineNo) : 0;          //平均值
                    $data[$keyDay]['Online_up'] = $OnlineUp;
                    $data[$keyDay]['Online_do'] = $OnlineDo;
                    $data[$keyDay]['dayUserLoginSum']=0;
                    //当日之前的用户
                    $sql = "select aa.sAccount,aa.dCreateDate,aa.dUpdateTime,aa.IsFirstChar,bb.fromIdm from MIR_HUM_INFO as aa LEFT JOIN MIR_HUM_SDKID as bb  ON aa.sAccount=bb.sAccount where aa.dCreateDate < '{$jsEndDayTime}'";
                    $UserDB_result = $dblink->query($sql);
                    $UserSum = array();                                                          //总的用户集合
                    $DayNewUser = array();                                                       //新的用户
                    $DayLoginUser = array();                                                    //当天登入人数
                    $DaynewUserForm=array();
                    $newRolesSum = 0;                                                           //当天创建多少角色

                    foreach ($UserDB_result as $key => $values) {
                        foreach ($values as $vv) {
                            if (!in_array($vv['sAccount'], $UserSum)) {
                                $UserSum[] = $vv['sAccount'];
                            }
                            if (strtotime($vv['dCreateDate']) >= strtotime($jsStartDayTime) && strtotime($vv['dCreateDate']) < strtotime($jsEndDayTime)) {
                                $newRolesSum++;
                            }
                            if (strtotime($vv['dCreateDate']) >= strtotime($jsStartDayTime) && strtotime($vv['dCreateDate']) < strtotime($jsEndDayTime) && $vv['IsFirstChar'] == 1) {
                                if (!in_array($vv['sAccount'], $DayNewUser)) {
                                    $DayNewUser[] = $vv['sAccount'];
                                }
                                $DaynewUserForm[$vv['sAccount']]=$vv['fromIdm'];
                            }
                            if ($vv['dUpdateTime'] >= $jsStartDayTime && $vv['dUpdateTime'] < $EndDayTime) {
                                if (!in_array($vv['sAccount'], $DayLoginUser)) {
                                    $DayLoginUser[] = $vv['sAccount'];
                                }
                            }
                        }
                    }
                    $data[$keyDay]['newRolesSum'] = $newRolesSum;
                    $data[$keyDay]['UserSum'] = count($UserSum);
                    $data[$keyDay]['DayNewUser'] = count($DayNewUser);
                    $DaynewUserForm_cl=array();
                    foreach($DaynewUserForm as $vv){

                            if (@$DaynewUserForm_cl[$vv]) {
                                $DaynewUserForm_cl[$vv]['sum']++;
                            } else {
                                $DaynewUserForm_cl[$vv]['sum'] = 1;
                                if($vv) {
                                    @$DaynewUserForm_cl[$vv]['name'] = $fromInfo_cl[$vv];
                                }else{
                                    $DaynewUserForm_cl[$vv]['name'] = '未知';
                                }
                            }

                    }

                    $data[$keyDay]['DaynewUserForm']=$DaynewUserForm_cl;
                    //登入的需要改
                    //$data[$keyDay]['DayLoginUser']=count($DayLoginUser);
                    //当日充值数
                    $sql = "select aa.UserID,aa.nIndex,aa.nNumber,bb.UserID as bbUserID,aa.fromIdm from {$DBPayName}.dbo.pay_{$DBPayId} as aa LEFT JOIN (select UserID from  {$DBPayName}.dbo.pay_{$DBPayId} where createTimes < '{$jsStartDayTime}' GROUP BY UserID) as bb ON aa.UserID=bb.UserID where aa.createTimes >= '{$jsStartDayTime}' and aa.createTimes < '{$jsEndDayTime}'";
                    $pay_result = $dblink->query($sql);
                    $amountSum = 0;                      //总金额
                    $newPaySum_a = [];
                    $PaySum_a = [];
                    $ExchangeRate=$this->main['ExchangeRate'];
                    foreach ($pay_result as $key => $values) {
                        foreach ($values as $vv) {
                            $amountSum += ($vv['nNumber'] /$ExchangeRate );
                            if (!in_array($vv['UserID'], $PaySum_a)) {
                                $PaySum_a[] = $vv['UserID'];
                            }
                            if (!$vv['bbUserID']) {
                                if (!in_array($vv['UserID'], $newPaySum_a)) {
                                    $newPaySum_a[] = $vv['UserID'];
                                }
                            }
                        }
                    }

                    $data[$keyDay]['amountSum'] = $amountSum;                     //总金额
                    $data[$keyDay]['newPaySum'] = count($newPaySum_a);            //新增充值人数
                    $data[$keyDay]['PaySum'] = count($PaySum_a);                   //总充值人数


                    //求得当日登入量
                    if($jsStartDayTime_cl==date("Y_m_d")) {
                        $sql = "select PlayerID from {$DBLogName}.dbo.LogMsg GROUP  BY PlayerID";
                    }else{
                        $sql = "select PlayerID from {$DBLogName}.dbo.ChartLog_{$jsStartDayTime_cl} GROUP  BY PlayerID";
                    }

                    $dayLogin_result=$dblink->query($sql);
                    foreach($dayLogin_result as $item){
                        $data[$keyDay]['dayUserLoginSum']=count($item);
                    }
                    $data[$keyDay]['ARPU'] = $data[$keyDay]['dayUserLoginSum']?sprintf("%.2f",$amountSum/$data[$keyDay]['dayUserLoginSum']):0;
                    $data[$keyDay]['ARPPU'] = count($PaySum_a) ? sprintf("%.2f", $amountSum / count($PaySum_a)) : 0;

                    //新用户转化率
                    $data[$keyDay]['newUserPaylv']=$data[$keyDay]['DayNewUser']?sprintf("%.4f",$data[$keyDay]['newPaySum']/$data[$keyDay]['DayNewUser'])*100:0;
                    if(strtotime($keyDay) >= strtotime(date("Y-m-d"))){

                        $this->rd->setex($redis_butter_key, 60 * 10, json_encode($data[$keyDay]));
                    }else {
                        $this->rd->setex($redis_butter_key, 24 * 3600 * 10, json_encode($data[$keyDay]));
                    }
                }
            }
            $this->assign('data',$data);
        }else{
            $this->assign('data','');
            $this->assign('serverIndex',0);
        }
        $this->display("Data/DayReport.html");
    }
}

?>