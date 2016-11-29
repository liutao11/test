<?php
/**
 * Created by PhpStorm.
 * User: liutao
 * Date: 2015/9/2
 * Time: 10:40
 */
class wk_imgRequest implements interWebClass{
    private $request;
    private $response;
    private $homeUrl;
    public $url;
    public function __construct(&$request, &$response,&$homeUrl,&$url){
        $this->request=&$request;
        $this->response=&$response;
        $this->homeUrl=&$homeUrl;
        $this->url=&$url;
    }
    public function start(){
        $this->GET_FUN();
    }
    public function GET_FUN(){
        $this->response->header("Access-Control-Allow-Origin", "*");
        $this->response->header("Cache-Control","no-cache, must-revalidate");
        $this->response->header("Content-Type","image/jpeg");
        $this->response->end(file_get_contents($this->homeUrl.$this->url));
    }
    public function POST_FUN(){
        return 1;
    }
    public function smarty(){}
}

?>