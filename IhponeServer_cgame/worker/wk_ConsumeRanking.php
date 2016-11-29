<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/16
 * Time: 19:19
 */
class wk_ConsumeRanking extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $serverId=$cookie['serverIndex'];
        }else{
            $serverId=0;
        }
        $this->assign('serverIndex', $serverId);
        if(@$cookie['ConsumeRankingStartDay']){
            $StartDay=$cookie['ConsumeRankingStartDay'];
        }else{
            $StartDay=date("Y-m-d 00:00:00");
        }
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName,ServerTitle");
        $this->assign('serverS',$serverS);
        $this->assign("startDay",$StartDay);
        $data_b=array();
        if($serverId){
            foreach($serverS as $server){
                if($server['id']==$serverId){
                    $DBLogName=$server['DBLogName'];
                    $logTableName=date("Y_m_d",strtotime($StartDay));
                    if($logTableName==date("Y_m_d")) {
                        $sql = "select PlayerName,Value1,Actions from {$DBLogName}.dbo.NormalMsg where MsgID='53'";
                    }else{
                        $sql = "select PlayerName,Value1,Actions from {$DBLogName}.dbo.ItemLog_{$logTableName} where MsgID='53'";
                    }
                    $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex']);
                    $dbresult=$dblink->query($sql);
                    foreach($dbresult as $item){
                        foreach($item as $vv){
                            if($vv['Value1'] < 0){
                                if(@$data_b[$vv['PlayerName']]){
                                    $data_b[$vv['PlayerName']]['sum']+=$vv['Value1'];
                                }else{
                                    $data_b[$vv['PlayerName']]['sum']=$vv['Value1'];
                                    $data_b[$vv['PlayerName']]['PlayerName']=$vv['PlayerName'];
                                    $data_b[$vv['PlayerName']]['GameServerUnid']=$server['GameServerUnid'];
                                }
                            }
                        }
                    }
                    break;
                }
            }
        }else{
            foreach($serverS as $server){
                $DBLogName=$server['DBLogName'];
                $logTableName=date("Y_m_d",strtotime($StartDay));
                if($logTableName==date("Y_m_d")) {
                    $sql = "select PlayerName,Value1,Actions from {$DBLogName}.dbo.NormalMsg where MsgID='53'";
                }else{
                    $sql = "select PlayerName,Value1,Actions from {$DBLogName}.dbo.ItemLog_{$logTableName} where MsgID='53'";
                }
                $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$server['id']);
                $dbresult=$dblink->query($sql);

                foreach($dbresult as $item){
                    foreach($item as $vv){
                        if($vv['Value1'] < 0){
                            if(@$data_b[$vv['PlayerName']]){
                                $data_b[$vv['PlayerName']]['sum']+=$vv['Value1'];
                            }else{
                                $data_b[$vv['PlayerName']]['sum']=$vv['Value1'];
                                $data_b[$vv['PlayerName']]['PlayerName']=$vv['PlayerName'];
                                $data_b[$vv['PlayerName']]['GameServerUnid']=$server['GameServerUnid'];
                            }
                        }
                    }
                }
            }
        }
        $uname=$this->main['cookieName'];
        foreach($data_b as $values){
             $this->rd->zAdd($uname."_ConsumeRanking_cs",$values['sum'],json_encode($values));
        }
        $ListSum=$this->rd->zSize($uname."_ConsumeRanking_cs");
        $PageSum=20;

        if(@$cookie['ConsumeRankingShowPage']){
            $showPageInt=$cookie['ConsumeRankingShowPage'];
            $start=($showPageInt-1)*$PageSum;
            $end=$showPageInt*$PageSum-1;
            $data_a=$this->rd->zRange($uname."_ConsumeRanking_cs",$start,$end);
        }else{
            $showPageInt=1;
            $data_a=$this->rd->zRange($uname."_ConsumeRanking_cs",0,($PageSum-1));
        }
        foreach($data_a as $value_js){
            $data[]=json_decode($value_js,true);
        }
        $this->rd->del($uname."_ConsumeRanking_cs");
        if(@$data) {
            $pagelength = $PageSum;
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
            $this->assign("pageSum", 0);
            $this->assign("pageNumber",$PageSum);
            $data='';
        }
        $this->assign("data",$data);
        $this->display("Data/ConsumeRanking.html");
    }
}



?>