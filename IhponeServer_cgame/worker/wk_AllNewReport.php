<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/25
 * Time: 17:08
 */
class wk_AllNewReport extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        if(@$cookie['DayReportStartDay'] && $cookie['DayReportEndDay']){
            $StartDay=$cookie['DayReportStartDay'];
            $EndDay=$cookie['DayReportEndDay'];
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");

        }
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName,ServerTitle");
        $this->assign('serverS',$serverS);
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);
        $serverS_cl=array();
        foreach($serverS as $vv){
            $serverS_cl[$vv['id']]=$vv;
        }
        foreach($serverS as $vv){
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$vv['id']);
            $EndDay_sql=date("Y-m-d H:i:s",strtotime($EndDay)+24*3600);
            $sql="select sChrName,sAccount,isFirstChar from {$vv['DBGameName']}.dbo.mir_hum_info where dCreateDate >= '{$StartDay}' and dCreateDate <= '{$EndDay_sql}'";
            $result_cl=$dblink->query($sql);
            $result[$vv['id']]=$result_cl[$vv['id']];

        }
        $sumRoles=0;
        $sumAccos=0;
        foreach($result as $key=>$vv){
            $data[$key]['severTitle']=$serverS_cl[$key]['ServerTitle'];
            $data[$key]['newRoleSum']=count($vv);
            $sumRoles+=count($vv);
            $data[$key]['newAccountSum']=0;
            foreach($vv as $v){
                if($v['isFirstChar']==1){
                    $data[$key]['newAccountSum']++;
                    $sumAccos++;
                }
            }
        }
        $this->assign('sumRoles',$sumRoles);
        $this->assign('sumAccos',$sumAccos);
        $this->assign('data',$data);
        $this->display("Data/AllNewReport.html");
    }
}




?>