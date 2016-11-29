<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/21
 * Time: 14:21
 */

class wk_SendPropEmilGet extends  e_OperatorsWorker{
    function Admin($cookie,$cookieKey){
        $roleS=$this->get['roleS'];
        $isSetupTime=$this->get['isSetupTime'];
        $setupTime=$this->get['setupTime'];
        $title=$this->get['title'];
        $username=$cookie['username'];
        $textarea=$this->get['textarea'];
        if($isSetupTime && $title && $textarea){
            $serverS=$cookie['SendPropEmilGet_Buffer_serverS'];
            $serverS_lent=count($serverS);
            if($serverS_lent < 1){
                $this->response->end(json_encode(array("status" => "10002", "message" => "没有选择服务器！")));
            }elseif($serverS_lent == 1){              //单一服务
                if($roleS) {
                    if ($isSetupTime == 1 && $setupTime) {              //定时发送
                        $sendTime = strtotime($setupTime);
                        if ($sendTime > time()) {
                            $TimeS = time();
                            $timeAfter = $sendTime - $TimeS;
                            $emilId = chr(rand(65, 90)) . chr(rand(65, 90)) . $TimeS . chr(rand(97, 122));
                            $roleS_c=$roleS;
                            @$timerIndex = swoole_timer_after(($timeAfter) * 1000, array($this, 'AfterSend'), array('roleS' => $roleS_c, "emilId" => $emilId, 'title' => $title, 'textarea' => $textarea, 'PropS' => $cookie['SendPropEmilGet_Buffer_PropS'], 'serverS' => $serverS));
                            $serverS_js = json_encode($serverS);
                            $PropS_js = json_encode($cookie['SendPropEmilGet_Buffer_PropS']);
                            $this->DBinsert("PropEmil", 'emilId,roleS,title,content,CTime,status,timerIndex,timerTime,serverS,PropS,setUser', "'{$emilId}','{$roleS_c}','{$title}','{$textarea}','{$TimeS}','0','{$timerIndex}','{$sendTime}','{$serverS_js}','{$PropS_js}','{$username}'");
                            $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));

                        } else {
                            $this->response->end(json_encode(array("status" => "10002", "message" => "填写定时发送时间错误！")));
                        }
                    } elseif ($isSetupTime != 1) {                      //立即发送
                        $TimeS = time();
                        $emilId = chr(rand(65, 90)) . chr(rand(65, 90)) . $TimeS . chr(rand(97, 122));
                        $PropS_array=$cookie['SendPropEmilGet_Buffer_PropS']? $cookie['SendPropEmilGet_Buffer_PropS']:'';
                        $arg = array('roleS' => $roleS, "emilId" => $emilId, 'title' => $title, 'textarea' => $textarea, 'PropS' =>$PropS_array, 'serverS' => $serverS);
                        $serverS_js = json_encode($serverS);
                        $this->AfterSend($arg);
                        $PropS_js = json_encode($cookie['SendPropEmilGet_Buffer_PropS']);
                        $this->DBinsert("PropEmil", 'emilId,roleS,title,content,CTime,status,timerIndex,timerTime,serverS,PropS,setUser', "'{$emilId}','{$roleS}','{$title}','{$textarea}','{$TimeS}','1','','','{$serverS_js}','{$PropS_js}','{$username}'");
                        $this->response->end(json_encode(array("status" => "2000", "message" => "操作成功！")));
                    } else {
                        $this->response->end(json_encode(array("status" => "10002", "message" => "填写定时发送时间！")));
                    }
                }else{
                    $this->response->end(json_encode(array("status" => "10002", "message" => "填写角色名！")));
                }
            }elseif($serverS_lent > 1){               //多服务
                $this->response->end(json_encode(array("status" => "10002", "message" => "多服务器！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
    function AfterSend(&$arg){
        foreach($arg['serverS'] as $kk=>$vv){
            $role_array=explode(",",$arg['roleS']);
            $send_account_roles=array();


            foreach($role_array as $role_only) {
                $dataLink = new cl_gamedbS($this->DBReadLink(), $this->rd, 'test', $kk);
                $CTime = date("Y-m-d H:i:s");
                $sItem = '';
                foreach ($arg['PropS'] as $vv) {
                    $sItem .= $vv['PropName'] . '*0*' . $vv['PropNum'] .'*'.$vv['PropClockValues']. ',';
                }
                $sItem = substr($sItem, 0, -1);


                $sql = "insert into MIR_MAIL(sCharName,sSendName,sLable,sMemo,sItem,sDateTime) values ('{$role_only}','系统','{$arg['title']}','{$arg['textarea']}','{$sItem}','{$CTime}')";
                $result = $dataLink->update($sql);
                if($result){
                    $send_account_roles[]=$role_only;
                }
            }
            return $send_account_roles;
        }
    }
}


?>