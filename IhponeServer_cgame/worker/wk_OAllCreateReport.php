<?php
/**
 * 全平台创建率
 */
class wk_OAllCreateReport extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        if(@$cookie['DayReportStartDay']){
            $StartDay=$cookie['DayReportStartDay'];
        }else{
            $StartDay=date("Y-m-d");
        }
        $this->assign("startDay",$StartDay);

        $StartDayTime=strtotime($StartDay);
        $EndDayTime=$StartDayTime+24*3600;

        $SDay=date("Y-m-d H:i:s",$StartDayTime);
        $EDay=date("Y-m-d H:i:s",$EndDayTime);
        $dblink=new cl_AllGamedb($this->DBReadLink(),'','',3);
        $jsDay=date("Y_m_d",$StartDayTime);
        if(date("Y_m_d")==$jsDay) {
           $tableName='LogSvr.dbo.LogMsg';
        }else{
            $tableName="LogSvr.dbo.ChartLog_{$jsDay}";
        }
        $sql = "select aa.sAccount,bb.PlayerID from s1.dbo.MIR_HUM_INFO as aa LEFT  JOIN (select PlayerID from {$tableName} GROUP  BY PlayerID ) as bb ON bb.PlayerID=aa.sAccount where aa.dCreateDate>='{$SDay}' and aa.dCreateDate < '{$EDay}'";
        $result=$dblink->query($sql);

        $objectS=$this->DBselectAll('objectS');
        foreach($objectS as $vv){
            $objectS_cl[$vv['id']]=$vv['title'];
        }
        $data=array();
        foreach($result as $ob=>$ser){
            $data[$ob]['objectTitle']=$objectS_cl[$ob];
            if(@!$data[$ob]['newCreateSum']){
                $data[$ob]['newCreateSum']=0;
                $data[$ob]['newLoginSum']=0;
            }
            foreach($ser as $item){
                foreach($item as $vv){
                     if(@$data[$ob]['newCreateSum']){
                         $data[$ob]['newCreateSum']++;
                     }else{
                         $data[$ob]['newCreateSum']=1;
                     }
                     if($vv['PlayerID']){
                         if(@$data[$ob]['newLoginSum']){
                             $data[$ob]['newLoginSum']++;
                         }else{
                             $data[$ob]['newLoginSum']=1;
                         }
                     }
                }
            }
        }
        $this->assign("data",$data);
        $this->display("Admin/AllCreateReport.html");
    }
}




?>