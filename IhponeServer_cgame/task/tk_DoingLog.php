<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/16
 * Time: 11:37
 */
class tk_DoingLog extends task{
    function exe(){
        $tTime=time();
        $sendContent=json_encode($this->data['sendContent']);
        if($this->main['ipAddressSend']) {
            $address = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=" . $this->data['userIp']);
        }else{
            $address='{"country":"本地"}';
        }
        $address=json_decode($address,true);
        if(@$address['country']){
            $result = $this->DBinsert("DoingLog", "userName,className,userIp,sendType,tTime,whereAddress,sendContent", "'{$this->data['userName']}','{$this->data['className']}','{$this->data['userIp']}','{$this->data['sendType']}','{$tTime}','{$address['country']}','{$sendContent}'");
        }else {
            $result = $this->DBinsert("DoingLog", "userName,className,userIp,sendType,tTime,whereAddress,sendContent", "'{$this->data['userName']}','{$this->data['className']}','{$this->data['userIp']}','{$this->data['sendType']}','{$tTime}','','{$sendContent}'");
        }
    }
}



?>