<?php
/**
 * Created by PhpStorm.
 * User: liutao
 * Date: 2015/9/21
 * Time: 16:46
 */
$main=array(
    //角色配置
    'roleS'=>array('1'=>"超级管理",'2'=>'平台管理','3'=>"数据",'4'=>"运营","5"=>"客服","6"=>"渠道用户"),
    //cookie 前缀
    'cookieName'=>"CGame_HS_",
    //玩家动作选择
    "PlayerDoing"=>array(
        "0"=>"全部","40"=>"物品消耗",'41'=>"传承","51"=>"玩家属性",/*"52"=>"会员等级变化",*/"53"=>'元宝数据','54'=>'礼卷改变','55'=>'金币变化','56'=>'工会贡献','57'=>'挖宝积分',
        '58'=>'功勋改变','59'=>'等级改变', '60'=>'水晶改变',"61"=>"挖宝获得","62"=>"物品获得","63"=>"物品被叠加","64"=>"存入创库","65"=>"仓库取出","66"=>"建立行会",
        "67"=>"分解行会","68"=>"行会职位改变"
    ),
    "PlayerDoingSelect"=>array(
        "0"=>"全部","40"=>"物品消耗",'41'=>"传承","51"=>"玩家属性",/*"52"=>"会员等级变化",*/"53"=>'元宝数据','54'=>'礼卷改变','55'=>'金币变化','56'=>'工会贡献','57'=>'挖宝积分',
        '58'=>'功勋改变','59'=>'等级改变', '60'=>'水晶改变',"61"=>"挖宝获得","62"=>"物品获得","63"=>"物品被叠加","64"=>"存入创库","65"=>"仓库取出","66"=>"建立行会",
        "67"=>"分解行会","68"=>"行会职位改变"
    ),
    "PlayerDoingMessage"=>array(
        "40"=>"消耗物品-消费方式,中括号内容是消耗后，改玩家剩余装备数量;",
        "51"=>"经验增加方式-获得经验NPC",
        ""
    ),
    "ipAddressSend"=>"0",                    //是否远程监测ip地址

    "ExchangeRate"=>200,                     //人民币与元宝数换算
    "PayDB"=>"PhoneOtherServer",                          //订单库
    "payListTable"=>"PayListCGame",                      //充值订单列表

    "RunBufferFile"=>"/root/log/IhponeBuffer.json",                      //运行时产出的一些重要数据

    "vipLevel"=>array(5=>array("min"=>0,"max"=>5),6=>array("min"=>6,"max"=>30),7=>array("min"=>31,"max"=>100),8=>array("min"=>101,"max"=>300),9=>array("min"=>301,"max"=>500),
                   10=>array("min"=>501,"max"=>1000),11=>array("min"=>1001,"max"=>1200),12=>array("min"=>1201,"max"=>1500),13=>array("min"=>1501,"max"=>2000),14=>array("min"=>2001,"max"=>2500),15=>array("min"=>2501,"max"=>3000)
    ),

    //渠道id匹配
    "fromInfo"=>array(
        'yj'=>array("fromInfoId"=>11,"fromInfoName"=>"淘手游")
    ),
)
?>