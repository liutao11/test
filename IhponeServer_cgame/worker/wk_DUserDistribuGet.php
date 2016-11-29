<?php
/**
 * 日表报提交
 */
class wk_DUserDistribuGet extends   e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $style=$this->get['style'];
        @$class=$this->get['class']?$this->get['class']:"";
        if($style && $serverIndex){
            $cookieName=$this->main['cookieName'];
            $cookie['serverIndex']=$serverIndex;
            $cookie[$class.'style']=$style;
            $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}'","id,GameServerUnid");
            foreach($serverS as $vv){
                if($serverIndex==$vv['id']){
                    $cookie['serverUnid']=$vv['GameServerUnid'];
                }
            }
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}