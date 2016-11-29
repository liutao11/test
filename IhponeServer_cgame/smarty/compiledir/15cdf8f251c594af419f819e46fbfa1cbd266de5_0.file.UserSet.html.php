<?php /* Smarty version 3.1.28-dev/54, created on 2016-11-07 19:11:03
         compiled from "/mnt/hgfs/linux/IhponeServer_cgame/views/Admin/UserSet.html" */ ?>
<?php
/*%%SmartyHeaderCode:178358504558206147edf565_87281588%%*/
$_valid = $_smarty_tpl->decodeProperties(array (
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/54',
  'unifunc' => 'content_582061480aa6d6_58807867',
  'file_dependency' => 
  array (
    '15cdf8f251c594af419f819e46fbfa1cbd266de5' => 
    array (
      0 => '/mnt/hgfs/linux/IhponeServer_cgame/views/Admin/UserSet.html',
      1 => 1478517054,
      2 => 'file',
    ),
    '3ec737df16ee686e2f80964f4237a248f38b0420' => 
    array (
      0 => '/mnt/hgfs/linux/IhponeServer_cgame/views/Admin/index.html',
      1 => 1478495874,
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
if ($_valid && !is_callable('content_582061480aa6d6_58807867')) {
function content_582061480aa6d6_58807867 ($_smarty_tpl) {
ob_start();
$_smarty_tpl->compiled->nocache_hash = '178358504558206147edf565_87281588';
?>

<?php 
$_smarty_tpl->_Block->registerBlock($_smarty_tpl, array('caching' => false, 'function' => 'block_function_bbb_11312804715820614802edd4_79242852', 'name' => 'bbb'));
ob_end_clean();
/*  Call merged included template "Admin/index.html" */
$_smarty_tpl->_Inline->renderInline($_smarty_tpl, 'Admin/index.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 1, false, false, 'content_5820614803a4f8_18582415', '3ec737df16ee686e2f80964f4237a248f38b0420');
/*  End of included template "Admin/index.html" */
}
}
?><?php
/*%%SmartyHeaderCode:178358504558206147edf565_87281588%%*/
/* file:Admin/index.html */
if ($_valid && !is_callable('content_5820614803a4f8_18582415')) {
function content_5820614803a4f8_18582415 ($_smarty_tpl) {
?>
<?php
$_smarty_tpl->compiled->nocache_hash = '178358504558206147edf565_87281588';
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
                        <div class="list_m_title"><div class='list_icon'></div>玩家</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a16') {?>style="display: block "<?php }?>>
                            <div class="list_m_list" ><a href="/UserRoleList/?xx=b5&zz=a16&yy=1" >角色列表</a></div>
                            <div class="list_m_list" ><a href="/UserAllRoleList/?xx=b5&zz=a16&yy=1" >全服角色列表</a></div>
                            <div class="list_m_list" ><a href="/UserDoingLog/?xx=b5&zz=a16&yy=2">动作记录</a></div>
                            <div class="list_m_list" ><a href="/UserLoginLog/?xx=b5&zz=a16&yy=3">登录记录</a></div>
                        </div>

<!--                        <div class="list_m_title"><div class='list_icon8'></div>禁言</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a17') {?>style="display: block "<?php }?>>
                        <div class="list_m_list" ><a href="/GagListSet/?xx=b5&zz=a17&yy=6">禁言管理</a></div>
                        <div class="list_m_list" ><a href="/AddGag/?xx=b5&zz=a17&yy=7">禁言</a></div>
                        </div>-->
<!--                        <div class="list_m_title"><div class='list_icon9'></div>封禁帐号</div>
                        <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a18') {?>style="display: block "<?php }?>>
                           <div class="list_m_list" ><a href="/BanNumberSet/?xx=b5&yy=6">封号管理</a></div>                        
						   <div class="list_m_list" ><a href="/AddBanNumber/?xx=b5&yy=7">封号</a></div>
						</div>-->
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
                            <div class="list_m_list" ><a href="/SUserControlLog/?xx=b5&zz=a20&yy=2">控制日志</a></div>
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
$_smarty_tpl->_Block->callBlock($_smarty_tpl, array('caching' => false, 'function' => 'block_function_bbb_146403141158206148091811_45788763', 'name' => 'bbb'));
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
/*/%%SmartyNocache:178358504558206147edf565_87281588%%*/
}
}
?><?php
/* block_function_bbb_11312804715820614802edd4_79242852  file:Admin/UserSet.html */
if (!function_exists('block_function_bbb_11312804715820614802edd4_79242852')) {
function block_function_bbb_11312804715820614802edd4_79242852($_smarty_tpl, $block) {?>
<?php echo '<script'; ?>
 src="/views/datastyle/WdatePicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/views/dataTimeStyle/jquery.datetimepicker.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="/views/dataTimeStyle/jquery.datetimepicker.css" type="text/css" />
<style>
    .page_title{font-size: 14px;color: #438EB9;margin: 10px 0 0 0;height: 35px;line-height: 35px;background:#FAFAFA ;border: 1px solid #DEDEDE;border-radius: 6px;padding-left: 10px;}
    .page_title span{font-size: 18px;color: #438EB9;padding-left: 10px;height: 40px;line-height: 40px;font-weight: bold}
    .fisrtGet{box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);border: 1px solid #DEDEDE;border-radius: 5px;padding: 0 10px 0 10px}


    .table_list{background:#F5F5F5;border-bottom:1px solid #DEDEDE;height: 30px;}
    .table_tr{float: left;  height: 30px;line-height: 30px;width: 150px;font-size: 12px;text-align: center;overflow: hidden}
    .table_name{float: left;line-height: 30px;height: 30px;}
    .noticeAdd{float: left;}
    .add_div{float: left;line-height: 30px;height: 30px;}
    .show_div{background: url('/views/img/bg_cc.png');width: 100%;height: 100%;position: fixed;z-index: 3;display: none;top:0;left: 0}
    .show_center{width: 1000px;margin: 200px auto 0 auto;background: #ffffff}
    .showList{clear: both;height: 32px;margin-top: 10px;}
    .showList_name{float: left;height: 30px;line-height: 30px;font-size: 12px;;text-align: right;width: 150px;}
    .showList select{display: block;float: left;height: 30px;line-height: 30px;font-size: 12px;width: 150px;}
    .showList span{display: block;float: left;height: 30px;line-height: 30px;font-size: 12px;width: 50px;text-align: right;}
    .showList input{height: 30px;line-height: 30px;display: block;float: left;width: 300px;border: 1px solid #cccccc;font-size: 14px;}
    .close_show_title{font-size: 18px;color: #438EB9;line-height: 40px;height: 40px;float: left}
    .showList textarea{line-height: 30px;height: 60px;display: block;float: left;width: 600px;}
    .close_show_div{float: right;font-size: 14px;height: 40px;line-height: 40px;margin-right: 30px;}
    .showList_submit{width: 120px;height: 25px;line-height: 25px;font-size: 14px;text-align: center;border: 1px solid  #cccccc;cursor: pointer}
    .exeIng{width: 70px ;color: #438EB9;font-size: 12px;line-height: 30px;height: 30px;text-align: center;float: left;cursor: pointer}
    .exeIng:hover{color: #cccccc}
    .changeIng{width: 70px ;color: #438EB9;font-size: 12px;line-height: 30px;height: 30px;text-align: center;float: left;cursor: pointer}
    .changeIng:hover{color: #cccccc}
    .table_tt_list{clear: both;height: 40px;}
    .table_tt_tr{float: left;line-height: 40px;height: 40px;width: 150px;text-align: center;font-size: 14px;font-weight: 600}
    .roleDiv{float: left;width: 300px;height: 40px;}
</style>
<div class="conten">
    <div class="page_title">用户管理</div>
    <div style="padding-left: 10px;padding-top: 10px;">
        <div style="margin-top: 10px;" class="queryShow">
            <div style="font-size: 14px ;height: 30px;line-height: 30px;">
                <div class="table_name">用户列表：</div>
                <div class="noticeAdd">
                    <div class="icon_add"></div>
                    <div class="add_div">增加用户</div>
                </div>
            </div>
            <div class="fisrtGet">
                <div class="table_tt_list">
                    <div class="table_tt_tr">用户ID</div>
                    <div class="table_tt_tr">用户名</div>
                    <div class="table_tt_tr">姓名</div>
                    <div class="table_tt_tr">身份</div>
                    <div class="table_tt_tr">所属平台</div>
                    <div class="table_tt_tr">操作</div>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
                    <?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
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
                    <div class="table_list">
                        <div class="table_tr"><?php echo $_smarty_tpl->tpl_vars['vv']->value['id'];?>
</div>
                        <div class="table_tr"><?php echo $_smarty_tpl->tpl_vars['vv']->value['userName'];?>
</div>
                        <div class="table_tr"><?php echo $_smarty_tpl->tpl_vars['vv']->value['chinaName'];?>
</div>
                        <div class="table_tr"><?php echo $_smarty_tpl->tpl_vars['roleS']->value[$_smarty_tpl->tpl_vars['vv']->value['groundId']];?>
</div>
                        <div class="table_tr"><?php if ($_smarty_tpl->tpl_vars['vv']->value['objectGround']) {
echo $_smarty_tpl->tpl_vars['objectS_b']->value[$_smarty_tpl->tpl_vars['vv']->value['objectGround']];
} else { ?>全平台<?php }?></div>
                        <div class="table_tr">
                            <?php if ($_smarty_tpl->tpl_vars['vv']->value['userName'] != 'root') {?>
                                <div class="exeIng"  UserId="<?php echo $_smarty_tpl->tpl_vars['vv']->value['id'];?>
" DBtype="<?php echo $_smarty_tpl->tpl_vars['vv']->value['type'];?>
"><?php if ($_smarty_tpl->tpl_vars['vv']->value['type'] == 1) {?>关闭<?php } else { ?><span style="color: green;font-size: 12px;">开启</span><?php }?></div>
                                <div class="changeIng"  UserId="<?php echo $_smarty_tpl->tpl_vars['vv']->value['id'];?>
" userName="<?php echo $_smarty_tpl->tpl_vars['vv']->value['userName'];?>
"  chinaName="<?php echo $_smarty_tpl->tpl_vars['vv']->value['chinaName'];?>
" groundId="<?php echo $_smarty_tpl->tpl_vars['vv']->value['groundId'];?>
" objectGround="<?php echo $_smarty_tpl->tpl_vars['vv']->value['objectGround'];?>
"  DBtype="<?php echo $_smarty_tpl->tpl_vars['vv']->value['type'];?>
">修改</div>
                            <?php }?>
                        </div>
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
                <?php }?>
                <div class="table_tt_list"></div>
            </div>
        </div>
    </div>

</div>
<div class="show_div">
    <div class="show_center">
        <div class="page_title"><div  class="close_show_title" >增加用户</div><div class="close_show_div">关闭</div></div>
        <div class="showList">
            <div class="showList_name">用户名：</div>
            <input type="text" class="userName">
        </div>
        <div class="showList">
            <div class="showList_name">密码：</div>
            <input type="text" class="password">
        </div>
        <div class="showList">
            <div class="showList_name">姓名：</div>
            <input type="text" class="chinaName">
        </div>

        <div class="showList">
            <div class="showList_name">平台：</div>
            <select class="ObjectId">
                <option value="0">--选择平台--</option>
                <?php
$_from = $_smarty_tpl->tpl_vars['objectS']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_vv_1_saved_item = isset($_smarty_tpl->tpl_vars['vv']) ? $_smarty_tpl->tpl_vars['vv'] : false;
$_smarty_tpl->tpl_vars['vv'] = new Smarty_Variable();
$__foreach_vv_1_total = $_smarty_tpl->_count($_from);
if ($__foreach_vv_1_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['vv']->value) {
$__foreach_vv_1_saved_local_item = $_smarty_tpl->tpl_vars['vv'];
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['vv']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['vv']->value['title'];?>
</option>
                <?php
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_1_saved_local_item;
}
}
if ($__foreach_vv_1_saved_item) {
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_1_saved_item;
}
?>
            </select>
        </div>
        <div class="showList">
            <div class="showList_name">身份：</div>
            <select class="roleSId">
                <option value="0">--选择身份--</option>
                <?php
$_from = $_smarty_tpl->tpl_vars['roleS']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_vv_2_saved_item = isset($_smarty_tpl->tpl_vars['vv']) ? $_smarty_tpl->tpl_vars['vv'] : false;
$__foreach_vv_2_saved_key = isset($_smarty_tpl->tpl_vars['kk']) ? $_smarty_tpl->tpl_vars['kk'] : false;
$_smarty_tpl->tpl_vars['vv'] = new Smarty_Variable();
$__foreach_vv_2_total = $_smarty_tpl->_count($_from);
if ($__foreach_vv_2_total) {
$_smarty_tpl->tpl_vars['kk'] = new Smarty_Variable();
foreach ($_from as $_smarty_tpl->tpl_vars['kk']->value => $_smarty_tpl->tpl_vars['vv']->value) {
$__foreach_vv_2_saved_local_item = $_smarty_tpl->tpl_vars['vv'];
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['kk']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['vv']->value;?>
</option>
                <?php
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_2_saved_local_item;
}
}
if ($__foreach_vv_2_saved_item) {
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_2_saved_item;
}
if ($__foreach_vv_2_saved_key) {
$_smarty_tpl->tpl_vars['kk'] = $__foreach_vv_2_saved_key;
}
?>
            </select>
        </div>

        <div class="showList" style="display: none">
            <div class="showList_name">主渠道：</div>
            <select class="fromIdmId">
                <option value="0">--主渠道--</option>
                <?php
$_from = $_smarty_tpl->tpl_vars['fromInfo']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_vv_3_saved_item = isset($_smarty_tpl->tpl_vars['vv']) ? $_smarty_tpl->tpl_vars['vv'] : false;
$_smarty_tpl->tpl_vars['vv'] = new Smarty_Variable();
$__foreach_vv_3_total = $_smarty_tpl->_count($_from);
if ($__foreach_vv_3_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['vv']->value) {
$__foreach_vv_3_saved_local_item = $_smarty_tpl->tpl_vars['vv'];
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['vv']->value['fromInfoId'];?>
"><?php echo $_smarty_tpl->tpl_vars['vv']->value['fromInfoName'];?>
</option>
                <?php
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_3_saved_local_item;
}
}
if ($__foreach_vv_3_saved_item) {
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_3_saved_item;
}
?>
            </select>
        </div>

        <div class="showList" style="display: none">
            <div class="showList_name">副渠道：</div>
            <select class="fromIdsId">
                <option value="0">--副渠道--</option>
                <?php if ($_smarty_tpl->tpl_vars['YJSKIDArray']->value != '') {?>
                    <?php
$_from = $_smarty_tpl->tpl_vars['YJSKIDArray']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_vv_4_saved_item = isset($_smarty_tpl->tpl_vars['vv']) ? $_smarty_tpl->tpl_vars['vv'] : false;
$_smarty_tpl->tpl_vars['vv'] = new Smarty_Variable();
$__foreach_vv_4_total = $_smarty_tpl->_count($_from);
if ($__foreach_vv_4_total) {
foreach ($_from as $_smarty_tpl->tpl_vars['vv']->value) {
$__foreach_vv_4_saved_local_item = $_smarty_tpl->tpl_vars['vv'];
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['vv']->value['SKID'];?>
"><?php echo $_smarty_tpl->tpl_vars['vv']->value['SKID_NAME'];?>
</option>
                    <?php
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_4_saved_local_item;
}
}
if ($__foreach_vv_4_saved_item) {
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_4_saved_item;
}
?>
                <?php }?>
            </select>
        </div>
        <div class="showList" style="height: 64px;">
            <div class="showList_submit" style="margin: 0 auto">提交</div>
        </div>
    </div>
</div>
<?php echo '<script'; ?>
>
    $(function(){
        var conten_x=$(".conten").width();
        isModify=1;                                //判断是否是修改模式
        UserId=0;                                //修改的id
        if(conten_x <=1600){
            $(".conten").css({"width":"1600px"});
        }
        $(".noticeAdd").each(function(index){
            $(this).click(function(){
                isModify=1;
                $(".show_div").show();
            })
        });
        $(".close_show_div").click(function(){
            $(".show_div").hide();
            isModify=1;
        });
        $(".showList_submit").click(function(){
            $(".show_div").hide();
            var userName=$(".userName").val();
            var password=$(".password").val();
            var chinaName=$(".chinaName").val();
            var roleSId=$(".roleSId").val();
            var ObjectId=$(".ObjectId").val();
            var fromIdmId=$(".fromIdmId").val();
            var fromIdsId=$(".fromIdsId").val();
            if(ObjectId && userName && password && chinaName && roleSId){
                $(this).html('发送中...');
                $(this).css({"background":"#616161"});
                $.get("/UserSetGet/",{"isModify":isModify, "ObjectId":ObjectId, "userName":userName, "password":password, "chinaName":chinaName, "roleSId":roleSId, "fromIdmId":fromIdmId, "fromIdsId":fromIdsId, "UserId":UserId},function(data){
                    var obj = jQuery.parseJSON(data);
                    if(obj.status!=2000){
                        alert(obj.message)
                    }else{
                        alert("ok");
                    }
                    window.location.reload();
                });
            }else{
                alert("填写错误");
            }
        });
        $(".exeIng").click(function(){
            var UserId=$(this).attr("UserId");
            var DBtype=$(this).attr("DBtype");
            $.post("/ChangeUserSet/",{"DBtype":DBtype,"UserId":UserId},function(data){
                var obj = jQuery.parseJSON(data);
                if(obj.status!=2000){
                    alert(obj.message)
                }else{
                    alert("ok");
                }
                window.location.reload();
            });
        });
        $(".roleSId").change(function(){

            var roleSIdkey=$(this).val();
            if(roleSIdkey==6){
                $(".showList").eq(5).show().eq(6).hide();
            }else{
                $(".showList").eq(5).hide().eq(6).hide();
            }
        });
        /*$(".fromIdmId").change(function(){
            var  fromIdmId=$(this).val();
            if(fromIdmId==1){
                $(".showList").eq(6).show();
            }else{
                $(".showList").eq(6).hide();
            }
        });*/
    });
<?php echo '</script'; ?>
>
<?php
}
}
/*/ block_function_bbb_11312804715820614802edd4_79242852 */
?>
<?php
/* block_function_bbb_146403141158206148091811_45788763  file:Admin/index.html */
if (!function_exists('block_function_bbb_146403141158206148091811_45788763')) {
function block_function_bbb_146403141158206148091811_45788763($_smarty_tpl, $block) {?>
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
/*/ block_function_bbb_146403141158206148091811_45788763 */
?>
