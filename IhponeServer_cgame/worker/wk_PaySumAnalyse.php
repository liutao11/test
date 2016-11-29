<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/25
 * Time: 11:49
 */
class wk_PaySumAnalyse extends e_DataWorker{
    function Admin($cookie,$cookieKey){
        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,ServerTitle,GameServerUnid,DBGameName,DBLogName,DBPayName,DBPayId");
        $this->assign('serverS',$serverS);
        $serverKeyValue=array();
        $ExchangeRate=$this->main['ExchangeRate'];
        foreach($serverS as $vv){
            $serverKeyValue[$vv['id']]=$vv['GameServerUnid'];
            $serverS_cl[$vv['id']]=$vv;
        }
        if(@$cookie['serverIndex'] && $cookie['serverIndex']!=0 ) {
            $this->assign('serverIndex',$cookie['serverIndex']);
            $gameServerInfo=$serverS_cl[$cookie['serverIndex']];
            $this->assign("serverUnid",$gameServerInfo['GameServerUnid']);

            $dblink=new cl_gamedbS($this->update_db->get_link(),$this->rd,$cookie['objectGround'],$cookie['serverIndex']);



            $sql="select sum(nNumber)/{$ExchangeRate} as numberSum from {$gameServerInfo['DBPayName']}.dbo.Pay_{$gameServerInfo['DBPayId']} GROUP by UserID";
            $result=$dblink->query($sql);
            $data=array(
                'ground1'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'<=10'),
                'ground2'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'11-20'),
                'ground3'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'21-30'),
                'ground4'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'31-40'),
                'ground5'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'41-50'),
                'ground6'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'51-60'),
                'ground7'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'61-70'),
                'ground8'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'71-80'),
                'ground9'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'81-90'),
                'ground10'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'91-100'),
                'ground11'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'101-200'),
                'ground12'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'201-300'),
                'ground13'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'301-400'),
                'ground14'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'401-500'),
                'ground15'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'501-600'),
                'ground16'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'601-700'),
                'ground17'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'701-800'),
                'ground18'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'801-900'),
                'ground19'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'901-1000'),
                'ground20'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'1001-5000'),
                'ground21'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'5001-10000'),
                'ground22'=>array("moneySum"=>0,"userSum"=>0,"devel"=>'10001以上'),
            );
            $moneySum=0;
            foreach($result as $item){
                foreach($item as $vv){
                    if($vv['numberSum']<=10){
                        $data['ground1']['userSum']++;
                        $data['ground1']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>10 && $vv['numberSum'] <=20){
                        $data['ground2']['userSum']++;
                        $data['ground2']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>20 && $vv['numberSum'] <=30){
                        $data['ground3']['userSum']++;
                        $data['ground3']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>30 && $vv['numberSum'] <=40){
                        $data['ground4']['userSum']++;
                        $data['ground4']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>40 && $vv['numberSum'] <=50){
                        $data['ground5']['userSum']++;
                        $data['ground5']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>50 && $vv['numberSum'] <=60){
                        $data['ground6']['userSum']++;
                        $data['ground6']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>60 && $vv['numberSum'] <=70){
                        $data['ground7']['userSum']++;
                        $data['ground7']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>70 && $vv['numberSum'] <=80){
                        $data['ground8']['userSum']++;
                        $data['ground8']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>80 && $vv['numberSum'] <=90){
                        $data['ground9']['userSum']++;
                        $data['ground9']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>90 && $vv['numberSum'] <=100){
                        $data['ground10']['userSum']++;
                        $data['ground10']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>100 && $vv['numberSum'] <=200){
                        $data['ground11']['userSum']++;
                        $data['ground11']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>200 && $vv['numberSum'] <=300){
                        $data['ground12']['userSum']++;
                        $data['ground12']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>300 && $vv['numberSum'] <=400){
                        $data['ground13']['userSum']++;
                        $data['ground13']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>400 && $vv['numberSum'] <=500){
                        $data['ground14']['userSum']++;
                        $data['ground14']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>500 && $vv['numberSum'] <=600){
                        $data['ground15']['userSum']++;
                        $data['ground15']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>600 && $vv['numberSum'] <=700){
                        $data['ground16']['userSum']++;
                        $data['ground16']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>700 && $vv['numberSum'] <=800){
                        $data['ground17']['userSum']++;
                        $data['ground17']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>800 && $vv['numberSum'] <=900){
                        $data['ground18']['userSum']++;
                        $data['ground18']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>900 && $vv['numberSum'] <=1000){
                        $data['ground19']['userSum']++;
                        $data['ground19']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>1000 && $vv['numberSum'] <=5000){
                        $data['ground20']['userSum']++;
                        $data['ground20']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>5000 && $vv['numberSum'] <=10000){
                        $data['ground21']['userSum']++;
                        $data['ground21']['moneySum']+=$vv['numberSum'];
                    }else if($vv['numberSum']>10000){
                        $data['ground22']['userSum']++;
                        $data['ground22']['moneySum']+=$vv['numberSum'];
                    }
                    $moneySum+=$vv['numberSum'];
                }
            }

            $this->assign('data',$data);
            $this->assign('moneySum',$moneySum);
            $legend_js=array();
            $moneySum_js=array();
            $userSum_js=array();
            foreach($data as $kk=>$vv){
                $legend_js[]=$vv['devel'];
                $legend_js1[]='充'.$vv['devel'];
                $moneySum_js[]=array("value"=>$vv['moneySum'],'name'=>$vv['devel']);
                $userSum_js[]=array("value"=>$vv['userSum'],'name'=>'充'.$vv['devel']);
            }

            $this->assign("legend_js",json_encode($legend_js));
            $this->assign("legend_js1",json_encode($legend_js1));
            $this->assign("moneySum_js",json_encode($moneySum_js));
            $this->assign("userSum_js",json_encode($userSum_js));
        }else{
            $this->assign('serverIndex',0);
            $this->assign("serverUnid","全服");
            $this->assign("data",'');
            $this->assign("legend_js",'[]');
            $this->assign("legend_js1",'[]');
            $this->assign("moneySum_js",'[]');
            $this->assign("userSum_js",'[]');

        }


        $this->display("Data/PaySumAnalyse.html");

    }
}




?>