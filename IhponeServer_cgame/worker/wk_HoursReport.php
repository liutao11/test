<?php
/**
 * 分时报表
 */
class wk_HoursReport extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $serverIndex=$cookie['serverIndex'];
        }else{
            $serverIndex=$serverS[0]['id'];
        }
        $this->assign('serverIndex',$serverIndex);
        $ExchangeRate=$this->main['ExchangeRate'];
        if(@$cookie['HoursReportDay']){
            $HoursReportDay=$cookie['HoursReportDay'];
        }else{
            $HoursReportDay=date("Y-m-d");
        }
        $this->assign("HoursReportDay",$HoursReportDay);
        $this->assign('serverS',$serverS);

        if(@$serverIndex && $serverIndex!=0 ){
            $dblinkS=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$serverIndex,'3');
            $serverRange=$cookie['serverUnid'];
        }else{
            $dblinkS=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],'','3');
            $serverRange='全服';
        }
        foreach($serverS as $vv){
            if($vv['id']==$serverIndex){
                $DBGameName=$vv['DBGameName'];
                break;
            }
        }



        $this->assign('serverRange',$serverRange);
        $SDay=$HoursReportDay." 00:00:00";
        $EDay=$HoursReportDay." 23:59:59";
        if(date("Y-m-d")==$HoursReportDay) {
            $sql = "select aa.dCreateDate,aa.sAccount,aa.IsFirstChar from {$DBGameName}.dbo.MIR_HUM_INFO as aa where aa.dCreateDate >= '{$SDay}' and  aa.dCreateDate <= '{$EDay}'";
        }else{
            $dbDay=date("Y_m_d",strtotime($HoursReportDay));
            $sql = "select aa.dCreateDate,aa.sAccount,aa.IsFirstChar from {$DBGameName}.dbo.MIR_HUM_INFO as aa where aa.dCreateDate >= '{$SDay}' and  aa.dCreateDate <= '{$EDay}'";
        }
        $data=array('00'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'01'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'02'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'03'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),
            '04'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'05'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'06'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'07'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),
            '08'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'09'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'10'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'11'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),
            '12'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'13'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'14'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'15'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),
            '16'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'17'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'18'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'19'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),
            '20'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'21'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'22'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),'23'=>array("newRoleSum"=>0,"IsFirstCharSum"=>0),
            );
        if($HoursReportDay!=date("Y-m-d",time())){
            $redisTime=7*24*3600;
        }else{
            $redisTime=300;
        }
        $result=$dblinkS->query($sql,$redisTime);
        $dataSum=array("newRoleSumHZ"=>0,"IsFirstCharSumHZ"=>0);
        foreach($result as $item){
            foreach($item as $vv){
                $hoursKey=date('H',strtotime($vv['dCreateDate']));
                $data[$hoursKey]['newRoleSum']++;
                $dataSum['newRoleSumHZ']++;
                if($vv['IsFirstChar']==1){
                    $data[$hoursKey]['IsFirstCharSum']++;
                    $dataSum['IsFirstCharSumHZ']++;
                }
            }
        }

        $this->assign('data',$data);
        $this->assign("dataSum",$dataSum);
        $this->display("Data/HoursReport.html");
    }
}



?>