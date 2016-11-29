<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/25
 * Time: 17:54
 */
class wk_AllOnlineReport extends e_DataWorker{
    function Admin ($cookie,$cookieKey){
        if(@$cookie['DayReportStartDay'] && $cookie['DayReportEndDay']){
            $StartDay=$cookie['DayReportStartDay'];
            $EndDay=$cookie['DayReportEndDay'];
        }else{
            $StartDay=date("Y-m-d 00:00:00");
            $EndDay=date("Y-m-d 23:59:59");
        }
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);
        foreach($serverS as $vv){
            $serverS_cl[$vv['id']]=$vv['GameServerUnid'];
        }
        $EndDay_sql=date("Y-m-d H:i:s",strtotime($EndDay)+24*3600);
        $sql="select OnlineCount from dbo.MIR_ONLINE as aa where aa.UpdateTime >= '{$StartDay}' and aa.UpdateTime<='{$EndDay_sql}' ORDER  BY aa.UpdateTime desc";

        if(date("Y-m-d 23:59:59")!=$EndDay){
            $redisTime=7*24*3600;
        }else{
            $redisTime=600;
        }
        foreach($serverS as $vv) {
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$vv['id']);
            $result_cl=$dblink->query($sql,$redisTime);
            $result[$vv['id']]=$result_cl[$vv['id']];
        }

        $data=array();
        foreach($result as $key=>$item){
            foreach($item as $kk=>$vv){
                $data[$key]['gameUnid']=$serverS_cl[$key];
                if($kk==0) {
                    $data[$key]['nowOnlineUserNum'] =$vv['OnlineCount'];
                }
                if(@$data[$key]['topOnlineUserNum']){
                    if($data[$key]['topOnlineUserNum']<$vv['OnlineCount']){
                        $data[$key]['topOnlineUserNum']=$vv['OnlineCount'];
                    }
                }else{
                    $data[$key]['topOnlineUserNum']=$vv['OnlineCount'];
                }

                if(@$data[$key]['OnlineUserNum']){
                    $data[$key]['OnlineUserNum']+=$vv['OnlineCount'];
                }else{
                    $data[$key]['OnlineUserNum']=$vv['OnlineCount'];
                }
                if(@$data[$key]['OnlineTimes']){
                    $data[$key]['OnlineTimes']++;
                }else{
                    $data[$key]['OnlineTimes']=1;
                }
            }
        }
        $this->assign("data",$data);
        $this->display("Data/AllOnlineReport.html");

    }
}




?>