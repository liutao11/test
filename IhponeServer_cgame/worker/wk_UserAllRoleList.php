<?php
/**角色*/
class wk_UserAllRoleList extends e_ServiceWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName,DBPayName");
        $this->assign('serverS',$serverS);


        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ){
            $this->assign('serverIndex',$cookie['serverIndex']);
            $serverIndex=$cookie['serverIndex'];
        }else{
            $serverIndex=$serverS[0]['id'];
            $this->assign('serverIndex',$serverIndex);
        }
        @$values=$cookie['UserRoleListBlurValues'];
        @$index=$cookie['UserRoleListBlurIndex'];
        $ExchangeRate=$this->main['ExchangeRate'];


        if($values){
            if($index==1){
                $sql_butter="and aa.sChrName like '{$values}%'";
            }elseif($index==2){
                $sql_butter="and aa.sAccount like '{$values}%'";
            }elseif($index==3){
                if($values=="男"){
                    $sql_butter="and aa.btSex=0";
                }elseif($values=="女"){
                    $sql_butter="and aa.btSex=1";
                }
            }elseif($index==4){
                if($values=="战士"){
                    $sql_butter="and aa.btJob=0";
                }elseif($values=="法师"){
                    $sql_butter="and aa.btJob=1";
                }elseif($values=="道士"){
                    $sql_butter="and aa.btJob=2";
                }
            }elseif($index==5){
                $sql_butter="and aa.Level='{$values}'";
            }elseif($index==6){
                $sql_butter="and aa.btRelevel='{$values}'";
            }
        }else{
            $sql_butter="";
        }
        $this->assign("index",$index?$index:0);
        $this->assign("value",$values?$values:"");

        $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'], $serverIndex);
        $className=__CLASS__;
        $sql_orderBy="ORDER  BY aa.id desc";
        $sql_orderBy_x="ORDER  BY aa.id asc";
        @$SortName= $cookie[$className."SortName"]? $cookie[$className."SortName"]:0;
        @$SortValue= $cookie[$className."SortValue"]?$cookie[$className."SortValue"]:0;
        $this->assign("SortName",$SortName);
        $this->assign("SortValue",$SortValue);


        if($SortName && $SortValue){
            if($SortName=="level"){
                if($SortValue==1){
                    $sql_orderBy="ORDER  BY aa.Level asc";
                    $sql_orderBy_x="ORDER  BY aa.Level desc";
                }else{
                    $sql_orderBy="ORDER  BY aa.Level desc";
                    $sql_orderBy_x="ORDER  BY aa.Level asc";
                }
            }else if($SortName=="liveLevel"){
                if($SortValue==1){
                    $sql_orderBy="ORDER  BY aa.btRelevel asc";
                    $sql_orderBy_x="ORDER  BY aa.btRelevel desc";
                }else{
                    $sql_orderBy_x="ORDER  BY aa.btRelevel asc";
                    $sql_orderBy="ORDER  BY aa.btRelevel desc";
                }
            }else if($SortName=="vipLevel"){
                if($SortValue==1){
                    $sql_orderBy="ORDER  BY aa.nReserved1 asc";
                    $sql_orderBy_x="ORDER  BY aa.nReserved1 desc";
                }else{
                    $sql_orderBy_x="ORDER  BY aa.nReserved1 asc";
                    $sql_orderBy="ORDER  BY aa.nReserved1 desc";
                }
            }else if($SortName=="gold"){
                if($SortValue==1){
                    $sql_orderBy="ORDER  BY aa.nGold asc";
                    $sql_orderBy_x="ORDER  BY aa.nGold desc";
                }else{
                    $sql_orderBy="ORDER  BY aa.nGold desc";
                    $sql_orderBy_x="ORDER  BY aa.nGold asc";
                }
            }else if($SortName=="BGold"){
                if($SortValue==1){
                    $sql_orderBy="ORDER  BY aa.nGameGird asc";
                    $sql_orderBy_x="ORDER  BY aa.nGameGird desc";
                }else{
                    $sql_orderBy="ORDER  BY aa.nGameGird desc";
                    $sql_orderBy_x="ORDER  BY aa.nGameGird asc";
                }
            }else if($SortName=="Acer"){
                if($SortValue==1){
                    $sql_orderBy="ORDER  BY aa.nReserved1 asc";
                    $sql_orderBy_x="ORDER  BY aa.nReserved1 desc";
                }else{
                    $sql_orderBy="ORDER  BY aa.nReserved1 desc";
                    $sql_orderBy_x="ORDER  BY aa.nReserved1 asc";
                }
            }else if($SortName=="Loyal"){
                if($SortValue==1){
                    $sql_orderBy="ORDER  BY aa.nLoyal asc";
                    $sql_orderBy_x="ORDER  BY aa.nLoyal desc";

                }else{
                    $sql_orderBy="ORDER  BY aa.nLoyal desc";
                    $sql_orderBy_x="ORDER  BY aa.nLoyal asc";
                }
            }else if($SortName=="BLoyal"){
                if($SortValue==1){
                    $sql_orderBy="ORDER  BY aa.nGameGold asc";
                    $sql_orderBy_x="ORDER  BY aa.nGameGold desc";
                }else{
                    $sql_orderBy="ORDER  BY aa.nGameGold desc";
                    $sql_orderBy_x="ORDER  BY aa.nGameGold asc";
                }
            }
        }
        if(@$cookie[$className.'ChangePageInt']){
            $showPageInt=$cookie[$className.'ChangePageInt'];
        }else{
            $showPageInt=1;
        }
        $this->assign('showPageInt',$showPageInt);
        $pagelength=40;
        $topMax="top ".$showPageInt* $pagelength;
        $sql="select {$topMax} aa.Id,aa.sChrName,aa.sAccount,aa.btSex,aa.btJob,aa.Level,aa.btRelevel,aa.nGold,aa.nGameGird,aa.nReserved1,aa.nLoyal,aa.nGameGold,aa.nReserved1/{$ExchangeRate} as moneyInt ,CONVERT(varchar(100),aa.dCreateDate,20) dCreateDate from dbo.MIR_HUM_INFO as aa  where 1=1 {$sql_butter} {$sql_orderBy}";
        $sql_row="select count(aa.Id) as row from dbo.MIR_HUM_INFO as aa";
        $redis_key_row=$this->main['cookieName']."::".$className."::".$serverIndex."::".md5($sql_row);

        $data_row=$this->rd->get($redis_key_row);
        if(!$data_row){
            $result_row=$dblink->query($sql_row,600);
            $data_row=$result_row[$serverIndex][0]['row'];
            $this->rd->setex($redis_key_row,600,$data_row);
        }

        $sql_cl="select * from (select top {$pagelength}  *  from ( {$sql} ) as aa  {$sql_orderBy_x}) as aa {$sql_orderBy}";
        $result=$dblink->query($sql_cl,600);
        $data=$result[$serverIndex];
        $data_s=array();
        $vipLevel=$this->main['vipLevel'];

        foreach($data as $kk=>$vv){
            $vv['vipLevel']="";
            if($vv['nReserved1']){
                foreach($vipLevel as $k=>$v){
                    if($vv['nReserved1']>=$v['min'] && $vv['nReserved1']<=$v['max']){
                        $vv['vipLevel']="vip".$k;
                    }
                }
            }
            $data_s[]=$vv;
        }
        $this->assign('data',$data_s);

        $pageSum=ceil($data_row/$pagelength);
        $this->assign("pageSum",$pageSum);
        $this->assign("pageSumTo5",$pageSum-5);
        $this->assign("pageSumTo11",$pageSum-11);

        $this->assign("showPageIntS5",$showPageInt-5);
        $this->assign("showPageIntA5",$showPageInt+5);
        $this->assign("pageSum_11",$pageSum-11);
        $this->assign('pagelength',$pagelength);
        $this->assign('className',$className);

        $this->display("Service/UserAllRoleList.html");
    }
}






















?>