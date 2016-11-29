<?php
/**
 * 所有的类必须实现start()方法
 */
interface interWebClass{
   public function start();
   public function GET_FUN();
   public function POST_FUN();
   public function smarty();
}
interface interTaskClass{
   public function exe();
   public function start();
}
interface interTimerClass{
   public function exe();
   public function start();
}

?>