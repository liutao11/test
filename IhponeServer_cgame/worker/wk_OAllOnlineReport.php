<?php
/**
 * 全平台在线情况
 */

class wk_OAllOnlineReport extends e_AdminWorker{
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
        $dblink=new cl_AllGamedb($this->DBReadLink());
        $sql="select OnlineCount,UpdateTime from dbo.MIR_ONLINE where UpdateTime>='{$SDay}' and UpdateTime < '{$EDay}' ORDER by UpdateTime desc";
        $result=$dblink->query($sql);

        $objectS=$this->DBselectAll('objectS');
        foreach($objectS as $vv){
            $objectS_cl[$vv['id']]=$vv['title'];
        }
        $db=array();
        foreach($result as $ob=>$ser){
            $data[$ob]['objectTitle']=$objectS_cl[$ob];
            foreach($ser as $item){
                foreach($item as $kk=>$vv) {
                    if($kk==0){
                        if(@$data[$ob]['nowOnlineSum']){
                            $data[$ob]['nowOnlineSum']+=$vv['OnlineCount'];
                        }else{
                            $data[$ob]['nowOnlineSum']=$vv['OnlineCount'];
                        }
                    }
                    if(@$data[$ob]['oneServerTopOnline']){
                        if($vv['OnlineCount']>$data[$ob]['oneServerTopOnline']){
                            $data[$ob]['oneServerTopOnline']=$vv['OnlineCount'];
                        }
                    }else{
                        $data[$ob]['oneServerTopOnline']=$vv['OnlineCount'];
                    }
                    if(@$data[$ob]['OnlineSum']){
                        $data[$ob]['OnlineSum']+=$vv['OnlineCount'];
                        $data[$ob]['OnlineSumTime']++;
                    }else{
                        $data[$ob]['OnlineSum']=$vv['OnlineCount'];
                        $data[$ob]['OnlineSumTime']=1;
                    }

                    if(@$db[$ob][$vv['UpdateTime']]){
                        $db[$ob][$vv['UpdateTime']]+=$vv['OnlineCount'];
                    }else{
                        $db[$ob][$vv['UpdateTime']]=$vv['OnlineCount'];
                    }


                }
            }
        }
        foreach($db as $kk=>$vv){
            arsort($vv);
            foreach($vv as $v){
                $data[$kk]['maxOnlineSum']=$v;
                break;
            }

        }
        $this->assign("data",$data);
        $this->display("Admin/AllOnlineReport.html");
    }
}



?>