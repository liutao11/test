<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/2/16
 * Time: 10:12
 */
class wk_DoingLogShow extends e_AdminWorker{
    function  Admin($cookie,$cookieKey){
        if(@$cookie['DoingLogShowStartDay'] && $cookie['DoingLogShowEndDay']){
            $StartDay=$cookie['DoingLogShowStartDay'];
            $EndDay=$cookie['DoingLogShowEndDay'];
        }else{
            $StartDay=date("Y-m-d 00:00:00");
            $EndDay=date("Y-m-d 23:59:59");
        }
        $this->assign("startDay",$StartDay);
        $this->assign("endDay",$EndDay);
        $StartTime=strtotime($StartDay);
        $EndTime=strtotime($EndDay);
        $data=$this->DBselectAll('DoingLog',"tTime >= '{$StartTime}' and tTime <= '{$EndTime}'",'*','order by id desc','limit 0,100');
        $this->assign("data",$data);


        $pagelength=20;
        $this->assign("pageSum",ceil(count($data)/$pagelength));
        $this->assign('pagelength',$pagelength);

        $this->display("Data/DoingLogShow.html");
    }
}





?>