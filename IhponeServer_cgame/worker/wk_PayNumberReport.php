<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/9/21
 * Time: 17:31
 */
class wk_PayNumberReport extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $className=__CLASS__;
        $this->assign("className",$className);
        if(@$cookie[$className.'StartDay'] && $cookie[$className.'EndDay']){
            $StartDay=$cookie[$className.'StartDay'];
            $EndDay=$cookie[$className.'EndDay'];
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");
        }
        $this->assign("StartDay",$StartDay);
        $this->assign("EndDay",$EndDay);

        $ExchangeRate=$this->main['ExchangeRate'];
        $PayDB=$this->main['PayDB'];
        $payListTable=$this->main['payListTable'];

        @$styleValues=$cookie[$className."style"]?$cookie[$className."style"]:0;
        @$serverIndex=$cookie['serverIndex']?$cookie['serverIndex']:0;
        $this->assign("serverIndex",$serverIndex);
        $this->assign("styleValues",$styleValues);
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        $data=[];
        if($serverIndex && $styleValues){
            $StartDayTime=strtotime($StartDay);
            $EndDayTime=strtotime($EndDay)+24*3600;
            $ServerTitle='';
            foreach($serverS as $server){
                if($server['id']==$serverIndex){
                    $ServerTitle=$server['ServerTitle'];
                    break;
                }
            }
            $this->assign('ServerTitle',$ServerTitle);
            if($styleValues==1){ //   新用户测试
                $sql="select aa.numberInt,aa.callbackInfo from (select count(PlayerId) as numberInt,CTime,callbackInfo from {$PayDB}.{$payListTable} where callbackInfo LIKE '{$ServerTitle}%' GROUP BY PlayerId) as aa where aa.CTime>='{$StartDayTime}' and aa.CTime < '{$EndDayTime}'";
            }elseif($styleValues==2) {   //所有用户充值测试
                $sql = "select count(PlayerId) as numberInt,callbackInfo from {$PayDB}.{$payListTable} where callbackInfo LIKE '{$ServerTitle}%' and CTime>='{$StartDayTime}' and CTime < '{$EndDayTime}' GROUP BY PlayerId";
            }elseif($styleValues==3){
                $sql="select count(PlayerId) as numberInt,callbackInfo from {$PayDB}.{$payListTable} where callbackInfo LIKE '{$ServerTitle}%' and CTime>='{$StartDayTime}' and CTime < '{$EndDayTime}' and PlayerId not IN (select aa.PlayerId from (select PlayerId,CTime from {$PayDB}.{$payListTable} where callbackInfo LIKE '{$ServerTitle}%' GROUP BY PlayerId) as aa where aa.CTime>='{$StartDayTime}' and aa.CTime < '{$EndDayTime}' ) GROUP by PlayerId";
            }
            $peopleSum=0;
            $result_object=$this->DBReadLink()->query($sql);
            if($result_object){
                $result_array=$result_object->fetchAll(PDO::FETCH_ASSOC);
                foreach($result_array as $vv){
                    if(isset($data[$vv['numberInt']])){
                        $data[$vv['numberInt']]['thisPeoPleSum']++;
                    }else{
                        $data[$vv['numberInt']]['thisPeoPleSum']=1;;
                    }
                    $peopleSum++;
                }
            }
            ksort($data);
            $data_cl=[];

            if($peopleSum) {
                foreach ($data as $kk => $vv) {
                    $vv['thisPeoPleSumLv'] = sprintf("%.4f",$vv['thisPeoPleSum'] / $peopleSum)*100;
                    $data_cl[$kk]=$vv;
                }
            }
            $data=$data_cl;
        }
        $this->assign("data",$data);
        $this->display("Data/PayNumberReport.html");
    }
}

?>