<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/19
 * Time: 11:17
 */
class wk_SendPropEmilGet_Buffer extends e_OperatorsWorker{
    function Admin($cookie,$cookieKey){
        $doing=$this->get['doing'];
        $cookieName=$this->main['cookieName'];

        if($doing){
            if($doing=='serverIdAdd'){
                $serverId=$this->get['serverId'];
                if($serverId){
                    $serverS=$this->DBselect("gameServer","id='{$serverId}' and IsClose=1","id,GameServerUnid,ServerTitle");
                    $cookie['SendPropEmilGet_Buffer_serverS'][$serverId]=array("id"=>$serverS['id'],"GameServerUnid"=>$serverS['ServerTitle']);
                    $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
                    $endArray_js=json_encode(array("status" => "2000", "data" =>$cookie['SendPropEmilGet_Buffer_serverS']));
                    $this->response->end($endArray_js);
                }else{
                    $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
                }
            }elseif($doing=='serverIdDel'){
                $serverId=$this->get['serverId'];
                if($serverId){
                    unset($cookie['SendPropEmilGet_Buffer_serverS'][$serverId]);
                    $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
                    $this->response->end(json_encode(array("status" => "2000", "data" =>$cookie['SendPropEmilGet_Buffer_serverS'])));
                }else{
                    $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
                }
            }elseif($doing=="roleSTest"){
                $roleS=$this->get['roleS'];
                if($roleS){
                    @$BufferServerS=$cookie['SendPropEmilGet_Buffer_serverS'];
                    if($BufferServerS) {
                        $BufferServerS_Length=count($BufferServerS);
                        if($BufferServerS_Length==1){

                            foreach($BufferServerS as $kk=>$vv){
                                $serverId=$kk;
                            }

                            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$serverId);


                            $roleS_a = explode(',', $roleS);
                            $selectStatus=1;
                            foreach($roleS_a as $vv){
                                $sql="select id from mir_hum_info where sChrName='{$vv}'";
                                $result=$dblink->query($sql);
                                if(!$result[$serverId]){
                                    $selectStatus=0;
                                    $errorName=$vv;
                                    break;
                                }
                            }
                            if($selectStatus) {
                                $this->response->end(json_encode(array("status" => "2000")));
                            }else{
                                $this->response->end(json_encode(array("status" => "10002","message" => "角色名‘{$errorName}’不存在！")));
                            }
                        }else{
                            $this->response->end(json_encode(array("status" => "10002", "message" => "选择多则服务器！")));
                        }
                    }else{
                        $this->response->end(json_encode(array("status" => "10002", "message" => "没有选择服务器！")));
                    }
                }else{
                    $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
                }
            }elseif($doing=="PropSelect"){
                $values=$this->get['values'];
                if($values){
                    $cookieName=$this->main['cookieName'];
                    $cookieKey="PropSetup_butter";
                    $PropSetup_butter=$this->rd->get($cookieName.$cookieKey);
                    if($PropSetup_butter){
                        $propSetup=json_decode($PropSetup_butter,true);
                    }else{
                        $PropSetup_butter=file_get_contents($this->homeUrl."/conf/propSetup.php");
                        $this->rd->setex($cookieName.$cookieKey,3600,$PropSetup_butter);
                        $propSetup=json_decode($PropSetup_butter,true);
                    }
                    $preg="/^{$values}/";
                    $resultData=[];
                    foreach($propSetup as $kk=>$vv){
                        if(preg_match($preg,$vv['name'])){
                            $resultData[$kk]=$vv;
                        }
                    }
                    $this->response->end(json_encode(array("status" => "2000", "data" => $resultData)));
                }else{
                    $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
                }
            }elseif($doing=="AddPropDefault"){                                    //道具附件
                $PropId=$this->get['PropId'];
                $PropNum=$this->get['PropNum'];
                $PropName=$this->get['PropName'];
                if($PropId!='' && $PropNum && $PropName){
                    if(@count($cookie['SendPropEmilGet_Buffer_PropS'])<10) {
                        $cookie['SendPropEmilGet_Buffer_PropS'][$PropId] = array('PropId' => $PropId, "PropNum" => $PropNum, "PropName" => $PropName, "PropClockValues" => "1");
                        $this->rd->setex($cookieName . $cookieKey, 1800, json_encode($cookie));
                        $this->response->end(json_encode(array("status" => "2000", "data" => $cookie['SendPropEmilGet_Buffer_PropS'])));
                    }else{
                        $this->response->end(json_encode(array("status" => "10002", "message" => "附件已满！")));
                    }
                }else{
                    $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
                }
            }elseif($doing=='AddPropDel'){
                $PropId=$this->get['PropId'];
                unset($cookie['SendPropEmilGet_Buffer_PropS'][$PropId]);
                $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
                $this->response->end(json_encode(array("status" => "2000")));
            }elseif($doing=='AddPropChange'){
                $PropId=$this->get['PropId'];
                $PropNum=$this->get['PropNum'];
                if($PropId!='' && $PropNum!=''){
                    $cookie['SendPropEmilGet_Buffer_PropS'][$PropId]['PropNum']=$PropNum;
                    $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
                }

                $this->response->end(json_encode(array("status" => "2000")));
            }elseif($doing=="serverIdAddOnly"){
                $serverId=$this->get['serverId'];
                if($serverId){
                    $serverS=$this->DBselect("gameServer","id='{$serverId}' and IsClose=1","id,GameServerUnid,ServerTitle");
                    $cookie['SendPropEmilGet_Buffer_serverS']=array();
                    $cookie['SendPropEmilGet_Buffer_serverS'][$serverId]=array("id"=>$serverS['id'],"GameServerUnid"=>$serverS['ServerTitle']);
                    $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
                    $this->response->end(json_encode(array("status" => "2000", "data" =>$cookie['SendPropEmilGet_Buffer_serverS'])));
                }else{
                    $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
                }

            }elseif($doing=="PropStyleChange"){
                $PropId=$this->get['PropId'];
                $PropStyleValues=$this->get['values'];
                if($PropId!='' && $PropStyleValues!=''){
                    $cookie['SendPropEmilGet_Buffer_PropS'][$PropId]['PropStyleValues']=$PropStyleValues;
                    $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
                }
                $this->response->end(json_encode(array("status" => "2000")));
            }elseif($doing=="PropClockChange"){
                $PropId=$this->get['PropId'];
                $PropClockValues=$this->get['values'];
                if($PropId!='' && $PropClockValues!=''){
                    $cookie['SendPropEmilGet_Buffer_PropS'][$PropId]['PropClockValues']=$PropClockValues;
                    $this->rd->setex($cookieName.$cookieKey,1800,json_encode($cookie));
                }
                $this->response->end(json_encode(array("status" => "2000")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "10002", "message" => "参数不完整！")));
        }
    }
}



?>