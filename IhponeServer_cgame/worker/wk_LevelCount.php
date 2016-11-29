<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/22
 * Time: 18:17
 */
class wk_LevelCount extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName");
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
        $sqlStartDay=$startDay." 00:00:00";
        $sqlEndDay=$endDay." 23:59:59";
        if($serverId){
            $serverS_cl=[];
            foreach($serverS as $vv){
                $serverS_cl[$vv['id']]=$vv;
            }
            $serverIndex=$serverId;
            $this->assign('serverIndex',$serverIndex);
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$serverIndex);
            $sql="select Id,sChrName,Level,dUpdateTime from dbo.MIR_HUM_INFO where dCreateDate >= '{$sqlStartDay}' and dCreateDate <= '{$sqlEndDay}' and isFirstChar=1";
            $result=$dblink->query($sql,600);
            $data=array();
            $sum=0;
            $lostSum=0;
            foreach($result as $item) {
                foreach ($item as $vv) {
                    $sum++;
                    if (@$data[$vv['Level']]) {
                        $data[$vv['Level']]['levelSum']++;
                        $bTime = time() - 3 * 24 * 3600;
                        $updateTime = strtotime($vv['dUpdateTime']);
                        if ($bTime > $updateTime) {
                            $data[$vv['Level']]['LostLevelSum']++;
                            $lostSum++;
                        }
                        $data[$vv['Level']]['roleArray'][$vv['Id']]=$vv['sChrName'];
                    } else {
                        $data[$vv['Level']]['levelSum'] = 1;
                        $data[$vv['Level']]['levelNum']=$vv['Level'];
                        $bTime = time() - 3 * 24 * 3600;
                        $updateTime = strtotime($vv['dUpdateTime']);
                        if ($bTime > $updateTime) {
                            $data[$vv['Level']]['LostLevelSum'] = 1;
                            $lostSum++;
                        } else {
                            $data[$vv['Level']]['LostLevelSum'] = 0;
                        }
                        $data[$vv['Level']]['roleArray'][$vv['Id']]=$vv['sChrName'];
                    }
                }
            }
            $this->assign('sum',$sum);
            $this->assign('lostSum',$lostSum);
            $serverUnid=$serverS_cl[$serverIndex]['GameServerUnid'];

            $this->assign('serverUnid',$serverUnid);
            if(@$cookie['levelCountType']){
                if($cookie['levelCountType']==1){
                    foreach($data as $vv){
                        $this->rd->zAdd("GM_levelCountDB",$vv['levelSum'],json_encode($vv));
                    }
                }elseif($cookie['levelCountType']==2){
                    foreach($data as $vv){
                        $this->rd->zAdd("GM_levelCountDB",$vv['LostLevelSum'],json_encode($vv));
                    }
                }
                if($cookie['levelCountTypeValue']){
                    $redisScore=$this->rd->zRevRange("GM_levelCountDB",0,-1);
                }else{
                    $redisScore=$this->rd->zRange("GM_levelCountDB",0,-1);
                }
                $data=array();
                foreach($redisScore as $cLvv){
                    $data[]=json_decode($cLvv,true);
                }
                $this->rd->del("GM_levelCountDB");
                $this->assign("type",$cookie['levelCountType']);
                $this->assign("typeValue",$cookie['levelCountTypeValue']);
            }else{
                ksort($data);
                $this->assign("type",'');
                $this->assign("typeValue",'');
            }
            $data_level=array();
            $data_levelSum=array();
            $data_lostLevelSum=array();
            foreach($data as $item){
                $data_level[]=$item['levelNum'];
                $data_levelSum[]=$item['levelSum'];
                $data_lostLevelSum[]=$item['LostLevelSum'];
            }
            $this->assign('data_level',json_encode($data_level));
            $this->assign('data_levelSum',json_encode($data_levelSum));
            $this->assign('data_lostLevelSum',json_encode($data_lostLevelSum));
            $this->assign('data',$data);

            $data_down=[];
            foreach($data as $vv){
                $data_down_b=[];
                $data_down_b[]=$vv['levelNum'];
                $data_down_b[]= $serverUnid;
                $data_down_b[]=$vv['levelSum'];
                $data_down_b[]=sprintf("%.4f",$vv['levelSum']/$sum)*100;
                $data_down_b[]=$vv['LostLevelSum'];
                $data_down_b[]=sprintf("%.4f",$vv['LostLevelSum']/$vv['levelSum'])*100;
                $data_down[]=$data_down_b;
            }
            $this->assign("exportData",json_encode(array("object"=>$serverUnid."LevelCount.xls","title"=>array("等级","服区","本级人数","人数所占率","本级流失数","本级流失率"),"data"=>$data_down)));
        }else{
            $this->assign("type",'');
            $this->assign("typeValue",'');
            $this->assign('serverIndex',0);
            $this->assign("data",'');
            $this->assign('sum',0);
            $this->assign('lostSum',0);
            $this->assign('data_level','');
            $this->assign('data_levelSum','');
            $this->assign('data_lostLevelSum','');
        }
        $this->assign("className",$className);
        $this->assign('startDay',$startDay);
        $this->assign('endDay',$endDay);
        $this->display("Data/LevelCount.html");
    }
}



?>