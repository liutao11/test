<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/8
 * Time: 12:02
 */
class wk_downloadExlPost extends c_web{
    function Admin($cookie,$cookieKey){
        $dataJson=$this->post["dataJson"];
        if($dataJson) {
            $keyName = "Download::ExlPostData::" . time();
            $this->rd->setex($keyName, 120, $dataJson);
            $this->response->end(json_encode(array("status" => "2000", "dataKey" => $keyName)));
        }else{
            json_encode(array("status" => "10002", "message" => "提交数据非法！"));
        }
    }
}


?>