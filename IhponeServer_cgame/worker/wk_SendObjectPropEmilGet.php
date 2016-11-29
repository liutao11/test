<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/21
 * Time: 19:09
 */
class wk_SendObjectPropEmilGet extends e_OperatorsWorker{
    function Admin($cookie,$cookieKey){
        @$levelStarte=$this->get['levelStarte']?$this->get['levelStarte']:false;
        @$levelEnd=$this->get['levelEnd']?$this->get['levelEnd']:false;
        @$roleType=$this->get['roleType'];
        @$loginStarteTime=$this->get['loginStarteTime']?$this->get['loginStarteTime']:false;
        @$loginEndTime=$this->get['loginEndTime']?$this->get['loginEndTime']:false;
        $isSetupTime=$this->get['isSetupTime'];
        $setupTime=$this->get['setupTime'];
        $title=$this->get['title'];
        $textarea=$this->get['textarea'];
        $userObject=$this->get['userObject'];
        $username=$cookie['username'];
        if($isSetupTime && $title && $textarea && $userObject){
            if( $levelStarte && $levelEnd){
                if($levelEnd<$levelStarte){
                    $this->response->end(json_encode(array("status" => "10002", "message" => "等级设置错误！")));
                    return;
                }
            }
            if($loginStarteTime && $loginEndTime){
                $loginStarteTimeInt=strtotime($loginStarteTime);
                $loginEndTimeInt=strtotime($loginEndTime);
                if($loginEndTimeInt <  $loginStarteTimeInt){
                    $this->response->end(json_encode(array("status" => "10002", "message" => "登入时间错误！")));
                    return;
                }
            }
            $timeInt=time();
            $emilId=chr(rand(65,90)).chr(rand(65,90)).$timeInt.chr(rand(97,122));
            if($isSetupTime==1){
                $setupTimeInt=strtotime($setupTime);

                if($setupTimeInt > $timeInt){

                    $timeAfter=$setupTimeInt-$timeInt;
                    $serverS=$cookie['SendPropEmilGet_Buffer_serverS'];
                    $roleObject=array("userObject"=>$userObject,"levelStarte"=>$levelStarte,"levelEnd"=>$levelEnd,'roleType'=>$roleType,'loginStarteTime'=>$loginStarteTime,'loginEndTime'=>$loginEndTime);
                    @$timerIndex=swoole_timer_after(($timeAfter)*1000,array($this,'AfterSend'),array('roleS'=>$roleObject,"emilId"=>$emilId,'title'=>$title,'textarea'=>$textarea,'PropS'=>$cookie['SendPropEmilGet_Buffer_PropS'],'serverS'=>$serverS));
                    $serverS_js=json_encode($serverS);
                    $roleObject_js=json_encode($roleObject);
                    $PropS_js=json_encode($cookie['SendPropEmilGet_Buffer_PropS']);
                    $this->DBinsert("PropEmil",'emilId,roleS,title,content,CTime,status,timerIndex,timerTime,serverS,PropS,setUser',"'{$emilId}','{$roleObject_js}','{$title}','{$textarea}','{$timeInt}','0','{$timerIndex}','{$setupTimeInt}','{$serverS_js}','{$PropS_js}','{$username}'");
                    $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
                }else{
                    $this->response->end(json_encode(array("status" => "10002", "message" => "定时发送时间错误！")));
                }
            }else{
                $serverS=$cookie['SendPropEmilGet_Buffer_serverS'];
                $roleObject=array("userObject"=>$userObject,"levelStarte"=>$levelStarte,"levelEnd"=>$levelEnd,'roleType'=>$roleType,'loginStarteTime'=>$loginStarteTime,'loginEndTime'=>$loginEndTime);
                $arg=array('roleS'=>$roleObject,"emilId"=>$emilId,'title'=>$title,'textarea'=>$textarea,'PropS'=>$cookie['SendPropEmilGet_Buffer_PropS'],'serverS'=>$serverS);
                $this->AfterSend($arg);
                $serverS_js=json_encode($serverS);
                $roleObject_js=json_encode($roleObject);
                $PropS_js=json_encode($cookie['SendPropEmilGet_Buffer_PropS']);
                $this->DBinsert("PropEmil",'emilId,roleS,title,content,CTime,status,timerIndex,timerTime,serverS,PropS,setUser',"'{$emilId}','{$roleObject_js}','{$title}','{$textarea}','{$timeInt}','1','','','{$serverS_js}','{$PropS_js}','{$username}'");
                $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！数据量很多,执行需要时间,注意不要反复操作！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
    function AfterSend(&$arg){
        $this->server->task(json_encode(["TaskClass"=>"SendObjectEmil","data"=>$arg]));
    }
}

?>