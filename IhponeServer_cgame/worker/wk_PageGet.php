<?php
/**
 * 页面跳转页面
 */
class wk_PageGet extends worker{
    function GET_FUN(){
        $cookie=$this->cookie['swooleCookie'];
        $cookieName=$this->main['cookieName'];
        $values=$this->get['values'];
        if($cookie){
            $cookieKey=$cookie;
            $rdresult=$this->rd->get($cookieName.$cookie);
            $rdresult_array=json_decode($rdresult,true);
            if($rdresult_array['joinState']){
                if($values>=0){
                    $groundId=$rdresult_array['groundId'];
                    if($groundId==1){
                        $rdresult_array['objectGround']=$values;
                        if($values!=0) {
                            $objectS = $this->DBselectAll('objectS');
                            foreach ($objectS as $vv) {
                                if ($vv['id'] == $values) {
                                    $rdresult_array['objectName'] = $vv['title'];
                                    $rdresult_array['pageType']=2;
                                }
                            }
                        }else{
                            $rdresult_array['objectName'] = '超级管理';
                            $rdresult_array['pageType']=1;
                        }
                        unset($rdresult_array['serverIndex']);

                        $this->rd->setex($cookieName.$cookieKey,1800,json_encode($rdresult_array));
                        $this->response->end(json_encode(array("status" => "2000")));
                    }else{
                        $this->response->end(json_encode(array("status" => "1002", "message" => "改用没有权限！")));
                    }
                }else{
                    $this->response->end(json_encode(array("status" => "1002", "message" => "参数不完整！")));
                }
            }else{
                $this->response->end(json_encode(array("status" => "1002", "message" => "请登录！")));
            }
        }else{
            $this->response->end(json_encode(array("status" => "1002", "message" => "请登录！")));
        }
    }
}
?>