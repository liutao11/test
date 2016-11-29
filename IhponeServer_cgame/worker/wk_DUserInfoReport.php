<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/5/26
 * Time: 10:20
 */
class wk_DUserInfoReport extends e_DataWorker{
    function Admin($cookie,$cookieKey){

        $serverS = $this->DBselectAll("gameServer", "ObjectId='{$cookie['objectGround']}' and isClose=1", "id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS', $serverS);
        if(@$cookie['DayReportStartDay'] && $cookie['DayReportEndDay']){
            $StartDay=$cookie['DayReportStartDay'];
            $EndDay=$cookie['DayReportEndDay'];
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");
        }
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);
        $className=__CLASS__;
        $this->assign("className",$className);
        @$stayId=$cookie[$className.'stayId']?$cookie[$className.'stayId']:0;
        $this->assign('stayId',$stayId);
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 && $stayId) {
            $this->assign('serverIndex',$cookie['serverIndex']);
            foreach($serverS as $server){
                if($server['id']==$cookie['serverIndex']){
                    $DBGameName=$server['DBGameName'];
                    $DBLogName=$server['DBLogName'];
                    $DBPayName=$server['DBPayName'];
                    $DBPayId=$server['DBPayId'];
                    break;
                }
            }
            $StartDayTime=strtotime($StartDay);
            $EndDayTime=strtotime($EndDay);
            $DaySum=($EndDayTime-$StartDayTime)/(24*3600)+1;
            $data=[];
            for($i=0;$i<$DaySum;$i++){
                $keyDay=date("Y-m-d",$StartDayTime+24*3600*$i);
                $keyDay_cl=date("Y_m_d",$StartDayTime+24*3600*$i);
                $redis_butter_key='Buffer::'.__CLASS__.'::'.$cookie['serverIndex'].'::'.$stayId."::".$keyDay;
                $data_day_db=$this->rd->get($redis_butter_key);
                if($data_day_db){
                    $data[$keyDay]=json_decode($data_day_db,true);
                }else {
                    $jsStartDayTime = date("Y-m-d H:i:s", $StartDayTime + 24 * 3600 * $i);
                    $jsEndDayTime = date("Y-m-d H:i:s", $StartDayTime + 24 * 3600 * ($i + 1));
                    $dblink = new cl_gamedbS($this->update_db->get_link(), $this->rd, $cookie['objectGround'], $cookie['serverIndex']);

                    if($stayId==1){                                //职业分布
                        $sql="select btjob from {$DBGameName}.dbo.MIR_HUM_INFO where dCreateDate < '{$jsEndDayTime}'";
                        $day_data_butter=array('0'=>0,'1'=>0,'2'=>0);
                        $btjob_resutl=$dblink->query($sql);
                        foreach($btjob_resutl as $vv){
                            foreach($vv as $v){
                                $day_data_butter[$v['btjob']]++;
                            }
                        }
                        $data[$keyDay]['jobIndex0']=$day_data_butter['0'];
                        $data[$keyDay]['jobIndex1']=$day_data_butter['1'];
                        $data[$keyDay]['jobIndex2']=$day_data_butter['2'];
                        $data[$keyDay]['jobSum']=$day_data_butter['0']+$day_data_butter['1']+$day_data_butter['2'];
                    }elseif($stayId==2){
                        if($keyDay==date("Y-m-d")){
                            $sql="select PlayerName,Value1 from {$DBLogName}.dbo.NormalMsg where MsgID=59";
                        }else{
                            $sql="select PlayerName,Value1 from {$DBLogName}.dbo.ItemLog_{$keyDay_cl} where MsgID=59";
                        }
                        $level_result=$dblink->query($sql);
                        $level_onlyOne=[];
                        foreach($level_result as $vv){
                            foreach($vv as $v){
                                $level_onlyOne[$v['PlayerName']]=$v['Value1'];
                            }
                        }
                        $data[$keyDay]=array('group1'=>0,'group2'=>0,'group3'=>0,'group4'=>0,'group5'=>0,'group6'=>0,'group7'=>0,'group8'=>0,'group9'=>0,'group10'=>0);
                        foreach($level_onlyOne as $values){
                            if($values <=10){
                                $data[$keyDay]['group1']++;
                            }elseif($values >= 11 and $values <=20){
                                $data[$keyDay]['group2']++;
                            }elseif($values >= 21 and $values <=30){
                                $data[$keyDay]['group3']++;
                            }elseif($values >= 31 and $values <=40){
                                $data[$keyDay]['group4']++;
                            }elseif($values >= 41 and $values <=50){
                                $data[$keyDay]['group5']++;
                            }elseif($values >= 51 and $values <=60){
                                $data[$keyDay]['group6']++;
                            }elseif($values >= 61 and $values <=70){
                                $data[$keyDay]['group7']++;
                            }elseif($values >= 71 and $values <=80){
                                $data[$keyDay]['group8']++;
                            }elseif($values >= 81 and $values <=90){
                                $data[$keyDay]['group8']++;
                            }elseif($values >= 91 and $values <=100){
                                $data[$keyDay]['group8']++;
                            }
                        }
                    }elseif($stayId==3){
                        if($keyDay==date("Y-m-d")){
                            $sql="select PlayerName,Value1 from {$DBLogName}.dbo.NormalMsg where MsgID=52";
                        }else{
                            $sql="select PlayerName,Value1 from {$DBLogName}.dbo.ItemLog_{$keyDay_cl} where MsgID=52";
                        }
                        $level_result=$dblink->query($sql);
                        $level_onlyOne=[];
                        foreach($level_result as $vv){
                            foreach($vv as $v){
                                $level_onlyOne[$v['PlayerName']]=$v['Value1'];
                            }
                        }
                        $data[$keyDay]=array('1'=>0,'2'=>0,'3'=>0,'4'=>0,'5'=>0,'6'=>0,'7'=>0,'8'=>0,'9'=>0,'10'=>0,'11'=>0,'12'=>0,'13'=>0,'14'=>0,'15'=>0);
                        foreach($level_onlyOne as $values){
                            if(@$data[$keyDay][$values]){
                                $data[$keyDay][$values]++;
                            }else{
                                $data[$keyDay][$values]=1;
                            }
                        }
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
            $this->assign('serverIndex',0);
        }

        $this->display("Data/DUserInfoReport.html");
    }
}

?>