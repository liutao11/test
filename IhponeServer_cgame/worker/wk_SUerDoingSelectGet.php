<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/27
 * Time: 11:20
 */
class wk_SUerDoingSelectGet extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverIndex=$this->get['serverIndex'];
        $startDay=$this->get['startDay'];
        $endDay=$this->get['endDay'];
        $className=$this->get['className'];
        $roles=$this->get['roles'];
        $showState=$this->get['showState'];
        $PlayerDoingSelset=$this->get['PlayerDoingSelset'] >=-1?$this->get['PlayerDoingSelset']:"";

        if(strtotime($startDay) <= strtotime($endDay) && strtotime($startDay) < time()){
            $cookieName = $this->main['cookieName'];
            $cookie['serverIndex'] = $serverIndex;
            $cookie[$className.'StartDay'] = $startDay;
            $cookie[$className.'EndDay'] = $endDay;
            $cookie['UserDoingSelectIndex'] = $PlayerDoingSelset;
            $cookie[$className.'roles']=$roles;
            $cookie[$className."showState"]=$showState;
            unset($cookie[$className."ChangePageInt"]);
            $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
             $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}





?>