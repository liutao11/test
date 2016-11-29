<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/9/22
 * Time: 14:09
 */
class wk_UserGoldRanking extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $className=__CLASS__;
        $this->assign('className',$className);
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,NetUrl,DBPort,DBUser,DBPassword,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        @$serverIndex=$cookie['serverIndex']?$cookie['serverIndex']:0;
        $this->assign("serverIndex",$serverIndex);
        $data=[];
        $ExchangeRate=$this->main['ExchangeRate'];
        $vipLevel=$this->main['vipLevel'];
        if($serverIndex){
            $DBGameName= $netUrl=$port=$user=$password='';
            foreach($serverS as $server){
                if($serverIndex==$server['id']){
                    $DBGameName=$server['DBGameName'];
                    $netUrl=$server['NetUrl'];
                    $port=$server['DBPort'];
                    $user=$server['DBUser'];
                    $password=$server['DBPassword'];
                    break;
                }
            }
            $sql="select nReserved1,nGameGold,sAccount,sChrName,Level from {$DBGameName}.dbo.MIR_HUM_INFO  where nGameGold >0 ORDER BY nGameGold desc";

            $dbname=$DBGameName;
            $mssql_Link=new cl_gamedb($netUrl,$port,$user,$password,$dbname,$this->rd);
            $result_array=$mssql_Link->query($sql);
            $pagelength=40;                         //每页条数
            $data=$result_array;


            if(@$cookie[$className.'ChangePageInt']){
                $showPageInt=$cookie[$className.'ChangePageInt'];
            }else{
                $showPageInt=1;
            }
            $data_s=array();
            $pp=1;
            foreach($data as $kk=>$vv){
                if(($showPageInt-1)*$pagelength <= $kk && $kk <= ($showPageInt*$pagelength-1)){
                    $vv['rankingId']=($showPageInt-1)*$pagelength+$pp;
                    $vv['amount']=$vv['nReserved1']/$ExchangeRate;
                    $vv['vipLevel']='-';
                    if($vv['nReserved1']) {
                        foreach ($vipLevel as $vipkk => $vipvv) {
                            if ($vipvv['min']<=$vv['amount'] && $vipvv['max'] >=$vv['amount']){
                                $vv['vipLevel']=$vipkk;
                            }
                        }
                    }
                    $data_s[]=$vv;
                    $pp++;
                }
            }
            $this->assign('showPageInt',$showPageInt);
            $this->assign('data',$data_s);
            $pageSum=ceil(count($data)/$pagelength);
            $this->assign("pageSum",$pageSum);
            $this->assign("pageSumTo5",$pageSum-5);
            $this->assign("pageSumTo11",$pageSum-11);
            $this->assign("showPageIntS5",$showPageInt-5);
            $this->assign("showPageIntA5",$showPageInt+5);
            $this->assign("pageSum_11",$pageSum-11);
            $this->assign('pagelength',$pagelength);
        }else {
            $this->assign('showPageInt',0);
            $this->assign('data',0);

            $this->assign("pageSum",0);
            $this->assign("pageSumTo5",0);
            $this->assign("pageSumTo11",0);
            $this->assign("showPageIntS5",0);
            $this->assign("showPageIntA5",0);
            $this->assign("pageSum_11",0);
            $this->assign('pagelength',0);
            $this->assign("data", $data);
        }
        $this->display("Data/UserGoldRanking.html");
    }
}


?>