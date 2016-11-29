<?php
/**
 * 游戏数据库连接
 */
class cl_AllGamedb{
    private $mydblink;            //php程序自身所带的数据库索引
    private $objectIndex;         //拥有的平台
    private $serverIndex;         //是否选择区服号
    private $dbname;               //数据名
    function __construct($mydblink,$objectIndex='',$serverIndex='',$dbname='1'){
        $this->mydblink=$mydblink;
        $this->objectIndex=$objectIndex;
        $this->serverIndex=$serverIndex;
        $this->dbname=$dbname;
    }
    function query($sql){
        if($this->objectIndex){
            $sql_butter_object="aa.ObjectId ='{$this->objectIndex}'";
        }else{
            $sql_butter_object='1=1';
        }
        if($this->serverIndex!='') {
            $sql_butter_server="aa.id = '{$this->serverIndex}'";
        }else{
            $sql_butter_server='1=1';
        }

        $result=$this->mydblink->query("select aa.ObjectId,aa.id,aa.NetUrl,aa.DBPort,aa.DBUser,aa.DBPassword,aa.DBGameName,aa.DBLogName,aa.MasterServerIndex as mId,bb.NetUrl as mNetUrl,bb.DBPort as mDBPort,bb.DBUser as mDBUser,bb.DBPassword as mDBPassword,bb.DBGameName as mDBGameName,bb.DBLogName as mDBLogName from gameServer as aa LEFT JOIN gameServer as bb ON  aa.MasterServerIndex=bb.id  where aa.IsClose=1 and '{$sql_butter_object}' and '{$sql_butter_server}'");

        if($this->mydblink->errorCode()=='00000'){
            $result_array=$result->fetchAll(PDO::FETCH_ASSOC);
            $resultdb=array();
            foreach($result_array as $kk=>$vv){
                if($vv['mId']){
                    $msdb = mssql_connect("{$vv['mNetUrl']}:{$vv['mDBPort']}", "{$vv['mDBUser']}", "{$vv['mDBPassword']}");
                }else {
                    $msdb = mssql_connect("{$vv['NetUrl']}:{$vv['DBPort']}", "{$vv['DBUser']}", "{$vv['DBPassword']}");
                }
                if (!$msdb) {
                    echo "connect sqlserver error";
                }
                if($this->dbname==1){
                    if($vv['mId']) {
                        mssql_select_db($vv['mDBGameName'], $msdb);
                    }else{
                        mssql_select_db($vv['DBGameName'], $msdb);
                    }
                }elseif($this->dbname==2){
                    if($vv['mId']){
                        mssql_select_db($vv['mDBLogName'], $msdb);
                    }else {
                        mssql_select_db($vv['DBLogName'], $msdb);
                    }
                }else{

                }

                $result = mssql_query($sql, $msdb);
                $row_array=array();
                while($row= mssql_fetch_array($result,MSSQL_ASSOC)){
                    $row_array[]=$row;
                }
                mssql_free_result($result);
                $resultdb[$vv['ObjectId']][$vv['id']]=$row_array;
            }
            return $resultdb;
        }else{
            $dberror=$this->mydblink->errorInfo();
            echo "********************错误原因：******************\n";
            var_dump($sql);
            echo $dberror[2];
            return false;
        }
    }
}



?>