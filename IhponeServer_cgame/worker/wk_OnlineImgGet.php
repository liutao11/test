<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/22
 * Time: 11:20
 */
class  wk_OnlineImgGet extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        $startDayTime=strtotime($startDay);
        $endDayTime=strtotime($endDay);

        if($startDayTime<$endDayTime){
            $cookieName=$this->main['cookieName'];
            $cookie['serverIndex']=$serverIndex;
            $cookie['OnlineImgStartDay']= $startDay;
            $cookie['OnlineImgEndDay']=$endDay;

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





?>