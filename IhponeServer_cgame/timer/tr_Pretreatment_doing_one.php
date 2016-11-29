<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/23
 * Time: 14:31
 */
class tr_Pretreatment_doing_one extends timer {
    function exe(){

        $dblink=$this->update_db->get_link();
        $sql="select id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId,OpenTime from gameServer  where isClose=1";
        $result=$dblink->query($sql);
        


        if($result && $result->rowCount()>0) {
            $resultjgs = $result->fetchAll(PDO::FETCH_ASSOC);
            //foreach($resultjgs);
        }
        $this->update_db->reback_link($dblink);

    }

}



?>