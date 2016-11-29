<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/1
 * Time: 15:31
 */
class wk_phpOther_bulletin extends worker{
    function  GET_FUN(){
        $path_info_array=explode(".",$this->request->server['path_info']);
        $name=substr($path_info_array[0],1);
        $this->response->header("Content-Type","text/html;charset=utf-8");
        $this->display("test/{$name}.html");


    }
}



?>