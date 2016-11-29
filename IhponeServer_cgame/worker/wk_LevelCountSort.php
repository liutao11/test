<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/14
 * Time: 11:35
 */
class wk_LevelCountSort extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $type=$this->get['type'];
        $cookieName=$this->main['cookieName'];
        $cookie['levelCountType']=$type;
        if($cookie['levelCountTypeValue']){
            $cookie['levelCountTypeValue']=0;
        }else{
            $cookie['levelCountTypeValue']=1;
        }
        $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
        $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
    }
}


?>