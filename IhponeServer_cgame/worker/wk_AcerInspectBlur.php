<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/28
 * Time: 16:19
 */
class wk_AcerInspectBlur extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $index=$this->get['index'];
        $value=$this->get['value'];
        if($index){
            $cookieName = $this->main['cookieName'];
            $cookie['AcerInspectBlurIndex'] = $index;
            $cookie['AcerInspectBlurValues'] = $value;
            $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}







?>