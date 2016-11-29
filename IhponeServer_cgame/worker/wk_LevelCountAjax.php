<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/20
 * Time: 15:21
 */
class wk_LevelCountAjax extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $valueIndex=$this->get['valueIndex'];
        var_dump($cookie);
        if($valueIndex){
            $gameServerInfo=$this->DBselect("gameServer","id='{$cookie['serverIndex']}'");

            $mssqlLink=new cl_gamedb($gameServerInfo['NetUrl'],$gameServerInfo['DBPort'],$gameServerInfo['DBUser'],$gameServerInfo['DBPassword'],$gameServerInfo['DBGameName'],$this->rd);
            $userInfo=$mssqlLink->query("select sChrName,btSex,btJob,nGold,Level,dCreateDate,dUpdateTime,btRelevel,nGameGold from MIR_HUM_INFO where Id='{$valueIndex}'");
            if($userInfo){
                $data['sChrName']=$userInfo[0]['sChrName'];
                $data['btSex']=$userInfo[0]['btSex']==1?'男':"女";
                if($userInfo[0]['btJob']==0){
                    $btJob['btJob']='战士';
                }elseif($userInfo[0]['btJob']==1){
                    $btJob['btJob']='法师';
                }else{
                    $btJob['btJob']='道士';
                }
                $data['nGold']=$userInfo[0]['nGold'];
                $data['Level']=$userInfo[0]['Level'];
                $data['btRelevel']=$userInfo[0]['btRelevel'];
                $data['nGameGold']=$userInfo[0]['nGameGold'];
                $data['CreateDay']=date("Y-m-d H:i:s",strtotime($userInfo['0']['dCreateDate']));
                $data['UpdateDay']=date("Y-m-d H:i:s",strtotime($userInfo['0']['dUpdateTime']));
                $this->response->end(json_encode(array("status" => "2000", "data" => $data)));
            }else{
                $this->response->end(json_encode(array("status" => "2001")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "1002", "message" => "参数缺少！")));
        }
    }
}




?>