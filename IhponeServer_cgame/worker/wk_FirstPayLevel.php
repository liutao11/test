<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/16
 * Time: 17:55
 */
class wk_FirstPayLevel extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName");
        $this->assign('serverS',$serverS);
        $serverKeyValue=array();
        $ExchangeRate=$this->main['ExchangeRate'];
        foreach($serverS as $vv){
            $serverKeyValue[$vv['id']]=$vv['GameServerUnid'];
        }
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ) {
            $this->assign('serverIndex',$cookie['serverIndex']);
            $serverId=$cookie['serverIndex'];
            $this->assign("serverUnid",$cookie['serverUnid']);
        }else{
            $this->assign('serverIndex',0);
            $serverId=0;
            $this->assign("serverUnid","全服");
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround']);
        }
        $data=array(
            'ground1'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'10以下'),
            'ground2'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'11-20'),
            'ground3'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'21-30'),
            'ground4'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'31-40'),
            'ground5'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'41-50'),
            'ground6'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'51-60'),
            'ground7'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'61-70'),
            'ground8'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'71-80'),
            'ground9'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'81-90'),
            'ground10'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'91-100')
        );
        $moneySum=0;
        $UserID=array();
        if($serverId){
            foreach($serverS as $v){
                if($v['id']==$serverId){
                    $DBPayName=$v['DBPayName'];
                    $GameServerUnid=$v['GameServerUnid'];
                    break;
                }
            }
            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$v['id']);
            $sql="select nNumber/{$ExchangeRate} as numberSum,UserID,DrawoutLevel as uLevel from {$DBPayName}.dbo.Pay_{$GameServerUnid}";
            $result=$dblink->query($sql);
            foreach($result as $item){
                foreach($item as $vv){
                    if(!in_array($vv['UserID'],$UserID)) {
                        if ($vv['uLevel'] <= 10) {
                            $data['ground1']['userSum']++;
                            $data['ground1']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['uLevel'] >= 11 && $vv['uLevel'] < 21) {
                            $data['ground2']['userSum']++;
                            $data['ground2']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['uLevel'] >= 21 && $vv['uLevel'] < 31) {
                            $data['ground3']['userSum']++;
                            $data['ground3']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['uLevel'] >= 31 && $vv['uLevel'] < 41) {
                            $data['ground4']['userSum']++;
                            $data['ground4']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['uLevel'] >= 41 && $vv['uLevel'] < 51) {
                            $data['ground5']['userSum']++;
                            $data['ground5']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['uLevel'] >= 51 && $vv['uLevel'] < 61) {
                            $data['ground6']['userSum']++;
                            $data['ground6']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['uLevel'] >= 61 && $vv['uLevel'] < 71) {
                            $data['ground7']['userSum']++;
                            $data['ground7']['moneySum'] += $vv['numberSum'];
                        } else if ($vv['uLevel'] >= 71 && $vv['uLevel'] < 81) {
                            $data['ground8']['userSum']++;
                            $data['ground8']['moneySum'] += $vv['numberSum'];
                        }else if($vv['uLevel'] >= 81 && $vv['uLevel'] < 91){
                            $data['ground9']['userSum']++;
                            $data['ground9']['moneySum'] += $vv['numberSum'];
                        } else if($vv['uLevel'] >= 91 && $vv['uLevel'] < 101){
                            $data['ground10']['userSum']++;
                            $data['ground10']['moneySum'] += $vv['numberSum'];
                            $data['ground10']['serverUnid']=$GameServerUnid;
                        }
                        $moneySum += $vv['numberSum'];
                        $UserID[]=$vv['UserID'];
                    }
                }
            }
        }else{
            foreach($serverS as $v){
                $DBPayName=$v['DBPayName'];
                $GameServerUnid=$v['GameServerUnid'];
                $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$v['id']);
                $sql="select nNumber/100 as numberSum,UserID,DrawoutLevel as uLevel from {$DBPayName}.dbo.Pay_{$GameServerUnid}";
                $result=$dblink->query($sql);
                foreach($result as $item) {
                    foreach ($item as $vv) {
                        if (!in_array($vv['UserID'], $UserID)) {
                            if ($vv['uLevel'] <= 10) {
                                $data['ground1']['userSum']++;
                                $data['ground1']['moneySum'] += $vv['numberSum'];

                            } else if ($vv['uLevel'] >= 11 && $vv['uLevel'] < 21) {
                                $data['ground2']['userSum']++;
                                $data['ground2']['moneySum'] += $vv['numberSum'];

                            } else if ($vv['uLevel'] >= 21 && $vv['uLevel'] < 31) {
                                $data['ground3']['userSum']++;
                                $data['ground3']['moneySum'] += $vv['numberSum'];

                            } else if ($vv['uLevel'] >= 31 && $vv['uLevel'] < 41) {
                                $data['ground4']['userSum']++;
                                $data['ground4']['moneySum'] += $vv['numberSum'];

                            } else if ($vv['uLevel'] >= 41 && $vv['uLevel'] < 51) {
                                $data['ground5']['userSum']++;
                                $data['ground5']['moneySum'] += $vv['numberSum'];

                            } else if ($vv['uLevel'] >= 51 && $vv['uLevel'] < 61) {
                                $data['ground6']['userSum']++;
                                $data['ground6']['moneySum'] += $vv['numberSum'];

                            } else if ($vv['uLevel'] >= 61 && $vv['uLevel'] < 71) {
                                $data['ground7']['userSum']++;
                                $data['ground7']['moneySum'] += $vv['numberSum'];

                            } else if ($vv['uLevel'] >= 71 && $vv['uLevel'] < 81) {
                                $data['ground8']['userSum']++;
                                $data['ground8']['moneySum'] += $vv['numberSum'];

                            } else if ($vv['uLevel'] >= 81 && $vv['uLevel'] < 91) {
                                $data['ground9']['userSum']++;
                                $data['ground9']['moneySum'] += $vv['numberSum'];

                            } else if ($vv['uLevel'] >= 91 && $vv['uLevel'] < 101) {
                                $data['ground10']['userSum']++;
                                $data['ground10']['moneySum'] += $vv['numberSum'];

                            }
                            $UserID[] = $vv['UserID'];
                        }
                    }
                }
            }
        }
        $this->assign("class","FirstPayLevel");
        $this->assign('data',$data);
        $this->assign('moneySum',$moneySum);
        $this->display("Data/FirstPayLevel.html");
    }
}


?>