<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/17
 * Time: 11:11
 */
class wk_ConsumeAnalysis extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $serverId=$cookie['serverIndex'];
        }else{
            $serverId=0;
        }
        $this->assign('serverIndex', $serverId);
        $className=__CLASS__;
        $this->assign("className",$className);
        if(@$cookie[$className.'StartDay'] && $cookie[$className.'EndDay']){
            $StartDay=$cookie[$className.'StartDay'];
            $EndDay=$cookie[$className.'EndDay'];
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");
        }
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName,ServerTitle");
        $this->assign('serverS',$serverS);
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);
        $data_b=array();
        $PlayerDoing=$this->main['PlayerDoing'];
        $this->assign('PlayerDoing',$PlayerDoing);

        @$DoingIndex=$cookie['DoingIndex'];
        $this->assign('DoingIndex',$DoingIndex);
        $data=[];
        if($serverId && $DoingIndex){
            foreach($serverS as $server){
                if($server['id']==$serverId){
                    $DBLogName=$server['DBLogName'];
                    $this->assign("GameServerUnid",$server['GameServerUnid']);
                    //计算天数
                    $startDayTime=strtotime($StartDay);
                    $endDayTime=strtotime($EndDay)+24*3600;
                    $Days=($endDayTime-$startDayTime)/(24*3600);
                    $sql="";
                    for($i=0;$i<$Days;$i++) {
                        $logTableName = date("Y_m_d", $startDayTime+$i*24*3600);
                        if ($logTableName == date("Y_m_d")) {
                            if($sql) {
                                $sql .= " union select PlayerName,Value1,Actions,FuncName from {$DBLogName}.dbo.NormalMsg where MsgID='{$DoingIndex}'";
                            }else{
                                $sql = "select PlayerName,Value1,Actions,FuncName from {$DBLogName}.dbo.NormalMsg where MsgID='{$DoingIndex}'";
                            }
                        } else {
                            if($sql) {
                                $sql .= " union select PlayerName,Value1,Actions,FuncName from {$DBLogName}.dbo.ItemLog_{$logTableName} where MsgID='{$DoingIndex}'";
                            }else{
                                $sql = "select PlayerName,Value1,Actions,FuncName from {$DBLogName}.dbo.ItemLog_{$logTableName} where MsgID='{$DoingIndex}'";
                            }
                        }
                    }
                    $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex']);
                    $dbresult=$dblink->query($sql);
                    foreach($dbresult as $item){
                        foreach($item as $vv){

                                if(@$data_b[$vv['Actions'].$vv['FuncName']]){
                                    $data_b[$vv['Actions'].$vv['FuncName']]['sum']+=$vv['Value1'];
                                    $data_b[$vv['Actions'].$vv['FuncName']]['num']+=1;
                                    if(!in_array($vv['PlayerName'],$data_b[$vv['Actions'].$vv['FuncName']]['userIdArray'])){
                                        $data_b[$vv['Actions'].$vv['FuncName']]['userNum']+=1;
                                        $data_b[$vv['Actions'].$vv['FuncName']]['userIdArray'][]=$vv['PlayerName'];
                                    }
                                }else{
                                    $data_b[$vv['Actions'].$vv['FuncName']]['sum']=$vv['Value1'];
                                    $data_b[$vv['Actions'].$vv['FuncName']]['num']=1;
                                    $data_b[$vv['Actions'].$vv['FuncName']]['price']=$vv['Value1'];
                                    $data_b[$vv['Actions'].$vv['FuncName']]['userNum']=1;
                                    $data_b[$vv['Actions'].$vv['FuncName']]['userIdArray'][]=$vv['PlayerName'];
                                    $data_b[$vv['Actions'].$vv['FuncName']]['name']=$vv['Actions'].'-'.$vv['FuncName'];

                                }

                        }
                    }
                    break;
                }
            }
            $uname=$this->main['cookieName'];
            $keyName=$uname."Buffer::".__CLASS__.$serverId .$DoingIndex;
            foreach($data_b as $values){
                $this->rd->zAdd($keyName,$values['sum'],json_encode($values));
            }
            $ListSum=$this->rd->zSize($keyName);
            $PageSum=40;



            if(@$cookie['ConsumeRankingShowPage']){
                $showPageInt=$cookie['ConsumeRankingShowPage'];
                $start=($showPageInt-1)*$PageSum;
                $end=$showPageInt*$PageSum-1;
                $data_a=$this->rd->zRange($keyName,$start,$end);
            }else{
                $showPageInt=1;
                $data_a=$this->rd->zRange($keyName,0,($PageSum-1));
            }



            foreach($data_a as $value_js){
                $data[]=json_decode($value_js,true);
            }
            $this->rd->del($keyName);

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
            $this->assign("pageSum", '');
            $this->assign("pageSumTo5", '');
            $this->assign("pageSumTo11",'');
            $this->assign("showPageInt",'');
            $this->assign("showPageIntS5", '');
            $this->assign("showPageIntA5", '');
            $this->assign("pageSum_11", '');
            $this->assign('pagelength', '');
        }
        $this->assign("data",$data);
        $this->display("Data/ConsumeAnalysis.html");
    }
}
?>