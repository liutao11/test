<?php
/**
 * 发布公告
 */
class wk_NoticeAddPost extends e_OperatorsWorker{
    public $NoticeListId;                         //公告列表id；
    public $NoticeTimeLong;                       //间隔时间
    function  Admin($cookie,$cookieKey){
        $workerId=$this->server->worker_id;
        $serverIndex=$this->post['serverIndex'];
        $title=$this->post['title'];
        $message=$this->post['message'];
        $startDay=$this->post['startDay'];
        $timeNumber=$this->post['timeNumber'];
        $timeLong=$this->post['timeLong'];
        $formId=$this->request->fd;
        $noticeType=$this->post['noticeType'];

        if($title && $message) {
            $objectId=$cookie['objectGround'];
            if($noticeType==1){                          //有发布时间得时候
                $startDayTime=strtotime($startDay);
                $nowTime=time();
               if($startDayTime>$nowTime){
                  if($timeNumber>1){
                      if($timeLong){    //有循环次数
                          $result=$this->DBInsertResultId("NoticeList","objectId,serverIndex,title,message,startDay,timeNumber,timeLong,sendNum,fromId,workerId,state","'{$objectId}','{$serverIndex}','{$title}','{$message}','{$startDayTime}','{$timeNumber}','{$timeLong}','0',{$formId},{$workerId},1");
                          $this->NoticeListId=$result['autoId'];
                          $this->NoticeTimeLong=$timeLong;
                          $afterTimeLong=$startDayTime-$nowTime;


                          $timerResult=swoole_timer_after(1000*$afterTimeLong,array($this,'timerAfter'));
                          $this->DBupdate("NoticeList","timerAfterId={$timerResult}","id={$result['autoId']}");

                          $this->response->end(json_encode(array("status" => "2000", "message" => "ok！")));
                      }else{
                          $this->response->end(json_encode(array("status" => "10001", "message" => "设置了循环2次数就必须要设置间隔时间！")));
                      }
                  }else{                //发送一次
                      $timeNumber=1;
                      $result=$this->DBInsertResultId("NoticeList","objectId,serverIndex,title,message,startDay,timeNumber,timeLong,sendNum,fromId,workerId,state","'{$objectId}','{$serverIndex}','{$title}','{$message}','{$startDayTime}','{$timeNumber}','{$timeLong}','0','{$formId}',{$workerId},1");
                      $this->NoticeListId=$result['autoId'];
                      $afterTimeLong=$startDayTime-$nowTime;



                      //$afterTimeLong=10;



                      $timerResult=swoole_timer_after(1000*$afterTimeLong,array($this,'timerAfterOne'));
                      $this->DBupdate("NoticeList","timerAfterId={$timerResult}","id={$result['autoId']}");
                      $this->response->end(json_encode(array("status" => "2000", "message" => "ok！")));
                  }
               }else{
                   $this->response->end(json_encode(array("status" => "10001", "message" => "时间非法！")));
               }
            }else{                             //没有发布时间
               if($timeNumber>1){               //需要重复
                   if($timeLong){
                       if($serverIndex){                //指定服
                           $DBResult=$this->DBselect("gameServer","id={$serverIndex} and IsClose=1",'NetUrl,TelnetPort');
                           $this->sendToGameServer($DBResult['NetUrl'],$DBResult['TelnetPort'],$message);
                       }else{                           //全项目发布
                           $DBResult=$this->DBselectAll("gameServer","ObjectId={$objectId} and IsClose=1",'NetUrl,TelnetPort');
                           foreach($DBResult as $vv){
                               $this->sendToGameServer($vv['NetUrl'],$vv['TelnetPort'],$message);
                           }
                       }
                       $startDayTime=time();
                       $result=$this->DBInsertResultId("NoticeList","objectId,serverIndex,title,message,startDay,timeNumber,timeLong,sendNum,fromId,workerId,state","'{$objectId}','{$serverIndex}','{$title}','{$message}','{$startDayTime}','{$timeNumber}','{$timeLong}','1',{$formId},{$workerId},1");
                       $timerResult=swoole_timer_tick(1000*$timeLong, array($this, 'NoticeAddReload'),array('NoticeListId'=>$result['autoId']));
                       $this->DBupdate("NoticeList","timerTickId={$timerResult}","id={$result['autoId']}");
                       $this->response->end(json_encode(array("status" => "2000", "message" => "ok！")));
                   }else{
                       $this->response->end(json_encode(array("status" => "10001", "message" => "设置了循环2次数就必须要设置间隔时间！")));
                   }
               }else{
                   $timeNumber=1;
                   if($serverIndex){                //指定服
                       $DBResult=$this->DBselect("gameServer","id={$serverIndex} and IsClose=1",'NetUrl,TelnetPort');
                       $this->sendToGameServer($DBResult['NetUrl'],$DBResult['TelnetPort'],$message);
                   }else{                           //全项目发布
                       $DBResult=$this->DBselectAll("gameServer","ObjectId={$objectId} and IsClose=1",'NetUrl,TelnetPort');
                       foreach($DBResult as $vv){
                           $this->sendToGameServer($vv['NetUrl'],$vv['TelnetPort'],$message);
                       }
                   }
                   $startDayTime=time();
                   $result=$this->DBInsertResultId("NoticeList","objectId,serverIndex,title,message,startDay,timeNumber,timeLong,sendNum,fromId,workerId,state","'{$objectId}','{$serverIndex}','{$title}','{$message}','{$startDayTime}','{$timeNumber}','{$timeLong}','1','{$formId}',{$workerId},1");
                   $this->response->end(json_encode(array("status" => "2000", "message" => "ok！")));
               }
            }
        }
    }
    /** 插入数据并返回插入的id*/
    final public  function DBInsertResultId($tablename,$keys,$values){
        $sql="insert into {$tablename} ({$keys}) values ({$values})";
        $dblink=$this->update_db->get_link();
        $result = $dblink->exec($sql);
        $this->update_db->reback_link($dblink);
        if($dblink->errorCode()=='00000'){
            $result_a=array('state'=>true,"autoId"=>$dblink->lastInsertId());
            return $result_a;
        }else{
            echo "********************错误原因：******************\n";
            $error=$dblink->errorInfo();
            echo "执行SQL：".$sql."\n";
            echo "错误提示：".$error['2']."\n";
            return 0;

        }
    }
    function timerAfterOne(){                      //发送一次
        $NoticeListId=$this->NoticeListId;
        $result=$this->DBselect("NoticeList","id={$NoticeListId}");
        $message= $result['message'];
        if($result['serverIndex']){
            $DBResult=$this->DBselect("gameServer","id={$result['serverIndex']} and IsClose=1",'NetUrl,TelnetPort');
            $this->sendToGameServer($DBResult['NetUrl'],$DBResult['TelnetPort'],$message);
        }else{
            $DBResult=$this->DBselectAll("gameServer","ObjectId={$result['objectId']} and IsClose=1",'NetUrl,TelnetPort');
            foreach($DBResult as $vv){
                $this->sendToGameServer($vv['NetUrl'],$vv['TelnetPort'],$message);
            }
        }
        $sendNum=$result['sendNum'];
        $sendNum++;
        $this->DBupdate("NoticeList","sendNum={$sendNum},state=2","id={$NoticeListId}");
        echo "自动发布公告:{$NoticeListId}:{$message}\n";
    }
    function timerAfter(){     //重复发送
        $NoticeListId=$this->NoticeListId;
        $result=$this->DBselect("NoticeList","id={$NoticeListId}");
        $message= $result['message'];


        if($result['serverIndex']){
            $DBResult=$this->DBselect("gameServer","id={$result['serverIndex']} and IsClose=1",'NetUrl,TelnetPort');
            $this->sendToGameServer($DBResult['NetUrl'],$DBResult['TelnetPort'],$message);
        }else{
            $DBResult=$this->DBselectAll("gameServer","ObjectId={$result['objectId']} and IsClose=1",'NetUrl,TelnetPort');
            foreach($DBResult as $vv){
                $this->sendToGameServer($vv['NetUrl'],$vv['TelnetPort'],$message);
            }
        }
        $sendNum=$result['sendNum'];
        $sendNum++;
        $this->DBupdate("NoticeList","sendNum={$sendNum}","id={$NoticeListId}");

        $timerId=swoole_timer_tick(1000*$this->NoticeTimeLong, array($this, 'NoticeAddReload'),array('NoticeListId'=>$this->NoticeListId));
        $this->DBupdate("NoticeList","timerTickId={$timerId}","id={$this->NoticeListId}");
    }
    function NoticeAddReload($interval,$params){
        $NoticeListId=$params['NoticeListId'];
        $result=$this->DBselect("NoticeList","id={$NoticeListId}");
        $message= $result['message'];
        if($result['serverIndex']){              //单服
            $DBResult=$this->DBselect("gameServer","id={$result['serverIndex']} and IsClose=1",'NetUrl,TelnetPort');
            $this->sendToGameServer($DBResult['NetUrl'],$DBResult['TelnetPort'],$message);
        }else {                                   //项目全服
            $DBResult=$this->DBselectAll("gameServer","ObjectId={$result['objectId']} and IsClose=1",'NetUrl,TelnetPort');
            foreach($DBResult as $vv){
                $this->sendToGameServer($vv['NetUrl'],$vv['TelnetPort'],$message);
            }
        }
        $sendNum=$result['sendNum'];
        $sendNum++;

        if($sendNum==$result['timeNumber']){
             $this->DBupdate("NoticeList","sendNum={$sendNum},state=2","id={$NoticeListId}");
            swoole_timer_clear($interval);
        }else{
           $this->DBupdate("NoticeList", "sendNum={$sendNum}", "id={$NoticeListId}");
        }
        echo "自动发布公告:{$NoticeListId}:{$message}\n";
    }
    function sendToGameServer($NetUrl,$TelnetPort,$message){
        try {
            $client = new swoole_client(SWOOLE_SOCK_TCP);
            if ($client->connect($NetUrl, $TelnetPort, 20)) {
                $sends = 'LINENOTICE 1 ' . $message . "\\";
                $client->send($sends);
                //$result = $client->recv();
                $result=1;
                $client->close();
                return $result;
            } else {
                echo "connect failed. Error: {$client->errCode}\n";
                return false;
            }
        }catch (ErrorException $e){
            return false;
        }
    }
}


?>