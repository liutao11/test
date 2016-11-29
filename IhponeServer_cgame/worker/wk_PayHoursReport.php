<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/25
 * Time: 10:16
 */
class wk_PayHoursReport extends e_DataWorker{
    function  Admin($cookie,$cookieKey){
        if(@$cookie['HoursReportDay']){
            $StartDay=$cookie['HoursReportDay'];
        }else{
            $StartDay=date("Y-m-d 00:00:00");
        }
        $this->assign("StartDay",$StartDay);
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        $ExchangeRate=$this->main['ExchangeRate'];
        $this->assign("ExchangeRate",$ExchangeRate);
        $serverKeyValue=array();
        foreach($serverS as $vv){
            $serverKeyValue[$vv['id']]=$vv['GameServerUnid'];
            $serverS_cl[$vv['id']]=$vv;
        }
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ) {
            $this->assign('serverIndex',$cookie['serverIndex']);
            $this->assign("serverUnid",$cookie['serverUnid']);


            $gameServerInfo=$serverS_cl[$cookie['serverIndex']];


            $dblinkS=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex'],3);

            $result=$this->DBselect("gameServer","ObjectId='{$cookie['objectGround']}'");
            $gameDBName=$result['DBGameName'];
            $logDBName=$result['DBLogName'];

            $startDayTime=strtotime($StartDay);
            for($i=0;$i<24;$i++){
                $startDay_b=date("Y-m-d H:i:s",$startDayTime+$i*3600);
                $endDay_b=date("Y-m-d H:i:s",$startDayTime+($i+1)*3600);
                $sql="select aa.nNumber,aa.UserID ,bb.UserID as oldUserID from {$gameServerInfo['DBPayName']}.dbo.Pay_{$gameServerInfo['DBPayId']} as aa LEFT  JOIN  ( select UserID from  {$gameServerInfo['DBPayName']}.dbo.Pay_{$gameServerInfo['DBPayId']} where  createTimes <= '{$startDay_b}' GROUP  BY  UserID ) as bb on bb.UserID= aa.UserID where aa.createTimes >= '{$startDay_b}' and aa.createTimes < '{$endDay_b}'";
                $result=$dblinkS->query($sql);

                $data[$i]=array();
                $data[$i]['payNumberSum']=0;
                $data[$i]['payTimeSum']=0;

                $UserID_array_b=array();
                $new_UserID_array_b=array();


                foreach($result as $item){
                    foreach($item as $vv){
                        $data[$i]['payTimeSum']++;
                        $data[$i]['payNumberSum']+=$vv['nNumber'];
                        if(!in_array($vv['UserID'],$UserID_array_b)) {
                            $UserID_array_b[] = $vv['UserID'];
                        }
                        if(!$vv['oldUserID']){
                            if(!in_array($vv['UserID'],$new_UserID_array_b)) {
                                $new_UserID_array_b[] = $vv['UserID'];
                            }
                        }
                    }
                }
                $data[$i]['payUserSum']=count($UserID_array_b);
                $data[$i]['NewPayUserSum']=count($new_UserID_array_b);
                $data[$i]['ARPU']=$data[$i]['payUserSum']?sprintf("%.2f",$data[$i]['payNumberSum']/$data[$i]['payUserSum']/$ExchangeRate):0;
                //总登入人数
                $logDay=date("Y_m_d",$startDayTime);
                if(date("Y_m_d")==$logDay){
                    $sql="select PlayerID from {$gameServerInfo['DBLogName']}.dbo.logMsg GROUP  by PlayerID";
                }else{
                    $sql="select PlayerID from {$gameServerInfo['DBLogName']}.dbo.ChartLog_{$logDay} GROUP  by PlayerID";
                }
                $result=$dblinkS->query($sql);
                $data[$i]['PlayerSum']= 0;
                foreach($result as $item){
                    $data[$i]['PlayerSum']+=count($item);
                }
                $data[$i]['PayLv']= $data[$i]['PlayerSum']?sprintf("%.4f",$data[$i]['payUserSum']/$data[$i]['PlayerSum'])*100:0;
            }
            $j=0;
            foreach($data as $kk=>$vv){
                if($j>=1){
                    $jspayNumberSum=$data[$kk]['payNumberSum'];
                    $qtpayNumberSum=$data[($kk-1)]['payNumberSum'];
                    if($jspayNumberSum && $qtpayNumberSum){
                        if($jspayNumberSum >$qtpayNumberSum){ //增长
                            $data[$kk]['type']=1;
                            $data[$kk]['lv']=sprintf("%.4f",($jspayNumberSum-$qtpayNumberSum)/$qtpayNumberSum)*100;
                        }elseif($jspayNumberSum < $qtpayNumberSum){    //减少
                            $data[$kk]['type']=2;
                            $data[$kk]['lv']=sprintf("%.4f",($qtpayNumberSum-$jspayNumberSum)/$qtpayNumberSum)*100;
                        }else{
                            $data[$kk]['type']=0;
                        }
                    }else{
                        $data[$kk]['type']=0;
                    }
                }else{
                    $data[$kk]['type']=0;
                }
                $j++;
            }

            $this->assign("data",$data);
            $data_xAxis=array();
            $data_PaySum=array();
            $data_PayTime=array();
            foreach($data as $kk=>$vv){
                $data_xAxis[]=$kk;
                $data_PaySum[]=$vv['payNumberSum']/100;
                $data_PayTime[]=$vv['payUserSum'];
            }
            $this->assign('data_xAxis',json_encode($data_xAxis));
            $this->assign("data_PaySum",json_encode($data_PaySum));
            $this->assign('data_PayTime',json_encode($data_PayTime));



        }else{
            $this->assign('serverIndex',0);
            $this->assign("serverUnid","全服");
            $this->assign('data','');
            $this->assign('data_payDay','');
            $this->assign('data_payNumberSum','');
            $this->assign('data_payUserSum','');
            $this->assign("data_xAxis",'[]');
            $this->assign("data_PaySum","[]");
            $this->assign("data_PayTime","[]");
        }
        $this->display("Data/PayHoursReport.html");
    }
}




?>