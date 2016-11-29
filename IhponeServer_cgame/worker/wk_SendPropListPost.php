<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/10/19
 * Time: 16:57
 */
class wk_SendPropListPost extends e_OperatorsWorker{
    function Admin($cookie,$cookieKey){
        $filesInfo=$this->request->files;
        $endStr="<script>alert('error,Do not know the cause of the error');history.go(-1)</script>";
        if($filesInfo['PropFileName']){
            var_dump(trim(file_get_contents($filesInfo['PropFileName']['tmp_name'])));
            $sjonState=json_decode(trim(file_get_contents($filesInfo['PropFileName']['tmp_name'])),true);
            if($sjonState) {
                $fileUrl=$this->homeUrl . "/conf/propSetup.php";
                if(is_file( $fileUrl)) {
                    unlink($fileUrl);
                }
                rename($filesInfo['PropFileName']['tmp_name'],$fileUrl);
                $cookieName=$this->main['cookieName'];
                $cookieKey="PropSetup_butter";
                $this->rd->del($cookieName.$cookieKey);
                $endStr="<script>alert('ok');history.go(-1)</script>";
            }else{
                $endStr="<script>alert('Upload file content format error,this is not [json]');history.go(-1)</script>";
            }
        }
        $this->response->header("Content-Type","text/html;charset=utf-8");
        $this->response->end($endStr);
    }
}




?>