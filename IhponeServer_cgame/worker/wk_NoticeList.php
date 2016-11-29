<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/29
 * Time: 15:32
 */
class wk_NoticeList extends e_OperatorsWorker{
    function  Admin($cookie,$cookieKey){
        $NoticeData=$this->DBselectAll("NoticeList");
        $Serverdata=$this->DBselectAll("gameServer");
        $ServerData_cl=array();
        foreach($Serverdata as $item){
            $ServerData_cl[$item['id']]=$item['GameServerUnid'];
        }
        $data=array();
        if(@$Serverdata) {
            foreach ($NoticeData as $vv) {
                if (@$vv['serverIndex']) {
                    $vv['serverName'] = $ServerData_cl[$vv['serverIndex']];
                } else {
                    $vv['serverName'] = "全服";
                }
                $data[] = $vv;
            }
        }
        $this->assign("data",$data);
        $pagelength=20;
        $this->assign("pageSum",ceil(count($data)/$pagelength));
        $this->assign('pagelength',$pagelength);
        $this->display("Operators/NoticeList.html");
    }
}




?>