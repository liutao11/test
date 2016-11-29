<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/25
 * Time: 14:43
 */
class wk_FirstPayAnalyse extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        $ExchangeRate=$this->main['ExchangeRate'];
        $serverKeyValue=array();
        foreach($serverS as $vv){
            $serverKeyValue[$vv['id']]=$vv['GameServerUnid'];
            $serverS_cl[$vv['id']]=$vv;
        }
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ) {
            $this->assign('serverIndex',$cookie['serverIndex']);
            $this->assign("serverUnid",$cookie['serverUnid']);
            $gameServerInfo=$serverS_cl[$cookie['serverIndex']];
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex']);
            $sql="select nNumber/{$ExchangeRate} as numberSum,UserID from {$gameServerInfo['DBPayName']}.dbo.Pay_{$gameServerInfo['DBPayId']}";
            $result=$dblink->query($sql);
            $data=array(
                'ground1'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'10以下'),
                'ground2'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'11-50'),
                'ground3'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'51-100'),
                'ground4'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'101-200'),
                'ground5'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'201-500'),
                'ground6'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'501-1000'),
                'ground7'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'1001-5000'),
                'ground8'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'5001-10000'),
                'ground9'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'10001以上'),
            );
            $moneySum=0;
            $UserID=array();
            foreach($result as $item){
                foreach($item as $vv){
                    if(!in_array($vv['UserID'],$UserID)) {
                        if ($vv['numberSum'] <= 10) {
                            $data['ground1']['userSum']++;
                            $data['ground1']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['numberSum'] >= 11 && $vv['numberSum'] < 51) {
                            $data['ground2']['userSum']++;
                            $data['ground2']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['numberSum'] >= 51 && $vv['numberSum'] < 101) {
                            $data['ground3']['userSum']++;
                            $data['ground3']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['numberSum'] >= 101 && $vv['numberSum'] < 201) {
                            $data['ground4']['userSum']++;
                            $data['ground4']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['numberSum'] >= 201 && $vv['numberSum'] < 501) {
                            $data['ground5']['userSum']++;
                            $data['ground5']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['numberSum'] >= 501 && $vv['numberSum'] < 1001) {
                            $data['ground6']['userSum']++;
                            $data['ground6']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['numberSum'] >= 1001 && $vv['numberSum'] < 5001) {
                            $data['ground7']['userSum']++;
                            $data['ground7']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['numberSum'] >= 5001 && $vv['numberSum'] < 10001) {
                            $data['ground8']['userSum']++;
                            $data['ground8']['moneySum'] += $vv['numberSum'];
                        } else {
                            $data['ground9']['userSum']++;
                            $data['ground9']['moneySum'] += $vv['numberSum'];
                        }
                        $moneySum += $vv['numberSum'];
                        $UserID[]=$vv['UserID'];
                    }
                }
            }

            $this->assign('data',$data);
            $this->assign('moneySum',$moneySum);
        }else{
            $this->assign('serverIndex',0);
            $this->assign("serverUnid","全服");
            $this->assign('data','');
            $this->assign('moneySum','');
        }


        $this->display("Data/FirstPayAnalyse.html");
    }
}






?>