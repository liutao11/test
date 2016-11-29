<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/15
 * Time: 11:30
 */
class wk_SUserControlLog extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);
        foreach($serverS as $vv){
            $serverS_cl[$vv['id']]=$vv['GameServerUnid'];
        }

        $sqlCountSum="select count(id) as CountSum from UserControlLog";
        $sqlCountSumResult=$this->DBReadLink()->query($sqlCountSum);
        $CountSum_array=$sqlCountSumResult->fetch(PDO::FETCH_ASSOC);
        $CountSum=$CountSum_array['CountSum'];
        $pagelength=15;
        $className="SUserControlLog";
        @$showPageInt=$cookie[$className.'ShowPage']?$cookie[$className.'ShowPage']:1;
        $startList=($showPageInt-1)*$pagelength;
        $endList=$pagelength;
        $sql="select * from UserControlLog GROUP  BY  id desc limit {$startList},{$endList}";
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

        $this->display("Service/SUserControlLog.html");

    }
}


?>