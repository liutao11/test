<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/9/14
 * Time: 14:32
 */
abstract class pipe implements interTaskClass {
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
            }else{
                return -1;
            }
        }else{
            echo "********************错误原因：******************\n";
            echo "执行命令：".$sql."\n";
            $error=$this->update_db->errorInfo();
            echo "mysqli提示:".$error['2']."\n";
            return -1;
        }
    }
    final public  function  DBupdate($tablename,$set,$where='1=1'){
        $sql="update {$tablename} set {$set} where {$where}";
        $result =$this->update_db->query($sql);
        if($this->update_db->errorCode()=='00000'){
            if($result && $result->rowCount()>0){
                $return_s=$result;
            }elseif($result==0) {
                $return_s= 0;
            }else{
                $return_s=-1;
            }
        }else{
            $error=$result->errorInfo();
            echo "********************错误原因：******************\n";
            echo "执行命令：".$sql."\n";
            echo "mysqli提示:".$error[2]."\n";
            $return_s= -1;
        }
        return $return_s;
    }
    abstract function exe();
}


?>