<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/22
 * Time: 10:34
 */
class wk_FAllPayReport extends e_FromWorker{
    function Admin($cookie,$cookieKey){
        if(@$cookie['DayReportStartDay'] && $cookie['DayReportEndDay']){
            $StartDay=$cookie['DayReportStartDay'];
            $EndDay=strtotime($cookie['DayReportEndDay'])>strtotime(date("Y-m-d 23:59:59"))?date("Y-m-d 23:59:59"):$cookie['DayReportEndDay'];
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");

        }
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,OpenTime,DBGameName,DBLogName,DBPayName,ServerTitle,DBPayId");
        $this->assign('serverS',$serverS);
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);

        foreach($serverS as $vv){
            $serverS_cl[$vv['id']]=$vv;
            $gameDBName=$vv['DBGameName'];
            $logDBName=$vv['DBLogName'];
        }
        $startDayTime=strtotime( $StartDay);
        $endDayTime=strtotime($EndDay);


        if(date("Y-m-d")!=$EndDay){
            $redisTime=7*24*3600;
        }else{
            $redisTime=600;
        }

        $DayS=($endDayTime-$startDayTime)/(24*3600)+1;
        foreach($this->main['fromInfo'] as $vv_i){
            $fromInfo_cl[$vv_i['fromInfoId']]=$vv_i['fromInfoName'];
        }

        $data=array();
        foreach($serverS as $vv) {
            $dblinkS=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$vv['id'],3);

            $tables_result=$dblinkS->query("select name from {$vv['DBLogName']}.dbo.sysobjects where xtype='u'");
            $tables_array=[];
            foreach($tables_result as $item){
                foreach($item as $Itemvv) {
                    $tables_array[] = $vv['DBLogName'].".dbo.".$Itemvv['name'];
                }
            }
            $sql_b='';
            $openTime=strtotime(date("Y-m-d",strtotime($vv['OpenTime'])));
            for($i=1;$i<=$DayS;$i++) {
                if(date("Y-m-d")==date("Y-m-d",$endDayTime)) {
                    if ($i != $DayS) {
                        $jsStartDayTime=$startDayTime + ($i - 1) * 24 * 3600;
                        $dbDayName = date("Y_m_d", $jsStartDayTime);
                        if($jsStartDayTime >= $openTime) {
                            $LogTables="{$vv['DBLogName']}.dbo.ChartLog_{$dbDayName}";
                            if(in_array($LogTables,$tables_array)) {
                                $sql_b .= "select PlayerID from {$LogTables} where msgid=100 UNION ";
                            }
                        }
                    } else {
                        $sql_b.="select PlayerID from {$vv['DBLogName']}.dbo.LogMsg where msgid=100 ";
                    }
                }else{
                    $jsStartDayTime=$startDayTime + ($i - 1) * 24 * 3600;
                    $dbDayName = date("Y_m_d", $jsStartDayTime);
                    if($jsStartDayTime >= $openTime) {
                        $LogTables="{$vv['DBLogName']}.dbo.ChartLog_{$dbDayName}";
                        if ($i != $DayS) {
                            if(in_array($LogTables,$tables_array)) {
                                $sql_b .= "select PlayerID from {$vv['DBLogName']}.dbo.ChartLog_{$dbDayName} where msgid=100 UNION ";
                            }
                        } else {
                            if(in_array($LogTables,$tables_array)) {
                                $sql_b .= "select PlayerID from {$vv['DBLogName']}.dbo.ChartLog_{$dbDayName} where msgid=100 ";
                            }
                        }
                    }
                }
            }
            if($cookie['fromIdsId']) {
                $sql = "select cc.PlayerID,dd.fromIdm,dd.fromIds from (select aa.PlayerID from ({$sql_b}) as aa GROUP by aa.PlayerID ) as cc LEFT JOIN  {$vv['DBGameName']}.dbo.MIR_HUM_SDKID as dd on dd.sAccount=cc.PlayerID where dd.fromIds='{$cookie['fromIdsId']}'";
            }else{
                $sql = "select cc.PlayerID,dd.fromIdm,dd.fromIds from (select aa.PlayerID from ({$sql_b}) as aa GROUP by aa.PlayerID ) as cc LEFT JOIN  {$vv['DBGameName']}.dbo.MIR_HUM_SDKID as dd on dd.sAccount=cc.PlayerID where dd.fromIdm='{$cookie['fromIdmId']}'";
            }
            $result_cl = $dblinkS->query($sql, $redisTime);
            @$result[$vv['id']]=$result_cl[$vv['id']];
        }
        foreach($result as $key=>$item){
            $data[$key]['serverTitle']=$serverS_cl[$key]['ServerTitle'];
            $data[$key]['joinSum']=count($item);                                                 //总登入人数
            $data[$key]['moneySum']=0;                                                            //充值金额
            $data[$key]['TimeSum']=0;                                                            //充值次数
            $data[$key]['UsersSum']=0;                                                           //充值人数
            $data[$key]['newUsersSum']=0;                                                        //新增充值人数
            $data[$key]['PayFromInfo']=[];
        }


        foreach($serverS as $vv) {
            $dblinkS=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$vv['id'],3);
            $EndDay_sql=date("Y-m-d H:i:s",strtotime($EndDay)+24*3600);
            if($cookie['fromIdsId']) {
                $sql = "select aa.UserID,aa.nNumber,aa.createTimes,aa.fromIdm from  {$vv['DBPayName']}.dbo.Pay_{$vv['DBPayId']} as aa  where aa.createTimes >='{$StartDay}' and aa.createTimes <= '{$EndDay_sql}' and aa.fromIds='{$cookie['fromIdsId']}'";
            }else{
                $sql = "select aa.UserID,aa.nNumber,aa.createTimes,aa.fromIdm from  {$vv['DBPayName']}.dbo.Pay_{$vv['DBPayId']} as aa  where aa.createTimes >='{$StartDay}' and aa.createTimes <= '{$EndDay_sql}' and aa.fromIdm='{$cookie['fromIdmId']}'";
            }
            $result_cl = $dblinkS->query($sql, $redisTime);
            @$result[$vv['id']]=$result_cl[$vv['id']];
            if($cookie['fromIdsId']) {
                $sql = "select UserID from {$vv['DBPayName']}.dbo.Pay_{$vv['DBPayId']} where createTimes < '{$StartDay}' and fromIds='{$cookie['fromIdsId']}'";
            }else{
                $sql = "select UserID from {$vv['DBPayName']}.dbo.Pay_{$vv['DBPayId']} where createTimes < '{$StartDay}' and fromIdm='{$cookie['fromIdmId']}'";
            }
            $orderPayUser_result_b=$dblinkS->query($sql, $redisTime);

            @$orderPayUser_result[$vv['id']]=$orderPayUser_result_b[$vv['id']];
        }

        $orderPay_a=[];                                            //老的充值用户id集合
        foreach($orderPayUser_result as $vv){
            if($vv && is_array($vv)) {
                foreach ($vv as $v) {
                    $orderPay_a[] = $v['UserID'];
                }
            }
        }

        $payUser_a=[];
        $data_day=[];
        $data_day_server=[];
        $endDayTime_cl= $endDayTime+24*3600;
        for($i=$startDayTime;$i <= $endDayTime_cl;$i+=3600){

            $data_day[date("Y-m-d H",$i)]=0;


            foreach($serverS as $vv) {
                $data_day_server[$vv['id']]['data'][date("Y-m-d H",$i)]=0;
                $data_day_server[$vv['id']]['serverName']=$vv['ServerTitle'];
            }

        }




        $newpPayUser_o=[];                    //新充值人集合
        foreach ($result as $key => $item) {
            $newpPayUser_o[$key]=[];
            $payUser_a[$key]=[];        //充值用户集合
            foreach ($item as $vv) {
                $data[$key]['moneySum']+=$vv['nNumber']/10;
                $data[$key]['TimeSum']++;
                if(!in_array($vv['UserID'], $payUser_a[$key])){
                    $payUser_a[$key][]=$vv['UserID'];
                }
                if(!in_array($vv['UserID'],$orderPay_a)){
                    if(!in_array($vv['UserID'],$newpPayUser_o[$key])){
                        $newpPayUser_o[$key][]=$vv['UserID'];
                    }
                }

                if(@$data[$key]['PayFromInfo'][$vv['fromIdm']]){
                    $data[$key]['PayFromInfo'][$vv['fromIdm']]['amount']+=$vv['nNumber']/10;
                }else{
                    $data[$key]['PayFromInfo'][$vv['fromIdm']]['amount']=$vv['nNumber']/10;
                    $data[$key]['PayFromInfo'][$vv['fromIdm']]['name']=$fromInfo_cl[$vv['fromIdm']];
                }
                $data_day_key=date("Y-m-d H",strtotime($vv['createTimes']));

                $data_day[$data_day_key]+=$vv['nNumber']/10;

                $data_day_server[$key]['data'][$data_day_key]+=$vv['nNumber']/10;
            }
        }
        foreach($payUser_a as $key=>$vv) {
            $data[$key]['UsersSum'] = count($vv);
        }


        foreach($newpPayUser_o as $key=>$vv){
            $data[$key]['newUsersSum']=count($vv);
        }
        $this->assign("data",$data);
        $data_sum=array('amountSum'=>0,"numberSum"=>0,"userSum"=>0,'joinSum'=>0,"newUsersSum"=>0);
        foreach($data as $vv){
            $data_sum['amountSum']+=$vv['moneySum'];
            $data_sum['numberSum']+=$vv['TimeSum'];
            $data_sum['userSum']+=$vv['UsersSum'];
            $data_sum['joinSum']+=$vv['joinSum'];
            $data_sum['newUsersSum']+=$vv['newUsersSum'];
            if(@$vv['PayFromInfo'] && is_array($vv['PayFromInfo'])){
                foreach($vv['PayFromInfo'] as $k=>$v) {
                    if(@$data_sum['PayFromInfo'][$k]){
                        $data_sum['PayFromInfo'][$k]['amount']+=$v['amount'];
                    }else{
                        $data_sum['PayFromInfo'][$k]['amount']=$v['amount'];
                        $data_sum['PayFromInfo'][$k]['name']=$v['name'];
                    }
                }
            }
        }
        $data_sum['ARPU']=$data_sum['joinSum']?sprintf("%.2f",$data_sum['amountSum']/$data_sum['joinSum']):0;
        $data_sum['paylv']=$data_sum['joinSum']?sprintf("%.4f",$data_sum['userSum']/$data_sum['joinSum'])*100:0;
        $this->assign("data_sum",$data_sum);

        $this->assign('data_day_key',json_encode(array_keys($data_day)));
        $this->assign('data_day_values',json_encode(array_values($data_day)));
        $this->assign("data_day_server", $data_day_server);

        $this->display("From/FAllPayReport.html");

    }
}


?>