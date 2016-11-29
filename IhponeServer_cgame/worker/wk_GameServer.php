<?php
/**
 * 服区列表
 */
class wk_GameServer extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $fileServer=$this->DBselectAll("fileServer");
        $this->assign("fileServer",$fileServer);
        $this->assign("data",$this->DBselectAll('gameServer'));
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

        $this->display("Admin/GameServer.html");
    }
}
?>