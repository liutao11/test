<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/15
 * Time: 17:58
 */
class wk_ObjectSetGet extends  e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $isModify=$this->get['isModify'];
        $ObjectId=$this->get['ObjectId'];
        $title=$this->get['title'];
        $titleUnid=$this->get['titleUnid'];
        $sendPassword=$this->get["sendPassword"];
        $bottomStr=$this->get["bottomStr"];
        $orgUrl=$this->get["orgUrl"];
        $bbsUrl=$this->get["bbsUrl"];
        $payUrl=$this->get["payUrl"];
        $VIPStrUrl=$this->get["VIPStrUrl"];
        $GMUrl=$this->get["GMUrl"];
        $wallowUrl=$this->get["wallowUrl"];
        $downloadUrl=$this->get["downloadUrl"];
        $gameDownloadUrl=$this->get['gameDownloadUrl'];
        if($title){
            if($isModify==1){
                $result = $this->DBupdate("objectS","title='{$title}',titleUnid='{$titleUnid}', sendPassword='{$sendPassword}', bottomStr='{$bottomStr}', orgUrl='{$orgUrl}', bbsUrl='{$bbsUrl}', payUrl='{$payUrl}', VIPStrUrl='{$VIPStrUrl}', GMUrl='{$GMUrl}', wallowUrl='{$wallowUrl}', downloadUrl='{$downloadUrl}',gameDownloadUrl='{$gameDownloadUrl}'","id='{$ObjectId}'");
            }else {
                $times = time();
                $result = $this->DBinsert("objectS", 'title,titleUnid, sendPassword, bottomStr, orgUrl, bbsUrl, payUrl, VIPStrUrl, GMUrl, wallowUrl, downloadUrl,timeS,gameDownloadUrl', "'{$title}','{$titleUnid}', '{$sendPassword}','{$bottomStr}','{$orgUrl}','{$bbsUrl}','{$payUrl}','{$VIPStrUrl}','{$GMUrl}','{$wallowUrl}','{$downloadUrl}','{$times}','{$gameDownloadUrl}'");
            }
            if($result){
                $this->response->end(json_encode(array("status" => "10002", "message" => "操作成功！")));
            }else{
                $this->response->end(json_encode(array("status" => "10002", "message" => "操作失败！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}