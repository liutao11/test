<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/11/25
 * Time: 15:53
 */
class wk_SlimitConnectionLog extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $sqlCountSum="select count(id) as CountSum from SlimitConnectionList";
        $sqlCountSumResult=$this->DBReadLink()->query($sqlCountSum);
        $CountSum_array=$sqlCountSumResult->fetch(PDO::FETCH_ASSOC);
        $CountSum=$CountSum_array['CountSum'];
        $pagelength=30;
        $className=__CLASS__;
        @$showPageInt=$cookie[$className.'ShowPage']?$cookie[$className.'ShowPage']:1;
        $startList=($showPageInt-1)*$pagelength;
        $endList=$pagelength;
        $sql="select * from SlimitConnectionList GROUP  BY  id desc limit {$startList},{$endList}";
        $result=$this->DBReadLink()->query($sql);
        $data_s=$result->fetchAll(PDO::FETCH_ASSOC);
        $this->assign('data',$data_s);
        $pageSum=ceil($CountSum/$pagelength);
        $this->assign("pageSum",$pageSum);
        $this->assign("pageSumTo5",$pageSum-5);
        $this->assign("pageSumTo11",$pageSum-11);
        $this->assign("showPageIntS5",$showPageInt-5);
        $this->assign("showPageIntA5",$showPageInt+5);
        $this->assign("showPageInt",$showPageInt);
        $this->assign("pageSum_11",$pageSum-11);
        $this->assign('pagelength',$pagelength);
        $this->assign('className',$className);
        $this->display("Service/SlimitConnectionLog.html");
    }
}

?>