<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/28
 * Time: 20:12
 */
class wk_ChangeObjectGet extends e_AdminWorker{
    function Admin($cookie,$cookieKey){
        $values=$this->get['values'];
        if($values){
            $result=$this->DBselectAll('gameServer',"ObjectId='{$values}' and Style !=3 ","id,GameServerUnid");
            if($result) {
                $rdb=array("state"=>2000,"data"=>$result);
            }else{
                $rdb=array("state"=>1002);
            }
            $this->response->end(json_encode($rdb));
        }
    }
}


?>