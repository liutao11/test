<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/10/17
 * Time: 14:55
 */
class wk_PayRankingDoaload extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,NetUrl,DBPort,DBUser,DBPassword,DBGameName,DBLogName,DBPayName,DBPayId");
        $serverS_cl=array();
        if(is_array($serverS)) {
            foreach ($serverS as $vv) {
                $serverKeyValue[$vv['id']] = $vv['GameServerUnid'];
                $serverS_cl[$vv['id']] = $vv;
            }
        }
        $redis_key="GMToolPayRanking_buffer_".time();
        $ExchangeRate=$this->main['ExchangeRate'];
        $EndDay=$this->get['endDay'];
        $StartDay=$this->get['startDay'];
        $serverIndex=$this->get['serverIndex'];
        if(@$serverIndex && $serverIndex!=0 ) {
            $this->assign('serverIndex', $cookie['serverIndex']);
            $dblink = new cl_gamedbS($this->update_db->get_link(), $this->rd, $cookie['objectGround'], $cookie['serverIndex']);
            $gameServerInfo = $serverS_cl[$serverIndex];
            $StartDay_sql=$StartDay." 00:00:00";
            $EndDay_sql = date("Y-m-d H:i:s", strtotime($EndDay) + 24 * 3600);
            $sql = "select SUM(nNumber)/{$ExchangeRate} as nNumberSum,aa.UserID,bb.dCreateDate,bb.dUpdateTime from {$gameServerInfo['DBPayName']}.dbo.Pay_{$gameServerInfo['DBPayId']}  as aa LEFT  JOIN (select sAccount,sChrName,dupdateTime,dCreateDate from ( select sAccount,sChrName,dupdateTime,dCreateDate,row_number() over (partition by sAccount order by dupdateTime desc) rn   from  {$gameServerInfo['DBGameName']}.dbo.MIR_HUM_INFO ) t where t.rn <=1)  as bb on aa.UserID=bb.sAccount where aa.createTimes >= '{$StartDay_sql}' and aa.createTimes<='{$EndDay_sql}' GROUP  BY aa.UserID,bb.dCreateDate,bb.dUpdateTime";
            $result = $dblink->query($sql);
            $UserID_array=array();
            foreach($result as  $kk=>$item){
                foreach($item as $vv){
                    if(!in_array($vv['UserID'],$UserID_array)) {
                        $vv['GameServerUnid'] = $serverKeyValue[$kk];
                        $vv['dCreateDate_cl'] = date("Y-m-d H:i:s", strtotime($vv['dCreateDate']));
                        $day = ceil((time() - strtotime($vv['dUpdateTime'])) / (24 * 3600));
                        $vv['daySum'] = $day;
                        $this->rd->zAdd($redis_key, $vv['nNumberSum'], json_encode($vv));
                        $UserID_array[]=$vv['UserID'];
                    }
                }
            }
            $data_b=$this->rd->zRevRange($redis_key,0,-1);
            $this->rd->del($redis_key);
        }else{
            foreach($serverS as $server){
                $DBPayName=$server['DBPayName'];
                $DBPayId=$server['DBPayId'];
                $DBGameName = $server['DBGameName'];
                $netUrl =  $server['NetUrl'];
                $port =  $server['DBPort'];
                $user =  $server['DBUser'];
                $ServerTitle =  $server['ServerTitle'];
                $password =  $server['DBPassword'];
                $dbname=$DBGameName;
                $GameServerUnid=$server['GameServerUnid'];
                $dblink = new cl_gamedb($netUrl, $port, $user, $password, $dbname, $this->rd);
                $EndDay_sql=date("Y-m-d H:i:s",strtotime($EndDay)+24*3600);
                $StartDay_sql=$StartDay." 00:00:00";
                $sql="select SUM(nNumber)/{$ExchangeRate} as nNumberSum,aa.UserID,bb.dCreateDate,bb.dUpdateTime from {$DBPayName}.dbo.Pay_{$DBPayId}  as aa LEFT  JOIN (select sAccount,sChrName,dupdateTime,dCreateDate from ( select sAccount,sChrName,dupdateTime,dCreateDate,row_number() over (partition by sAccount order by dupdateTime desc) rn   from  {$DBGameName}.dbo.MIR_HUM_INFO ) t where t.rn <=1)  as bb on aa.UserID=bb.sAccount where aa.createTimes >= '{$StartDay_sql}' and aa.createTimes<='{$EndDay_sql}' GROUP  BY aa.UserID,bb.dCreateDate,bb.dUpdateTime";
                $result=$dblink->query($sql);
                $UserID_array=array();
                foreach($result as $vv){
                    if(!in_array($vv['UserID'],$UserID_array)) {
                        $vv['GameServerUnid'] = $GameServerUnid;
                        $vv['dCreateDate_cl'] = date("Y-m-d H:i:s", strtotime($vv['dCreateDate']));
                        $day = ceil((time() - strtotime($vv['dUpdateTime'])) / (24 * 3600));
                        $vv['daySum'] = $day;
                        $this->rd->zAdd($redis_key, $vv['nNumberSum'], json_encode($vv));
                        $UserID_array[]=$vv['UserID'];
                    }
                }


            }

            $data_b=$this->rd->zRevRange($redis_key,0,-1);
            $this->rd->del($redis_key);
        }
        $data_str="排名\t服区\t账号\t充值\t角色创建时间\t最后一次上线天线\t\n";
        $rowNum=1;
        if(is_array($data_b)) {
            foreach ($data_b as $vv_json) {
                $vv=json_decode($vv_json,true);
                $data_str.=$rowNum."\t".$vv['GameServerUnid']."\t".$vv['UserID']."\t".$vv['nNumberSum']."\t".$vv['dCreateDate_cl']."\t";
                if($vv['daySum']==1){
                    $data_str.="今天\t\n";
                }else{
                    $data_str.=$vv['daySum']."天前\t\n";
                }
                $rowNum++;
            }
        }
        $this->response->header("Content-type","application/vnd.ms-excel");
        $this->response->header("Content-Disposition","attachment;filename=PayRanking_{$serverIndex}_{$StartDay}_{$EndDay}.xls");
        $this->response->end($data_str);
    }
}

?>