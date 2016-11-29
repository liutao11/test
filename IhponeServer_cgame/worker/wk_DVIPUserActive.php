<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/7/27
 * Time: 18:02
 */
class wk_DVIPUserActive extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,ServerTitle,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        @$serverId=$cookie['serverIndex']?$cookie['serverIndex']:$serverS[0]['id'];
        $className=__CLASS__;
        if(@$cookie[$className.'startDay'] && $cookie[$className.'endDay']){
            $startDay=$cookie[$className.'startDay'];
            $endDay=$cookie[$className.'endDay'];
        }else{
            $startDay=date("Y-m-d",time()-7*24*3600);
            $endDay=date("Y-m-d");
        }

        foreach($serverS as $v){
            if($v['id']==$serverId){
                $DBLogName=$v['DBLogName'];
                $DBGameName=$v['DBGameName'];
            }
        }
        $mssqlLink=new cl_gamedbS($this->DBReadLink(),$this->rd,$cookie['objectGround'],$serverId,$DBGameName);
        $sqlStartDay=$startDay." 00:00:00";
        $sqlEndDay=$endDay." 23:59:59";
        if(strtotime($sqlStartDay) < strtotime($sqlEndDay)) {
            $sql = "select nReserved1,saccount,dUpdateTime from mir_hum_info where nReserved1 > 0 and dCreateDate >= '{$sqlStartDay}' and dCreateDate <= '{$sqlEndDay}'";
        }else{
            $sql = "select nReserved1,saccount,dUpdateTime from mir_hum_info where nReserved1 > 0";
        }

        $redis_key="GMDB_".$cookie['objectGround']."_".$serverId."_".md5($sql)."_data";
        $data_redis=$this->rd->get($redis_key);
        $data=array(
            '1'=>array('LevelSum'=>0,'loseUserSum'=>0),
            '2'=>array('LevelSum'=>0,'loseUserSum'=>0),
            '3'=>array('LevelSum'=>0,'loseUserSum'=>0),
            '4'=>array('LevelSum'=>0,'loseUserSum'=>0),
            '5'=>array('LevelSum'=>0,'loseUserSum'=>0),
            '6'=>array('LevelSum'=>0,'loseUserSum'=>0),
            '7'=>array('LevelSum'=>0,'loseUserSum'=>0),
            '8'=>array('LevelSum'=>0,'loseUserSum'=>0),
            '9'=>array('LevelSum'=>0,'loseUserSum'=>0),
            '10'=>array('LevelSum'=>0,'loseUserSum'=>0),
        );
        $data_sum = 0;
        if($data_redis){
            echo 'ooo';
            $data=json_decode($data_redis,true);
        }else {
            $result_data=$mssqlLink->query($sql, 100);
            foreach($result_data as $key=>$item){
                foreach($item as $kk=>$vv){
                    if($vv['nReserved1'] <=100){
                        $data['1']['LevelSum']++;
                        $updateTime=strtotime($vv['dUpdateTime']);
                        $nowTime=time();
                        if($nowTime-3*34*3600 >= $updateTime){
                            $data['1']['loseUserSum']++;
                        }
                    }elseif($vv['nReserved1'] > 100 && $vv['nReserved1'] <= 10000){
                        $data['2']['LevelSum']++;
                        $updateTime=strtotime($vv['dUpdateTime']);
                        $nowTime=time();
                        if($nowTime-3*34*3600 >= $updateTime){
                            $data['2']['loseUserSum']++;
                        }
                    }elseif($vv['nReserved1'] > 10000 && $vv['nReserved1'] <= 50000){
                        $data['3']['LevelSum']++;
                        $updateTime=strtotime($vv['dUpdateTime']);
                        $nowTime=time();
                        if($nowTime-3*34*3600 >= $updateTime){
                            $data['3']['loseUserSum']++;
                        }
                    }elseif($vv['nReserved1'] > 50000 && $vv['nReserved1'] <= 100000){
                        $data['4']['LevelSum']++;
                        $updateTime=strtotime($vv['dUpdateTime']);
                        $nowTime=time();
                        if($nowTime-3*34*3600 >= $updateTime){
                            $data['4']['loseUserSum']++;
                        }
                    }elseif($vv['nReserved1'] > 100000 && $vv['nReserved1'] <= 300000){
                        $data['5']['LevelSum']++;
                        $updateTime=strtotime($vv['dUpdateTime']);
                        $nowTime=time();
                        if($nowTime-3*34*3600 >= $updateTime){
                            $data['5']['loseUserSum']++;
                        }
                    }elseif($vv['nReserved1'] > 300000 && $vv['nReserved1'] <= 500000){
                        $data['6']['LevelSum']++;
                        $updateTime=strtotime($vv['dUpdateTime']);
                        $nowTime=time();
                        if($nowTime-3*34*3600 >= $updateTime){
                            $data['6']['loseUserSum']++;
                        }
                    }elseif($vv['nReserved1'] > 500000 && $vv['nReserved1'] <= 1000000){
                        $data['7']['LevelSum']++;
                        $updateTime=strtotime($vv['dUpdateTime']);
                        $nowTime=time();
                        if($nowTime-3*34*3600 >= $updateTime){
                            $data['7']['loseUserSum']++;
                        }
                    }elseif($vv['nReserved1'] >1000000 && $vv['nReserved1'] <= 3000000){
                        $data['8']['LevelSum']++;
                        $updateTime=strtotime($vv['dUpdateTime']);
                        $nowTime=time();
                        if($nowTime-3*34*3600 >= $updateTime){
                            $data['8']['loseUserSum']++;
                        }
                    }elseif($vv['nReserved1'] >3000000 && $vv['nReserved1'] <= 5000000){
                        $data['9']['LevelSum']++;
                        $updateTime=strtotime($vv['dUpdateTime']);
                        $nowTime=time();
                        if($nowTime-3*34*3600 >= $updateTime){
                            $data['9']['loseUserSum']++;
                        }
                    }else{
                        $data['10']['LevelSum']++;
                        $updateTime=strtotime($vv['dUpdateTime']);
                        $nowTime=time();
                        if($nowTime-3*34*3600 >= $updateTime){
                            $data['10']['loseUserSum']++;
                        }
                    }
                }
            }
            if($result_data){
                $this->rd->setex($redis_key,300,json_encode($data));
            }
        }
        $VIpSum=0;
        $VIploseUserSum=0;
        foreach($data as $vv){
            $VIpSum+=$vv['LevelSum'];
            $VIploseUserSum+=$vv['loseUserSum'];
        }
        $data_cl=[];
        foreach($data as $key=>$vv){
            $vv['LevelSumLv']= $VIpSum?sprintf("%.4f", $vv['LevelSum']/$VIpSum)*100:0;
            $vv['loseUserSumLv']=$vv['LevelSum']?sprintf("%.4f",$vv['loseUserSum']/$vv['LevelSum'])*100:0;
            $data_cl[$key]=$vv;
        }
        $this->assign("data",$data_cl);
        $this->assign('serverIndex',$serverId);
        $this->assign('VIpSum',$VIpSum);
        $this->assign('VIploseUserSum',$VIploseUserSum);
        $this->assign("VIploseUserLv",$VIpSum?sprintf("%.4f",$VIploseUserSum/$VIpSum)*100:0);
        $this->assign("className",$className);
        $this->assign('startDay',$startDay);
        $this->assign('endDay',$endDay);
        $this->display("Data/DVIPUserActive.html");
    }
}
?>