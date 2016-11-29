<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/22
 * Time: 16:20
 */
class wk_RealTime extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $this->assign('serverIndex',$cookie['serverIndex']);
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex']);
        }else{
            $this->assign('serverIndex',0);
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround']);
        }
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,ServerTitle");
        $this->assign('serverS',$serverS);

        $StartDay=date("Y-m-d 00:00:00");
        $EndDay=date("Y-m-d 23:59:59");
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);
        $sql="select UpdateTime,OnlineCount from dbo.MIR_ONLINE where UpdateTime>'{$StartDay}' and UpdateTime< '{$EndDay}'";

        $result=$dblink->query($sql);

        $data=array();
        $length=(strtotime($EndDay)-strtotime($StartDay))/300;
        $data_x=array();
        for($i=0;$i<=$length;$i++){
            $data_x[]=date("Y-m-d H:i",(strtotime($StartDay)+300*$i));
            $key=strtotime($StartDay)+300*$i;
            $data[$key]=0;
        }
        foreach($result as $item){
            foreach($item as $vv){
                $UpdateTimeS=strtotime($vv['UpdateTime']);
                $UpdateTimeS_m=$UpdateTimeS%60;
                if($UpdateTimeS_m==1){
                    $UpdateTimeS=$UpdateTimeS-1;
                }elseif($UpdateTimeS_m==2){
                    $UpdateTimeS=$UpdateTimeS-2;
                }elseif($UpdateTimeS_m==59){
                    $UpdateTimeS=$UpdateTimeS+1;
                }elseif($UpdateTimeS_m==58){
                    $UpdateTimeS=$UpdateTimeS+2;
                }
                if(isset($data[$UpdateTimeS])){
                    $data[$UpdateTimeS]+=$vv['OnlineCount'];
                }

            }
        }
        ksort($data);

        //var_dump($data);
        $data_cl=array();
        foreach($data as $vv){
            $data_cl[]=ceil($vv*1.2);
        }

        $this->assign("data_cl",json_encode($data_cl));
        $this->assign("data_x",json_encode($data_x));

        $this->display("Data/RealTime.html");
    }
}



?>