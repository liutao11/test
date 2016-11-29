<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/7/25
 * Time: 17:15
 */
class wk_DTaskGroup extends e_DataWorker{
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
            $sql = "select Level,VarData0,dUpdateTime from mir_hum_info where dCreateDate >= '{$sqlStartDay}' and dCreateDate <= '{$sqlEndDay}'";
        }else{
            $sql = "select Level,VarData0,dUpdateTime from mir_hum_info";
        }

        $redis_key="GMDB_".$cookie['objectGround']."_".$serverId."_".md5($sql)."_data";
        var_dump($redis_key);
        $data_redis=$this->rd->get($redis_key);
        $data_sum = 0;
        if($data_redis){
           $data_a=json_decode($data_redis,true);
            foreach($data_a as $vv){
                $data_sum+=$vv['sum'];
            }
        }else {
            $varData_result = $mssqlLink->query($sql, 100);
            $data = [];
            foreach ($varData_result as $vv) {
                foreach ($vv as $v) {
                    $tackIdLevel = unpack("i", substr($v['VarData0'], 4, 4));
                    $levelKey=$tackIdLevel[1];
                    if (@$data[$levelKey]) {
                        $data[$levelKey]['sum']++;
                        if(@$data[$levelKey]['userLevel'][$v['Level']]){
                            $data[$levelKey]['userLevel'][$v['Level']]++;
                        }else{
                            $data[$levelKey]['userLevel'][$v['Level']]=1;
                        }
                        $updateTime=strtotime($v['dUpdateTime']);
                        $nowTime=time();
                        if($nowTime-3600*24*3 > $updateTime){
                            $data[$levelKey]['loseUserSum']+=1;
                        }
                    } else {
                        $data[$levelKey]['sum'] = 1;
                        $data[$levelKey]['userLevel'][$v['Level']]=1;
                        $updateTime=strtotime($v['dUpdateTime']);
                        $nowTime=time();
                        if($nowTime-3600*24*3 > $updateTime){
                            $data[$levelKey]['loseUserSum']=1;
                        }else{
                            $data[$levelKey]['loseUserSum']=0;
                        }
                    }
                    $data_sum++;
                }
            };

            $data_a=[];
            foreach($data as $key=>$vv){
                ksort($vv['userLevel']);
                $data_a[$key]=$vv;
            }
            ksort($data_a);
            if ($data_a) {
                $this->rd->setex($redis_key, 300, json_encode($data_a));
            }
        }
        $this->assign("data",$data_a);
        $this->assign("data_sum",$data_sum);
        $this->assign('serverIndex',$serverId);
        $this->assign("className",$className);
        $this->assign('startDay',$startDay);
        $this->assign('endDay',$endDay);
        $this->display("Data/DTaskGroup.html");
    }
}

?>