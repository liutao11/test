<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/19
 * Time: 10:42
 */
class wk_UserDoingLogBlur extends c_web{
    function  Admin($cookie,$cookieKey){
        $classUNID=$this->get['classUNID'];
        $value=$this->get['value'];
        $className=$this->get['className'];
        @$CclassUNID=$cookie['UserDoingLogBlurClassUNID'];
        @$Cvalue=$cookie['UserDoingLogBlurValue'];
        if($classUNID==$CclassUNID && $value==$Cvalue){
            $this->response->end('{"status":"2001","message":"搜索条件没有改变！"}');
        }else{
            $cookieName=$this->main['cookieName'];
            $cookie[$className.'BlurClassUNID']=$classUNID;
            $cookie[$className.'BlurValue']=$value;
            $cookie[$className.'ChangePageInt']=1;
            $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
            $this->response->end('{"status":"2000"}');

        }
    }
}


?>