<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/22
 * Time: 16:06
 */
class wk_FPayListSelect extends e_FromWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,NetUrl,DBPort,DBUser,DBPassword,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        foreach($serverS as $vv){
            $serverS_cl[$vv['id']]=$vv;
        }
        @$serverIndex=$cookie['serverIndex']?$cookie['serverIndex']:$serverS['0']['id'];

        $className=__CLASS__;
        $this->assign('className',$className);
        $this->assign("serverIndex",$serverIndex);
        $NetUrl=$serverS_cl[$serverIndex]['NetUrl'];
        $post=$serverS_cl[$serverIndex]['DBPort'];
        $user=$serverS_cl[$serverIndex]['DBUser'];
        $password=$serverS_cl[$serverIndex]['DBPassword'];
        $gameName=$serverS_cl[$serverIndex]['DBGameName'];
        $payName=$serverS_cl[$serverIndex]['DBPayName'];
        $logName=$serverS_cl[$serverIndex]['DBLogName'];
        $payId=$serverS_cl[$serverIndex]['DBPayId'];
        $mssqlLink=new cl_gamedb($NetUrl,$post,$user,$password,$gameName,$this->rd);
        $ExchangeRate=$this->main['ExchangeRate'];


        @$roleKey0=$cookie[$className.'roleKey0']?$cookie[$className.'roleKey0']:"";
        @$roleKey1=$cookie[$className.'roleKey1']?$cookie[$className.'roleKey1']:"";
        $SQLWhere='';
        if($roleKey0){
            $SQLWhere.=" and sPayId like '%{$roleKey0}%'";
        }
        if($roleKey1){
            $SQLWhere.=" and UserId like '%{$roleKey1}%'";
        }
        if($cookie['fromIdsId']) {
            $sql="select top 100 UserId,sPayId,nNumber,createTimes,sChrName,drawout from {$payName}.dbo.Pay_{$payId} where fromIds='{$cookie['fromIdsId']}' {$SQLWhere} ORDER  by nIndex DESC ";

        }else{
            $sql="select top 100 UserId,sPayId,nNumber,createTimes,sChrName,drawout from {$payName}.dbo.Pay_{$payId} where fromIdm='{$cookie['fromIdmId']}' {$SQLWhere} ORDER  by nIndex DESC ";
        }


        $data_result=$mssqlLink->query($sql);
        $pagelength=30;
        @$showPageInt=$cookie[$className.'ShowPage']?$cookie[$className.'ShowPage']:1;
        $data=[];
        $ListSum=0;
        $ListSum=count($data_result);
        foreach($data_result as $kk=>$vv){
            $key_b=$kk+1;
            if($key_b > ($showPageInt-1)*$pagelength && $key_b <= $showPageInt*$pagelength ) {
                $vv['CTime']=date("Y-m-d H:i:s",strtotime($vv['createTimes']));
                $vv['amount']=$vv['nNumber']/$ExchangeRate;
                $data[] = $vv;
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

        $this->assign('roleKey0',$roleKey0);
        $this->assign('roleKey1',$roleKey1);


        $this->display("From/FPayListSelect.html");
    }
}


?>