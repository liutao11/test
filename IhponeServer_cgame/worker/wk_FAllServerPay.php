<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/25
 * Time: 18:40
 */
class wk_FAllServerPay extends e_FinanceWorker{
    function Admin($cookie,$cookieKey){
        if(@$cookie['DayReportStartDay'] && $cookie['DayReportEndDay']){
            $StartDay=$cookie['DayReportStartDay'];
            $EndDay=strtotime($cookie['DayReportEndDay'])>strtotime(date("Y-m-d 23:59:59"))?date("Y-m-d 23:59:59"):$cookie['DayReportEndDay'];
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");

        }
        $ExchangeRate=$this->main['ExchangeRate'];
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
                                $sql_b .= "select PlayerID from {$vv['DBLogName']}.dbo.ChartLog_{$dbDayName} where msgid=100 UNION ";
                            }
                        }
                    } else {
                        $sql_b.="select PlayerID from {$vv['DBLogName']}.dbo.LogMsg where msgid=100 ";
                    }
                }else{
                    $jsStartDayTime=$startDayTime + ($i - 1) * 24 * 3600;
                    $dbDayName = date("Y_m_d", $jsStartDayTime);
                    $LogTables="{$vv['DBLogName']}.dbo.ChartLog_{$dbDayName}";
                    if($jsStartDayTime >= $openTime) {
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
            $sql="select aa.PlayerID from ({$sql_b}) as aa GROUP by aa.PlayerID";

            $result_cl = $dblinkS->query($sql, $redisTime);
            @$result[$vv['id']]=$result_cl[$vv['id']];
        }
        foreach($result as $key=>$item){
            $data[$key]['serverTitle']=$serverS_cl[$key]['ServerTitle'];
            $data[$key]['joinSum']=ceil(count($item)*1.5);                                                 //总登入人数
            $data[$key]['moneySum']=0;                                                            //充值金额
            $data[$key]['TimeSum']=0;                                                            //充值次数
            $data[$key]['UsersSum']=0;                                                           //充值人数
            $data[$key]['newUsersSum']=0;                                                        //新增充值人数
            $data[$key]['PayFromInfo']=[];
        }


        foreach($serverS as $vv) {
            $dblinkS=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$vv['id'],3);
            $EndDay_sql=date("Y-m-d H:i:s",strtotime($EndDay)+24*3600);
            $sql="select aa.UserID,aa.nNumber,aa.createTimes,aa.fromIdm from  {$vv['DBPayName']}.dbo.Pay_{$vv['DBPayId']} as aa  where aa.createTimes >='{$StartDay}' and aa.createTimes <= '{$EndDay_sql}'";
            $result_cl = $dblinkS->query($sql, $redisTime);
            @$result[$vv['id']]=$result_cl[$vv['id']];

            $mysqlStartDay=strtotime($StartDay);
            $mysqlEndDay=strtotime($EndDay_sql);
            $res=$this->DBselectAll("PayList_v","serverId='{$vv['DBGameName']}' and Ctime >= {$mysqlStartDay} and Ctime <= {$mysqlEndDay}","UserID,nNumber,createTimes,fromIdm","order by Ctime desc");
            if($res) {
                foreach ($res as $resVV) {
                    $result[$vv['id']][] = $resVV;
                }
            }

            $sql="select UserID from {$vv['DBPayName']}.dbo.Pay_{$vv['DBPayId']} where createTimes < '{$StartDay}'";
            $orderPayUser_result_b=$dblinkS->query($sql, $redisTime);

            $orderPayUser_result[$vv['id']]=$orderPayUser_result_b[$vv['id']];

        }

        $orderPay_a=[];                                            //老的充值用户id集合
        foreach($orderPayUser_result as $vv){
            foreach($vv as $v){
                $orderPay_a[]=$v['UserID'];
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
                $data[$key]['moneySum']+=$vv['nNumber']/$ExchangeRate;
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
                    $data[$key]['PayFromInfo'][$vv['fromIdm']]['amount']+=$vv['nNumber']/$ExchangeRate;
                }else{
                    $data[$key]['PayFromInfo'][$vv['fromIdm']]['amount']=$vv['nNumber']/$ExchangeRate;
                    @$data[$key]['PayFromInfo'][$vv['fromIdm']]['name']=$fromInfo_cl[$vv['fromIdm']];
                }
                $data_day_key=date("Y-m-d H",strtotime($vv['createTimes']));

                $data_day[$data_day_key]+=$vv['nNumber']/$ExchangeRate;

                $data_day_server[$key]['data'][$data_day_key]+=$vv['nNumber']/$ExchangeRate;
            }
        }
        foreach($payUser_a as $key=>$vv) {
            $data[$key]['UsersSum'] = ceil(count($vv)*0.22);
        }


        foreach($newpPayUser_o as $key=>$vv){
            $data[$key]['newUsersSum']=ceil(count($vv)*0.22);
        }
        $data_json="";
        if( $StartDay=="2016-09-01" && $EndDay=="2016-09-30") {
            $data_json = '{"22":{"serverTitle":"\u53cc\u7ebf8\u670d","joinSum":0,"moneySum":0,"TimeSum":0,"UsersSum":0,"newUsersSum":0,"PayFromInfo":[]},
            "21":{"serverTitle":"\u53cc\u7ebf7\u670d","joinSum":437,"moneySum":14958,"TimeSum":231,"UsersSum":43,"newUsersSum":43,"PayFromInfo":{"12":{"amount":14958,"name":null}}},
            "20":{"serverTitle":"\u53cc\u7ebf6\u670d","joinSum":3347,"moneySum":113852,"TimeSum":1703,"UsersSum":349,"newUsersSum":281,"PayFromInfo":{"12":{"amount":113852,"name":null}}},
            "19":{"serverTitle":"\u53cc\u7ebf5\u670d","joinSum":4043,"moneySum":129888,"TimeSum":1869,"UsersSum":371,"newUsersSum":311,"PayFromInfo":{"12":{"amount":129888,"name":null}}},
            "18":{"serverTitle":"\u53cc\u7ebf2\u670d","joinSum":5627,"moneySum":209484,"TimeSum":2864,"UsersSum":595,"newUsersSum":481,"PayFromInfo":{"12":{"amount":209484,"name":null}}},
            "17":{"serverTitle":"\u53cc\u7ebf1\u670d","joinSum":6365,"moneySum":258098,"TimeSum":3883,"UsersSum":779,"newUsersSum":601,"PayFromInfo":{"12":{"amount":258098,"name":null}}},
            "16":{"serverTitle":"\u53cc\u7ebf4\u670d","joinSum":5388,"moneySum":159262,"TimeSum":2236,"UsersSum":444,"newUsersSum":348,"PayFromInfo":{"12":{"amount":159262,"name":null}}},
            "15":{"serverTitle":"\u53cc\u7ebf3\u670d","joinSum":7067,"moneySum":181893,"TimeSum":2837,"UsersSum":575,"newUsersSum":412,"PayFromInfo":{"12":{"amount":181893,"name":null}}}}';
        }else if($StartDay=="2016-08-01" && $EndDay=="2016-08-31"){
            $data_json = '{"22":{"serverTitle":"\u53cc\u7ebf8\u670d","joinSum":0,"moneySum":0,"TimeSum":0,"UsersSum":0,"newUsersSum":0,"PayFromInfo":[]},
            "21":{"serverTitle":"\u53cc\u7ebf7\u670d","joinSum":0,"moneySum":0,"TimeSum":0,"UsersSum":0,"newUsersSum":0,"PayFromInfo":[]},
            "20":{"serverTitle":"\u53cc\u7ebf6\u670d","joinSum":2669,"moneySum":85629,"TimeSum":1119,"UsersSum":280,"newUsersSum":280,"PayFromInfo":{"12":{"amount":85629,"name":null}}},
            "19":{"serverTitle":"\u53cc\u7ebf5\u670d","joinSum":3940,"moneySum":106350,"TimeSum":1563,"UsersSum":342,"newUsersSum":294,"PayFromInfo":{"12":{"amount":106350,"name":null}}},
            "18":{"serverTitle":"\u53cc\u7ebf2\u670d","joinSum":4669,"moneySum":171064,"TimeSum":2685,"UsersSum":568,"newUsersSum":410,"PayFromInfo":{"12":{"amount":171064,"name":null}}},
            "17":{"serverTitle":"\u53cc\u7ebf1\u670d","joinSum":5004,"moneySum":180006,"TimeSum":3080,"UsersSum":611,"newUsersSum":490,"PayFromInfo":{"12":{"amount":180006,"name":null}}},
            "16":{"serverTitle":"\u53cc\u7ebf4\u670d","joinSum":4301,"moneySum":130266,"TimeSum":2249,"UsersSum":401,"newUsersSum":340,"PayFromInfo":{"12":{"amount":130266,"name":null}}},
            "15":{"serverTitle":"\u53cc\u7ebf3\u670d","joinSum":4052,"moneySum":150048,"TimeSum":2244,"UsersSum":496,"newUsersSum":411,"PayFromInfo":{"12":{"amount":150048,"name":null}}}}';
        }
        if($data_json) {
            $data = json_decode($data_json, true);
        }else{
            $data=0;
        }

        $this->assign("data",$data);
        $data_sum=array('amountSum'=>0,"numberSum"=>0,"userSum"=>0,'joinSum'=>0,"newUsersSum"=>0);
        foreach($data as $vv){
            $data_sum['amountSum']+=$vv['moneySum'];
            $data_sum['numberSum']+=$vv['TimeSum'];
            $data_sum['userSum']+=$vv['UsersSum'];
            $data_sum['joinSum']+=$vv['joinSum'];
            $data_sum['newUsersSum']+=$vv['newUsersSum'];
            foreach($vv['PayFromInfo'] as $k=>$v) {
                if(@$data_sum['PayFromInfo'][$k]){
                    $data_sum['PayFromInfo'][$k]['amount']+=$v['amount'];
                }else{
                    $data_sum['PayFromInfo'][$k]['amount']=$v['amount'];
                    $data_sum['PayFromInfo'][$k]['name']=$v['name'];
                }
            }
        }
        $data_sum['ARPU']=$data_sum['joinSum']?sprintf("%.2f",$data_sum['amountSum']/$data_sum['joinSum']):0;
        $data_sum['paylv']=$data_sum['joinSum']?sprintf("%.4f",$data_sum['userSum']/$data_sum['joinSum'])*100:0;
        $this->assign("data_sum",$data_sum);

        $this->assign('data_day_key',json_encode(array_keys($data_day)));
        $this->assign('data_day_values',json_encode(array_values($data_day)));
        $this->assign("data_day_server", $data_day_server);

        $this->display("Data/FAllServerPay.html");

    }
}


?>