<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/4/12
 * Time: 10:07
 */
class wk_ServiceSelectUserInfoGet extends c_web{
    function  Admin($cookie,$cookieKey){
        $serverInfo=$this->get['serverIndex'];
        $roleS=$this->get['roleS'];
        $fromInfo=$this->main['fromInfo'];
        if($serverInfo && $roleS){
            $mssql_Link=new cl_gamedbS($this->DBReadLink(),$this->rd,$cookie['objectGround'],$serverInfo);
            $dateResult=$mssql_Link->query("select top 20 aa.Id,aa.sAccount,aa.sChrName,aa.Level,aa.btJob,aa.btSex,aa.btReLevel,aa.nGold,aa.nGameGird,aa.nLoyal,aa.nGameGold,aa.dCreateDate,bb.fromIdm,bb.fromIds from  MIR_HUM_INFO AS aa LEFT JOIN MIR_HUM_SDKID as bb ON aa.sAccount=bb.sAccount WHERE aa.sChrName LIKE '{$roleS}%' or aa.sAccount LIKE '{$roleS}%'");
            foreach($dateResult as $vv){
                if($vv) {
                    $resultDataStatus=true;
                    foreach ($vv as $v) {
                        if ($v['btJob'] == 0)
                            $v['btJobCL'] = '战士';
                        elseif ($v['btJob'] == 1)
                            $v['btJobCL'] = '法师';
                        else
                            $v['btJobCL'] = '道士';
                        if ($v['btSex'] == 1) {
                            $v['btSexCL'] = '女';
                        } else {
                            $v['btSexCL'] = '男';
                        }
                        $v['dCreateDateCL'] = date("Y-m-d H:i:s", strtotime($v['dCreateDate']));
                        $v['GoldSum'] = $v['nGold'] + $v['nGameGird'];
                        $v['LoyalSum'] = $v['nLoyal'] + $v['nGameGold'];
                        foreach($fromInfo as $from_i){
                            if($from_i['fromInfoId']==$v['fromIdm']){
                                $v['fromIdmName']=$from_i['fromInfoName'];
                            }
                        }
                        $dateResult_cl[] = $v;
                    }

                }else{
                    $resultDataStatus=false;
                    break;
                }
            }
            if( $resultDataStatus) {
                $this->response->end(json_encode(array('status' => 2000, "data" => $dateResult_cl)));
            }else{
                $this->response->end('{"status":2000,"date":""}');
            }
        }else{
            $this->response->end('{"status":2001,"message":"参数错误！"}');
        }
    }
}



?>