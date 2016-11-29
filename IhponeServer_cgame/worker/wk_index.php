<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/15
 * Time: 17:14
 */
class wk_index extends e_AdminWorker{
   function Admin($cookie,$cookieKey){
       $this->assign('xx','999');
       $this->assign('yy','999');
       $this->assign("zz",'999');
       $this->display('Admin/index.html');
   }
}

?>