<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/4
 * Time: 15:10
 */
class wk_ReceiveMAC extends worker{
    function GET_FUN(){
        @$serverId=$this->get['serverId']?$this->get['serverId']:0;
        $macInt=$this->get["macInt"];                                                         //mac 编号
        @$packageName=$this->get['packageName']?$this->get['packageName']:"";             //包名
        @$fromIdm=$this->get['fromIdm']?$this->get['fromIdm']:"";                          //编号
        @$packageVer=$this->get['packageVer']?$this->get['packageVer']:"";                 //版本号
        if($macInt) {
            $time=time();
            $dayStr=date("Y-m-d");
            $this->DBinsert("ReveiveMAC", "serverId,macInt,CTime,packageName,fromIdm,packageVer", "'{$serverId}','{$macInt}','{$time}','{$packageName}','{$fromIdm}','{$packageVer}'");
            $result=$this->DBselect("UniqueMAC","macInt='{$macInt}'");
            if(!$result) {
                $this->DBinsert("UniqueMAC", 'macInt,fromIdm,CTime,packageName,dayStringKey,packageVer', "'{$macInt}','{$fromIdm}','{$time}','{$packageName}','{$dayStr}','{$packageVer}'");
            }
        }
        $this->response->end(1);
    }
}
?>