<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/29
 * Time: 13:42
 */
class wk_MergeGameServerGet extends e_AdminWorker{
    function  Admin($cookie,$cookieKey){
        $AddServerJsonString=$this->get['AddServerJson'];
        $DeleteServerJson=$this->get['DeleteServerJson'];
        $masterIndex=$this->get['masterIndex'];
        $AddServerJson=explode(',',substr($AddServerJsonString,0,-1));
        if($AddServerJson && $masterIndex) {
            if ($DeleteServerJson) {
                $DeleteServerJson = explode(',', substr($DeleteServerJson, 0, -1));
                $AddServerJson = array_diff($AddServerJson, $DeleteServerJson);
            }
            foreach ($AddServerJson as $id) {
                $this->DBupdate("gameServer","MasterServerIndex='{$masterIndex}'","id='{$id}'");
            }
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "数据非法！")));
        }
    }
}

?>