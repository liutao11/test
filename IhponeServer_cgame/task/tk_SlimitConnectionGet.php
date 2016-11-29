<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/11/25
 * Time: 16:29
 */
class tk_SlimitConnectionGet extends task{
    function exe(){
        $arg = $this->data;
        $setType=$arg['setType'];
        $ipUrl=$arg['ipUrl'];
        $serverIndex=$arg['serverIndex'];
        $username=$arg['username'];
        $message=$arg['message'];
        $DBId=$arg['DBId'];
        $ServerGameResult=$this->DBselectAll('gameServer',"IsClose=1",'id,GameServerUnid,NetUrl,TelnetPort');
        var_dump($ServerGameResult);
        $sendState=0;
        if(is_array($ServerGameResult)) {
            if($setType==1){         //禁止ip
                $sendString = "{\"ACTION\":\"PROHIBIT_IP\",\"DATA\":\"".$ipUrl."\"}\\";
            }else{
                $sendString = "{\"ACTION\":\"ALLOW_IP\",\"DATA\":\"".$ipUrl."\"}\\";
            }
            foreach ($ServerGameResult as $ServerGame) {
                if ($serverIndex == 0) {
                    $sendResutStatus=$this->TelnetSend($ServerGame['NetUrl'],$ServerGame['TelnetPort'],$sendString);
                    if($sendResutStatus!=0 || $sendResutStatus!=1){
                        $sendState=1;
                    }
                } else {
                   if($ServerGame['id']==$serverIndex){
                       $sendResutStatus=$this->TelnetSend($ServerGame['NetUrl'],$ServerGame['TelnetPort'],$sendString);
                       if($sendResutStatus!=0 || $sendResutStatus!=1){
                           $sendState=1;
                       }
                   }
                }
            }
        }
        $this->DBupdate('SlimitConnectionList',"sendStatus='{$sendState}'","id={$DBId}");

    }
}