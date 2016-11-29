<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/14
 * Time: 17:49
 */
class wk_SUerPaySelectGet extends  e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverInfo=$this->get['serverIndex'];
        $roleS=$this->get['roleS'];
        $keyStyle=$this->get['keyStyle'];
        if($serverInfo && $roleS){
            $mssql_Link=new cl_gamedbS($this->DBReadLink(),$this->rd,$cookie['objectGround'],$serverInfo);
            $serverResult=$this->DBselect("gameServer","id={$serverInfo}","id,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
            if($keyStyle==1) {
                $dateResult = $mssql_Link->query("select  nIndex,UserID,sPayId,nNumber,createTimes,drawouttime,sChrName from {$serverResult['DBPayName']}.dbo.Pay_{$serverResult['GameServerUnid']}  WHERE sChrName ='{$roleS}'");
            }elseif($keyStyle==2){
                $dateResult = $mssql_Link->query("select  nIndex,UserID,sPayId,nNumber,createTimes,drawouttime,sChrName from {$serverResult['DBPayName']}.dbo.Pay_{$serverResult['GameServerUnid']}  WHERE UserID ='{$roleS}'");
            }
            if($dateResult){
                foreach($dateResult[$serverInfo] as $vv){
                    $vv['createTimes']=date("Y-m-d H:i:s",strtotime($vv['createTimes']));
                    $vv['drawouttime']=date("Y-m-d H:i:s",strtotime($vv['drawouttime']));
                    $dateResult_cl[]=$vv;
                }

                $this->response->end(json_encode(array('status' => 2000, "data" => $dateResult_cl)));
            }else{
                $this->response->end('{"status":2000,"date":""}');
            }
        }else{
            $this->response->end('{"status":2001,"message":"参数错误！"}');
        }
    }
}



?>