<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/2
 * Time: 18:20
 */
class wk_DUserDistribuStyleGet extends  e_DataWorker{
    function Admin($cookie,$cookieKey){
        $values=$this->get['values'];
        $className=$this->get['className'];
        if($values && $className){
            $cookieName=$this->main['cookieName'];
            if($cookie[$className.'values']){
                if($cookie[$className.'values']==$values){
                    unset($cookie[$className.'values']);
                }else{
                    $cookie[$className.'values']=$values;
                }
            }else{
                $cookie[$className.'values']=$values;
            }
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "提交数据非法！")));
        }
    }
}

?>