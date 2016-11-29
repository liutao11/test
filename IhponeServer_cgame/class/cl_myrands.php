<?php
/**
 * 根据随机种子
 */
class cl_myrands{
    private  $num;
    private $min;
    private $max;
    function  __construct($num,$min,$max){
        $this->num=$num;
        $this->min=$min;
        $this->max=$max;
    }
    private final function shift(){
        $this->num= $this->num * 214013 + 2531011;
        $this->num &= 0xFFFFFFFF;
        return ($this->num >> 16) & 0x7fff;
    }
    function random(){
        $f=(($this->shift() << 15) | $this->shift());
        $result=$f*($this->max-$this->min) / 0x40000000 +$this->min;
        $result &= 0xFFFFFFFF;
        return $result;
    }
}
?>