<?php /* Smarty version 3.1.28-dev/54, created on 2016-11-28 10:55:16
         compiled from "/mnt/hgfs/linux/IhponeServer_cgame/views/Data/LevelCount.html" */ ?>
<?php
/*%%SmartyHeaderCode:609040718583b9c94db0634_95691269%%*/
$_valid = $_smarty_tpl->decodeProperties(array (
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/54',
  'unifunc' => 'content_583b9c94e729f2_69552920',
  'file_dependency' => 
  array (
    '0d43ec75f2559dcf41eca18ac5fd2e1a0a2c02d2' => 
    array (
      0 => '/mnt/hgfs/linux/IhponeServer_cgame/views/Data/LevelCount.html',
      1 => 1480301711,
      2 => 'file',
    ),
    '3ec737df16ee686e2f80964f4237a248f38b0420' => 
    array (
      0 => '/mnt/hgfs/linux/IhponeServer_cgame/views/Admin/index.html',
      1 => 1480066263,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:Admin/index.html' => 1,
  ),
  'isChild' => true,
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_583b9c94e729f2_69552920')) {
function content_583b9c94e729f2_69552920 ($_smarty_tpl) {
ob_start();
$_smarty_tpl->compiled->nocache_hash = '609040718583b9c94db0634_95691269';
?>

<?php 
$_smarty_tpl->_Block->registerBlock($_smarty_tpl, array('caching' => false, 'function' => 'block_function_bbb_1320691367583b9c94df7353_08992017', 'name' => 'bbb'));
ob_end_clean();
/*  Call merged included template "Admin/index.html" */
$_smarty_tpl->_Inline->renderInline($_smarty_tpl, 'Admin/index.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 1, false, false, 'content_583b9c94e055e5_91538547', '3ec737df16ee686e2f80964f4237a248f38b0420');
/*  End of included template "Admin/index.html" */
}
}
?><?php
/*%%SmartyHeaderCode:609040718583b9c94db0634_95691269%%*/
/* file:Admin/index.html */
if ($_valid && !is_callable('content_583b9c94e055e5_91538547')) {
function content_583b9c94e055e5_91538547 ($_smarty_tpl) {
?>
<?php
$_smarty_tpl->compiled->nocache_hash = '609040718583b9c94db0634_95691269';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理系统</title>
    <?php echo '<script'; ?>
 src="/views/js/jquery-1.7.2.min.js"><?php echo '</script'; ?>
>
    <meta http-equiv=Content-Type content="text/html;charset=utf-8">
    <style>
        *{padding: 0;margin: 0;color:#616161;font-size: 14px;}
        img{border: none}
        a{text-decoration: none}
        .list_m{display: none;background: #FFFFFF}
        .indexCenter{width: 100%;margin-top: 20px;}
        .left{float: left;width: 200px;background:#FAFAFA;box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);border: 1px solid #DEDEDE;margin-top: 10px;border-radius: 8px;margin-left: 10px;}
        .right{float: left;width: 1160px;margin-left: 40px;}
        .list_x{background: #FAFAFA;height: 40px;line-height: 40px;text-align: center;font-size: 15px;font-weight:600;border-bottom: 1px solid #cccccc; }
        .list_x:hover{background:#c8e5f6 }
        .head{background: #438EB9;height: 50px;position: relative;box-shadow: 0 4px 5px #438EB9;}

        .list_m_list{font-size: 10px;line-height: 30px;background:#FAFAFA;padding-left: 30px;width: 168px; background: url("/views/img/cc.png") repeat-y}
        .list_m_list a{font-size: 12px;}
        .tt_a{display:block;float: left}
        .title{font-size: 14px;color: #438EB9;margin: 10px 40px 0 0;height: 35px;line-height: 35px;background:#FAFAFA ;border: 1px solid #DEDEDE;border-radius: 6px;padding-left: 10px;}
        .ttright{float: right;width: 150px;position: relative}
        .user_list{position: absolute;top: 50px;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);display: none;right: 30px;}
        .user_list_list{background: #ffffff;line-height: 30px;text-align: center;font-size: 14px;width: 150px;border-radius: 0 0 4px 4px;}
        .user_list_list_div{height: 30px;line-height: 30px;border-radius: 0 0 4px 4px;}
		
        .user_list_list_div a{font-size: 12px;}

        .question_title{color:#438EB9;font-size: 16px;font-weight: 600 }
        .question_tt{color:#438EB9;font-weight: 600;font-size: 14px;margin-top: 5px;background: #F6F6F6;line-height: 30px;height: 30px; }
        .question_cention{font-size: 13px;line-height: 30px;text-indent: 2em}
        .icon{width:20px;height: 20px;background: url("/views/img/tubiao.png") -15px -15px;float: left;margin: 12px 0 0 8px;}
        .icon0{width:20px;height: 20px;background: url("/views/img/tubiao.png") -166px 0;float: left;margin: 12px 0 0 8px;}
        .icon1{width:20px;height: 20px;background: url("/views/img/tubiao.png") -208px 0;float: left;margin: 12px 0 0 8px;}
        .icon2{width:20px;height: 20px;background: url("/views/img/tubiao.png") -250px -75px;float: left;margin: 12px 0 0 8px;}
        .icon3{width:20px;height: 20px;background: url("/views/img/tubiao.png") -250px -113px;float: left;margin: 12px 0 0 8px;}
        .icon4{width:20px;height: 20px;background: url("/views/img/tubiao.png") -165px -190px;float: left;margin: 12px 0 0 8px;}
        .icon5{width:20px;height: 20px;background: url("/views/img/tubiao.png") -290px -112px;float: left;margin: 12px 0 0 8px;}
        .icon_add{width:20px;height: 20px;background: url("/views/img/tubiao.png") -206px -150px;float: left;margin-top: 5px;}
        .page{height: 30px;width: 150px;border-radius: 6px;float: left;background: #ffffff;line-height: 30px; text-align: center;margin: 10px;cursor: pointer}
		.page_left{height: 30px;line-height: 30px;float: left;width: 120px;text-align: center}
        .page_select{width: 150px;position: absolute;top: 42px;left: 191px;z-index: 100;background: #ffffff;border: 1px solid #aaaaaa;border-radius:0 0 3px 3px;border-top:none;box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);display: none}
        .page_select_list{line-height: 30px;height: 30px;padding-left:10px; cursor:pointer;font-size: 12px;}
        .page_select_list:hover{color:#438EB9;background:#c8e5f6}
        .page_select_list_x{line-height: 30px;height: 30px;padding-left:10px; }
        .title_index_center{background:#FAFAFA ;border: 1px solid #DEDEDE;border-radius: 8px;margin-top: 40px;margin-right: 40px;padding: 80px 60px;}
        .title_index_center p{font-size: 18px;  font-weight: 200;  line-height: 27px;  color: inherit;}
        .title_index_yh{font-size: 60px;line-height: 1.6em;font-weight: bold}
        .list_m_title{height: 30px;line-height: 30px;color:#8d8c8c;cursor: pointer}
		.list_m_title:hover{background:#dbf8dc}
        .list_m_select{clear: both;display: none}
        .list_icon{height:15px;width: 15px;background: url("/views/img/iconC.png") -168px 0;float: left;margin:7px 10px 0 5px;}
        .list_icon1{height:15px;width: 15px;background: url("/views/img/iconC.png") -457px -143px no-repeat;float: left;margin:7px 10px 0 5px;}
        .list_icon2{height:15px;width: 15px;background: url("/views/img/iconC.png") -219px -119px;float: left;margin:7px 10px 0 5px;}
        .list_icon3{height:15px;width: 15px;background: url("/views/img/iconC.png") -313px -23px;float: left;margin:7px 10px 0 5px;}
        .list_icon4{height:15px;width: 15px;background: url("/views/img/iconC.png") -361px -119px;float: left;margin:7px 10px 0 5px;}
        .list_icon5{height:15px;width: 15px;background: url("/views/img/iconC.png") -241px 0;float: left;margin:7px 10px 0 5px;}
        .list_icon6{height:15px;width: 15px;background: url("/views/img/iconC.png") -24px -144px;float: left;margin:7px 10px 0 5px;}
        .list_icon7{height:15px;width: 15px;background: url("/views/img/iconC.png") -73px -144px;float: left;margin:7px 10px 0 5px;}
        .list_icon8{height:15px;width: 15px;background: url("/views/img/iconC.png") -360px -23px;float: left;margin:7px 10px 0 5px;}
        .list_icon9{height:15px;width: 15px;background: url("/views/img/iconC.png") -217px -95px;float: left;margin:7px 10px 0 5px;}
        .list_icon10{height:15px;width: 15px;background: url("/views/img/iconC.png") -22px -122px;float: left;margin:7px 10px 0 5px;}
        .key_icon{height:15px;width: 15px;background: url("/views/img/iconC.png") -48px -120px;float: left;margin:7px 10px 0 5px;}
        .exit_icon{height:15px;width: 15px;background: url("/views/img/iconC.png") -217px -95px;float: left;margin:7px 10px 0 5px;}
        a:hover{color:#438EB9;font-weight: 600}
        .list_x_tt{float: left;text-align: center;width: 140px;font-size: 15px;cursor: pointer}
        .foot{height: 75px;clear: both;width: 100%;padding-top: 20px;}
        .foot_center{box-shadow: 4px 0 5px rgba(0, 0, 0, 0.15);height: 75px;padding: 10px 0 0 50px;font-size: 12px; color:rgba(0, 0, 0, 0.15)}
        .tt_right{float: right;margin-top: 10px;width: 220px;border-radius: 6px;background: #ffffff;height: 30px;margin-right: 30px;cursor: pointer}
        .ren_icon{height:15px;width: 15px;background: url("/views/img/iconC.png") -168px 0;float: left;margin:7px 10px 0 5px;}
        .tt_right_tt{float: left;font-size: 12px;line-height: 30px;}
        .select_icon{float: right;width: 20px;height: 30px;border-radius: 0 6px 6px 0;background: url("/views/img/select2.png") no-repeat #DEDEDE;}
        select,input{border: 1px solid #cccccc}
    </style>
</head>
<body>
    <div class="head">
        <a href="#" class="tt_a"><img src="/views/img/Admin_logo.png"></a>
        <div class="page"><div class="page_left"><?php echo $_smarty_tpl->tpl_vars['objectName']->value;?>
</div><div class="select_icon"></div></div>
        <div class="page_select">
            <div values="0" class="page_select_list">高级管理</div>
            <div values="0" class="page_select_list_x">选择平台</div>
            <?php
$_from = $_smarty_tpl->tpl_vars['objectS']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_vv_0_saved_item = isset($_smarty_tpl->tpl_vars['vv']) ? $_smarty_tpl->tpl_vars['vv'] : false;
$__foreach_vv_0_saved_key = isset($_smarty_tpl->tpl_vars['kk']) ? $_smarty_tpl->tpl_vars['kk'] : false;
$_smarty_tpl->tpl_vars['vv'] = new Smarty_Variable();
$__foreach_vv_0_total = $_smarty_tpl->_count($_from);
if ($__foreach_vv_0_total) {
$_smarty_tpl->tpl_vars['kk'] = new Smarty_Variable();
foreach ($_from as $_smarty_tpl->tpl_vars['kk']->value => $_smarty_tpl->tpl_vars['vv']->value) {
$__foreach_vv_0_saved_local_item = $_smarty_tpl->tpl_vars['vv'];
?>
            <div values="<?php echo $_smarty_tpl->tpl_vars['vv']->value['id'];?>
"  class="page_select_list" style="margin-left: 10px;"><?php echo $_smarty_tpl->tpl_vars['vv']->value['title'];?>
</div>
            <?php
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_0_saved_local_item;
}
}
if ($__foreach_vv_0_saved_item) {
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_0_saved_item;
}
if ($__foreach_vv_0_saved_key) {
$_smarty_tpl->tpl_vars['kk'] = $__foreach_vv_0_saved_key;
}
?>
        </div>
        <div class="ttright">
            <div class="tt_right">
                <div class="ren_icon"></div>
                <div class="tt_right_tt"><?php echo $_smarty_tpl->tpl_vars['userName']->value;?>
,欢迎</div>
                <div class="select_icon"></div>
            </div>
            <div class="user_list">
                <div class="user_list_list">
                    <div  class="user_list_list_div"><div class="key_icon"></div><a href="/changePassword/">修改密码</a></div>
                    <div  class="user_list_list_div"><div class="exit_icon"></div><a href="/exit/">退出</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="indexCenter">
        <div class="left">
            <?php if ($_smarty_tpl->tpl_vars['pageType']->value == 1) {?>
                <div class="list_x" style="border-radius: 8px 8px 0 0;">
                    <div class="icon0"></div>
                    <div class="list_x_tt">首 页</div>
                </div>
                <div class="list_m"  <?php if ($_smarty_tpl->tpl_vars['xx']->value == 'a1') {?>style="display: block "<?php }?>>
                    <div class="list_m_title"><div class='list_icon1'></div>首页</div>
                    <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a1') {?>style="display: block "<?php }?>>
                        <div class="list_m_list" ><a href="/index/?xx=a1&zz=a1&yy=1" >首页</a></div>
                    </div>
                    <div class="list_m_title"><div class='list_icon'></div>全平台运营报表</div>
                    <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a2') {?>style="display: block "<?php }?>>
                       <div class="list_m_list" ><a href="/OAllCreateReport/?xx=a1&zz=a2&yy=2" >全平台创建率</a></div>
                       <div class="list_m_list" ><a href="/OAllOnlineReport/?xx=a1&zz=a2&yy=2" >全平台在线</a></div>
                       <div class="list_m_list" ><a href="/OAllPayReport/?xx=a1&zz=a2&yy=2" >全平台充值</a></div>
					</div>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['groundId']->value == 1) {?>
                    <div class="list_x">
                        <div class="icon4"></div>
                        <div class="list_x_tt">系 统</div>
                    </div>
                    <div class="list_m" <?php if ($_smarty_tpl->tpl_vars['xx']->value == 'a2') {?>style="display: block "<?php }?>>
                        <div class="list_m_title"><div class='list_icon9'></div>用户</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a3') {?>style="display: block "<?php }?>>
                            <div class="list_m_list" ><a href="/UserSet/?xx=a2&zz=a3&yy=2" >用户管理</a></div>
                            <div class="list_m_list"><a href="/DoingLogShow/?xx=a2&zz=a3&yy=4">操作日志</a></div>
                        </div>
                    </div>
                    <div class="list_x">
                        <div class="icon1"></div>
                        <div class="list_x_tt">运 维</div>
                    </div>
                    <div class="list_m" <?php if ($_smarty_tpl->tpl_vars['xx']->value == 'a3') {?>style="display: block "<?php }?>>
                        <div class="list_m_title"><div class='list_icon'></div>项目管理</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a4') {?>style="display: block "<?php }?>>
                            <div class="list_m_list" ><a href="/ObjectSet/?xx=a3&zz=a4&yy=1" >平台管理</a></div>
                            <div class="list_m_list" ><a href="/ObjectNoticeSet/?xx=a3&zz=a4&yy=2" >平台公告</a></div>
                            <div class="list_m_list" ><a href="/OShowGameServerSet/?xx=a3&zz=a4&yy=2" >展示区服设置</a></div>
                        </div>
                        <div class="list_m_title"><div class='list_icon1'></div>服区管理</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a5') {?>style="display: block "<?php }?>>
                            <div class="list_m_list"><a href="/GameServer/?xx=a3&zz=a5&yy=5" >服区</a></div>
                            <div class="list_m_list"><a href="/MergeGameServer/?xx=a3&zz=a5&yy=6" >合并服区</a></div>
                            <div class="list_m_list"><a href="/ResourceServer/?xx=a3&zz=a5&yy=3">资源服务管理</a></div>
                        </div>
                    </div>
                    <div class="list_x">
                        <div class="icon5"></div>
                        <div class="list_x_tt">运 营</div>
                    </div>
                    <div class="list_m" <?php if ($_smarty_tpl->tpl_vars['xx']->value == 'a4') {?>style="display: block "<?php }?>>
                        <div class="list_m_title"><div class='list_icon3'></div>元宝申请审核</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a6') {?>style="display: block "<?php }?>>
                            <div class="list_m_list" ><a href="/AcreInspect/?xx=a4&zz=a6&yy=1" >元宝申请审核</a></div>
                        </div>
                    </div>
                <?php }?>
            <?php } else { ?>
                <?php if ($_smarty_tpl->tpl_vars['groundId']->value == 1 || $_smarty_tpl->tpl_vars['groundId']->value == 2 || $_smarty_tpl->tpl_vars['groundId']->value == 3 || $_smarty_tpl->tpl_vars['groundId']->value == 4 || $_smarty_tpl->tpl_vars['groundId']->value == 5) {?>
                    <div class="list_x" style="border-radius: 8px 8px 0 0;">
                        <div class="icon0"></div>
                        <div class="list_x_tt">首 页</div>
                    </div>
                    <div class="list_m"  <?php if ($_smarty_tpl->tpl_vars['xx']->value == 'b1') {?>style="display: block "<?php }?>>
                        <div class="list_m_title"><div class='list_icon'></div>首页</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a7') {?>style="display: block "<?php }?>>
                           <div class="list_m_list" ><a href="/indexPage/?xx=b1&zz=a7&yy=0" >平台首页</a></div>
                        </div>
                    </div>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['groundId']->value == 1 || $_smarty_tpl->tpl_vars['groundId']->value == 2 || $_smarty_tpl->tpl_vars['groundId']->value == 3) {?>
                    <div class="list_x">
                        <div class="icon1"></div>
                        <div class="list_x_tt">数 据</div>
                    </div>
                    <div class="list_m" <?php if ($_smarty_tpl->tpl_vars['xx']->value == 'b2') {?>style="display: block "<?php }?>>
                        <div class="list_m_title"><div class='list_icon1'></div>创建率数据</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a8') {?>style="display: block "<?php }?>>
                            <div class="list_m_list" ><a href="/DayReport/?xx=b2&zz=a8&yy=1" >创建率分日报表</a></div>
                            <div class="list_m_list" ><a href="/HoursReport/?xx=b2&zz=a8&yy=2">创建率分时报表</a></div>
                            <div class="list_m_list" ><a href="/DfromReport/?xx=b2&zz=a8&yy=2">渠道统计</a></div>
                            <div class="list_m_list" ><a href="/DGoldReport/?xx=b2&zz=a8&yy=2">金币统计</a></div>
                            <div class="list_m_list" ><a href="/DUserInfoReport/?xx=b2&zz=a8&yy=2">玩家数据统计</a></div>
                            <div class="list_m_list" ><a href="/DUserDistribu/?xx=b2&zz=a8&yy=2">玩家信息排序</a></div>
                        </div>
                        <div class="list_m_title"><div class='list_icon2'></div>在线数据</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a9') {?>style="display: block "<?php }?>>
                           <div class="list_m_list" ><a href="/RealTime/?xx=b2&zz=a9&yy=3">实时监控</a></div>
                           <div class="list_m_list" ><a href="/OnlineImg/?xx=b2&zz=a9&yy=4">在线数据图表</a></div>
                           <div class="list_m_list" ><a href="/UserGoldRanking/?xx=b2&zz=a9&yy=4">用户持有元宝排名</a></div>
                        </div>
                        <div class="list_m_title"><div class='list_icon3'></div>活跃数据</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a10') {?>style="display: block "<?php }?>>
                            <div class="list_m_list" ><a href="/LevelCount/?xx=b2&zz=a10&yy=5">等级流失统计</a></div>
                            <div class="list_m_list" ><a href="/ActiveUsers/?xx=b2&zz=a10&yy=6" >登录活跃统计</a></div>
                            <div class="list_m_list" ><a href="/UserRetention/?xx=b2&zz=a10&yy=6">留存率</a></div>
                            <div class="list_m_list" ><a href="/DTaskGroup/?xx=b2&zz=a10&yy=6" >任务等级分布</a></div>
                            <div class="list_m_list" ><a href="/DNewPayActive/?xx=b2&zz=a10&yy=6" >新充值用户充值活跃度</a></div>
                            <div class="list_m_list" ><a href="/DVIPUserActive/?xx=b2&zz=a10&yy=6" >VIP用户活跃度</a></div>
                        </div>
                        <div class="list_m_title"><div class='list_icon4'></div>充值数据</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a11') {?>style="display: block "<?php }?>>
                            <div class="list_m_list" ><a href="/PayList/?xx=b2&zz=a11&yy=7">订单列表</a></div>
                            <div class="list_m_list" ><a href="/PayNumberReport/?xx=b2&zz=a11&yy=8">用户充值次数报表</a></div>
                            <div class="list_m_list" ><a href="/PayDayReport/?xx=b2&zz=a11&yy=8">充值分日报表</a></div>
                            <div class="list_m_list" ><a href="/PayHoursReport/?xx=b2&zz=a11&yy=9" >充值分时报表</a></div>
                            <div class="list_m_list" ><a href="/PaySumAnalyse/?xx=b2&zz=a11&yy=10" >总计额度分析</a></div>
                            <div class="list_m_list" ><a href="/TimesPayAnalyse/?xx=b2&zz=a11&yy=11">单笔额度分析</a></div>
                            <div class="list_m_list" ><a href="/FirstPayAnalyse/?xx=b2&zz=a11&yy=12">首笔额度分析</a></div>
                            <div class="list_m_list" ><a href="/FirstPayLevel/?xx=b2&zz=a11&yy=12" >首笔等级分析</a></div>
                            <div class="list_m_list" ><a href="/PayRanking/?xx=b2&zz=a11&yy=13">玩家充值排行</a></div>
                            <div class="list_m_list" ><a href="/ConsumeRanking/?xx=b2&zz=a11&yy=13" >玩家消费元宝排行</a></div>
                            <div class="list_m_list" ><a href="/ConsumeAnalysis/?xx=b2&zz=a11&yy=13" >玩家日志分析</a></div>
                            <div class="list_m_list" ><a href="/DUserPayTable/?xx=b2&zz=a11&yy=13" >新用户月充值表</a></div>
                        </div>
                        <div class="list_m_title"><div class='list_icon5'></div>全服区报表</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a12') {?>style="display: block "<?php }?>>
                            <div class="list_m_list" ><a href="/AllServerReport/?xx=b2&zz=a12&yy=14" >全服报表</a></div>
                            <div class="list_m_list" ><a href="/AllPayReport/?xx=b2&zz=a12&yy=16" >全服运营充值表</a></div>
                            <div class="list_m_list" ><a href="/AllNewReport/?xx=b2&zz=a12&yy=14">全服运营创建报表</a></div>
                            <div class="list_m_list" ><a href="/AllOnlineReport/?xx=b2&zz=a12&yy=15" >全服运营在线人数表</a></div>
                            <div class="list_m_list" ><a href="/AllUserLeave/?xx=b2&zz=a12&yy=16" >全服运营留存表</a></div>
                            <div class="list_m_list" ><a href="/AllUserGoldRanking/?xx=b2&zz=a12&yy=16" >全服用户持有元宝排名</a></div>
                            <div class="list_m_list" ><a href="/AllUserRepeat/?xx=b2&zz=a12&yy=16" >全服用户去重(慎用)</a></div>
                        </div>
                    </div>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['groundId']->value == 1 || $_smarty_tpl->tpl_vars['groundId']->value == 2 || $_smarty_tpl->tpl_vars['groundId']->value == 4) {?>
                    <div class="list_x">
                        <div class="icon2"></div>
                        <div class="list_x_tt">运 维</div>
                    </div>
                    <div class="list_m" <?php if ($_smarty_tpl->tpl_vars['xx']->value == 'b4') {?>style="display: block "<?php }?>>
                        <div class="list_m_title"><div class='list_icon6'></div>公告</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a13') {?>style="display: block "<?php }?>>
	                        <div class="list_m_list" ><a href="/NoticeList/?xx=b4&zz=a13&yy=1" >公告列表</a></div>
	                        <div class="list_m_list" ><a href="/NoticeAdd/?xx=b4&zz=a13&yy=2" >发布公告</a></div>
                        </div>
                        <div class="list_m_title"><div class='list_icon7'></div>元宝申请</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a14') {?>style="display: block "<?php }?>>
                            <div class="list_m_list" ><a href="/AcerApplyList/?xx=b4&zz=a14&yy=3" >元宝申请记录</a></div>
                            <div class="list_m_list" ><a href="/AcerApply/?xx=b4&zz=a14&yy=4">申请元宝</a></div>
                            <div class="list_m_list" ><a href="/OVirtualPayList/?xx=b4&zz=a14&yy=5" >虚假充值生成</a></div>
                            <div class="list_m_list" ><a href="/OVirtualPayLog/?xx=b4&zz=a14&yy=6" >虚假充值记录</a></div>
                        </div>
                        <div class="list_m_title"><div class='list_icon10'></div>道具补发邮件</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a15') {?>style="display: block "<?php }?>>
                            <div class="list_m_list" ><a href="/SendPropList/?xx=b4&zz=a15&yy=3" >道具列表上传</a></div>
                            <div class="list_m_list" ><a href="/SendPropEmil/?xx=b4&zz=a15&yy=3" >发送道具邮件</a></div>
                            <div class="list_m_list" ><a href="/SendObjectPropEmil/?xx=b4&zz=a15&yy=3" >范围道具邮件发送</a></div>
                           <!-- <div class="list_m_list" ><a href="/OSendPropNumberEmil/?xx=b4&zz=a15&yy=3" >道具多数量邮件</a></div>-->
                            <div class="list_m_list" ><a href="/OPropEmilList/?xx=b4&zz=a15&yy=3" >道具邮件列表</a></div>
                        </div>
                    </div>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['groundId']->value == 1 || $_smarty_tpl->tpl_vars['groundId']->value == 2 || $_smarty_tpl->tpl_vars['groundId']->value == 5) {?>
                    <div class="list_x">
                        <div class="icon3"></div>
                        <div class="list_x_tt">客 服</div>
                    </div>
                    <div class="list_m" <?php if ($_smarty_tpl->tpl_vars['xx']->value == 'b5') {?>style="display: block "<?php }?>>
                        <div class="list_m_title"><div class='list_icon'></div>玩家数据</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a16') {?>style="display: block "<?php }?>>
                            <div class="list_m_list" ><a href="/UserRoleList/?xx=b5&zz=a16&yy=1" >角色列表</a></div>
                            <div class="list_m_list" ><a href="/UserAllRoleList/?xx=b5&zz=a16&yy=1" >全服角色列表</a></div>
                            <div class="list_m_list" ><a href="/UserDoingLog/?xx=b5&zz=a16&yy=2">动作记录</a></div>
                            <div class="list_m_list" ><a href="/UserLoginLog/?xx=b5&zz=a16&yy=3">登录记录</a></div>
                        </div>
                        <div class="list_m_title"><div class='list_icon10'></div>玩家查询</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a19') {?>style="display: block "<?php }?>>
                             <div class="list_m_list" ><a href="/ServiceSelectUserInfo/?xx=b5&zz=a19&yy=1">玩家信息查询</a></div>
                             <div class="list_m_list" ><a href="/SUerPaySelect/?xx=b5&zz=a19&yy=2">玩家充值查询</a></div>
                             <div class="list_m_list" ><a href="/SUerDoingSelect/?xx=b5&zz=a19&yy=2">玩家日志查询查询</a></div>
                             <div class="list_m_list" ><a href="/SUerPropSelect/?xx=b5&zz=a19&yy=2">玩家穿戴、仓库、背包查询</a></div>
                        </div>
                        <div class="list_m_title"><div class='list_icon10'></div>对玩家控制</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a20') {?>style="display: block "<?php }?>>
                            <div class="list_m_list" ><a href="/SUserOffline/?xx=b5&zz=a20&yy=1">踢人、禁言、封号</a></div>
                            <div class="list_m_list" ><a href="/SUserControlLog/?xx=b5&zz=a20&yy=2">玩家控制日志</a></div>
                            <div class="list_m_list" ><a href="/SlimitConnection/?xx=b5&zz=a20&yy=3">ip控制操作</a></div>
                            <div class="list_m_list" ><a href="/SlimitConnectionLog/?xx=b5&zz=a20&yy=4">ip控制操作日志</a></div>
                        </div>
                    </div>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['groundId']->value == 6) {?>
                <div class="list_x">
                    <div class="icon2"></div>
                    <div class="list_x_tt">财务</div>
                </div>
                <div class="list_m" <?php if ($_smarty_tpl->tpl_vars['xx']->value == 'd1') {?>style="display: block "<?php }?>>
                    <div class="list_m_title"><div class='list_icon3'></div>全服统计</div>
                    <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'd1') {?>style="display: block "<?php }?>>
                        <div class="list_m_list" ><a href="/FAllServerPay/?xx=d1&zz=d1&yy=1" >全服运营充值表</a></div>
                        <div class="list_m_list" ><a href="/FAllServerPayList/?xx=d1&zz=d1&yy=1" >充值列表</a></div>
                    </div>
                </div>
                <?php }?>



            <?php }?>
        </div>
        <div class="right">
            <?php 
$_smarty_tpl->_Block->callBlock($_smarty_tpl, array('caching' => false, 'function' => 'block_function_bbb_1528694102583b9c94e57508_38278429', 'name' => 'bbb'));
?>

        </div>
    </div>
    <div class="foot">
        <div class="foot_center">
            © 2016  版权所有    IE 及其外壳浏览器请使用 IE9 或以上版本的内核
        </div>
    </div>
<?php echo '<script'; ?>
>
    $(function (){
        var window_x=$(window).width();
        var window_y=$(window).height();

        if(window_x>=1900) {
            $(".right").css({
                "width": (window_x - 280) + "px"
            });
        }else{
            $(".indexCenter").css({"width": "1920px"});
            $(".right").css({"width": "1640px"});
        }
        if((window_y-35)<800){
            $(".left").css({"height": "850px"});
        }else {
            $(".left").css({"height": (window_y - 35) + "px"});
        }

        list_x_index=-1;
        $(".list_x").each(function (index){
            $(this).click(function(){
                if(index ==list_x_index){
                    $(".list_m").hide();
                    list_x_index=-1;
                    $(".list_x").css({"color": "#616161", "borderTop": "none"});
                }else {
                    $(".list_x").css({"color": "#616161", "borderTop": "none"});
                    $(".list_x:eq(" + index + ")").css({"color": "#438EB9"});
                    $(".list_m").hide();
                    $(".list_m:eq(" + index + ")").show();
                    list_x_index=index;
                }
            })
        });
        tt_rightState=1;
        $(".tt_right").click(function(){
            if(tt_rightState==1) {
                $(".user_list").show();
                tt_rightState=2;
            }else{
                $(".user_list").hide();
                tt_rightState=1;
            }
        });
        pageState=1;
        $(".page").click(function(){
            if(pageState==1) {
                $(".page_select").show();
                pageState=2;
            }else{
                $(".page_select").hide();
                pageState=1;
            }
        });
        $(".page_select_list").each(function(index){
            $(this).click(function(){
                var values=$(this).attr('values');
                $.get('/PageGet/',{"values":values,'doingunid':new Date().getTime()},function(data){
                    var obj = jQuery.parseJSON(data);
                    if(obj.status!=2000){
                        alert(obj.message)
                    }else{
                        location.href="/index/?xx=0&yy=0&zz=0";
                    }
                })
            })
		});
		 var selectShowInt=-1;
        $(".list_m_title").each(function(index){
            $(this).click(function(){
                if(selectShowInt==index) {
                    $(".list_m_select").eq(index).hide();
                    selectShowInt=-1;
                }else{
                    $(".list_m_select").hide();
                    $(".list_m_select").eq(index).show();
                    selectShowInt=index;
                }
            })
        })
    })
<?php echo '</script'; ?>
>
</body>
</html><?php
/*/%%SmartyNocache:609040718583b9c94db0634_95691269%%*/
}
}
?><?php
/* block_function_bbb_1320691367583b9c94df7353_08992017  file:Data/LevelCount.html */
if (!function_exists('block_function_bbb_1320691367583b9c94df7353_08992017')) {
function block_function_bbb_1320691367583b9c94df7353_08992017($_smarty_tpl, $block) {?>
<?php echo '<script'; ?>
 src="/views/dataTimeStyle/jquery.datetimepicker.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="/views/dataTimeStyle/jquery.datetimepicker.css" type="text/css" />
<style>
    .page_title{font-size: 14px;color: #438EB9;margin: 10px 0 0 0;height: 35px;line-height: 35px;background:#FAFAFA ;border: 1px solid #DEDEDE;border-radius: 6px;padding-left: 10px;}
    .page_title span{font-size: 18px;color: #438EB9;padding-left: 10px;height: 40px;line-height: 40px;font-weight: bold}
    #container_cen{height: 380px;}
    .selectDiv{height: 50px;}
    .selectDiv span{display: block;float: left;line-height: 50px;height: 50px;margin-left: 10px;}
    .selectDiv select{display: block;float: left;margin-top: 10px;height: 30px;width: 150px;line-height: 30px;margin-left: 10px;}
    .selectDiv input{display: block;float: left;height: 28px;width: 150px;margin: 10px 0 0 10px;}
    .selectDiv_submit{float: left;height: 28px;margin-top: 10px;margin-left: 20px;background:#438EB9;color: #ffffff;line-height: 30px;text-align: center;width: 100px;font-size: 12px;cursor: pointer}
    .payList span{color:#438EB9}
    .ReportData{box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);border: 1px solid #DEDEDE;border-radius: 5px;padding-left: 10px;padding-right:10px; }
    .ReportDataTitle{height: 40px;}
    .ReportDataTitle_list{float: left;line-height: 40px;height: 40px;width: 150px;text-align: center;font-size: 14px;font-weight: 600}
    .ReportDataTitle_list span{width: 20px;height: 20px;}
    .ReportDataCenter{background:#F5F5F5;border-bottom:1px solid #DEDEDE;height: 30px;}
    .ReportDataCenter_list{float: left;line-height: 30px;height: 30px;width: 150px;text-align: center;font-size: 12px;}
    .selectDataShow{height: 30px;width: 160px;float: left;margin: 8px 0 0 35px;}
    .selectDataShow_div{float: left;width: 80px;height: 30px;text-align: center;line-height: 30px;background:#F8F8F8;cursor:pointer;box-shadow: inset 0 2px 4px rgba(0,0,0,.15), 0 1px 2px rgba(0,0,0,.05);}
    .downloadExl{float: left;line-height: 30px;height: 30px;margin-top: 10px;font-size: 12px;width: 100px;text-align: center;cursor: pointer}
    .downloadExl:hover{color:#438EB9}
    .button_m{border-radius: 4px;background:#438EB9;color: #ffffff;font-size: 12px;text-align: center;width: 80px;height: 24px;line-height: 24px;margin: 3px auto 0 auto;cursor: pointer}
    .ReportDataTitle_list_show{position: absolute;width: 150px;height: 200px;background:#438EB9;left: 1030px;top: 30px;line-height: 30px;color: #cccccc;z-index: 10;display: none;box-shadow: 0 4px 5px #438EB9;border-radius: 2px;overflow-y:scroll; }
    .ReportDataTitle_list_show_str{color: #ffffff;cursor: pointer}
    .ReportDataTitle_list_show2{position: absolute;top:30px;left: 1200px;width: 400px;background: #F5F5F5;line-height: 30px;height: 90px;border-radius: 4px;display: none;box-shadow: 0 4px 5px #cccccc;border: 1px solid #cccccc}
    .ReportDataTitle_list_show2 span{color:#438EB9 }
    .button_s{font-size: 12px;}
</style>
<?php echo '<script'; ?>
 src="/views/echarts/echarts.min.js"><?php echo '</script'; ?>
>
<div class="page_title"><span><?php echo $_smarty_tpl->tpl_vars['objectName']->value;?>
</span> 平台->运营数据->等级流失率</div>
<div style="padding-top: 10px;">
    <div class="selectDiv">
        <span>服区*</span>
        <select class="serverIndex">
            <option value="0" <?php if ($_smarty_tpl->tpl_vars['serverIndex']->value == 0) {?>selected<?php }?>>--选择区服--</option>
            <?php
$_from = $_smarty_tpl->tpl_vars['serverS']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_vv_0_saved_item = isset($_smarty_tpl->tpl_vars['vv']) ? $_smarty_tpl->tpl_vars['vv'] : false;
$_smarty_tpl->tpl_vars['vv'] = new Smarty_Variable();
$__foreach_vv_0_total = $_smarty_tpl->_count($_from);
if ($__foreach_vv_0_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['vv']->value) {
$__foreach_vv_0_saved_local_item = $_smarty_tpl->tpl_vars['vv'];
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['vv']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['serverIndex']->value == $_smarty_tpl->tpl_vars['vv']->value['id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['vv']->value['ServerTitle'];?>
</option>
            <?php
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_0_saved_local_item;
}
}
if ($__foreach_vv_0_saved_item) {
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_0_saved_item;
}
?>
        </select>
        <span>日期*</span>
        <input type="text" class="startDay" value="<?php echo $_smarty_tpl->tpl_vars['startDay']->value;?>
">
        <span>日期*</span>
        <input type="text" class="endDay" value="<?php echo $_smarty_tpl->tpl_vars['endDay']->value;?>
">
        <div class="selectDiv_submit">提交</div>
    </div>

    <div class="ReportData">
        <table class="ReportData_list">
            <tr class="ReportDataTitle">
                <td class="ReportDataTitle_list">等级数</td>
                <td class="ReportDataTitle_list">服区</td>
                <td class="ReportDataTitle_list">本等级人数 <span>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td class="ReportDataTitle_list">人数所占率</td>
                <td class="ReportDataTitle_list">本级流失数 <span>&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td class="ReportDataTitle_list">本级流失率</td>
                <td class="ReportDataTitle_list">详细</td>
                <td class="ReportDataTitle_list">列表展现</td>
            </tr>
            <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
            <?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_vv_1_saved_item = isset($_smarty_tpl->tpl_vars['vv']) ? $_smarty_tpl->tpl_vars['vv'] : false;
$__foreach_vv_1_saved_key = isset($_smarty_tpl->tpl_vars['kk']) ? $_smarty_tpl->tpl_vars['kk'] : false;
$_smarty_tpl->tpl_vars['vv'] = new Smarty_Variable();
$__foreach_vv_1_total = $_smarty_tpl->_count($_from);
if ($__foreach_vv_1_total) {
$_smarty_tpl->tpl_vars['kk'] = new Smarty_Variable();
foreach ($_from as $_smarty_tpl->tpl_vars['kk']->value => $_smarty_tpl->tpl_vars['vv']->value) {
$__foreach_vv_1_saved_local_item = $_smarty_tpl->tpl_vars['vv'];
?>
            <tr class="ReportDataCenter" style="position: relative;display: block">
                <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['levelNum'];?>
</td>
                <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['serverUnid']->value;?>
</td>
                <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['levelSum'];?>
</td>
                <td class="ReportDataCenter_list"><?php echo sprintf("%.4f",$_smarty_tpl->tpl_vars['vv']->value['levelSum']/$_smarty_tpl->tpl_vars['sum']->value)*100;?>
%</td>
                <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['LostLevelSum'];?>
</td>
                <td class="ReportDataCenter_list"><?php echo sprintf("%.4f",$_smarty_tpl->tpl_vars['vv']->value['LostLevelSum']/$_smarty_tpl->tpl_vars['vv']->value['levelSum'])*100;?>
%</td>
                <td class="ReportDataCenter_list"><div class="button_m">详细</div></td>
                <td class="ReportDataCenter_list"><a class="button_s" href="/LevelCountShowList/?serverIndex=<?php echo $_smarty_tpl->tpl_vars['serverIndex']->value;?>
&levelNum=<?php echo $_smarty_tpl->tpl_vars['vv']->value['levelNum'];?>
&startDay=<?php echo $_smarty_tpl->tpl_vars['startDay']->value;?>
&endDay=<?php echo $_smarty_tpl->tpl_vars['endDay']->value;?>
" target="_blank">列表展现</a></td>
                <td class="ReportDataTitle_list_show">
                    <?php
$_from = $_smarty_tpl->tpl_vars['vv']->value['roleArray'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_value_2_saved_item = isset($_smarty_tpl->tpl_vars['value']) ? $_smarty_tpl->tpl_vars['value'] : false;
$__foreach_value_2_saved_key = isset($_smarty_tpl->tpl_vars['key']) ? $_smarty_tpl->tpl_vars['key'] : false;
$_smarty_tpl->tpl_vars['value'] = new Smarty_Variable();
$__foreach_value_2_total = $_smarty_tpl->_count($_from);
if ($__foreach_value_2_total) {
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable();
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$__foreach_value_2_saved_local_item = $_smarty_tpl->tpl_vars['value'];
?>
                    <span class="ReportDataTitle_list_show_str" valueIndex="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" listIndex="<?php echo $_smarty_tpl->tpl_vars['kk']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</span>,
                    <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_2_saved_local_item;
}
}
if ($__foreach_value_2_saved_item) {
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_2_saved_item;
}
if ($__foreach_value_2_saved_key) {
$_smarty_tpl->tpl_vars['key'] = $__foreach_value_2_saved_key;
}
?>
                </td>
                <td class="ReportDataTitle_list_show2">
                    查询中...
                </td>
            </tr>
            <?php
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_1_saved_local_item;
}
}
if ($__foreach_vv_1_saved_item) {
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_1_saved_item;
}
if ($__foreach_vv_1_saved_key) {
$_smarty_tpl->tpl_vars['kk'] = $__foreach_vv_1_saved_key;
}
?>
            <?php } else { ?>
            <div class="ReportDataCenter">没有数据！</div>
            <?php }?>

            <tr class="ReportDataTitle">
                <td class="ReportDataTitle_list" style="width: 300px">汇总</td>
                <td class="ReportDataTitle_list"><?php echo $_smarty_tpl->tpl_vars['sum']->value;?>
</td>
                <td class="ReportDataTitle_list"></td>
                <td class="ReportDataTitle_list"><?php echo $_smarty_tpl->tpl_vars['lostSum']->value;?>
</td>
                <td class="ReportDataTitle_list"><?php if ($_smarty_tpl->tpl_vars['sum']->value) {
echo sprintf("%.4f",$_smarty_tpl->tpl_vars['lostSum']->value/$_smarty_tpl->tpl_vars['sum']->value)*100;
}?></td>
            </tr>
        </table>
        <div class="ReportData_list" style="">
            <div id="container_cen">

            </div>
        </div>
    </div>
</div>
<?php echo '<script'; ?>
>
    Type='<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
';
    TypeValue='<?php echo $_smarty_tpl->tpl_vars['typeValue']->value;?>
';
    $(function() {
        var className="<?php echo $_smarty_tpl->tpl_vars['className']->value;?>
";
        $('.startDay').datetimepicker({
            lang: "ch",           //语言选择中文
            format: "Y-m-d",      //格式化日期
            timepicker: false,    //关闭时间选项
            yearStart: 2000,     //设置最小年份
            yearEnd: 2050,        //设置最大年份
            todayButton: false    //关闭选择今天按钮
        });
        $('.endDay').datetimepicker({
            lang: "ch",           //语言选择中文
            format: "Y-m-d",      //格式化日期
            timepicker: false,    //关闭时间选项
            yearStart: 2000,     //设置最小年份
            yearEnd: 2050,        //设置最大年份
            todayButton: false    //关闭选择今天按钮
        });
        $(".selectDiv_submit").click(function () {
            var serverIndex = $(".serverIndex").val();
            var startDay=$(".startDay").val();
            var endDay=$(".endDay").val();
            if (serverIndex!='' && serverIndex!=0 && startDay!='' && endDay!='') {
                $(this).html('发送中...');
                $(this).css({"background":"#616161"});
                $.get("/LevelCountGet/", {"serverIndex": serverIndex,"className":className,"startDay":startDay,"endDay":endDay,'doingunid':new Date().getTime()}, function (data) {
                    var obj = jQuery.parseJSON(data);
                    if (obj.status != 2000) {
                        alert(obj.message)
                    }
                    window.location.reload();
                })
            } else {
                alert("填写必须参数！")
            }
        });
        $(".ReportDataTitle_list:eq(2)").mousemove(function(index){
            if(Type==1 && TypeValue==1){
                $(this).find('span').css({"background": 'url("/views/img/iconC.png") -285px -95px'});
            }else {
                $(this).find('span').css({"background": 'url("/views/img/iconC.png") -310px -95px'});
            }
        });
        $(".ReportDataTitle_list:eq(2)").mouseout(function(index){
            $(this).find('span').css({"background": ''});
        });
        $(".ReportDataTitle_list:eq(4)").mousemove(function(index){
            if(Type==2 && TypeValue==1){
                $(this).find('span').css({"background": 'url("/views/img/iconC.png") -285px -95px'});
            }else {
                $(this).find('span').css({"background": 'url("/views/img/iconC.png") -310px -95px'});
            }
        });
        $(".ReportDataTitle_list:eq(4)").mouseout(function(index){
            $(this).find('span').css({"background": ''});
        });

        $(".ReportDataTitle_list:eq(2)").click(function(){
            $.get("/LevelCountSort/",{'type':"1",'doingunid':new Date().getTime()},function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.status != 2000) {
                    alert(obj.message)
                }
                window.location.reload();
            })
        });
        $(".ReportDataTitle_list:eq(4)").click(function(){
            $.get("/LevelCountSort/",{'type':"2",'doingunid':new Date().getTime()},function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.status != 2000) {
                    alert(obj.message)
                }
                window.location.reload();
            })
        });
        $(".selectDataShow_div").each(function(index){
            $(this).click(function(){
                $(".selectDataShow_div").css({"background": "#F8F8F8"});
                $(this).css({"background": "#E6E6E6"});
                $(".ReportData_list").hide();
                $(".ReportData_list:eq("+index+")").show();
            })
        });
        $(".downloadExl").click(function(){
            var dataJson=$(this).attr("data_json");
            $.post("/downloadExlPost/",{"dataJson":dataJson,'doingunid':new Date().getTime()},function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.status = 2000) {
                    location.href="/downloadExl/?dataKey="+obj.dataKey;
                }
            })
        });

        var button_m_index=0;
        var button_m_state=0;
        $(".button_m").each(function(index){
            $(this).click(function(){
                if(button_m_index==index) {
                    if (button_m_state == 0) {
                        $(".ReportDataTitle_list_show").hide().eq(index).show();
                        $(".ReportDataTitle_list_show2").hide();
                        button_m_index = index;
                        button_m_state = 1;
                    } else {
                        $(".ReportDataTitle_list_show").hide();
                        $(".ReportDataTitle_list_show2").hide();
                        button_m_index = 0;
                        button_m_state = 0;
                    }
                }else{
                    $(".ReportDataTitle_list_show").hide().eq(index).show();
                    $(".ReportDataTitle_list_show2").hide();
                    button_m_index = index;
                    button_m_state = 1;
                }
            });
        });

        $(".ReportDataTitle_list_show_str").each(function(index){
            $(this).click(function(){
                var listIndex=$(this).attr("listIndex");
                var valueIndex=$(this).attr("valueIndex");
                $(".ReportDataTitle_list_show2").eq(button_m_index).show();
                $.get("/LevelCountAjax/",{"valueIndex":valueIndex,'doingunid':new Date().getTime()},function(data){

                    var obj = jQuery.parseJSON(data);

                    if (obj.status == 2000) {
                        var showStr="<span>角色名:</span>"+obj.data.sChrName+"&nbsp;";
                        showStr+="<span>性别:</span>"+obj.data.btSex+"&nbsp;";
                        showStr+="<span>等级:</span>"+obj.data.Level+"&nbsp;";
                        showStr+="<span>创建时间:</span>"+obj.data.CreateDay+"&nbsp;";
                        showStr+="<span>更新时间:</span>"+obj.data.UpdateDay+"&nbsp;";
                        showStr+="<span>转生等级:</span>"+obj.data.btRelevel+"&nbsp;";
                        showStr+="<span>金币:</span>"+obj.data.nGold+"&nbsp;";
                        showStr+="<span>元宝:</span>"+obj.data.nGameGold+"&nbsp;";
                        $(".ReportDataTitle_list_show2").eq(button_m_index).html(showStr);

                    }else if(obj.status == 2001){
                        $(".ReportDataTitle_list_show2").eq(listIndex).html("没有查到数据!");
                    }else{
                        alert("参数错误！");
                    }
                });
            });
        });
    });
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    var myChart = echarts.init(document.getElementById('container_cen'));
    var option = {
                title: {text: '', subtext: ''},
                legend: {data:['本级人数','本级流失量']},
                toolbox: {show : false, feature : {dataZoom: {}, dataView: {readOnly: true}, magicType: {type: ['line', 'bar']}, restore: {}, saveAsImage: {}}},
                tooltip : {
                    trigger: 'axis', formatter: function(params) {return params[0].name + '<br/>' + params[0].seriesName + ' : ' + params[0].value + ' (人)<br/>' + params[1].seriesName + ' : ' + params[1].value + ' (人)';
                    },
                    axisPointer: {animation: false}
                },
                xAxis: {type: 'category', boundaryGap: false, splitLine: {show: false}, data: <?php echo $_smarty_tpl->tpl_vars['data_level']->value;?>
},
            yAxis: {type: 'value',splitLine: {show: false}},
    dataZoom: {type: 'inside'},
    series: [
        {name:'本级人数', type:'line', symbol: 'none', areaStyle: {normal: {}}, data:<?php echo $_smarty_tpl->tpl_vars['data_levelSum']->value;?>
},
    {name:'本级流失量', type:'line', symbol: 'none', areaStyle: {normal: {}},data: <?php echo $_smarty_tpl->tpl_vars['data_lostLevelSum']->value;?>
}
    ]
    };
    myChart.setOption(option);
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $(function(){
        $(".ReportData_list:gt(0)").hide();
    })
<?php echo '</script'; ?>
>

<?php
}
}
/*/ block_function_bbb_1320691367583b9c94df7353_08992017 */
?>
<?php
/* block_function_bbb_1528694102583b9c94e57508_38278429  file:Admin/index.html */
if (!function_exists('block_function_bbb_1528694102583b9c94e57508_38278429')) {
function block_function_bbb_1528694102583b9c94e57508_38278429($_smarty_tpl, $block) {?>
            <div class="title">首页</div>
            <div class="title_index_center">
                <div class="title_index_yh">欢迎来到本后台管理系统！</div>
                <p>您好，<?php echo $_smarty_tpl->tpl_vars['userName']->value;?>
，您的角色是系统管理员。<?php if ($_smarty_tpl->tpl_vars['xx']->value == 'a') {
echo $_smarty_tpl->tpl_vars['xx']->value;
echo $_smarty_tpl->tpl_vars['yy']->value;
}?></p>
                <p>这里是高级管理界面。</p>
                <p>请从页面左上方的下拉框选择管理界面，从左侧的菜单选择功能。或者点选以下快捷链接</p>
            </div>
            <?php
}
}
/*/ block_function_bbb_1528694102583b9c94e57508_38278429 */
?>
