<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/23
 * Time: 10:18
 */
class wk_LevelCountShowList extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $levelNum=$this->get['levelNum'];
        $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex']);
        $sql="select sChrName,btSex,btJob,nGold,Level,dCreateDate,dUpdateTime,btRelevel,nGameGold,sAccount from MIR_HUM_INFO where Level='{$levelNum}'";
        $levelShot_result=$dblink->query($sql);

        foreach($levelShot_result as $item){
            foreach($item as $vv){
                $data=[];
                $data['sChrName']=$vv['sChrName'];
                $data['sAccount']=$vv['sAccount'];
                $data['btSex']=$vv['btSex']==1?'男':"女";
                if($vv['btJob']==0){
                    $btJob['btJob']='战士';
                }elseif($vv['btJob']==1){
                    $btJob['btJob']='法师';
                }else{
                    $btJob['btJob']='道士';
                }
                $data['nGold']=$vv['nGold'];
                $data['Level']=$vv['Level'];
                $data['btRelevel']=$vv['btRelevel'];
                $data['nGameGold']=$vv['nGameGold'];
                $data['CreateDay']=date("Y-m-d H:i:s",strtotime($vv['dCreateDate']));
                $data['UpdateDay']=date("Y-m-d H:i:s",strtotime($vv['dUpdateTime']));
                $data_s[]=$data;
            }
        }
        $this->assign("data",$data_s);
        $this->display("Data/LevelCountShowList.html");



    }
}


?>