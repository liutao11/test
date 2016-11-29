<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/5/24
 * Time: 19:52
 */
class wk_DfromReport extends e_DataWorker{
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
        $ExchangeRate=$this->main['ExchangeRate'];

        foreach($this->main['fromInfo'] as $vv_i){
            $fromInfo_cl[$vv_i['fromInfoId']]=$vv_i['fromInfoName'];
        }
        $this->assign('fromInfo_cl', $fromInfo_cl);
        @$this->assign('showFromId',$cookie['fromInfoId']?$cookie['fromInfoId']:0);
        @$this->assign('serverIndex',$cookie['serverIndex']?$cookie['serverIndex']:0);
        $this->assign('class','DfromReport');

        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 && @$cookie['fromInfoId']) {
            foreach($serverS as $server){
                if($server['id']==$cookie['serverIndex']){
                    $DBGameName=$server['DBGameName'];
                    $DBLogName=$server['DBLogName'];
                    $DBPayName=$server['DBPayName'];
                    $DBPayId=$server['DBPayId'];
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
                $keyDay_cl=date("Y_m_d",$StartDayTime+24*3600*$i);
                $redis_butter_key='Buffer::'.__CLASS__.'::'.$cookie['serverIndex'].'::'.$cookie['fromInfoId']."::".$keyDay;
                $data_day_db=$this->rd->get($redis_butter_key);
                if($data_day_db){
                    $data[$keyDay]=json_decode($data_day_db,true);
                }else {
                    $jsStartDayTime = date("Y-m-d H:i:s", $StartDayTime + 24 * 3600 * $i);
                    $jsEndDayTime = date("Y-m-d H:i:s", $StartDayTime + 24 * 3600 * ($i + 1));
                    $dblink = new cl_gamedbS($this->update_db->get_link(), $this->rd, $cookie['objectGround'], $cookie['serverIndex']);
                    //得到访问人数
                    if($keyDay==date("Y-m-d")){
                        $sql="select bb.sAccount,bb.fromIdm from {$DBLogName}.dbo.LogMsg as aa LEFT  JOIN  {$DBGameName}.dbo.MIR_HUM_SDKID as bb ON aa.PlayerID=bb.sAccount where bb.fromIdm={$cookie['fromInfoId']} GROUP BY bb.sAccount,bb.fromIdm";
                    }else{

                        $sql="select bb.sAccount,bb.fromIdm from {$DBLogName}.dbo.ChartLog_{$keyDay_cl} as aa LEFT  JOIN  {$DBGameName}.dbo.MIR_HUM_SDKID as bb ON aa.PlayerID=bb.sAccount where bb.fromIdm={$cookie['fromInfoId']} GROUP BY bb.sAccount,bb.fromIdm";
                    }
                    $fromUser_result=$dblink->query($sql);

                    foreach($fromUser_result as $vv){
                        $fromUserNum=count($vv);
                    }
                    $data[$keyDay]['fromUserNum']=$fromUserNum;


                    //渠道充值
                    $sql="select UserId,nNumber,fromIdm from {$DBPayName}.dbo.Pay_{$DBPayId} where createTimes >= '{$jsStartDayTime}' and createTimes < '{$jsEndDayTime}' and fromIdm='{$cookie['fromInfoId']}'";
                    $Pay_result=$dblink->query($sql);
                    $Pay_user_a=[];                      //充值人数集合
                    $PayAmount=0;                         //充值总数
                    foreach($Pay_result as $vv){
                        foreach($vv as $v){
                            $PayAmount+=($v['nNumber']/$ExchangeRate);
                            if(!in_array($v['UserId'],$Pay_user_a)){
                                $Pay_user_a[]=$v['UserId'];
                            }
                        }
                    }
                    $data[$keyDay]['payUserNum']=count($Pay_user_a);       //充值人数
                    $data[$keyDay]['payAmount']=$PayAmount;                //充值总数

                    $data[$keyDay]['dayARPU']=count($Pay_user_a)?sprintf("%.2f",$PayAmount/(count($Pay_user_a))):0;
                    if($keyDay==date("Y-m-d")){
                        $this->rd->setex($redis_butter_key, 60 * 10, json_encode($data[$keyDay]));
                    }else {
                        $this->rd->setex($redis_butter_key, 24 * 3600 * 10, json_encode($data[$keyDay]));
                    }
                }
            }
            $this->assign('data',$data);
        }else{
            $this->assign('data','');
        }
        $this->display("Data/DfromReport.html");
    }
}


?>