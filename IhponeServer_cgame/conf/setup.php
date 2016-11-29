<?php
/**
 * 配置文件
 */
define("LIENSON_IP","0.0.0.0");
define("LIENSON_POST",4080);                                                               //访问之间通信端口
define("LIENSON_SPOST",'');                                                             //服务之间通信端口
define('WORKER_NUM',4);                                                                   //worker数量
define("TASK_WORKER_NUM",2);                                                             //Task进程数
define("LOGFILE","/root/log/tsy_PhoneServer.log");                                                //日志路劲
define("DAEMONIZE",false);                                                               //是否开启守护模式

//数据库配置
define('DB_STYLE','mysql');                                                              //数据库类型
$update_data_pool_host=array('127.0.0.1');                                               //数据库地址(主)
$read_data_pool_host=array('127.0.0.1','127.0.0.1');                                   //数据库地址（从）
define('DB_USER','root');                                                                //数据库的用户名
define('DB_PWD','123456');                                                               //数据库密码
define('DB_DATA','PhoneServer_cgame');                                                         //数据库名
define('DB_PORT','3306');                                                                //数据库端口号
define("DB_LINK_INT","2");                                                                //每一个进程

//redis配置
define("REDIS_STATIC",1);                                                                  //是否开启redis
define('REDIS_HOST',"127.0.0.1");                                                        //redis地址
define("REDIS_PORT","6379");                                                               //redis端口
define('REDIS_PASS','123456');                                                            //redis的pass
define("REDIS_DB_NO",0);                                                                   //redis默认的数据表

//session配置
define("SESSION_YX",60*30);                                                                     //session的有戏时间
define("MY_IP",'120.26.115.160');                                                             //设置自己的ip号
define("MY_NAME","a");                                                                          //监控的时自我描述
define("TOKEN_VER","wx.1905.com");                                                        //token验证地址
define('S_VI_TIME',30);                                                                       //session 有效时间，单位分
define('HOMEURL',__DIR__);
$my_friends=array();                                                                         //可以信任的服务器ip

//web
?>