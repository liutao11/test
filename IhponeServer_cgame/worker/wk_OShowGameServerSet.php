<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/8/30
 * Time: 14:23
 */
class wk_OShowGameServerSet extends e_AdminWorker{
    function  Admin($cookie,$cookieKey){
        $fileServer=$this->DBselectAll("fileServer");
        $this->assign("fileServer",$fileServer);
        $data=$this->DBselectAll('ShowGameServer');
        $data_c=[];
        foreach($data as $vv){
            $vv['OpenTime']=date("Y-m-d H:i:s",$vv['CTime']);
            $data_c[]=$vv;
        }
        $this->assign("data",$data_c);
        $result_object=$this->DBselectAll("objectS");
        foreach($result_object as $vv){
            $result_object_cl[$vv['id']]=$vv['title'];
        }
        $this->assign("objectSJson",json_encode($result_object_cl));
        $result_fileServer=$this->DBselectAll("fileServer");
        $result_fileServer_cl=[];
        if($result_fileServer) {
            foreach ($result_fileServer as $vv) {
                $result_fileServer_cl[$vv['id']] = $vv['describeStr'];
            }
        }
        $this->assign("fileServerJson",json_encode($result_fileServer_cl));

        $this->display("Admin/OShowGameServerSet.html");

    }
}


?>