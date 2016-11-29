<?php
/**
 * 游戏数据库连接
 */
class cl_gamedbS{
    private $mydblink;            //php程序自身所带的数据库索引
    private $objectIndex;         //拥有的平台
    private $serverIndex;         //是否选择区服号
    private $dbname;               //数据名，1 游戏库，2，日志库，3，不指定数据
    private $redis;                //redis链接指针
    private $redisTime;           //redis保持时间

    function __construct($mydblink,$redis,$objectIndex,$serverIndex='',$dbname='1',$redisTime='300'){
        $this->mydblink=$mydblink;
        $this->redis=$redis;
        $this->objectIndex=$objectIndex;
        $this->serverIndex=$serverIndex;
        $this->dbname=$dbname;
        $this->redisTime=$redisTime;
    }
    function query($sql,$Time=''){
        $rdResult=$this->redis->get("GMDB_".$this->objectIndex."_".$this->serverIndex."_".md5($sql));
        if($rdResult){
            return json_decode($rdResult,true);
        }else {
            echo "没有缓冲数据{$sql}\n";
            if ($this->serverIndex != '') {
                $sqls = "select aa.id,aa.NetUrl,aa.DBPort,aa.DBUser,aa.DBPassword,aa.DBGameName,aa.DBLogName,aa.MasterServerIndex as mId,bb.NetUrl as mNetUrl,bb.DBPort as mDBPort,bb.DBUser as mDBUser,bb.DBPassword as mDBPassword,bb.DBGameName as mDBGameName,bb.DBLogName as mDBLogName from gameServer as aa LEFT JOIN gameServer as bb ON  aa.MasterServerIndex=bb.id  where aa.IsClose=1 and aa.id = '{$this->serverIndex}'";
            } else {
                $sqls = "select aa.id,aa.NetUrl,aa.DBPort,aa.DBUser,aa.DBPassword,aa.DBGameName,aa.DBLogName,aa.MasterServerIndex as mId,bb.NetUrl as mNetUrl,bb.DBPort as mDBPort,bb.DBUser as mDBUser,bb.DBPassword as mDBPassword,bb.DBGameName as mDBGameName,bb.DBLogName as mDBLogName from gameServer as aa LEFT JOIN gameServer as bb ON  aa.MasterServerIndex=bb.id   where aa.IsClose=1 and aa.ObjectId ='{$this->objectIndex}'";
            }
            $result = $this->mydblink->query($sqls);

            if ($this->mydblink->errorCode() == '00000') {
                $result_array = $result->fetchAll(PDO::FETCH_ASSOC);
                $resultdb = array();
                $result_redis_status=true;
                foreach ($result_array as $kk => $vv) {
                    if ($vv['mId']) {
                        $cont_url=$vv['mNetUrl'];
                        $cont_port=$vv['mDBPort'];
                        $cont_user=$vv['mDBUser'];
                        $cont_password=$vv['mDBPassword'];
                    } else {
                        $cont_url=$vv['NetUrl'];
                        $cont_port=$vv['DBPort'];
                        $cont_user=$vv['DBUser'];
                        $cont_password=$vv['DBPassword'];
                    }

                    if ($this->dbname == 1) {
                        if ($vv['mId']) {
                            $DBGameName=$vv['mDBGameName'];
                        } else {
                            $DBGameName=$vv['DBGameName'];
                        }
                    } elseif ($this->dbname == 2) {
                        if ($vv['mId']) {
                            $DBGameName=$vv['mDBLogName'];
                        } else {
                            $DBGameName=$vv['DBLogName'];
                        }
                    }else{
                        if ($vv['mId']) {
                            $DBGameName=$vv['mDBGameName'];
                        } else {
                            $DBGameName = $vv['DBGameName'];
                        }
                    }

                    $msdb=new PDO ("dblib:host={$cont_url}:{$cont_port};dbname={$DBGameName}",$cont_user,$cont_password);
                    $result =$msdb->query($sql);
                    if(!$result){
                        $result_redis_status=false;
                    }else {
                        $row_array = $result->fetchAll(PDO::FETCH_ASSOC);
                        $resultdb[$vv['id']] = $row_array;
                    }
                }
                if($result_redis_status) {
                    $rdTime = $Time ? $Time : $this->redisTime;
                    $this->redis->setex("GMDB_" . $this->objectIndex . "_" . $this->serverIndex . "_" . md5($sql), $rdTime, json_encode($resultdb));
                }
                return $resultdb;
            } else {
                $dberror = $this->mydblink->errorInfo();
                echo "********************错误原因：******************\n";
                echo $dberror[2];
                return false;
            }
        }
    }
    function update($sql){
        if($this->serverIndex!='') {
            $result=$this->mydblink->query("select aa.id,aa.NetUrl,aa.DBPort,aa.DBUser,aa.DBPassword,aa.DBGameName,aa.DBLogName,aa.MasterServerIndex as mId,bb.NetUrl as mNetUrl,bb.DBPort as mDBPort,bb.DBUser as mDBUser,bb.DBPassword as mDBPassword,bb.DBGameName as mDBGameName,bb.DBLogName as mDBLogName from gameServer as aa LEFT JOIN gameServer as bb ON  aa.MasterServerIndex=bb.id  where aa.id = '{$this->serverIndex}'");
        }else{
            $result=$this->mydblink->query("select aa.id,aa.NetUrl,aa.DBPort,aa.DBUser,aa.DBPassword,aa.DBGameName,aa.DBLogName,aa.MasterServerIndex as mId,bb.NetUrl as mNetUrl,bb.DBPort as mDBPort,bb.DBUser as mDBUser,bb.DBPassword as mDBPassword,bb.DBGameName as mDBGameName,bb.DBLogName as mDBLogName from gameServer as aa LEFT JOIN gameServer as bb ON  aa.MasterServerIndex=bb.id   where aa.ObjectId ='{$this->objectIndex}'");
        }
        if($this->mydblink->errorCode()=='00000'){
            $result_array=$result->fetchAll(PDO::FETCH_ASSOC);
            $resultdb=array();
            foreach($result_array as $kk=>$vv){
                if ($vv['mId']) {
                    $cont_url=$vv['mNetUrl'];
                    $cont_port=$vv['mDBPort'];
                    $cont_user=$vv['mDBUser'];
                    $cont_password=$vv['mDBPassword'];
                } else {
                    $cont_url=$vv['NetUrl'];
                    $cont_port=$vv['DBPort'];
                    $cont_user=$vv['DBUser'];
                    $cont_password=$vv['DBPassword'];
                }

                if ($this->dbname == 1) {
                    if ($vv['mId']) {
                        $DBGameName=$vv['mDBGameName'];
                    } else {
                        $DBGameName=$vv['DBGameName'];
                    }
                } elseif ($this->dbname == 2) {
                    if ($vv['mId']) {
                        $DBGameName=$vv['mDBLogName'];
                    } else {
                        $DBGameName=$vv['DBLogName'];
                    }
                }else{
                    if ($vv['mId']) {
                        $DBGameName=$vv['mDBGameName'];
                    } else {
                        $DBGameName=$vv['DBGameName'];
                    }
                }
                $msdb=new PDO ("dblib:host={$cont_url}:{$cont_port};dbname={$DBGameName}",$cont_user,$cont_password);
                $result = $msdb->query($sql);
            }
            if($result){
                return 1;
            }else{
                return 0;
            }
        }else{
            $dberror=$this->mydblink->errorInfo();
            echo "********************错误原因：******************\n";
            echo $dberror[2];
            return false;
        }
    }


}



?>