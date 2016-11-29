<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/27
 * Time: 15:40
 */
class wk_UserRoleListGet extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $doing=$this->get['doing'];
        if($doing) {
            if($doing=='submit') {
                $serverIndex = $this->get['serverIndex'];
                $startDay = $this->get['startDay'];
                $endDay = $this->get['endDay'];
                $className = $this->get['className'];
                $startDayTime = strtotime($startDay);
                $endDayTime = strtotime($endDay);
                if ($startDayTime <= $endDayTime) {
                    if (true) {
                        $cookieName = $this->main['cookieName'];
                        $cookie['serverIndex'] = $serverIndex;
                        $cookie['DayReportStartDayS'] = $startDay;
                        $cookie['DayReportEndDayS'] = $endDay;
                        $serverS = $this->DBselectAll("gameServer", "ObjectId='{$cookie['objectGround']}'", "id,GameServerUnid");
                        foreach ($serverS as $vv) {
                            if ($serverIndex == $vv['id']) {
                                $cookie['serverUnid'] = $vv['GameServerUnid'];
                            }
                        }
                        unset($cookie['UserRoleListBlurIndex']);
                        unset($cookie['UserRoleListBlurValues']);
                        unset($cookie[$className . 'ChangePageInt']);
                        unset($cookie[$className."SortName"]);
                        unset($cookie[$className."SortValue"]);
                        $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
                        $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
                    } else {
                        $this->response->end(json_encode(array("status" => "10002", "message" => "超过查询天数！")));
                    }
                } else {
                    $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
                }
            }else if($doing=="sort"){
                $name=$this->get['name'];
                $value=$this->get['value'];
                $className = $this->get['className'];
                $cookie[$className."SortName"]=$name;
                $cookie[$className."SortValue"]=$value;
                $cookieName = $this->main['cookieName'];
                $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
                $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
            }else if($doing=='submit_all'){
                $serverIndex = $this->get['serverIndex'];
                $className = $this->get['className'];
                $cookieName = $this->main['cookieName'];
                $cookie['serverIndex'] = $serverIndex;
                $serverS = $this->DBselectAll("gameServer", "ObjectId='{$cookie['objectGround']}'", "id,GameServerUnid");
                foreach ($serverS as $vv) {
                    if ($serverIndex == $vv['id']) {
                        $cookie['serverUnid'] = $vv['GameServerUnid'];
                    }
                }
                unset($cookie['UserRoleListBlurIndex']);
                unset($cookie['UserRoleListBlurValues']);
                unset($cookie[$className . 'ChangePageInt']);
                unset($cookie[$className."SortName"]);
                unset($cookie[$className."SortValue"]);
                $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
                $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}




?>