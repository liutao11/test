<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/23
 * Time: 14:56
 */
class wk_PayList extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        if(@$cookie['DayReportStartDay'] && $cookie['DayReportEndDay']){
            $StartDay=$cookie['DayReportStartDay'];
            $EndDay=$cookie['DayReportEndDay'];
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");
        }
        $ExchangeRate=$this->main['ExchangeRate'];
        $this->assign("ExchangeRate",$ExchangeRate);
        $className=__CLASS__;
        $this->assign("className",$className);
        @$roleKey0=$cookie[$className.'roleKey0']?$cookie[$className.'roleKey0']:'';
        @$roleKey1=$cookie[$className.'roleKey1']?$cookie[$className.'roleKey1']:'';
        $this->assign("roleKey0",$roleKey0);
        $this->assign("roleKey1",$roleKey1);
        $this->assign("StartDay",$StartDay);
        $this->assign("EndDay",$EndDay);
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        $serverKeyValue=array();
        foreach($serverS as $vv){
            $serverKeyValue[$vv['id']]=$vv['GameServerUnid'];
        }

        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $data=array();
            $this->assign('serverIndex',$cookie['serverIndex']);
            foreach($serverS as $server){
                if($server['id']==$cookie['serverIndex']){
                    $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex']);
                    $AddWhere='';
                    if($roleKey0){
                        $AddWhere.=" and aa.sPayId like '{$roleKey0}%'";
                    }
                    if($roleKey1){
                        $AddWhere.=" and aa.UserID like '{$roleKey1}%'";
                    }
                    $StartDay_sql=date("Y-m-d H:i:s",strtotime($StartDay));
                    $EndDay_sql=date("Y-m-d H:i:s",strtotime($EndDay)+24*3600);
                    $sql="select aa.UserID,aa.createTimes,aa.nNumber,aa.sPayId from {$server['DBPayName']}.dbo.Pay_{$server['DBPayId']} as aa  where aa.createTimes >= '{$StartDay_sql}' and  aa.createTimes <= '{$EndDay_sql}' {$AddWhere} order by aa.createTimes desc";
                    $result=$dblink->query($sql);
                    break;
                }

            }
            $pagelength=30;
            @$showPageInt=$cookie['PayListShowPage']?$cookie['PayListShowPage']:1;

            foreach($result as $key=>$item){
                $ListSum=count($item);
                foreach($item as $kk=>$vv){
                    $key_b=$kk+1;
                    if($key_b > ($showPageInt-1)*$pagelength && $key_b <= $showPageInt*$pagelength ) {
                        $vv['serverUnid'] = $serverKeyValue[$key];
                        $vv['createTimeCl'] = date("Y-m-d H:i:s", strtotime($vv['createTimes']));
                        $data[] = $vv;
                    }
                }
            }

            $this->assign('data',$data);
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
            $this->assign('serverIndex',0);
            $this->assign('data','');
            $this->assign("pageSum",0);
            $this->assign("pageSumTo5", 0);
            $this->assign("pageSumTo11",0);
            $this->assign("showPageInt",0);
            $this->assign("showPageIntS5", 0);
            $this->assign("showPageIntA5", 0);
            $this->assign("pageSum_11", 0);
            $this->assign('pagelength',0);

        }
        $this->assign('class',"PayList");
        $this->display("Data/PayList.html");
    }
}



?>