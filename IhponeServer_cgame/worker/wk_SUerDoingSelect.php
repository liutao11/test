<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/8/1
 * Time: 19:15
 */
class wk_SUerDoingSelect extends e_ServiceWorker{
    function  Admin($cookie,$cookiekey){
        @$serverIndex=$cookie['serverIndex']?$cookie['serverIndex']:'0';
        $this->assign('serverIndex',$serverIndex);
        $this->assign("PlayerDoing",$this->main['PlayerDoingSelect']);
        $PlayerDoing =$this->main['PlayerDoing'];
        $this->assign("doingTypeList",$PlayerDoing);
        $className=__CLASS__;
        $this->assign('className',$className);
        if(@$cookie[ $className.'StartDay'] && $cookie[ $className.'EndDay']){
            $StartDay=$cookie[ $className.'StartDay'];
            $EndDay=$cookie[ $className.'EndDay'];
        }else{
            $StartDay=date("Y-m-d");
            $EndDay=date("Y-m-d");
        }
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);
        $pagelength=40;
        $this->assign('pagelength',$pagelength);

        $serverS=$this->DBselectAll("gameServer","ObjectId='{$cookie['objectGround']}' and isClose=1","id,GameServerUnid,DBGameName,DBLogName");
        $this->assign('serverS',$serverS);


        @$roles=$cookie[$className.'roles']?$cookie[$className.'roles']:"";
        $this->assign('roles',$roles);

        @$UserDoingSelectIndex=$cookie['UserDoingSelectIndex']>-1?$cookie['UserDoingSelectIndex']:"-1";
        $this->assign('UserDoingSelectIndex',$UserDoingSelectIndex);

        @$showState=$cookie[$className."showState"]?$cookie[$className."showState"]:1;
        $this->assign("showState",$showState);
        if($showState==1){
            $sqlOrderState='desc';
            $sqlOrderStateHover="asc";
        }elseif($showState==2){
            $sqlOrderState='asc';
            $sqlOrderStateHover="desc";
        }else{
            $sqlOrderState='desc';
            $sqlOrderStateHover="asc";
        }
        if(@$cookie[$className.'ChangePageInt']){
            $showPageInt=$cookie[$className.'ChangePageInt'];
        }else{
            $showPageInt=1;
        }
        $this->assign('showPageInt',$showPageInt);
        if($serverIndex && $roles){
            if($UserDoingSelectIndex>-1) {
                $StartDayTime = strtotime($StartDay);
                $EndDayTime = strtotime($EndDay);
                $dayS = ($EndDayTime - $StartDayTime) / (24 * 3600) + 1;
                $sql = '';
                for ($i = 0; $i < $dayS; $i++) {
                    $jsDayTime = $StartDayTime + $i * 24 * 3600;
                    $sqljsDayTime = date("Y_m_d", $jsDayTime);
                    if ($sql) {
                        if ($sqljsDayTime == date("Y_m_d")) {
                            $sql .= "UNION select MsgID,MapName,PlayerX,PlayerY,Actions,Value1,Value2,funcName,PlayerName,SendTime,SendIP from NormalMsg where MsgID='{$UserDoingSelectIndex}' and PlayerName='{$roles}'";
                        } else {
                            $sql .= "UNION select MsgID,MapName,PlayerX,PlayerY,Actions,Value1,Value2,funcName,PlayerName,SendTime,SendIP from ItemLog_{$sqljsDayTime} where MsgID='{$UserDoingSelectIndex}' and PlayerName='{$roles}'";
                        }
                    } else {
                        if ($sqljsDayTime == date("Y_m_d")) {
                            $sql .= "select MsgID,MapName,PlayerX,PlayerY,Actions,Value1,Value2,funcName,PlayerName,SendTime,SendIP from NormalMsg where MsgID='{$UserDoingSelectIndex}' and PlayerName='{$roles}'";
                        } else {
                            $sql .= "select MsgID,MapName,PlayerX,PlayerY,Actions,Value1,Value2,funcName,PlayerName,SendTime,SendIP from ItemLog_{$sqljsDayTime} where MsgID='{$UserDoingSelectIndex}' and PlayerName='{$roles}'";
                        }
                    }
                }

                $sql_cl = "select aa.MsgID,aa.MapName,aa.PlayerX,aa.PlayerY,aa.Actions,aa.Value1,aa.Value2,aa.funcName,aa.PlayerName,aa.SendTime,aa.SendIP from ({$sql}) as aa ORDER by CONVERT(varchar(100), aa.SendTime, 0)  {$sqlOrderState}";
                $redis_key = $this->main['cookieName'] . '::' . $className . '::' . $cookie['objectGround'] . "::" . $serverIndex . '::' . md5($sql_cl);
                $redis_data_json = $this->rd->get($redis_key);
                if ($redis_data_json) {
                    $data = json_decode($redis_data_json, true);
                } else {
                    $dblink = new cl_gamedbS($this->update_db->get_link(), $this->rd, $cookie['objectGround'], $serverIndex, '2');
                    $result_data = $dblink->query($sql_cl);
                    $data = $result_data[$serverIndex];
                    if ($data) {
                        $this->rd->setex($redis_key, 300, json_encode($data));
                    }
                }
                $dataRows = count($data);
                $data_c = [];
                if ($showPageInt >= 1) {
                    foreach ($data as $key => $vv) {
                        if ($key >= ($showPageInt - 1) * $pagelength && $key <= ($showPageInt) * $pagelength - 1) {
                            $data_c[] = $vv;
                        }
                    }
                }

                //var_dump($data);
                if ($dataRows > 0) {
                    $pageSum = ceil($dataRows / $pagelength);
                    $this->assign("pageSum", $pageSum);
                    $this->assign("pageSumTo5", $pageSum - 5);
                    $this->assign("pageSumTo11", $pageSum - 11);
                    $this->assign("showPageIntS5", $showPageInt - 5);
                    $this->assign("showPageIntA5", $showPageInt + 5);
                    $this->assign("pageSum_11", $pageSum - 11);
                    $this->assign('pagelength', $pagelength);
                } else {
                    $pageSum = 0;
                    $this->assign("pageSum", $pageSum);
                    $this->assign("pageSumTo5", $pageSum - 5);
                    $this->assign("pageSumTo11", $pageSum - 11);
                    $this->assign("showPageIntS5", $showPageInt - 5);
                    $this->assign("showPageIntA5", $showPageInt + 5);
                    $this->assign("pageSum_11", $pageSum - 11);
                    $this->assign('pagelength', $pagelength);
                }
                $this->assign('data', $data_c);
            }else if ($UserDoingSelectIndex==-1) {
                $StartDayTime = strtotime($StartDay);
                $EndDayTime = strtotime($EndDay);
                $dayS = ($EndDayTime - $StartDayTime) / (24 * 3600) + 1;
                $sql = '';
                for ($i = 0; $i < $dayS; $i++) {
                    $jsDayTime = $StartDayTime + $i * 24 * 3600;
                    $sqljsDayTime = date("Y_m_d", $jsDayTime);
                    if ($sql) {
                        if ($sqljsDayTime == date("Y_m_d")) {
                            $sql .= "UNION select MsgID,MapName,PlayerX,PlayerY,Actions,Value1,Value2,funcName,PlayerName,SendTime,SendIP from NormalMsg where PlayerName='{$roles}'";
                        } else {
                            $sql .= "UNION select MsgID,MapName,PlayerX,PlayerY,Actions,Value1,Value2,funcName,PlayerName,SendTime,SendIP from ItemLog_{$sqljsDayTime} where  PlayerName='{$roles}'";
                        }
                    } else {
                        if ($sqljsDayTime == date("Y_m_d")) {
                            $sql .= "select MsgID,MapName,PlayerX,PlayerY,Actions,Value1,Value2,funcName,PlayerName,SendTime,SendIP from NormalMsg where  PlayerName='{$roles}'";
                        } else {
                            $sql .= "select MsgID,MapName,PlayerX,PlayerY,Actions,Value1,Value2,funcName,PlayerName,SendTime,SendIP from ItemLog_{$sqljsDayTime} where  PlayerName='{$roles}'";
                        }
                    }
                }
                $pagelengthRow=$showPageInt*$pagelength;
                $sql_cl = "select gg.MsgID,gg.MapName,gg.PlayerX,gg.PlayerY,gg.Actions,gg.Value1,gg.Value2,gg.funcName,gg.PlayerName,gg.SendTime,gg.SendIP from (select top {$pagelength} ff.MsgID,ff.MapName,ff.PlayerX,ff.PlayerY,ff.Actions,ff.Value1,ff.Value2,ff.funcName,ff.PlayerName,ff.SendTime,ff.SendIP from ( select top {$pagelengthRow} ee.MsgID,ee.MapName,ee.PlayerX,ee.PlayerY,ee.Actions,ee.Value1,ee.Value2,ee.funcName,ee.PlayerName,ee.SendTime,ee.SendIP from ( select top {$pagelengthRow}  aa.MsgID,aa.MapName,aa.PlayerX,aa.PlayerY,aa.Actions,aa.Value1,aa.Value2,aa.funcName,aa.PlayerName,aa.SendTime,aa.SendIP from ({$sql}) as aa ORDER by CONVERT(varchar(100), aa.SendTime, 0)  {$sqlOrderState} ) as ee ORDER by CONVERT(varchar(100), ee.SendTime, 0)  {$sqlOrderStateHover} ) as ff ) as gg ORDER by CONVERT(varchar(100), gg.SendTime, 0) {$sqlOrderState}";
                $redis_key = $this->main['cookieName'] . '::' . $className . '::' . $cookie['objectGround'] . "::" . $serverIndex . '::' . md5($sql_cl);
                $redis_key_row=$this->main['cookieName'] . '::' . $className . '::' . $cookie['objectGround'] . "::" . $serverIndex . '::' . md5($sql)."::row";
                $redis_data_json = $this->rd->get($redis_key);
                $dataRows_int=$this->rd->get($redis_key_row);
                $dataRows=0;
                if ($redis_data_json && $dataRows_int>0) {
                    $data = json_decode($redis_data_json, true);
                    $dataRows= $dataRows_int;
                } else {
                    $dblink = new cl_gamedbS($this->update_db->get_link(), $this->rd, $cookie['objectGround'], $serverIndex, '2');
                    $result_data = $dblink->query($sql_cl);
                    $data = $result_data[$serverIndex];
                    if ($data) {
                        $this->rd->setex($redis_key, 300, json_encode($data));
                    }

                    if($dataRows_int){
                        $dataRows=$dataRows_int;
                    }else{
                        $sql_row="select count(cc.MsgID) as row from ( {$sql} ) as cc";
                        $result_row=$dblink->query($sql_row);
                        if($result_row[$serverIndex][0]['row']){
                            $dataRows=$result_row[$serverIndex][0]['row'];
                            $this->rd->setex($redis_key_row, 300, $dataRows);
                        }
                    }
                }
                $PlayerDoingSelect=$this->main['PlayerDoingSelect'];
                $data_cl=[];
                foreach($data as $info){
                    @$info["MsgID"]=$PlayerDoingSelect[$info['MsgID']]?$PlayerDoingSelect[$info['MsgID']]:$info['MsgID'];
                    $data_cl[]=$info;
                }
                $pageSum = ceil($dataRows / $pagelength);
                $this->assign("pageSum", $pageSum);
                $this->assign("pageSumTo5", $pageSum - 5);
                $this->assign("pageSumTo11", $pageSum - 11);
                $this->assign("showPageIntS5", $showPageInt - 5);
                $this->assign("showPageIntA5", $showPageInt + 5);
                $this->assign("pageSum_11", $pageSum - 11);
                $this->assign('pagelength', $pagelength);
                $this->assign('data', $data_cl);

            }
        }else{
            $data='';
            $this->assign('pageSum',0);
            $this->assign("pageSumTo5",0);
            $this->assign("pageSumTo11",0);
            $this->assign('data',$data);
        }


        $this->display("Service/SUerDoingSelect.html");
    }
}


?>