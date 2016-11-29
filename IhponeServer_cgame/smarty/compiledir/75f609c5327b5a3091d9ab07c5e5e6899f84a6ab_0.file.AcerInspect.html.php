<?php /* Smarty version 3.1.28-dev/54, created on 2016-11-28 13:43:00
         compiled from "/mnt/hgfs/linux/IhponeServer_cgame/views/Admin/AcerInspect.html" */ ?>
<?php
/*%%SmartyHeaderCode:1695401075583bc3e441f279_53157151%%*/
$_valid = $_smarty_tpl->decodeProperties(array (
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/54',
  'unifunc' => 'content_583bc3e4542802_74841097',
  'file_dependency' => 
  array (
    '75f609c5327b5a3091d9ab07c5e5e6899f84a6ab' => 
    array (
      0 => '/mnt/hgfs/linux/IhponeServer_cgame/views/Admin/AcerInspect.html',
      1 => 1480311710,
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
if ($_valid && !is_callable('content_583bc3e4542802_74841097')) {
function content_583bc3e4542802_74841097 ($_smarty_tpl) {
ob_start();
$_smarty_tpl->compiled->nocache_hash = '1695401075583bc3e441f279_53157151';
?>

<?php 
$_smarty_tpl->_Block->registerBlock($_smarty_tpl, array('caching' => false, 'function' => 'block_function_bbb_365446952583bc3e44c0f82_42141683', 'name' => 'bbb'));
ob_end_clean();
/*  Call merged included template "Admin/index.html" */
$_smarty_tpl->_Inline->renderInline($_smarty_tpl, 'Admin/index.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 1, false, false, 'content_583bc3e44ce697_54505490', '3ec737df16ee686e2f80964f4237a248f38b0420');
/*  End of included template "Admin/index.html" */
}
}
?><?php
/*%%SmartyHeaderCode:1695401075583bc3e441f279_53157151%%*/
/* file:Admin/index.html */
if ($_valid && !is_callable('content_583bc3e44ce697_54505490')) {
function content_583bc3e44ce697_54505490 ($_smarty_tpl) {
?>
<?php
$_smarty_tpl->compiled->nocache_hash = '1695401075583bc3e441f279_53157151';
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
$_smarty_tpl->_Block->callBlock($_smarty_tpl, array('caching' => false, 'function' => 'block_function_bbb_917664660583bc3e452efe0_64531446', 'name' => 'bbb'));
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
/*/%%SmartyNocache:1695401075583bc3e441f279_53157151%%*/
}
}
?><?php
/* block_function_bbb_365446952583bc3e44c0f82_42141683  file:Admin/AcerInspect.html */
if (!function_exists('block_function_bbb_365446952583bc3e44c0f82_42141683')) {
function block_function_bbb_365446952583bc3e44c0f82_42141683($_smarty_tpl, $block) {?>
<?php echo '<script'; ?>
 src="/views/dataTimeStyle/jquery.datetimepicker.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="/views/dataTimeStyle/jquery.datetimepicker.css" type="text/css" />
<style>
    .page_title{font-size: 14px;color: #438EB9;margin: 10px 0 0 0;height: 35px;line-height: 35px;background:#FAFAFA ;border: 1px solid #DEDEDE;border-radius: 6px;padding-left: 10px;}
    .page_title span{font-size: 18px;color: #438EB9;padding-left: 10px;height: 40px;line-height: 40px;font-weight: bold}
    .ReportData{box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);border: 1px solid #DEDEDE;border-radius: 5px;}

    .ReportDataTitle{height: 40px;}
    .ReportDataTitle_list{float: left;line-height: 40px;height: 40px;width: 150px;text-align: center;font-size: 14px;font-weight: 600}
    .ReportDataCenter{background:#F5F5F5;border-bottom:1px solid #DEDEDE;height: 30px;}
    .ReportDataCenter_list{float: left;line-height: 30px;height: 30px;width: 150px;text-align: center;font-size: 12px;}
    .drop_down{width: 20px;height: 20px;margin-left: 10px;margin-top: 10px;background: url("/views/img/iconC.png") -310px -115px #F5F5F5;}

    .showList{clear: both;height: 32px;margin-top: 10px;}
    .showList_name{float: left;height: 30px;line-height: 30px;font-size: 12px;;text-align: right;width: 150px;}
    .showList select{display: block;float: left;height: 30px;line-height: 30px;font-size: 12px;width: 150px;}
    .showList span{display: block;float: left;height: 30px;line-height: 30px;font-size: 12px;width: 150px;}
    .showList input{height: 30px;line-height: 30px;display: block;float: left;width: 300px;border: 1px solid #cccccc;font-size: 14px;}
    .showList textarea{line-height: 30px;height: 60px;display: block;float: left;width: 600px;}
    .container_tt{height: 40px;line-height: 40px;font-size: 16px;background: transparent linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) repeat scroll 0% 0%}
    .iconC1{width: 20px;height: 20px;background: url("/views/img/iconC.png") 0 0;float: left;margin: 12px 10px auto 10px;}
    .selectDiv{height: 50px;position: relative}
    .selectDiv span{display: block;float: left;line-height: 50px;height: 50px;margin-left: 10px;}
    .selectDiv select{display: block;float: left;margin-top: 10px;height: 30px;width: 150px;line-height: 30px;margin-left: 10px;}
    .selectDiv input{display: block;float: left;height: 28px;width: 150px;margin: 10px 0 0 10px;}
    .selectDiv_submit{float: left;height: 28px;margin-top: 10px;margin-left: 20px;background:#438EB9;color: #ffffff;line-height: 30px;text-align: center;width: 100px;font-size: 12px;cursor:pointer}
    .roleKey{width: 90%;border: 1px solid #DEDEDE;height: 30px;line-height: 30px;border-radius:4px;margin: 0 auto}
    .correct{width: 15px;height: 15px;background: url("/views/img/iconC.png") -287px 0;margin-top: 7px;float: left;cursor: pointer}
    .error{width: 15px;height: 15px;background: url("/views/img/iconC.png") -312px 0;margin-top: 7px;float: left;margin-left: 10px;cursor: pointer}

</style>
<div class="page_title"><span><?php echo $_smarty_tpl->tpl_vars['objectName']->value;?>
</span> 平台->运营数据->元宝申请审核</div>
<div style="padding-top: 10px;">
    <div class="selectDiv">
        <span>平台*</span>
        <select class="objectIndex">
            <option value="0" >--选择平台--</option>
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
            <option value="<?php echo $_smarty_tpl->tpl_vars['vv']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['objectIndex']->value == $_smarty_tpl->tpl_vars['vv']->value['id']) {?> selected<?php }?> ><?php echo $_smarty_tpl->tpl_vars['vv']->value['title'];?>
</option>
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
        </select>
        <span>服区*</span>
        <select class="serverIndex">
            <option value="0"  <?php if ($_smarty_tpl->tpl_vars['serverIndex']->value == 0) {?>selected<?php }?>>--选择区服--</option>
            <?php if ($_smarty_tpl->tpl_vars['objectIndex']->value) {?>
            <?php
$_from = $_smarty_tpl->tpl_vars['dServerS']->value;
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
            <option value="<?php echo $_smarty_tpl->tpl_vars['kk']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['kk']->value == $_smarty_tpl->tpl_vars['serverIndex']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['vv']->value;?>
</option>
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
            <?php }?>
        </select>
        <span>日期*</span>
        <input type="text" class="startDay" value="<?php echo $_smarty_tpl->tpl_vars['startDay']->value;?>
">
        <span>到</span>
        <input type="text" class="endDay" value="<?php echo $_smarty_tpl->tpl_vars['endDay']->value;?>
">
        <div class="selectDiv_submit">提交</div>
    </div>
    <div class="ReportData">
        <div class="container_tt"><div class="iconC1"></div>元宝申请记录</div>
        <div class="ReportDataTitle">
            <div class="ReportDataTitle_list" style="width: 60px;">服区</div>
            <div class="ReportDataTitle_list" style="width: 80px;">状态</div>
            <div class="ReportDataTitle_list" style="width: 400px;">角色名</div>
            <div class="ReportDataTitle_list" style="width: 60px;">元宝数量</div>
            <div class="ReportDataTitle_list" style="width: 80px;">是否充值奖励</div>
            <div class="ReportDataTitle_list" style="width: 200px;">申请时间</div>
            <div class="ReportDataTitle_list" >备注</div>
            <div class="ReportDataTitle_list" >申请人</div>
            <div class="ReportDataTitle_list" style="width: 110px;">审核人</div>
            <div class="ReportDataTitle_list" style="width: 200px;">审核时间</div>
            <div class="ReportDataTitle_list" style="width: 110px;">操作</div>
        </div>
        <div class="ReportDataTitle">
            <div class="ReportDataTitle_list" style="width: 60px;"></div>
            <div class="ReportDataTitle_list" style="width: 80px;">
                <select class="roleKey">
                    <option value="0" >全部</option>
                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['index']->value == 1 && $_smarty_tpl->tpl_vars['value']->value == 1) {?>selected<?php }?> >未审核</option>
                    <option value="2" <?php if ($_smarty_tpl->tpl_vars['index']->value == 1 && $_smarty_tpl->tpl_vars['value']->value == 2) {?>selected<?php }?>>通过</option>
                    <option value="3" <?php if ($_smarty_tpl->tpl_vars['index']->value == 1 && $_smarty_tpl->tpl_vars['value']->value == 3) {?>selected<?php }?>>未通过</option>
                </select>
            </div>
            <div class="ReportDataTitle_list" style="width: 400px;"><input type="text" class="roleKey" value="<?php if ($_smarty_tpl->tpl_vars['index']->value == 2) {
echo $_smarty_tpl->tpl_vars['value']->value;
} else {
}?>"></div>
            <div class="ReportDataTitle_list" style="width: 60px;"><input type="text" class="roleKey" value="<?php if ($_smarty_tpl->tpl_vars['index']->value == 3) {
echo $_smarty_tpl->tpl_vars['value']->value;
} else {
}?>"></div>
            <div class="ReportDataTitle_list" style="width: 80px;">
                <select class="roleKey">
                    <option value="0">全部</option>
                    <option value="1" <?php if ($_smarty_tpl->tpl_vars['index']->value == 4 && $_smarty_tpl->tpl_vars['value']->value == 1) {?>selected<?php }?> >是</option>
                    <option value="2" <?php if ($_smarty_tpl->tpl_vars['index']->value == 4 && $_smarty_tpl->tpl_vars['value']->value == 2) {?>selected<?php }?> >否</option>
                </select>
            </div>
            <div class="ReportDataTitle_list" style="width: 200px;"></div>
            <div class="ReportDataTitle_list"></div>
            <div class="ReportDataTitle_list"><input type="text" class="roleKey" value="<?php if ($_smarty_tpl->tpl_vars['index']->value == 5) {
echo $_smarty_tpl->tpl_vars['value']->value;
} else {
}?>"></div>
            <div class="ReportDataTitle_list"><input type="text" class="roleKey" value="<?php if ($_smarty_tpl->tpl_vars['index']->value == 6) {
echo $_smarty_tpl->tpl_vars['value']->value;
} else {
}?>"></div>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['data']->value) {?>
        <?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
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
        <div class="ReportDataCenter" <?php if ($_smarty_tpl->tpl_vars['kk']->value > ($_smarty_tpl->tpl_vars['pagelength']->value-1)) {?> style="display: none"<?php }?>>
        <div class="ReportDataCenter_list" style="width: 60px;"><?php echo $_smarty_tpl->tpl_vars['vv']->value['serverUnid'];?>
</div>
        <div class="ReportDataCenter_list" style="width: 80px;"><?php if ($_smarty_tpl->tpl_vars['vv']->value['state'] == 1) {?>未审核<?php } elseif ($_smarty_tpl->tpl_vars['vv']->value['state'] == 2) {?><span style="color: green">通过</span><?php } elseif ($_smarty_tpl->tpl_vars['vv']->value['state'] == 3) {?><span style="color: red">未通过</span><?php } else { ?>未知状态<?php }?></div>
        <div class="ReportDataCenter_list" style="width: 400px;"><?php echo $_smarty_tpl->tpl_vars['vv']->value['roleS'];?>
</div>
        <div class="ReportDataCenter_list" style="width: 60px;"><?php echo $_smarty_tpl->tpl_vars['vv']->value['number'];?>
</div>
        <div class="ReportDataCenter_list" style="width: 80px;"><?php if ($_smarty_tpl->tpl_vars['vv']->value['isReward'] == 1) {?>是<?php } elseif ($_smarty_tpl->tpl_vars['vv']->value['isReward'] == 2) {?>否<?php }?></div>
        <div class="ReportDataCenter_list" style="width: 200px;"><?php echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['vv']->value['ApplyTime']);?>
</div>
        <div class="ReportDataCenter_list" ><?php echo $_smarty_tpl->tpl_vars['vv']->value['message'];?>
</div>
        <div class="ReportDataCenter_list" ><?php echo $_smarty_tpl->tpl_vars['vv']->value['ApplyName'];?>
</div>
        <div class="ReportDataCenter_list" style="width: 110px;"><?php echo $_smarty_tpl->tpl_vars['vv']->value['inspectName'];?>
</div>
        <div class="ReportDataCenter_list" style="width: 200px;"><?php if ($_smarty_tpl->tpl_vars['vv']->value['inspectTime']) {
echo date("Y-m-d H:i:s",$_smarty_tpl->tpl_vars['vv']->value['inspectTime']);
}?></div>
        <div class="ReportDataCenter_list" style="width: 110px;"><?php if ($_smarty_tpl->tpl_vars['vv']->value['state'] == 1) {?><div class="correct" AcerId="<?php echo $_smarty_tpl->tpl_vars['vv']->value['id'];?>
"  isReward="<?php echo $_smarty_tpl->tpl_vars['vv']->value['isReward'];?>
"></div><div class="error" AcerId="<?php echo $_smarty_tpl->tpl_vars['vv']->value['id'];?>
"   isReward="<?php echo $_smarty_tpl->tpl_vars['vv']->value['isReward'];?>
"></div><?php }?></div>
    </div>
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
    <?php } else { ?>
    <div class="ReportDataCenter">没有数据！</div>
    <?php }?>
    <div class="ReportDataTitle">
        <?php if ($_smarty_tpl->tpl_vars['pageSum']->value >= 2) {?>
        <div class="drop_down"></div>
        <?php }?>
    </div>

</div>
<?php echo '<script'; ?>
>
    $(function(){
        var pageSum=<?php echo $_smarty_tpl->tpl_vars['pageSum']->value;?>
;
        var showPage=1;
        var showPageLength=<?php echo $_smarty_tpl->tpl_vars['pagelength']->value;?>
;
        var objectServer=<?php echo $_smarty_tpl->tpl_vars['objectServer']->value;?>
;
        $('.startDay').datetimepicker({
            lang:"ch",           //语言选择中文
            format:"Y-m-d 00:00:00",      //格式化日期
            timepicker:false,    //关闭时间选项
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });
        $('.endDay').datetimepicker({
            lang:"ch",           //语言选择中文
            format:"Y-m-d 23:59:59",      //格式化日期
            timepicker:false,    //关闭时间选项
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });
        var selectDiv_submit_state=1;

        $(".selectDiv_submit").click(function(){
            var objectIndex=$(".objectIndex").val();
            var serverIndex=$(".serverIndex").val();
            var startDay=$(".startDay").val();
            var endDay=$(".endDay").val();
            if(selectDiv_submit_state==1) {
                $(this).html('发送中...');
                $(this).css({"background":"#616161"});
                selectDiv_submit_state=0;
                if (objectIndex && startDay && endDay && serverIndex) {
                    $.get("/AcerInspectGet/", {"objectIndex": objectIndex, "serverIndex": serverIndex, "endDay": endDay, "startDay": startDay,'doingunid':new Date().getTime()}, function (data) {
                        var obj = jQuery.parseJSON(data);
                        if (obj.status != 2000) {
                            alert(obj.message)
                        } else {
                            window.location.reload();
                        }
                    })
                } else {
                    alert("填写必须参数！")
                }
            }
        });
        $(".roleKey").each(function(index){
            $(this).change(function (){
                var value=$(this).val();
                var indexs=index+1;
                if( indexs) {
                    $.get("/AcerInspectBlur/",{"index":indexs,"value":value,'doingunid':new Date().getTime()},function(data){
                        var obj = jQuery.parseJSON(data);
                        if(obj.status!=2000){
                            alert(obj.message)
                        } else {
                            window.location.reload();
                        }
                    })
                }
            });
        });
        $(".drop_down").click(function(){
            if(pageSum>showPage){
                var link=showPage*showPageLength-1;
                for(var i=1;i<=showPageLength;i++){
                    $(".ReportDataCenter:eq("+link+")").show();
                    link++;
                }
                showPage++;
                if(showPage==pageSum){
                    $(this).hide();
                }
            }
        });
        $(".objectIndex").change(function(){
            var objectIndex=$(this).val();
            if(objectIndex){
                var obj=jQuery.parseJSON(objectServer);
                var string='<option value="0">--选择区服--</option>';
                for(var key in objectServer){
                    if(key==objectIndex){
                        for(var cc in objectServer[key]){
                            string+='<option value="'+cc+'">'+objectServer[key][cc]+'</option>';
                        }
                    }
                }
                $(".serverIndex").html(string);
            }
        });
        $(".correct").click(function(){
            var AcerId=$(this).attr("AcerId");
            var isReward=$(this).attr("isReward");
            $.get("/AcreInspectControl/",{"state":1,"AcerId":AcerId,"isReward":isReward,'doingunid':new Date().getTime()},function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.status != 2000) {
                    alert(obj.message)
                }
                window.location.reload();
            });
        });
        $(".error").click(function(){
            var AcerId=$(this).attr("AcerId");
            var isReward=$(this).attr("isReward");
            $.get("/AcreInspectControl/",{"state":2,"AcerId":AcerId,"isReward":isReward,'doingunid':new Date().getTime()},function(data){
                var obj = jQuery.parseJSON(data);
                if (obj.status != 2000) {
                    alert(obj.message)
                }
                window.location.reload();
            });
        })
    });
<?php echo '</script'; ?>
>
<?php
}
}
/*/ block_function_bbb_365446952583bc3e44c0f82_42141683 */
?>
<?php
/* block_function_bbb_917664660583bc3e452efe0_64531446  file:Admin/index.html */
if (!function_exists('block_function_bbb_917664660583bc3e452efe0_64531446')) {
function block_function_bbb_917664660583bc3e452efe0_64531446($_smarty_tpl, $block) {?>
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
/*/ block_function_bbb_917664660583bc3e452efe0_64531446 */
?>
