<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/8
 * Time: 14:31
 */
class wk_downloadExl extends c_web{
    function Admin($cookie,$cookieKey){
        $dataKey=$this->get["dataKey"];
        $dataJson=$this->rd->get($dataKey);
        if($dataJson) {
            $data = json_decode($dataJson, true);
            $this->response->header("Content-type","application/vnd.ms-excel");
            $this->response->header("Content-Disposition","ttachment;filename={$data['object']}");
            $sendOutString = '';
            foreach ($data['title'] as $vv) {
                $sendOutString .= $vv . "\t";
            }
            foreach ($data['data'] as $item) {
                $sendOutString .= "\n";
                foreach ($item as $vv) {
                    $sendOutString .= $vv . "\t";
                }
            }
            $this->response->end($sendOutString);
        }
    }
}
?>