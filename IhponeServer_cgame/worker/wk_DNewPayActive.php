<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/7/27
 * Time: 15:33
 */
class wk_DNewPayActive extends e_DataWorker{
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
            $data=[];
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
                    $sql = "select aa.UserId,bb.PaySum,aa.createtimes from ( select a.UserId,a.createtimes from {$DBPayName}.dbo.Pay_{$DBPayId} as a where nIndex = ( select min(nIndex) from {$DBPayName}.dbo.Pay_{$DBPayId} where UserId = a.UserId ) and a.createtimes > '{$jsStartDay}' and a.createtimes <'{$jsEndDay}' ) as aa LEFT JOIN ( select UserID,count(UserId) as PaySum from {$DBPayName}.dbo.Pay_{$DBPayId} group by UserId ) as bb on aa.UserId=bb.UserId";
                    $thisDayNewUser = $dblinkS->query($sql);
                    $data[$dayKey] = array('dayNewPayUserSum'=>0,"SecondPaySum"=>0,"ThirdPaySum"=>0,"morePaySum"=>0);
                    foreach ($thisDayNewUser as $item) {
                        foreach($item as $vv){
                            $data[$dayKey]['dayNewPayUserSum']++;
                            if($vv['PaySum']>1){
                                $data[$dayKey]['SecondPaySum']++;
                            }
                            if($vv['PaySum']>2){
                                $data[$dayKey]['ThirdPaySum']++;
                            }
                            if($vv['PaySum']>3){
                                $data[$dayKey]['morePaySum']++;
                            }
                        }
                    }
                    unset($thisDayNewUser);
                    //当天登入人数

                    if($data[$dayKey]) {
                        $this->rd->setex($redisKey, 300, json_encode($data[$dayKey]));
                    }
                }
            }
        }else{
            $data=[];
        }
        $data_cl=[];
        foreach($data as $key=>$vv){
            $vv['SecondPaySumLv']=$vv['dayNewPayUserSum']?sprintf("%.4f",$vv['SecondPaySum']/$vv['dayNewPayUserSum'])*100:0;
            $vv['ThirdPaySumLv']=$vv['dayNewPayUserSum']?sprintf("%.4f",$vv['ThirdPaySum']/$vv['dayNewPayUserSum'])*100:0;
            $vv['morePaySumLv']=$vv['dayNewPayUserSum']?sprintf("%.4f",$vv['morePaySum']/$vv['dayNewPayUserSum'])*100:0;
            $data_cl[$key]=$vv;
        }
        $this->assign('data',$data_cl);
        $this->display("Data/DNewPayActive.html");
    }
}

?>