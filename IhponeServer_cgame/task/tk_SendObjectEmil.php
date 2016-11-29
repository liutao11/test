<?php
/**
 * Created by PhpStorm.
 * User: lt
 * Date: 2016/6/16
 * Time: 20:05
 */
class tk_SendObjectEmil extends task{
    function exe(){
        $arg=$this->data;
        $send_account_roles=[];
        foreach($arg['serverS'] as $kk=>$vv){
            $result = $this->DBselect("gameServer", "id={$kk}", "NetUrl,TelnetPort,DBPort,TelnetPort,DBUser,DBPassword,DBGameName");
            $msdb_link = new PDO ("dblib:host={$result['NetUrl']}:{$result['DBPort']};dbname={$result['DBGameName']}", $result['DBUser'], $result['DBPassword']);
            try {
                if($arg['roleS']['userObject']==1) {             //在线发布
                    $client = new swoole_client(SWOOLE_SOCK_TCP);
                    if ($client->connect($result['NetUrl'], $result['TelnetPort'], 20)) {

                        unset($arg['serverS']);
                        $client->send("ONLINELIST \\");
                        $online_roleS_result=$client->recv();
                        $client->close();

                        if($online_roleS_result) {
                            $roleS=explode('*', substr($online_roleS_result,0,-1));
                            foreach($roleS as $role_only) {
                                $CTime = date("Y-m-d H:i:s");
                                $sItem = '';
                                foreach ($arg['PropS'] as $vv) {
                                    $sItem .= $vv['PropName'] . '*0*' . $vv['PropNum'] .'*'.$vv['PropClockValues']. ',';
                                }
                                $sItem = substr($sItem, 0, -1);

                                $sql = "insert into MIR_MAIL(sCharName,sSendName,sLable,sMemo,sItem,sDateTime) values ('{$role_only}','系统','{$arg['title']}','{$arg['textarea']}','{$sItem}','{$CTime}')";
                                $result = $msdb_link->query($sql);
                                if($result){
                                    $send_account_roles[]=$role_only;
                                }
                            }
                        }
                    } else {
                        echo $result['NetUrl'] . ':' . $result['TelnetPort'] . '链接失败!';
                    }
                }elseif($arg['roleS']['userObject']==2){                   //所有角色
                    try {
                        $msdb_result = $msdb_link->query("select sChrName from MIR_HUM_INFO");

                        $db_array = $msdb_result->fetchAll(PDO::FETCH_ASSOC);
                        $sItem = '';
                        foreach ($arg['PropS'] as $vv) {
                            $sItem .= $vv['PropName'] . '*0*' . $vv['PropNum'] .'*'.$vv['PropClockValues']. ',';
                        }
                        $sItem = substr($sItem, 0, -1);
                        $CTime = date("Y-m-d H:i:s");

                        foreach($db_array as $key=>$item){
                            if($item['sChrName']) {
                                $sql = "insert into MIR_MAIL(sCharName,sSendName,sLable,sMemo,sItem,sDateTime) values ('{$item['sChrName']}','系统','{$arg['title']}','{$arg['textarea']}','{$sItem}','{$CTime}')";
                                $result = $msdb_link->query($sql);

                                if ($result) {
                                    $send_account_roles[] = $item['sChrName'];
                                }
                            }
                        }

                    }catch (PDOException $e){
                        var_dump($e->getMessage());
                    }
                }
            }catch (ErrorException $e){
                echo $e->getMessage();
            }
        }

        return $send_account_roles;
    }
}

?>