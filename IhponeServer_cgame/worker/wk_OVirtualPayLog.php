<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/8/10
 * Time: 13:53
 */
class wk_OVirtualPayLog extends e_OperatorsWorker{
    function Admin($cookie,$cookieKey){
        $pagelength=40;
        $className=__CLASS__;
        @$showPageInt=$cookie[$className.'ChangePageInt']?$cookie[$className.'ChangePageInt']:1;
        $sqlStart=($showPageInt-1)*$pagelength;
        $ExchangeRate=$this->main['ExchangeRate'];
        $data=$this->DBselectAll('VirtualPayList','1=1',"serverName,serverId,Userid,UserName,Amount ,CTime","order by id desc","limit {$sqlStart},{$pagelength}");
        $data_cl=[];
        foreach($data as $vv){
            $mm=$vv['Amount']/$ExchangeRate;
            $vv['Amount']=$mm;
            $data_cl[]=$vv;
        }
        $this->assign('data',$data_cl);
        $row=$this->DBselect("VirtualPayList","1=1","count(id) as row");

        $pageSum=ceil($row['row']/$pagelength);
        $this->assign("pageSum",$pageSum);
        $this->assign("pageSumTo5",$pageSum-5);
        $this->assign("pageSumTo11",$pageSum-11);
        $this->assign('showPageInt',$showPageInt);
        $this->assign("showPageIntS5",$showPageInt-5);
        $this->assign("showPageIntA5",$showPageInt+5);
        $this->assign("pageSum_11",$pageSum-11);
        $this->assign('pagelength',$pagelength);
        $this->assign("className",$className);
        $this->display("Operators/VirtualPayLog.html");
    }
}

?>