<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/1
 * Time: 17:14
 */
class wk_GagReleaseGet extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $id=$this->get['id'];
        $roleS=$this->get['roleS'];
        if($id && $roleS){
            $result=$this->DBupdate('GagList','GagState=2',"id='{$id}'");
            if($result){
                $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
            }else{
                $this->response->end(json_encode(array("status" => "2001", "message" => "操作失败！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "2001", "message" => "确实参数！")));
        }
    }
}




?>