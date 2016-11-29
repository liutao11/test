<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/5/28
 * Time: 15:23
 */
class wk_DUserDistribu extends  e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
        $className=__CLASS__;
        $this->assign('serverS',$serverS);
        foreach($this->main['fromInfo'] as $vv_i){
            $fromInfo_cl[$vv_i['fromInfoId']]=$vv_i['fromInfoName'];
        }

        $this->assign("className",$className);
        @$serverIndex=$cookie['serverIndex']?$cookie['serverIndex']:0;
        $this->assign("serverIndex",$serverIndex);
        @$style=$cookie[$className.'style']?$cookie[$className.'style']:1;                   //默认查询类型
        $this->assign("styleIndex",$style);
        @$showPageInt=$cookie[$className.'ChangePageInt']?$cookie[$className.'ChangePageInt']:1;
        $this->assign("showPageInt",$showPageInt);
        $valuesIndex=$cookie[$className.'values']?$cookie[$className.'values']:'';
        $this->assign("valuesIndex",$valuesIndex);
        if($serverIndex && $style) {
            $dblink = new cl_gamedbS($this->update_db->get_link(), $this->rd, $cookie['objectGround'],$serverIndex);
            $sql="select aa.Id,aa.sChrName,aa.sAccount,aa.btSex,aa.btJob,aa.Level,aa.btRelevel,aa.nGold,aa.nGameGird,aa.nGameGold,aa.nLoyal,aa.dCreateDate from MIR_HUM_INFO as aa";
            $result=$dblink->query($sql);
            foreach($result as $vv){
                $data_b=$vv;
            }
            if($cookie[$className.'values']){
                foreach($data_b as $v){
                    if($cookie[$className.'values']=='g1'){
                        $this->rd->zAdd($className."::buffer",$v['Level'],json_encode($v));
                    }elseif($cookie[$className.'values']=='g2'){
                        $this->rd->zAdd($className."::buffer",$v['btRelevel'],json_encode($v));
                    }elseif($cookie[$className.'values']=='g3'){
                        $this->rd->zAdd($className."::buffer",$v['nGold'],json_encode($v));
                    }elseif($cookie[$className.'values']=='g4'){
                        $this->rd->zAdd($className."::buffer",$v['nGameGird'],json_encode($v));
                    }elseif($cookie[$className.'values']=='g5'){
                        $this->rd->zAdd($className."::buffer",$v['nGameGold'],json_encode($v));
                    }elseif($cookie[$className.'values']=='g6'){
                        $this->rd->zAdd($className."::buffer",$v['nLoyal'],json_encode($v));
                    }
                }
                $result_s=$this->rd->zRevRange($className."::buffer",0,-1);
                $this->rd->del($className."::buffer");
                $data=[];
                foreach($result_s as $vv){
                    $data[]=json_decode($vv,true);
                }
            }else{
                $data=$data_b;
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

        }else{
            $this->assign('data','');
            $pageSum=0;
            $pagelength=40;
            $this->assign("pageSum",$pageSum);
            $this->assign("pageSumTo5",$pageSum-5);
            $this->assign("pageSumTo11",$pageSum-11);

            $this->assign("showPageIntS5",$showPageInt-5);
            $this->assign("showPageIntA5",$showPageInt+5);
            $this->assign("pageSum_11",$pageSum-11);
            $this->assign('pagelength',$pagelength);
            $this->assign('className',$className);
        }
        $this->display("Data/DUserDistribu.html");
    }
}


?>