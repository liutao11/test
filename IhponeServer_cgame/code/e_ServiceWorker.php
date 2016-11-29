<?php
/*
 * 客服
*/
abstract class e_ServiceWorker extends worker{
    function GET_FUN(){
        $cookie=$this->cookie['swooleCookie'];
        $cookieName=$this->main['cookieName'];
        if($cookie){
            $cookieKey=$cookie;
            $rdresult=$this->rd->get($cookieName.$cookie);
            $rdresult_array=json_decode($rdresult,true);
            if($rdresult_array['joinState'] && ($rdresult_array['groundId']==5 || $rdresult_array['groundId']==1 || $rdresult_array['groundId']==2)){
                $this->assign("groundId", $rdresult_array['groundId']);
                if($rdresult_array['groundId']!=1){
                    $this->assign("objectS", $this->DBselectAll('objectS',"id='{$rdresult_array['objectGround']}'"));
                }else {
                    $this->assign("objectS", $this->DBselectAll('objectS'));
                }
                $this->assign("userName",$rdresult_array['username']);
                $this->assign("objectName",$rdresult_array['objectName']);
                $this->assign("pageType",$rdresult_array['pageType']);
                @$this->assign("xx",$this->get['xx']?$this->get['xx']:0);
                @$this->assign("yy",$this->get['yy']?$this->get['yy']:0);
                @$this->assign("zz",$this->get['zz']?$this->get['zz']:0);
                $this->rd->setex($cookieName. $cookie,1800*4,$rdresult);
                $result=$this->server->task(json_encode(array("TaskClass"=>"DoingLog","data"=>array("userName"=>$rdresult_array['username'],"sendType"=>"get","sendContent"=>$this->get,"className"=>$this->request->server['path_info'],'userIp'=>$this->request->server['remote_addr']))));
                $this->Admin($rdresult_array,$cookieKey);
            }else{
                $this->joinTnto();
            }
        }else{
            $cookieKey=md5(time());
            $this->response->header("Set-Cookie","swooleCookie={$cookieKey};path=/;");
            $this->rd->setex($cookieName. $cookieKey,1800*4,json_encode(array('joinState'=>'0')));
            $this->joinTnto();
        }
    }
    function POST_FUN(){
        $cookie=$this->cookie['swooleCookie'];
        $cookieName=$this->main['cookieName'];
        if($cookie){
            $cookieKey=$cookie;
            $rdresult=$this->rd->get($cookieName.$cookie);
            $rdresult_array=json_decode($rdresult,true);
            if($rdresult_array['joinState'] && ($rdresult_array['groundId']==5 || $rdresult_array['groundId']==1 || $rdresult_array['groundId']==2)){
                $this->assign("groundId", $rdresult_array['groundId']);
                if($rdresult_array['groundId']!=0){
                    $this->assign("objectS", $this->DBselectAll('objectS',"id='{$rdresult_array['objectGround']}'"));
                }else {
                    $this->assign("objectS", $this->DBselectAll('objectS'));
                }
                $this->assign("objectName",$rdresult_array['objectName']);
                $this->assign("pageType",$rdresult_array['pageType']);

                $this->rd->setex($cookieName. $cookie,1800*4,$rdresult);
                $result=$this->server->task(json_encode(array("TaskClass"=>"DoingLog","data"=>array("userName"=>$rdresult_array['username'],"sendType"=>"post","sendContent"=>$this->post,"className"=>$this->request->server['path_info'],'userIp'=>$this->request->server['remote_addr']))));
                $this->Admin($rdresult_array,$cookieKey);
            }else{
                $this->joinTnto();
            }
        }else{
            $cookieKey=md5(time());
            $this->response->header("Set-Cookie","swooleCookie={$cookieKey};path=/;");
            $this->rd->setex($cookieName. $cookieKey,1800*4,json_encode(array('joinState'=>'0')));
            $this->joinTnto();
        }
    }
    function joinTnto(){
        $this->display('Admin/joinInto.html');
    }
    abstract function Admin($cookie,$cookieKey);
}

?>