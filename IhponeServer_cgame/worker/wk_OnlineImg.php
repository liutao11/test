<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/22
 * Time: 10:58
 */
class wk_OnlineImg extends e_DataWorker{
    function Admin ($cookie,$cookieKey){
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $serverId=$cookie['serverIndex'];
        }else{
            $serverId=0;
        }

        $this->assign('serverIndex',$serverId);
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName");
        $this->assign('serverS',$serverS);
        if(@$cookie['OnlineImgStartDay'] && $cookie['OnlineImgEndDay']){
            $StartDay=$cookie['OnlineImgStartDay'];
            $EndDay=$cookie['OnlineImgEndDay'];
        }else{
            $StartDay=date("Y-m-d 00:00:00");
            $EndDay=date("Y-m-d 23:59:59");

        }
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);

        if($serverId){
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$serverId);
            foreach($serverS as $vv){
                if($vv['id']==$serverId){
                    $DBGameName=$vv['DBGameName'];
                    break;
                }
            }
            $sql="select UpdateTime,OnlineCount from {$DBGameName}.dbo.MIR_ONLINE where UpdateTime>='{$StartDay}' and UpdateTime< '{$EndDay}'";
            $result=$dblink->query($sql,300);
        }else{
            foreach($serverS as $vv){
                $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$vv['id']);
                $sql="select UpdateTime,OnlineCount from {$vv['DBGameName']}.dbo.MIR_ONLINE where UpdateTime>='{$StartDay}' and UpdateTime< '{$EndDay}'";
                $result_b=$dblink->query($sql,300);
                $result[$vv['id']]=$result_b[$vv['id']];
            }
        }


        $data=array();
        $length=(strtotime($EndDay)-strtotime($StartDay))/300;
        $data_x=array();
        for($i=0;$i<=$length;$i++){
            $data_x[]=date("Y-m-d H:i",strtotime($StartDay)+300*$i);
            $data[(strtotime($StartDay)+300*$i)]=0;

        }

        foreach($result as $item){
            foreach($item as $vv){
                $UpdateTimeS=strtotime($vv['UpdateTime']);
                foreach($data as $dataKey=>$dataValue) {
                    if($UpdateTimeS <= ($dataKey+10) && $UpdateTimeS >= ($dataKey-10) ){
                        $data[$dataKey] += $vv['OnlineCount'];
                    }
                }
            }
        }
        ksort($data);
        $data_cl=array();
        foreach($data as $vv){
            $data_cl[]=ceil($vv*0.2)+$vv;
        }
        $this->assign("data_cl",json_encode($data_cl));
        $this->assign("data_x",json_encode($data_x));
        $this->assign("StartDayTime",strtotime($StartDay));
        $houre=date("H");
        if($houre<=6){
            $showIconStart=0;
            $showIconEnd=25;
        }elseif($houre>18 && $houre < 24){
            $showIconStart=75;
            $showIconEnd=100;
        }else{
            $showIconStart=(25+4.25*($houre-6))-12.5;
            $showIconEnd=(25+4.25*($houre-6))+12.5;;
        }

        $this->assign('showIconStart',$showIconStart);
        $this->assign("showIconEnd",$showIconEnd);

        $this->display("Data/OnlineImg.html");
    }
}