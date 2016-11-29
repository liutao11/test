<?php
/**
 * 玩结束
 */
class wk_UserSetGet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $typeInt=$this->get["isModify"];
        $userName=$this->get['userName'];
        $password=$this->get['password'];
        $chinaName=$this->get['chinaName'];
        $roleIndex=$this->get['roleSId'];
        $objectIndex=$this->get["ObjectId"];
        $fromIdmId=$this->get['fromIdmId'];
        $fromIdsId=$this->get['fromIdsId'];
        $UserId=$this->get['UserId'];
        if($typeInt && $userName && $roleIndex && $objectIndex>=0){
            $time=time();
            if($typeInt ==1){
                if($roleIndex==6){                        //渠道用户
                    $fromInfo=$this->main['fromInfo'];
                    $fromIdmName='';
                    foreach($fromInfo as $vv){
                        if($vv['fromInfoId']==$fromIdmId){
                            $fromIdmName=$vv['fromInfoName'];
                            break;
                        }
                    }

                    if($fromIdmId==1){                    //易接渠道用户
                        $SKIDStr=file_get_contents($this->homeUrl."/conf/YijieSkIdSetup.php");
                        $YJSKIDArray=json_decode($SKIDStr,true);
                        $fromIdsName='';
                        foreach($YJSKIDArray as $vv){
                            if($vv['SKID']==$fromIdsId){
                                $fromIdsName=$vv['SKID_NAME'];
                            }
                        }
                        $result = $this->DBinsert('userList', "userName,password,chinaName,groundId,objectGround,TTime,UFromIdmId,UFromIdsId,UFromIdmName,UFromIdsName", "'{$userName}','" . md5($password) . "','{$chinaName}','{$roleIndex}','{$objectIndex}','{$time}','{$fromIdmId}','{$fromIdsId}','{$fromIdmName}','{$fromIdsName}'");
                    }else{
                        $result = $this->DBinsert('userList', "userName,password,chinaName,groundId,objectGround,TTime,UFromIdmId,UFromIdmName", "'{$userName}','" . md5($password) . "','{$chinaName}','{$roleIndex}','{$objectIndex}','{$time}','{$fromIdmId}','{$fromIdmName}'");
                    }
                }else {
                    $result = $this->DBinsert('userList', "userName,password,chinaName,groundId,objectGround,TTime", "'{$userName}','" . md5($password) . "','{$chinaName}','{$roleIndex}','{$objectIndex}','{$time}'");
                }
            }else if($typeInt ==2){
                if($password!=''){
                    $result = $this->DBupdate("userList","userName='{$userName}',password='".md5($password)."',chinaName='{$chinaName}',groundId='{$roleIndex}',objectGround='{$objectIndex}'","id={$UserId}");
                }else{
                    $result = $this->DBupdate("userList","userName='{$userName}',chinaName='{$chinaName}',groundId='{$roleIndex}',objectGround='{$objectIndex}'","id={$UserId}");
                }
            }else {
                $result=false;
            }
            if($result){
                $this->response->end(json_encode(array("status" => "10002", "message" => "操作成功！")));
            }else{
                $this->response->end(json_encode(array("status" => "10002", "message" => "操作失败！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}
?>