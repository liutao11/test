<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/7/28
 * Time: 16:26
 */
class wk_OPropEmilList extends e_OperatorsWorker{
    function  Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and IsClose=1","id,GameServerUnid,DBGameName,DBLogName,ServerTitle");
        $this->assign('serverS',$serverS);
        $serverS_c=[];

        $className=__CLASS__;
        foreach($serverS as $server){
            $serverS_c[$server['id']]=$server;
        }
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $serverIndex=$cookie['serverIndex'];
        }else{
            $serverIndex=$serverS[0]['id'];
        }
        @$showPageInt=$cookie[$className.'ChangePageInt']?$cookie[$className.'ChangePageInt']:1;
        $pagelength=40;
        $sqlLimitStart=($showPageInt-1)*$pagelength;
        $result_propEmil=$this->DBselectAll("PropEmil","1=1","roles,title,CTime,status,serverS,PropS,setUser","ORDER  by CTime desc","limit {$sqlLimitStart},{$pagelength}");
        $data=[];
        $PropSetup_butter=file_get_contents($this->homeUrl."/conf/propSetup.php");
        $propSetup=json_decode($PropSetup_butter,true);
        $propSetup_cl=[];
        foreach($propSetup as $prop){
            $propSetup_cl[$prop['id']]=$prop['name'];
        }
        foreach($result_propEmil as $vv){
            $roles_info=json_decode($vv['roles'],true);
            if($roles_info){
                if($roles_info['userObject']==1){
                    $vv['objectRoles']='在线用户发放';
                }else{
                    $vv['objectRoles']='全用户发放';
                }
            }else{
                $vv['objectRoles']=$vv['roles'];
            }
            $serverS_info=json_decode($vv['serverS'],true);
            foreach($serverS_info as $k=>$v) {
                @$vv['serverName'] = $serverS_c[$k]['ServerTitle'] ?$serverS_c[$k]['ServerTitle']:"未知";
            }
            $PropS_info=json_decode($vv['PropS'],true);
            $vv['PropName']='';
            if($PropS_info) {
                foreach ($PropS_info as $k => $v) {
                    @$vv['PropName'] .= $propSetup_cl[$k] ? $propSetup_cl[$k] : "未知：编号{$k}";
                    $vv['PropName'] .="*{$v['PropNum']};";
                }
            }
            $data[]=$vv;
        }
        $this->assign('data',$data);
        $this->assign('serverIndex',$serverIndex);

        $result_ob=$this->DBReadLink()->query("select count(id) as rows from PropEmil");
        $result_a=$result_ob->fetch(PDO::FETCH_ASSOC);
        $rows=$result_a['rows'];
        $pageSum=ceil($rows/$pagelength);
        $this->assign("pageSum",$pageSum);
        $this->assign("pageSumTo5",$pageSum-5);
        $this->assign("pageSumTo11",$pageSum-11);

        $this->assign("showPageIntS5",$showPageInt-5);
        $this->assign("showPageIntA5",$showPageInt+5);
        $this->assign("pageSum_11",$pageSum-11);
        $this->assign('pagelength',$pagelength);
        $this->assign("showPageInt", $showPageInt);

        $this->assign('className',$className);
        $this->display("Operators/PropEmilList.html");
    }
}


?>