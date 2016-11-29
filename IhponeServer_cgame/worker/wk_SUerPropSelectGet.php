<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/9/27
 * Time: 12:16
 */
class wk_SUerPropSelectGet extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverInfo=$this->get['serverIndex'];
        $roleS=$this->get['roleS'];
        if($serverInfo && $roleS){
            $serverResult=$this->DBselect("gameServer","id={$serverInfo}","id,GameServerUnid,NetUrl,DBPort,DBUser,DBPassword,DBGameName,DBLogName,DBPayName,DBPayId");
            $netUrl=$serverResult['NetUrl'];
            $port=$serverResult['DBPort'];
            $user=$serverResult['DBUser'];
            $password=$serverResult['DBPassword'];
            $dbname=$serverResult['DBGameName'];
            $redisLink=$this->rd;
            $mssql_Link=new cl_gamedb($netUrl,$port,$user,$password,$dbname,$redisLink);
            //装戴查询；
            $sql="select wIndex,count(wIndex) as sumInt from {$dbname}.dbo.MIR_HUM_BODY_ITEM where sChrName='{$roleS}' and wIndex != 0 GROUP BY wIndex";
            $body_Prop=$mssql_Link->query($sql);
            $data=[];
            $redisKey=$this->main['cookieName']."::Prop::IdValue";
            $prop_jsonStr=$this->rd->get($redisKey);
            $prop_key_value=[];
            if($prop_jsonStr && $prop_jsonStr!="null" && false){
                $prop_key_value=json_decode($prop_jsonStr,true);
            }else{
                $read_prop_str=file_get_contents($this->homeUrl."/conf/propSetup.php");
                $read_prop_array=json_decode($read_prop_str,true);
                $prop_key_value=[];
                foreach($read_prop_array as $vv){
                    $prop_key_value[$vv['id']]=$vv['name'];
                }
                $this->rd->setex($redisKey,3600*24,json_encode($prop_key_value));
            }
            foreach($body_Prop as $prop){
                $data_b=[];
                @$data_b['Name']=$prop_key_value[$prop['wIndex']]?$prop_key_value[$prop['wIndex']]:$prop['wIndex'];
                $data_b['sumInt']=$prop['sumInt'];
                $data_b['style']="穿戴装备";
                $data[]=$data_b;
            }
            //仓库
            $sql="select wIndex,count(wIndex) as sumInt from {$dbname}.dbo.MIR_HUM_STORAGE_ITEM where sChrName='{$roleS}' and wIndex != 0 GROUP BY wIndex";
            $body_Prop=$mssql_Link->query($sql);
            foreach($body_Prop as $prop){
                $data_b=[];
                @$data_b['Name']=$prop_key_value[$prop['wIndex']]?$prop_key_value[$prop['wIndex']]:$prop['wIndex'];
                $data_b['sumInt']=$prop['sumInt'];
                $data_b['style']="仓库";
                $data[]=$data_b;
            }
            $sql="select wIndex,count(wIndex) as sumInt from {$dbname}.dbo.MIR_HUM_BAG_ITEM where sChrName='{$roleS}' and wIndex != 0 GROUP BY wIndex";
            $body_Prop=$mssql_Link->query($sql);
            foreach($body_Prop as $prop){
                $data_b=[];
                @$data_b['Name']=$prop_key_value[$prop['wIndex']]?$prop_key_value[$prop['wIndex']]:$prop['wIndex'];
                $data_b['sumInt']=$prop['sumInt'];
                $data_b['style']="背包";
                $data[]=$data_b;
            }
            $this->response->end(json_encode(array('status' => 2000, "data" => $data)));
        }else{
            $this->response->end('{"status":2001,"message":"参数错误！"}');
        }
    }
}


?>