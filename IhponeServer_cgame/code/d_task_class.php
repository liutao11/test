<?php
/**
 *task 进程继承的累
 */
abstract class task implements interTaskClass {
    public $read_db;
    public $update_db;
    public $rd;
    public $data;
    public $main;
    function __construct($read_db,$update_db,$rd,$data,$main){
        $this->read_db=$read_db;
        $this->update_db=$update_db;
        $this->rd=$rd;
        $this->data=$data;
        $this->main=$main;
    }
    final public function start(){
        $this->exe();
    }

    final public  function DBinsert($tablename,$keys,$values){
        $sql="insert into {$tablename} ({$keys}) values ({$values})";

        $result = $this->update_db->exec($sql);
        if( $this->update_db->errorCode()=='00000'){
            return $result;
        }else{
            echo "********************错误原因：******************\n";
            $error= $this->update_db->errorInfo();
            echo "执行SQL：".$sql."\n";
            echo "错误提示：".$error['2']."\n";
            return 0;
        }
    }
    final public  function  DBselect($tablename,$where="1=1",$list="*"){
        $sql="select {$list} from {$tablename} where {$where}";
        $result =$this->update_db->query($sql);
        if($this->update_db->errorCode()=='00000'){
            if($result && $result->rowCount()>0){
                $resultjgs=$result->fetchAll(PDO::FETCH_ASSOC);
                return $resultjgs[0];
            }elseif($result && $result->rowCount()==0) {
                return 0;
            }
            echo "{$sql}执行成功\n";
        }else{
            echo "********************错误原因：******************\n";
            echo "执行命令：".$sql."\n";
            $error=$this->update_db->errorInfo();
            echo "mysqli提示:".$error['2']."\n";
        }
    }
    final public  function  DBselectAll($tablename,$where="1=1",$list="*",$ordery='order by id desc',$limit=''){
        $sql="select {$list} from {$tablename} where {$where} {$ordery} {$limit}";
        $dblink=$this->update_db;
        $result=$dblink->query($sql);
        if($dblink->errorCode()=='00000'){
            if($result && $result->rowCount()>0){
                $resultjgs=$result->fetchAll(PDO::FETCH_ASSOC);
                return $resultjgs;
            }elseif($result && $result->rowCount()==0) {
                return 0;
            }
            echo "{$sql}执行成功\n";
        }else{
            echo "********************错误原因：******************\n";
            echo "执行命令：".$sql."\n";
            $error=$dblink->errorInfo();
            echo "mysqli提示:".$error['2']."\n";
        }

    }
    public final function DBupdate($tablename,$set,$where='1=1'){
        //正式修改一条数据；
        $sql="update {$tablename} set {$set} where {$where}";
        $dblink=$this->update_db;
        $result= $dblink->exec($sql);
        if($dblink->errorCode()=='00000'){
            if($result){
                return $result;
            }elseif($result==0) {
                return 0;
            }
            echo "{$sql}执行成功\n";
        }else{
            $error=$dblink->errorInfo();
            echo "********************错误原因：******************\n";
            echo "执行命令：".$sql."\n";
            echo "mysqli提示:".$error[2]."\n";
            return 0;
        }
    }
    public function TelnetSend($NetUrl,$Port,$sendString){
        try{
            $client = new swoole_client(SWOOLE_SOCK_TCP);
            $clientStatus=$client->connect($NetUrl, $Port,3);
            if($clientStatus){
                $client->send($sendString);
                @$result = $client->recv();
                $client->close();
                return $result;
            }else{
                echo "无法链接服务器！";
                return false;
            }

        }catch (Exception $e){
            echo $e->getMessage();
            return false;
        }
    }
    abstract function exe();
}
?>