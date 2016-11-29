<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/25
 * Time: 17:08
 */
class wk_AllServerReport extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $className=__CLASS__;
        if(@$cookie[$className.'StartDay'] && $cookie[$className.'EndDay']){
            $StartDay=$cookie[$className.'StartDay'];
            $EndDay=$cookie[$className.'EndDay'];
        }else{
            $StartDay=date("Y-m-d",time()-7*24*3600);
            $EndDay=date("Y-m-d");

        }
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}'","id,GameServerUnid,DBGameName,DBLogName,DBPayName");
        $this->assign('serverS',$serverS);
        $this->assign("startDay",$StartDay);
        $this->assign("className",$className);
        $this->assign("endDay",$EndDay);
        $serverS_cl=array();
        $PayInfo=[];
        $OnlineInfo=[];
        $NowOnlineInfo=[];
        foreach($serverS as $vv){
            $serverS_cl[$vv['id']]=$vv['GameServerUnid'];
            $gameDBName=$vv['DBGameName'];
            $logDBName=$vv['DBLogName'];
            $DBPayName=$vv['DBPayName'];
            $GameServerUnid=$vv['GameServerUnid'];

            $jsStartDay=$StartDay;
            $jsEndDay=$EndDay." 23:59:59";
            $dblinkS=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$vv['id']);
            //范围类充值
            $sql="select nNumber,createTimes from {$DBPayName}.dbo.Pay_{$GameServerUnid} where createTimes >= '{$jsStartDay}' and createTimes<= '{$jsEndDay}'";
            $serverPayInfo=$dblinkS->query($sql);
            $PayInfo[$vv['id']]=$serverPayInfo[$vv['id']];
            //在线人数
            $sql="select OnlineCount,UpdateTime from {$gameDBName}.dbo.MIR_ONLINE where UpdateTime >= '{$jsStartDay}' and UpdateTime<= '{$jsEndDay}'";
            $serverOnlineInfo=$dblinkS->query($sql);
            $OnlineInfo[$vv['id']]=$serverOnlineInfo[$vv['id']];
            $sql="select top 1 OnlineCount,UpdateTime from {$gameDBName}.dbo.MIR_ONLINE ORDER by UpdateTime DESC";
            $NowServerOnlineInfo=$dblinkS->query($sql);
            $NowOnlineInfo[$vv['id']]=$NowServerOnlineInfo[$vv['id']];
        }
        $StartDayTime=strtotime($StartDay);
        $EndDayTime=strtotime($EndDay)+24*3600;

        //开始初始值；
        $PayDate=[];
        $OnlineDate=[];
        for($i=$StartDayTime;$i<$EndDayTime;$i+=3600){
            $dateKey=date("Y-m-d H",$i);
            $PayDate[$dateKey]=0;
            $OnlineDate[$dateKey]=0;
        }
        $ExchangeRate=$this->main['ExchangeRate'];
        $PayMonet=0;
        foreach($PayInfo as $item){
            foreach($item as $vv){
                $dateKeyIndex=date("Y-m-d H",strtotime($vv['createTimes']));
                $PayDate[$dateKeyIndex]+=$vv['nNumber']/$ExchangeRate;
                $PayMonet +=$vv['nNumber']/$ExchangeRate;
            }
        }
        $OnlineDate_bu=[];
        foreach($OnlineInfo as $kk=>$item){
            foreach($item as $vv){
                $dateKeyIndex=date("Y-m-d H",strtotime($vv['UpdateTime']));

                $timeInt=strtotime($dateKeyIndex.":00:00");

                if(@$OnlineDate_bu[$kk][$timeInt]['sum']) {
                    $OnlineDate_bu[$kk][$timeInt]['sum'] += $vv['OnlineCount'];
                    $OnlineDate_bu[$kk][$timeInt]['time']++;
                }else{
                    $OnlineDate_bu[$kk][$timeInt]['sum'] = $vv['OnlineCount'];
                    $OnlineDate_bu[$kk][$timeInt]['time'] =1;
                }
            }
        }
        $OnlineDate_hours=[];
        foreach($OnlineDate_bu as $kk=>$vv){
            foreach($vv as $k=>$v){
                $OnlineDate_hours[$kk][$k]=$v['sum']/$v['time'];
            }
        }

        foreach($OnlineDate_hours as $item){
            foreach($item as $kk=>$vv){
                $keyIndex=date("Y-m-d H",$kk);
                $OnlineDate[$keyIndex]+=ceil($vv*1.2);
            }
        }

        //当前在线
        $nowOnline=0;
        foreach($NowOnlineInfo as $key=>$item){
            foreach($item as $v){
                $nowOnline+=ceil($v['OnlineCount']*1.2);
            }
        }
        $PayKey_js=json_encode(array_keys($PayDate));
        $PayValue_js=json_encode(array_values($PayDate));
        $OnlineKey_js=json_encode(array_keys($OnlineDate));
        $OnlineValue_js=json_encode(array_values($OnlineDate));

        $this->assign("nowOnline",$nowOnline);
        $this->assign("PayMonet",$PayMonet);
        $this->assign("PayKey_js",$PayKey_js);
        $this->assign("PayValue_js",$PayValue_js);
        $this->assign("OnlineKey_js",$OnlineKey_js);
        $this->assign("OnlineValue_js",$OnlineValue_js);

        $this->display("Data/AllServerReport.html");
    }
}




?>