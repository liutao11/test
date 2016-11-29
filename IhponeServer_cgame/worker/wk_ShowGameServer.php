<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/8/19
 * Time: 16:31
 */
class wk_ShowGameServer extends worker{
    function GET_FUN(){
        $this->response->header("Content-Type", "text/html;charset=utf-8");
        $key=$this->main['cookieName']."Show_Game_Server";
        $notice_content=$this->rd->get($key);
        if($notice_content){
            $this->response->end($notice_content);
        }else{
            $style=DB_STYLE;
            $port=DB_PORT;
            $use=DB_USER;
            $pwd=DB_PWD;
            $dbname=DB_DATA;
            $update_data_pool_host=$this->update_data_pool_host;
            $dblink = new PDO("{$style}:host={$update_data_pool_host[0]};dbname={$dbname};port={$port};charset=UTF8", $use, $pwd, array(PDO::ATTR_PERSISTENT => true));

            $object_result_object=$dblink->query("select wallowUrl,downloadUrl,gameDownloadUrl from objectS");
            $object_result_array=$object_result_object->fetch(PDO::FETCH_ASSOC);
            $OpenTime=time();
            $sql="select ServerTitle,NetUrl,GamePort,serverRunState,serverState from ShowGameServer where Style=1 and OpenType=1 and CTime <={$OpenTime}";
            $server_result_object=$dblink->query($sql);
            $server_result_array=$server_result_object->fetchAll(PDO::FETCH_ASSOC);
            $sendString='{"fUpdateVer":'.$object_result_array['wallowUrl'].',"fUpdateVerUrl":"'.$object_result_array['downloadUrl'].'","currVersion": 2,"downloadUrl":"'. $object_result_array['gameDownloadUrl'].'"';
            $serverSum=0;
            if($server_result_array) {
                foreach ($server_result_array as $server) {
                   $sendString.=',"gameServer'.$serverSum.'":"'.$server['ServerTitle'].'","gatewayIP'.$serverSum.'":"'.$server['NetUrl'].'","gatewayPort'.$serverSum.'":'.$server['GamePort'].',"gameServerState'.$serverSum.'":'.$server['serverRunState'].',"gameServerFlag'.$serverSum.'":'.$server['serverState'];
                   $serverSum++;
                }
            }
            $sendString.=',"gameServerCount":'.$serverSum.',';
            $gameServerInfo='[';
            if($server_result_array) {
                $serverLength=count($server_result_array);
                foreach ($server_result_array as $kk=>$server) {
                    if(($kk+1)==$serverLength) {
                        $gameServerInfo .= '{"serverTitle":"' . $server['ServerTitle'] . '","serverIp":"' . $server['NetUrl'] . '","serverPort":"' . $server['GamePort'] . '","serverState":' . $server['serverRunState'] . ',"serverFlag":' . $server['serverState'] . '}';
                    }else{
                        $gameServerInfo .= '{"serverTitle":"' . $server['ServerTitle'] . '","serverIp":"' . $server['NetUrl'] . '","serverPort":"' . $server['GamePort'] . '","serverState":' . $server['serverRunState'] . ',"serverFlag":' . $server['serverState'] . '},';
                    }
                }
            }
            $gameServerInfo.=']';
            $sendString.='"serverDataInfo":'. $gameServerInfo.'}';
            $this->rd->setex($key,300,$sendString);
            $this->response->end($sendString);
        }
    }
}

?>