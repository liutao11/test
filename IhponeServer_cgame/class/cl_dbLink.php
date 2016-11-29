<?php
/**
 * 数据连接池类
 */
class cl_dbLink{
    private $type;
    private $host;
    private $port;
    private $use;
    private $pwd;
    private $dbname;
    private $num;
    public $pool=array();
    function __construct(&$type,&$host,&$port,&$use,&$pwd,&$dbname,&$num=5){
        $this->type=&$type;
        $this->host=&$host;
        $this->port=&$port;
        $this->use=&$use;
        $this->pwd=&$pwd;
        $this->dbname=&$dbname;
        $this->num=$num;
        $this->worker();
        //启动一个定时去定期保持连接
        //swoole_timer_tick(1000*60*60*2, array($this, 'db_heart'));

    }
    function worker(){
        for($i=1;$i<=$this->num;$i++){
            $randhost_key=array_rand($this->host);
            $randhost=$this->host[$randhost_key];
            try {
                $dblink = new PDO("{$this->type}:host={$randhost};dbname={$this->dbname};port={$this->port};charset=UTF8", $this->use, $this->pwd, array(PDO::ATTR_PERSISTENT => true));
                array_push($this->pool, $dblink);
            }catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    }
    function get_link(){
        if(count($this->pool)){
            $dblink=array_shift($this->pool);
            return $dblink;
        }else{
            $this->worker();
            return array_shift($this->pool);
        }
    }
    function reback_link(&$rebacklink){
        if(count($this->pool) < $this->num){
            array_push($this->pool,$rebacklink);
        }
    }
    function db_heart(){
        echo "数据库连接池启动心跳：时间".time()."\n";
        foreach($this->pool as $vvlink){
            $re=$vvlink->query("select @@version");
        }
    }
}


?>