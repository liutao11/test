<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/9/22
 * Time: 14:09
 */
class wk_AllUserGoldRanking extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $className=__CLASS__;
        $this->assign('className',$className);
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,NetUrl,DBPort,DBUser,DBPassword,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        $data=[];
        $ExchangeRate=$this->main['ExchangeRate'];
        $vipLevel=$this->main['vipLevel'];
        $redisKey=$this->main['cookieName']."::".$cookie['objectGround']."::".$className;
        $redisKeyData=$this->main['cookieName']."::".$cookie['objectGround']."::".$className."::Data";
        $redisKeyState=$this->rd->get($redisKey);
        if(!$redisKeyState){
            $this->rd->del($redisKeyData);
            foreach ($serverS as $serverIndex) {
                $DBGameName = $serverIndex['DBGameName'];
                $netUrl =  $serverIndex['NetUrl'];
                $port =  $serverIndex['DBPort'];
                $user =  $serverIndex['DBUser'];
                $ServerTitle =  $serverIndex['ServerTitle'];
                $password =  $serverIndex['DBPassword'];
                $sql = "select nReserved1,nGameGold,sAccount,sChrName,Level from {$DBGameName}.dbo.MIR_HUM_INFO  where nGameGold >0 ORDER BY nGameGold desc";

                $dbname = $DBGameName;
                $mssql_Link = new cl_gamedb($netUrl, $port, $user, $password, $dbname, $this->rd);
                $result_array = $mssql_Link->query($sql);
                foreach ($result_array as $kk => $vv) {
                    $vv['amount'] = $vv['nReserved1'] / $ExchangeRate;
                    $vv['vipLevel'] = '-';
                    if ($vv['nReserved1']) {
                        foreach ($vipLevel as $vipkk => $vipvv) {
                            if ($vipvv['min'] <= $vv['amount'] && $vipvv['max'] >= $vv['amount']) {
                                $vv['vipLevel'] = $vipkk;
                            }
                        }
                    }
                    $vv['ServerTitle'] = $ServerTitle;
                    $this->rd->zAdd($redisKeyData, $vv['nGameGold'], json_encode($vv));
                }

            }
            $this->rd->setex($redisKey, 300, 1);
        }

        $pagelength=40;                         //每页条数
        if(@$cookie[$className.'ChangePageInt']){
            $showPageInt=$cookie[$className.'ChangePageInt'];
        }else{
            $showPageInt=1;
        }
        $data=$this->rd->zRevRange($redisKeyData,($showPageInt-1)*$pagelength,$showPageInt*$pagelength-1);
        $data_s=[];
        $page_var=1;
        foreach($data as $vv){
            $vv_b=json_decode($vv,true);
            $vv_b['rankingId']=($showPageInt-1)*$pagelength+$page_var;
            $data_s[]=$vv_b;
            $page_var++;
        }
        $rows=$this->rd->zSize($redisKeyData);
        $this->assign('showPageInt',$showPageInt);
        $this->assign('data',$data_s);
        $pageSum=ceil($rows/$pagelength);
        $this->assign("pageSum",$pageSum);
        $this->assign("pageSumTo5",$pageSum-5);
        $this->assign("pageSumTo11",$pageSum-11);

        $this->assign("showPageIntS5",$showPageInt-5);
        $this->assign("showPageIntA5",$showPageInt+5);
        $this->assign("pageSum_11",$pageSum-11);
        $this->assign('pagelength',$pagelength);
        $this->display("Data/AllUserGoldRanking.html");
    }
}


?>