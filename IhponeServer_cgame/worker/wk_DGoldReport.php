<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/5/24
 * Time: 19:52
 */
class wk_DGoldReport extends e_DataWorker{
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
        $className='DGoldReport';
        $this->assign("className",$className);

        @$this->assign('serverIndex',$cookie['serverIndex']?$cookie['serverIndex']:0);
        $this->assign('class','DfromReport');

        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0) {
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
            @$inputRoles=$cookie[$className.'roles']?$cookie[$className.'roles']:"";
            $this->assign('roles',$inputRoles);

            for($i=0;$i<$DaySum;$i++){
                $keyDay=date("Y-m-d",$StartDayTime+24*3600*$i);
                $keyDay_cl=date("Y_m_d",$StartDayTime+24*3600*$i);
                $redis_butter_key='Buffer::'.__CLASS__.'::'.$cookie['serverIndex'].'::'.$inputRoles."::".$keyDay;
                $data_day_db=$this->rd->get($redis_butter_key);

                if($data_day_db){
                    $data[$keyDay]=json_decode($data_day_db,true);
                }else {
                    $jsStartDayTime = date("Y-m-d H:i:s", $StartDayTime + 24 * 3600 * $i);
                    $jsEndDayTime = date("Y-m-d H:i:s", $StartDayTime + 24 * 3600 * ($i + 1));
                    $dblink = new cl_gamedbS($this->update_db->get_link(), $this->rd, $cookie['objectGround'], $cookie['serverIndex']);

                    $addWhere='';
                    if($inputRoles){
                        $addWhere="and PlayerName='{$inputRoles}'";
                    }
                    //得到访问人数
                    if($keyDay==date("Y-m-d")){
                        $sql="select Value1,Value2 from {$DBLogName}.dbo.NormalMsg where MsgID=55 {$addWhere} ORDER  BY sendTime asc";
                    }else{
                        $sql="select Value1,Value2 from {$DBLogName}.dbo.ItemLog_{$keyDay_cl} where MsgID=55 {$addWhere} ORDER  BY sendTime asc";
                    }
                    $NormalMsg_result=$dblink->query($sql);
                    $data[$keyDay]['get_sum']=0;
                    $data[$keyDay]['pop_sum']=0;
                    foreach($NormalMsg_result as $key=>$vv){
                        foreach($vv as $k=>$v){
                            if($inputRoles){
                                if($k==0){
                                    $data[$keyDay]['cs_sum']=$v['Value2']-$v['Value1'];
                                }
                                if($v['Value1'] >0){
                                    $data[$keyDay]['get_sum']+=$v['Value1'];
                                }else{
                                    $data[$keyDay]['pop_sum']+=$v['Value1'];
                                }
                            }else{
                                if($v['Value1'] >0){
                                    $data[$keyDay]['get_sum']+=$v['Value1'];
                                }else{
                                    $data[$keyDay]['pop_sum']+=$v['Value1'];
                                }
                            }
                        }
                    }
                    if(@$inputRoles) {
                        $data[$keyDay]['yc_sum'] = $data[$keyDay]['cs_sum'] + $data[$keyDay]['get_sum'] + $data[$keyDay]['pop_sum'];
                    }

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
        $this->display("Data/DGoldReport.html");
    }
}


?>