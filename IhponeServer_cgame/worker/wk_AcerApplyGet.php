<?php
/**
 * 申请元宝提交
 */
class wk_AcerApplyGet extends e_OperatorsWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get["serverIndex"];
        $roleS=$this->get["roleS"];
        $message=$this->get["message"];
        $number=$this->get["number"];
        $isBind=$this->get["isBind"];
        $isReward=$this->get["isReward"];
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}'","id,GameServerUnid,DBGameName,DBLogName");
        foreach($serverS as $item) {
            if($item['id']==$serverIndex){
                $serverUnid=$item['GameServerUnid'];
            }
        }
        if($serverIndex && $roleS && $message && $number && $isBind && $isReward &&  $serverUnid){
            $timeS=time();
            $username=$cookie['username'];
            $result=$this->DBinsert("AcerApply","serverIndex,roleS,message,number,isBind,isReward,serverUnid,ApplyTime,ApplyName,objectId","'{$serverIndex}','{$roleS}','{$message}','{$number}','{$isBind}','{$isReward}','{$serverUnid}','{$timeS}','{$username}','{$cookie['objectGround']}'");
            if($result){
                $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
            } else{
                $this->response->end(json_encode(array("status" => "10002", "message" => "操作失败！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}


?>