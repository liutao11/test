<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/27
 * Time: 11:20
 */
class wk_UserDoingLogGet extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $startDay=$this->get['startDay'];
        $className=$this->get['className'];
        @$myselfInputIndex=$this->get['myselfInputIndex']?$this->get['myselfInputIndex']:0;

        @$PlayerDoingSelset=$this->get['PlayerDoingSelset']?$this->get['PlayerDoingSelset']:"";
        @$roleKey0=$this->get['roleKey0']?$this->get['roleKey0']:"";
        @$roleKey1=$this->get['roleKey1']?$this->get['roleKey1']:"";
        @$roleKey2=$this->get['roleKey2']?$this->get['roleKey2']:"";
        @$roleKey3=$this->get['roleKey3']?$this->get['roleKey3']:"";
        @$roleKey4=$this->get['roleKey4']?$this->get['roleKey4']:"";
        @$roleKey5=$this->get['roleKey5']?$this->get['roleKey5']:"";
        $startDayTime=strtotime($startDay);
        if(true){
            if(true) {
                $cookieName = $this->main['cookieName'];
                $cookie['serverIndex'] = $serverIndex;
                $cookie['UDDayReportStartDayS'] = $startDay;
                $cookie['UserDoingSelectIndex'] = $myselfInputIndex;

                $cookie['PlayerDoingSelset'] = $PlayerDoingSelset;
                $cookie['roleKey0'] = $roleKey0;
                $cookie['roleKey1'] = $roleKey1;
                $cookie['roleKey2'] = $roleKey2;
                $cookie['roleKey3'] = $roleKey3;
                $cookie['roleKey4'] = $roleKey4;
                $cookie['roleKey5'] = $roleKey5;
                $serverS = $this->DBselectAll("gameServer", "ObjectId='{$cookie['objectGround']}'", "id,GameServerUnid");
                foreach ($serverS as $vv) {
                    if ($serverIndex == $vv['id']) {
                        $cookie['serverUnid'] = $vv['GameServerUnid'];
                    }
                }
                unset($cookie[$className.'ChangePageInt']);
                unset($cookie[$className.'BlurClassUNID']);
                unset($cookie[$className.'BlurValue']);
                $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
                $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
            }else{
                $this->response->end(json_encode(array("status" => "10002", "message" => "超过查询范围！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}





?>