<?php
/**
 * Created by PhpStorm.
 * User: 019
 * Date: 2015/11/10
 * Time: 16:50
 */
class wk_Login extends worker{
    function POST_FUN()
    {
        $name=$this->post['name'];
        $passwd=$this->post['password'];
        if($name && $passwd){
            $result=$this->DBselect("userList","userName='{$name}' and password='".md5($passwd)."' and type=1");
            if($result){
                $cookie=$this->cookie['swooleCookie'];
                if(!$cookie){
                    $cookie=md5(time());
                    $this->response->header("Set-Cookie","swooleCookie={$cookie};path=/;");
                }

                $cookieName=$this->main['cookieName'];
                $this->assign("groundId",$result['groundId']);

                if($result['groundId']!=1){
                    $objectS=$this->DBselectAll('objectS',"id='{$result['objectGround']}'");
                    $this->assign("objectS", $objectS);
                }else {
                    $objectS=$this->DBselectAll('objectS');
                    $this->assign("objectS", $objectS);
                }
                if($result['objectGround']==0){
                    $objectName='超级管理';
                    $pageType=1;
                }else {
                    foreach ($objectS as $vv) {
                        if($result['objectGround']==$vv['id']){
                            $objectName =$vv['title'];
                        }
                    }
                    $pageType=2;
                }
                $this->rd->setex($cookieName.$cookie,1800,json_encode(array("joinState"=>1,"unid"=>$result['id'],"username"=>$name,"chinaName"=>$result['chinaName'],"powerJson"=>$result['powerJson'],"groundId"=>$result['groundId'],"objectGround"=>$result['objectGround'],'objectName'=>$objectName,'pageType'=>$pageType)));

                $this->assign("objectName",$objectName);
                $this->assign("pageType",$pageType);
                $this->assign("userName",$result['userName']);
                if($result['objectGround']==0) {
                    $this->assign('xx','');
                    $this->assign('zz','');
                    $this->assign('yy','');
                    $this->display('Admin/index.html');
                }elseif($result['groundId']==6){
                    $this->assign('xx', '');
                    $this->assign('zz', '');
                    $this->assign('yy', '');
                    $fromInfo=$result['UFromIdsName']?$result['UFromIdmName'].'-'.$result['UFromIdsName']:$result['UFromIdmName'];
                    $this->assign("fromInfoS",$fromInfo);
                    $this->display('From/index.html');
                }else{
                    $this->assign('xx','');
                    $this->assign('zz','');
                    $this->assign('yy','');
                    $this->display("User/indexA.html");
                }
            }else{
                $this->display("Admin/joinInto.html");
            }
        }else{
            $this->display("Admin/joinInto.html");
        }
    }
    function GET_FUN(){
        $this->display("Admin/joinInto.html");
    }
}

?>