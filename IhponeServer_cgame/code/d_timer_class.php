<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/23
 * Time: 14:55
 */
abstract class timer implements interTimerClass{
    protected $update_db;
    protected $rd;
    public $main;
    public $homeUrl;
    function __construct($update_db,$rd,$main='',$homeUrl){
        $this->update_db=$update_db;
        $this->rd=$rd;
        $this->main=$main;
        $this->homeUrl=$homeUrl;
    }
    final public function start(){
        $this->exe();
    }
    abstract function exe();
}
?>