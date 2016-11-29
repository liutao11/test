<?php
/**

 */
class wk_ActiveUsers extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName,ServerTitle,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        $className=__CLASS__;
        if(@$cookie[$className.'startDay'] && $cookie[$className.'endDay']){
            $startDay=$cookie[$className.'startDay'];
            $endDay=$cookie[$className.'endDay'];
        }else{
            $startDay=date("Y-m-d");
            $endDay=date("Y-m-d");
        }
        $this->assign("startDay",$startDay);
        $this->assign("endDay",$endDay);
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0){
            $serverIndex=$cookie['serverIndex'];
        }else{
            $serverIndex=$serverS['0']['id'];
        }
        $this->assign('className',$className);
        $this->assign('serverIndex',$serverIndex);
        $cookieName=$this->main['cookieName'];
        if($serverIndex){
            foreach($serverS as $vv) {
                if($vv['id']==$serverIndex) {
                    $LOGname = $vv['DBLogName'];
                    $GMname = $vv['DBGameName'];
                    $DBPayName = $vv['DBPayName'];
                    $DBPayId = $vv['DBPayId'];
                    break;
                }
            }

            $dblinkS=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$serverIndex);
            $dayLength=(strtotime($endDay)-strtotime($startDay))/(24*3600)+1;
            for($i=0;$i<$dayLength;$i++){
                $jsStartDay=date("Y-m-d H:i:s",strtotime($startDay)+$i*24*3600);
                $dayKey=date("Y_m_d",strtotime($startDay)+$i*24*3600);
                $jsEndDay=date("Y-m-d H:i:s",strtotime($startDay)+($i+1)*24*3600);

                $redisKey=$cookieName.$className."::".$cookie['objectGround']."::".$serverIndex."::".$dayKey;
                $buffer_str=$this->rd->get($redisKey);
                if($buffer_str){
                    $data[$dayKey]=json_decode($buffer_str,true);
                }else {
                    //新增账号
                    $sql = "select sAccount from {$GMname}.dbo.MIR_HUM_INFO where dCreateDate >= '{$jsStartDay}' and  dCreateDate < '{$jsEndDay}' and IsFirstChar=1";
                    $thisDayNewUser = $dblinkS->query($sql);
                    $data[$dayKey] = [];
                    foreach ($thisDayNewUser as $item) {
                        $data[$dayKey]['dayNewUser'] = count($item);
                    }
                    unset($thisDayNewUser);
                    //当天登入人数
                    if ($dayKey == date("Y_m_d")) {
                        $sql = "select count(aa.PlayerId) as loginSum from (select PlayerId from {$LOGname}.dbo.LogMsg GROUP  BY  PlayerId) as aa";
                    } else {
                        $sql = "select count(aa.PlayerId) as loginSum from (select PlayerId from {$LOGname}.dbo.ChartLog_{$dayKey} GROUP  BY  PlayerId) as aa";
                    }
                    $userLogin_result = $dblinkS->query($sql);
                    if ($userLogin_result)
                        foreach ($userLogin_result as $item) {
                            $data[$dayKey]['loginSum'] = $item['0']['loginSum'] ? $item['0']['loginSum'] : 0;
                        } else {
                        $data[$dayKey]['loginSum'] = 0;
                    }
                    unset($userLogin_result);
                    //计算当天之前用户量
                    $sql = "select count(sAccount) as userSum from {$GMname}.dbo.MIR_HUM_INFO where  dCreateDate < '{$jsEndDay}' and IsFirstChar=1";
                    $userSum_result = $dblinkS->query($sql);
                    foreach ($userSum_result as $item) {
                        $data[$dayKey]['userSum'] = $item['0']['userSum'];
                    }
                    unset($userSum_result);
                    //活跃度
                    $data[$dayKey]['UserActiveLV'] = $data[$dayKey]['userSum'] ? sprintf("%.4f", $data[$dayKey]['loginSum'] / $data[$dayKey]['userSum']) * 100 : "0";
                    //当天充值人数
                    $sql = "select COUNT (aa.UserID) as PayUserSum from (select UserID from {$DBPayName}.dbo.Pay_{$DBPayId} WHERE createTimes >= '{$jsStartDay}' and createTimes < '{$jsEndDay}' GROUP  BY  UserID) as aa";
                    $thisPayUser_result = $dblinkS->query($sql);
                    foreach ($thisPayUser_result as $item) {
                        $data[$dayKey]['DayPayUserSum'] = $item['0']['PayUserSum'];
                    }
                    unset($thisPayUser_result);
                    //当天充值率
                    $data[$dayKey]['DayPayUserLV'] = $data[$dayKey]['loginSum'] ? sprintf("%.4f", $data[$dayKey]['DayPayUserSum'] / $data[$dayKey]['loginSum']) * 100 : "0";
                    //总的充值用户
                    $sql = "select COUNT (aa.UserID) as PayUserSum from (select UserID from {$DBPayName}.dbo.Pay_{$DBPayId} WHERE createTimes < '{$jsEndDay}' GROUP  BY  UserID) as aa";
                    $thisPayUser_result = $dblinkS->query($sql);
                    foreach ($thisPayUser_result as $item) {
                        $data[$dayKey]['PayUserSum'] = $item['0']['PayUserSum'];
                    }
                    unset($thisPayUser_result);
                    //总的充值率
                    $data[$dayKey]['PayUserLV'] = $data[$dayKey]['userSum'] ? sprintf("%.4f", $data[$dayKey]['PayUserSum'] / $data[$dayKey]['userSum']) * 100 : "0";
                    if($data[$dayKey]) {
                        if ($dayKey == date("Y_m_d")) {
                            $this->rd->setex($redisKey, 300, json_encode($data[$dayKey]));
                        } else {
                            $this->rd->setex($redisKey, 7 * 24 * 3600, json_encode($data[$dayKey]));
                        }
                    }
                }
            }
        }else{
            $data=[];
        }
        $this->assign('data',$data);
        $this->display("Data/ActiveUsers.html");
    }
}


?>