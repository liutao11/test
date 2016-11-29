<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/25
 * Time: 15:26
 */
class wk_PayRanking extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        if(@$cookie['DayReportStartDay'] && $cookie['DayReportEndDay']){
            $StartDay=$cookie['DayReportStartDay'];
            $EndDay=$cookie['DayReportEndDay'];
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");

        }
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,NetUrl,DBPort,DBUser,DBPassword,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);
        $serverS_cl=array();
        foreach($serverS as $vv){
            $serverKeyValue[$vv['id']]=$vv['GameServerUnid'];
            $serverS_cl[$vv['id']]=$vv;
        }
        if(date("Y-m-d")!=$EndDay){
            $redisTime=7*24*3600;
        }else{
            $redisTime=600;
        }
        $ExchangeRate=$this->main['ExchangeRate'];
        $redis_key="GMToolPayRanking_buffer_".time();
        $className=__CLASS__;
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $this->assign('serverIndex',$cookie['serverIndex']);
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex']);
            $gameServerInfo=$serverS_cl[$cookie['serverIndex']];
            $StartDay_sql=$StartDay." 00:00:00";
            $EndDay_sql=date("Y-m-d H:i:s",strtotime($EndDay)+24*3600);
            $sql="select SUM(nNumber)/{$ExchangeRate} as nNumberSum,aa.UserID,bb.dCreateDate,bb.dUpdateTime from {$gameServerInfo['DBPayName']}.dbo.Pay_{$gameServerInfo['DBPayId']}  as aa LEFT  JOIN (select sAccount,sChrName,dupdateTime,dCreateDate from ( select sAccount,sChrName,dupdateTime,dCreateDate,row_number() over (partition by sAccount order by dupdateTime desc) rn   from  {$gameServerInfo['DBGameName']}.dbo.MIR_HUM_INFO ) t where t.rn <=1)  as bb on aa.UserID=bb.sAccount where aa.createTimes >= '{$StartDay_sql}' and aa.createTimes<='{$EndDay_sql}' GROUP  BY aa.UserID,bb.dCreateDate,bb.dUpdateTime";
            $result=$dblink->query($sql,$redisTime);
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

            $pagelength=30;


            @$showPageInt=$cookie[$className.'ShowPage']?$cookie[$className.'ShowPage']:1;
            $ListSum=count($data_b);
            $data=[];
            foreach($data_b as $key=>$item){
                    $key_b=$key+1;
                    if($key_b > ($showPageInt-1)*$pagelength && $key_b <= $showPageInt*$pagelength ) {
                        $item=json_decode($item,true);
                        $item['rowNum']=$key_b;
                        $data[] = $item;
                    }
            }

            @$this->assign('data',$data);
            $pageSum = ceil($ListSum / $pagelength);
            $this->assign("pageSum", $pageSum);
            $this->assign("pageSumTo5", $pageSum - 5);
            $this->assign("pageSumTo11", $pageSum - 11);
            $this->assign("showPageInt",$showPageInt);
            $this->assign("showPageIntS5", $showPageInt - 5);
            $this->assign("showPageIntA5", $showPageInt + 5);
            $this->assign("pageSum_11", $pageSum - 11);
            $this->assign('pagelength', $pagelength);
        }else{
            $this->assign('serverIndex',0);
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
                $result=$dblink->query($sql,$redisTime);
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

            $pagelength=30;
            @$showPageInt=$cookie[$className.'ShowPage']?$cookie[$className.'ShowPage']:1;
            $ListSum=count($data_b);
            $data=[];
            foreach($data_b as $key=>$item){
                $key_b=$key+1;
                if($key_b > ($showPageInt-1)*$pagelength && $key_b <= $showPageInt*$pagelength ) {
                    $item=json_decode($item,true);
                    $item['rowNum']=$key_b;
                    $data[] = $item;
                }
            }
            $this->assign('data',$data);
            $pageSum = ceil($ListSum / $pagelength);
            $this->assign("pageSum", $pageSum);
            $this->assign("pageSumTo5", $pageSum - 5);
            $this->assign("pageSumTo11", $pageSum - 11);
            $this->assign("showPageInt",$showPageInt);
            $this->assign("showPageIntS5", $showPageInt - 5);
            $this->assign("showPageIntA5", $showPageInt + 5);
            $this->assign("pageSum_11", $pageSum - 11);
            $this->assign('pagelength', $pagelength);
        }
        $this->assign('class',$className);
        $this->display("Data/PayRanking.html");
    }
}

?>