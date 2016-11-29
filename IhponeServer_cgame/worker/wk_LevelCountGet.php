<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/22
 * Time: 18:28
 */
class wk_LevelCountGet extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $cookieName=$this->main['cookieName'];
        $cookie['serverIndex']=$serverIndex;
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}'","id,GameServerUnid");
        foreach($serverS as $vv){
            if($serverIndex==$vv['id']){
                $cookie['serverUnid']=$vv['GameServerUnid'];
            }
        }

        unset($cookie['levelCountType']);
        unset($cookie['levelCountTypeValue']);
        $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
        $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
    }
}



?>