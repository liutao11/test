<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/23
 * Time: 14:31
 */
class tr_Pretreatment_doing extends timer {
    function exe(){
        $sql="select id,ObjectId,OpenTime,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId from gameServer  where isClose=1";
        $result=$this->update_db->query($sql);
        if($result && $result->rowCount()>0) {
            $resultjgs = $result->fetchAll(PDO::FETCH_ASSOC);
        }


        //登入ip提取
        $RunBufferFile=$this->main['RunBufferFile'];
        if(is_file($RunBufferFile)) {
            $read_connet = file_get_contents($RunBufferFile);
            if ($read_connet){
                $RunBuffer=json_decode($read_connet,true);
            }else{
                $RunBuffer=array();
            }
        }else{
            $RunBuffer=array();
        }

        $ButterKey=$this->main['cookieName']."::Buffer::doing_TakenUserLogin_startTime";
        $NowTime=time();

        foreach($resultjgs as $vv) {
            $dblinkS = new cl_gamedbS($this->update_db, $this->rd,$vv['ObjectId'],$vv['id'], '1');
            if(@$RunBuffer[$ButterKey]){

            }else{
                $serverOpenTime=strtotime(date("Y-m-d",strtotime($vv['OpenTime'])));
                $todayTime=strtotime(date("Y-m-d"));
                $openDaySum=($todayTime-$serverOpenTime)/(24*3600);
                var_dump($openDaySum);

                for($i=0;$i<=$openDaySum;$i++){
                    $jsDay=date("Y_m_d",$serverOpenTime+$i*24*3600);

                    if($jsDay==date("Y_m_d")){

                    }else{
                        $sql="select top 1 PlayerID,PlayerName,NetCardSN,SendIP,SendTime from {$vv['DBLogName']}.dbo.ChartLog_{$jsDay} ";
                        $LoginInfo_result=$dblinkS->query($sql);

                        if($LoginInfo_result){
                            foreach($LoginInfo_result as $key=>$value){
                                foreach($value as $vv){

                                }
                            }
                        }
                    }

                }


            }

        }
        //$RunBuffer[$ButterKey]=$NowTime;
        file_put_contents($RunBufferFile,json_encode($RunBuffer));
    }

}



?>