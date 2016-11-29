<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/26
 * Time: 16:01
 */
class wk_UserDoingLog extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);

        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $this->assign('serverIndex',$cookie['serverIndex']);
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex'],'2');
            if(@$cookie['UDDayReportStartDayS']){
                $StartDay=$cookie['UDDayReportStartDayS'];
            }else{
                $StartDay=date("Y-m-d");
            }

            $this->assign("PlayerDoing",$this->main['PlayerDoing']);
            $PlayerDoing =$this->main['PlayerDoing'];
            $this->assign("doingTypeList",$PlayerDoing);

            @$UserDoingSelectIndex=$cookie['UserDoingSelectIndex']?$cookie['UserDoingSelectIndex']:0;
            $this->assign("UserDoingSelectIndex",$UserDoingSelectIndex);
            $this->assign("UserDoingSelectName",$PlayerDoing[$UserDoingSelectIndex]);
            $className="UserDoingLog";

            if(@$cookie[$className.'ChangePageInt']){
                $showPageInt=$cookie[$className.'ChangePageInt'];
            }else{
                $showPageInt=1;
            }
            $this->assign('showPageInt',$showPageInt);
            $this->assign("startDay",$StartDay);

            foreach($serverS as $vv){
                $serverS_cl[$vv['id']]=$vv['GameServerUnid'];
            }
            $sql_blur_where='';

            if(@$cookie['PlayerDoingSelset']){
                $sql_blur_where.="MsgID={$cookie['PlayerDoingSelset']}";
            }
            if($cookie['roleKey0']){
                if($sql_blur_where) {
                    $sql_blur_where .= " and MapName='{$cookie['roleKey0']}'";
                }else{
                    $sql_blur_where .= "MapName='{$cookie['roleKey0']}'";
                }
            }
            if($cookie['roleKey1']){
                if($sql_blur_where) {
                    $sql_blur_where .= " and PlayerName='{$cookie['roleKey1']}'";
                }else{
                    $sql_blur_where .= "PlayerName='{$cookie['roleKey1']}'";
                }
            }
            if($cookie['roleKey2']){
                if($sql_blur_where) {
                    $sql_blur_where .= " and Actions like '%{$cookie['roleKey2']}%'";
                }else{
                    $sql_blur_where .= "Actions like '%{$cookie['roleKey2']}%'";
                }
            }
            if($cookie['roleKey3']){
                if($sql_blur_where) {
                    $sql_blur_where .= " and Value1 like '{$cookie['roleKey3']}%'";
                }else{
                    $sql_blur_where .= "Value1 like '{$cookie['roleKey3']}%'";
                }
            }
            if($cookie['roleKey4']){
                if($sql_blur_where) {
                    $sql_blur_where .= " and Value2 like '{$cookie['roleKey4']}%'";
                }else{
                    $sql_blur_where .= "Value2 like '{$cookie['roleKey4']}%'";
                }
            }
            if($cookie['roleKey5']){
                if($sql_blur_where) {
                    $sql_blur_where .= " and FuncName like '{$cookie['roleKey5']}%'";
                }else{
                    $sql_blur_where .= "FuncName like '{$cookie['roleKey5']}%'";
                }
            }

            $DBNameDay=date("Y_m_d",strtotime($StartDay));
            if(date("Y-m-d",strtotime($StartDay))==date("Y-m-d")){
                if($sql_blur_where){
                    $sql = "select MsgID,MapName,PlayerX,PlayerY,Actions,Value1,Value2,FuncName,PlayerName,SendTime,SendIP from dbo.NormalMsg where {$sql_blur_where} ORDER BY SendTime desc";
                }else{
                    $sql = "select top 1000 MsgID,MapName,PlayerX,PlayerY,Actions,Value1,Value2,FuncName,PlayerName,SendTime,SendIP from dbo.NormalMsg  ORDER BY SendTime desc";
                }
            }else{
                if($sql_blur_where) {
                    $sql = "select MsgID,MapName,PlayerX,PlayerY,Actions,Value1,Value2,FuncName,PlayerName,SendTime,SendIP from dbo.ItemLog_{$DBNameDay} where {$sql_blur_where} ORDER BY SendTime desc";
                }else{
                    $sql = "select top 1000 MsgID,MapName,PlayerX,PlayerY,Actions,Value1,Value2,FuncName,PlayerName,SendTime,SendIP from dbo.ItemLog_{$DBNameDay} ORDER BY SendTime desc";
                }
            }
            $result=$dblink->query($sql,900);
            foreach($result as $key=>$item){
                foreach($item as $kk=>$vv) {
                    $vv['GameServerUnid'] = $serverS_cl[$key];
                    $data[] = $vv;

                }
            }
            $pagelength=40;
            $data_s=array();
            foreach($data as $kk=>$vv){
                if((($showPageInt-1)*$pagelength-1) <= $kk && $kk <= ($showPageInt*$pagelength-1)){
                    $data_s[]=$vv;
                }
            }
            $this->assign('data',$data_s);
            $pageSum=ceil(count($data)/$pagelength);
            $this->assign("pageSum",$pageSum);
            $this->assign("pageSumTo5",$pageSum-5);
            $this->assign("pageSumTo11",$pageSum-11);
            $this->assign("showPageIntS5",$showPageInt-5);
            $this->assign("showPageIntA5",$showPageInt+5);
            $this->assign("pageSum_11",$pageSum-11);
            $this->assign('pagelength',$pagelength);
            $this->assign('className',$className);
            $this->assign("PlayerDoingSelset",$cookie['PlayerDoingSelset']?$cookie['PlayerDoingSelset']:'');
            $this->assign("roleKey0",$cookie['roleKey0']?$cookie['roleKey0']:"");
            $this->assign("roleKey1",$cookie['roleKey1']?$cookie['roleKey1']:"");
            $this->assign("roleKey2",$cookie['roleKey2']?$cookie['roleKey2']:"");
            $this->assign("roleKey3",$cookie['roleKey3']?$cookie['roleKey3']:"");
            $this->assign("roleKey4",$cookie['roleKey4']?$cookie['roleKey4']:"");
            $this->assign("roleKey5",$cookie['roleKey5']?$cookie['roleKey5']:"");
            $this->assign("blurIndex",@$cookie[$className.'BlurClassUNID']?$cookie[$className.'BlurClassUNID']:0);
            $this->assign("blurValue",@$cookie[$className.'BlurValue']?$cookie[$className.'BlurValue']:"");
        }else{
            $this->assign("blurIndex",0);
            $this->assign("blurValue","");
            $this->assign('serverIndex',0);
            $this->assign('data',"0");
            $StartDay=date("Y-m-d");
            $this->assign("startDay",$StartDay);
            @$whereKey=$cookie['UserDoingWhereKey']?$cookie['UserDoingWhereKey']:'';
            $PlayerDoing =$this->main['PlayerDoing'];
            $this->assign("doingTypeList",$PlayerDoing);
            @$UserDoingSelectIndex=$cookie['UserDoingSelectIndex']?$cookie['UserDoingSelectIndex']:0;
            $this->assign("UserDoingSelectIndex",$UserDoingSelectIndex);
            $this->assign("UserDoingSelectName",$PlayerDoing[$UserDoingSelectIndex]);
            $this->assign("whereKey",$whereKey);
            $this->assign("pageSum",0);
            $this->assign("pageSumTo5",0);
            $this->assign("pageSumTo11",0);
            $this->assign('pagelength',15);
            $className="UserDoingLog";
            $this->assign('className',$className);
            $this->assign("PlayerDoingSelset",'');
            $this->assign("roleKey0","");
            $this->assign("roleKey1","");
            $this->assign("roleKey2","");
            $this->assign("roleKey3","");
            $this->assign("roleKey4","");
        }
        $this->display("Service/UserDoingLog.html");
    }
}
?>