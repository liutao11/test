<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/30
 * Time: 10:36
 */
class wk_OAllPayReport extends e_AdminWorker{
    function  Admin($cookie,$cookieKey){
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

        $objectS=$this->DBselectAll('objectS');
        foreach($objectS as $vv){
            $objectS_cl[$vv['id']]=$vv['title'];
        }

        $dblink=new cl_AllGamedb($this->DBReadLink(),'','',3);
        $jsDay=date("Y_m_d",$StartDayTime);
        if(date("Y_m_d")==$jsDay) {
            $sql = "select PlayerID from logSvr.dbo.LogMsg GROUP  BY  PlayerID";
        }else{
            $sql = "select PlayerID from logSvr.dbo.ChartLog_{$jsDay} GROUP  BY  PlayerID";
        }
        $result=$dblink->query($sql);
        $data=array();
        foreach($result as $object=>$values){
            $data[$object]['objectTitle']=$objectS_cl[$object];
            foreach($values as $index=>$item){
                if(@$data[$object]['loginSum']){
                    $data[$object]['loginSum']+=count($item);
                }else{
                    $data[$object]['loginSum']=count($item);
                    $data[$object]['moneySum']=0;
                    $data[$object]['exeTimes']=0;

                    $data[$object]['NewUserNumber']=0;
                    $data[$object]['UserNumber']=0;
                }
            }
        }
        $sql="select count(aa.UserID) as exeTimes,sum(aa.nNumber)/100 as moneySum,count(bb.UserID) as oldIsPay  from s1.dbo.Pay as aa LEFT JOIN (select UserID from s1.dbo.Pay where createTimes < '{$SDay}' GROUP  BY UserID) as bb ON bb.UserID=aa.UserID where aa.createTimes >= '{$SDay}' and aa.createTimes < '{$EDay}' GROUP  BY aa.UserID";
        $result=$dblink->query($sql);
        if($result){
            foreach($result as $ob=>$server){
                foreach($server as $key=>$item){
                    foreach($item as $vv){
                        if(@$data[$ob]['moneySum']){
                            $data[$ob]['moneySum']+=$vv['moneySum'];
                        }else{
                            $data[$ob]['moneySum']=$vv['moneySum'];
                        }
                        if(@$data[$ob]['exeTimes']){
                            $data[$ob]['exeTimes']+=$vv['exeTimes'];
                        }else{
                            $data[$ob]['exeTimes']=$vv['exeTimes'];
                        }
                        if(!$vv['oldIsPay']){
                            $data[$ob]['NewUserNumber']++;
                        }
                        $data[$ob]['UserNumber']++;
                    }
                }
            }
        }
        $this->assign("data",$data);
        $this->display("Admin/AllPayReport.html");
    }
}


?>