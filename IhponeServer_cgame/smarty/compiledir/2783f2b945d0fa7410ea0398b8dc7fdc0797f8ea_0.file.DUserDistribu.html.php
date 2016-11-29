<?php /* Smarty version 3.1.28-dev/54, created on 2016-11-25 17:29:57
         compiled from "/mnt/hgfs/linux/IhponeServer_cgame/views/Data/DUserDistribu.html" */ ?>
<?php
/*%%SmartyHeaderCode:720505886583804950c7768_56659960%%*/
$_valid = $_smarty_tpl->decodeProperties(array (
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/54',
  'unifunc' => 'content_583804951ef1c5_52158243',
  'file_dependency' => 
  array (
    '2783f2b945d0fa7410ea0398b8dc7fdc0797f8ea' => 
    array (
      0 => '/mnt/hgfs/linux/IhponeServer_cgame/views/Data/DUserDistribu.html',
      1 => 1473401116,
      2 => 'file',
    ),
    '3ec737df16ee686e2f80964f4237a248f38b0420' => 
    array (
      0 => '/mnt/hgfs/linux/IhponeServer_cgame/views/Admin/index.html',
      1 => 1480060300,
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
if ($_valid && !is_callable('content_583804951ef1c5_52158243')) {
function content_583804951ef1c5_52158243 ($_smarty_tpl) {
ob_start();
$_smarty_tpl->compiled->nocache_hash = '720505886583804950c7768_56659960';
?>

<?php 
$_smarty_tpl->_Block->registerBlock($_smarty_tpl, array('caching' => false, 'function' => 'block_function_bbb_91928255558380495186107_80883341', 'name' => 'bbb'));
ob_end_clean();
/*  Call merged included template "Admin/index.html" */
$_smarty_tpl->_Inline->renderInline($_smarty_tpl, 'Admin/index.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 1, false, false, 'content_5838049518f233_32582953', '3ec737df16ee686e2f80964f4237a248f38b0420');
/*  End of included template "Admin/index.html" */
}
}
?><?php
/*%%SmartyHeaderCode:720505886583804950c7768_56659960%%*/
/* file:Admin/index.html */
if ($_valid && !is_callable('content_5838049518f233_32582953')) {
function content_5838049518f233_32582953 ($_smarty_tpl) {
?>
<?php
$_smarty_tpl->compiled->nocache_hash = '720505886583804950c7768_56659960';
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
$_smarty_tpl->_Block->callBlock($_smarty_tpl, array('caching' => false, 'function' => 'block_function_bbb_1988914983583804951dcdb9_53018655', 'name' => 'bbb'));
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
/*/%%SmartyNocache:720505886583804950c7768_56659960%%*/
}
}
?><?php
/* block_function_bbb_91928255558380495186107_80883341  file:Data/DUserDistribu.html */
if (!function_exists('block_function_bbb_91928255558380495186107_80883341')) {
function block_function_bbb_91928255558380495186107_80883341($_smarty_tpl, $block) {?>
<?php echo '<script'; ?>
 src="/views/dataTimeStyle/jquery.datetimepicker.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="/views/dataTimeStyle/jquery.datetimepicker.css" type="text/css" />
<style>
    .page_title{font-size: 14px;color: #438EB9;margin: 10px 0 0 0;height: 35px;line-height: 35px;background:#FAFAFA ;border: 1px solid #DEDEDE;border-radius: 6px;padding-left: 10px;}
    .page_title span{font-size: 18px;color: #438EB9;padding-left: 10px;height: 40px;line-height: 40px;font-weight: bold}
    .container{width: 800px;height: 420px;box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);float: left;margin: 10px 5px 10px 5px;}
    .container_tt{height: 40px;line-height: 40px;font-size: 16px;background: transparent linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) repeat scroll 0% 0%}
    #container_cen{height: 380px;}
    .iconC1{width: 20px;height: 20px;background: url("/views/img/iconC.png") 0 0;float: left;margin: 12px 10px auto 10px;}
    #lineUser{height: 380px;}
    .selectDiv{height: 50px;}
    .selectDiv span{display: block;float: left;line-height: 50px;height: 50px;margin-left: 10px;}
    .selectDiv select{display: block;float: left;margin-top: 10px;height: 30px;width: 150px;line-height: 30px;margin-left: 10px;}
    .selectDiv input{display: block;float: left;height: 28px;width: 150px;margin: 10px 0 0 10px;}
    .selectDiv_submit{float: left;height: 28px;margin-top: 10px;margin-left: 20px;background:#438EB9;color: #ffffff;line-height: 30px;text-align: center;width: 100px;font-size: 12px;cursor: pointer}
    .payList{line-height: 30px;height: 30px;}
    .payList span{color:#438EB9}
    .containerPay{margin: 10px 0 0 10px;}
    .sumdiv{clear: both}
    .sumdivList{float:left;width: 300px;height: 100px;box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);padding-top: 10px;background: transparent linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, rgba(0, 0, 0, 0.1) 100%) repeat scroll 0% 0%;margin:0 10px 0 5px;}
    .sumdivList_icon{width: 30px;height: 30px;background: url("/views/img/iconS.png") -257px -260px;margin: 0 auto 0 auto;}
    .sumdivList_tt{text-align: center;font-size: 18px;font-weight: 600;height: 40px;line-height: 40px;}
    .sumdivList_int{font-weight: 600;font-size: 14px;color: #438EB9;text-align: center;line-height: 30px;height: 30px;}
    .sumdivList_icon_ren{width: 30px;height: 30px;background: url("/views/img/iconS.png") -35px -160px;margin: 0 auto 0 auto;}
    .ReportData{box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);border: 1px solid #DEDEDE;border-radius: 5px;padding-left: 10px;padding-right:10px; }
    .ReportDataTitle{height: 40px;}
    .ReportDataTitle_list{float: left;line-height: 40px;height: 40px;width: 100px;text-align: center;font-size: 14px;font-weight: 600}
    .ReportDataCenter{background:#F5F5F5;border-bottom:1px solid #DEDEDE;height: 30px;position: relative}
    .ReportDataCenter_list{float: left;line-height: 30px;height: 30px;width: 100px;text-align: center;font-size: 12px;}
    .button_m{border-radius: 4px;background:#438EB9;color: #ffffff;font-size: 12px;text-align: center;width: 80px;height: 24px;line-height: 24px;margin: 3px auto 0 auto;cursor: pointer}
    .ReportDataTitle_list_show{position: absolute;width: 150px;height: 200px;background:#438EB9;left: 700px;top: 30px;line-height: 30px;color: #ffffff;z-index: 10;box-shadow: 0 4px 5px #438EB9;border-radius: 2px;display: none}
    .ReportDataTitle_list_show_list{line-height: 22px;height: 22px;margin-left: 10px;}
    .ReportDataTitle_list_show_list span{color: #ffffff}
    .pageInt{width: 30px;height: 30px;border-radius: 4px;background: #DEDEDE;float: left;line-height: 30px;text-align: center;margin: 5px 10px 0 0;cursor: pointer}
    .pageInt:hover{background:#c8e5f6}
    .pageInt_z{width: 28px;height: 28px;border-radius: 4px;border: 1px solid #DEDEDE;float: left;line-height: 28px;text-align: center;margin: 5px 10px 0 0;}
</style>

<div class="page_title"><span><?php echo $_smarty_tpl->tpl_vars['objectName']->value;?>
</span> 平台->运营数据->玩家信息排序</div>
<div style="padding-top: 10px;">
    <div class="selectDiv">
        <span>服区*</span>
        <select class="serverIndex">
            <option value="0" <?php if ($_smarty_tpl->tpl_vars['serverIndex']->value == 0) {?>selected<?php }?>>选择区服</option>
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
        <span>类型*</span>
        <select class="style">
            <option value="1" <?php if ($_smarty_tpl->tpl_vars['styleIndex']->value == 1) {?>selected<?php }?>>元宝</option>
            <option value="2" <?php if ($_smarty_tpl->tpl_vars['styleIndex']->value == 2) {?>selected<?php }?>>金币</option>
        </select>
        <div class="selectDiv_submit">提交</div>
    </div>

    <div class="ReportData">
        <div class="ReportDataTitle">
            <div class="ReportDataTitle_list">角色名</div>
            <div class="ReportDataTitle_list" style="width: 240px;">账号</div>
            <div class="ReportDataTitle_list" style="width: 50px;">性别</div>
            <div class="ReportDataTitle_list" style="width: 50px;">职业</div>
            <div class="ReportDataTitle_list" style="width: 50px;<?php if ($_smarty_tpl->tpl_vars['valuesIndex']->value == 'g1') {?>background:#cccccc<?php }?>" values="g1" >等级</div>
            <div class="ReportDataTitle_list" style="width: 80px;<?php if ($_smarty_tpl->tpl_vars['valuesIndex']->value == 'g2') {?>background:#cccccc<?php }?>" values="g2">转生等级</div>
            <div class="ReportDataTitle_list" style="width: 50px;<?php if ($_smarty_tpl->tpl_vars['valuesIndex']->value == 'g3') {?>background:#cccccc<?php }?>" values="g3">金币</div>
            <div class="ReportDataTitle_list" style="width: 80px;<?php if ($_smarty_tpl->tpl_vars['valuesIndex']->value == 'g4') {?>background:#cccccc<?php }?>" values="g4">绑定金币</div>
            <div class="ReportDataTitle_list" style="width: 80px;<?php if ($_smarty_tpl->tpl_vars['valuesIndex']->value == 'g5') {?>background:#cccccc<?php }?>" values="g5">元宝</div>
            <div class="ReportDataTitle_list" style="width: 80px;<?php if ($_smarty_tpl->tpl_vars['valuesIndex']->value == 'g6') {?>background:#cccccc<?php }?>" values="g6">绑定元宝</div>
            <div class="ReportDataTitle_list" style="width: 200px;">创建时间</div>
        </div>
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
            <div class="ReportDataCenter" <?php if ($_smarty_tpl->tpl_vars['kk']->value > ($_smarty_tpl->tpl_vars['pagelength']->value-1)) {?> style="display: none"<?php }?>>
                <div class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['sChrName'];?>
</div>
                <div class="ReportDataCenter_list" style="width: 240px;"><?php echo $_smarty_tpl->tpl_vars['vv']->value['sAccount'];?>
</div>
                <div class="ReportDataCenter_list" style="width: 50px;"><?php if ($_smarty_tpl->tpl_vars['vv']->value['btSex'] == 0) {?>男<?php } else { ?>女<?php }?></div>
                <div class="ReportDataCenter_list" style="width: 50px;"><?php if ($_smarty_tpl->tpl_vars['vv']->value['btJob'] == 0) {?>战士<?php } elseif ($_smarty_tpl->tpl_vars['vv']->value['btJob'] == 1) {?>法师<?php } elseif ($_smarty_tpl->tpl_vars['vv']->value['btJob'] == 2) {?>道士<?php } else {
}?></div>
                <div class="ReportDataCenter_list" style="width: 50px;"><?php echo $_smarty_tpl->tpl_vars['vv']->value['Level'];?>
</div>
                <div class="ReportDataCenter_list" style="width: 80px;"><?php echo $_smarty_tpl->tpl_vars['vv']->value['btRelevel'];?>
</div>
                <div class="ReportDataCenter_list" style="width: 50px;"><?php echo $_smarty_tpl->tpl_vars['vv']->value['nGold'];?>
</div>
                <div class="ReportDataCenter_list" style="width: 80px;"><?php echo $_smarty_tpl->tpl_vars['vv']->value['nGameGird'];?>
</div>
                <div class="ReportDataCenter_list" style="width: 50px;"><?php echo $_smarty_tpl->tpl_vars['vv']->value['nGameGold'];?>
</div>
                <div class="ReportDataCenter_list" style="width: 80px;"><?php echo $_smarty_tpl->tpl_vars['vv']->value['nLoyal'];?>
</div>
                <div class="ReportDataCenter_list" style="width: 200px;"><?php echo date("Y-m-d H:i:s",strtotime($_smarty_tpl->tpl_vars['vv']->value['dCreateDate']));?>
</div>
            </div>
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
        <div class="ReportDataTitle">
            <?php if ($_smarty_tpl->tpl_vars['pageSum']->value >= 2 && $_smarty_tpl->tpl_vars['pageSum']->value <= 11) {?>
            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['pageSum']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['pageSum']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
            <div <?php if ($_smarty_tpl->tpl_vars['showPageInt']->value == $_smarty_tpl->tpl_vars['i']->value) {?>class="pageInt_z"<?php } else { ?>class="pageInt"<?php }?> pageInt="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</div>
            <?php }
}
?>

            <?php } elseif ($_smarty_tpl->tpl_vars['pageSum']->value > 11) {?>
            <?php if ($_smarty_tpl->tpl_vars['showPageInt']->value <= 5) {?>
            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 11+1 - (1) : 1-(11)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
            <div <?php if ($_smarty_tpl->tpl_vars['showPageInt']->value == $_smarty_tpl->tpl_vars['i']->value) {?>class="pageInt_z"<?php } else { ?>class="pageInt"<?php }?> pageInt="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</div>
            <?php }
}
?>

            <div class="pageInt_z">...</div>
            <?php } elseif ($_smarty_tpl->tpl_vars['showPageInt']->value > 5 && $_smarty_tpl->tpl_vars['showPageInt']->value <= $_smarty_tpl->tpl_vars['pageSum']->value-5) {?>
            <div class="pageInt_z">...</div>
            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['showPageIntA5']->value+1 - ($_smarty_tpl->tpl_vars['showPageIntS5']->value) : $_smarty_tpl->tpl_vars['showPageIntS5']->value-($_smarty_tpl->tpl_vars['showPageIntA5']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['showPageIntS5']->value, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
            <div <?php if ($_smarty_tpl->tpl_vars['showPageInt']->value == $_smarty_tpl->tpl_vars['i']->value) {?>class="pageInt_z"<?php } else { ?>class="pageInt"<?php }?> pageInt="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</div>
            <?php }
}
?>

            <div class="pageInt_z">...</div>
            <?php } elseif ($_smarty_tpl->tpl_vars['showPageInt']->value > $_smarty_tpl->tpl_vars['pageSumTo5']->value) {?>
            <div class="pageInt_z">...</div>
            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['pageSum']->value+1 - ($_smarty_tpl->tpl_vars['pageSumTo11']->value) : $_smarty_tpl->tpl_vars['pageSumTo11']->value-($_smarty_tpl->tpl_vars['pageSum']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['pageSumTo11']->value, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>
            <div <?php if ($_smarty_tpl->tpl_vars['showPageInt']->value == $_smarty_tpl->tpl_vars['i']->value) {?>class="pageInt_z"<?php } else { ?>class="pageInt"<?php }?> pageInt="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</div>
            <?php }
}
?>

            <?php }?>
            <?php }?>
        </div>
    </div>
</div>
<?php echo '<script'; ?>
>
    var className='<?php echo $_smarty_tpl->tpl_vars['className']->value;?>
';
    $(function(){
        $('.startDay').datetimepicker({
            lang:"ch",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });
        $('.endDay').datetimepicker({
            lang:"ch",           //语言选择中文
            format:"Y-m-d",      //格式化日期
            timepicker:false,    //关闭时间选项
            yearStart:2000,     //设置最小年份
            yearEnd:2050,        //设置最大年份
            todayButton:false    //关闭选择今天按钮
        });
        $(".selectDiv_submit").click(function(){
            var serverIndex=$(".serverIndex").val();
            var style=$(".style").val();
            if(serverIndex && style){
                $(this).html('发送中...');
                $(this).css({"background":"#616161"});
                $.get("/DUserDistribuGet/",{"serverIndex":serverIndex,"style":style,'class':className,"doingUnid":new Date().getTime()},function(data){
                    var obj = jQuery.parseJSON(data);
                    if(obj.status!=2000){
                        alert(obj.message)
                    }
                    window.location.reload();
                })
            }else{
                alert("填写必须参数！")
            }
        });
        $(".pageInt").each(function(){
            $(this).click(function(){
                var pageInt=$(this).attr('pageInt');
                $.get("/pageIntChangePage/",{"showId":pageInt,'className':className,"doingUnid":new Date().getTime()},function(data){
                    var obj = jQuery.parseJSON(data);
                    if(obj.status!=2000){
                        alert(obj.message)
                    }
                    window.location.reload();
                })
            })
        });

        $(".ReportDataTitle_list").each(function(index) {
            $(this).click(function () {
                 if(index==4 || index==5 || index==6|| index==7 || index==8 || index==9){
                     var values=$(this).attr('values');
                     $(this).css({"background":"#cccccc"});
                     $.get("/DUserDistribuStyleGet/",{'values':values,'className':className,"doingUnid":new Date().getTime()},function(data){
                         var obj = jQuery.parseJSON(data);
                         if(obj.status!=2000){
                             alert(obj.message)
                         }
                         window.location.reload();
                     })
                 }
            })
        })
    });

<?php echo '</script'; ?>
>
<?php
}
}
/*/ block_function_bbb_91928255558380495186107_80883341 */
?>
<?php
/* block_function_bbb_1988914983583804951dcdb9_53018655  file:Admin/index.html */
if (!function_exists('block_function_bbb_1988914983583804951dcdb9_53018655')) {
function block_function_bbb_1988914983583804951dcdb9_53018655($_smarty_tpl, $block) {?>
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
/*/ block_function_bbb_1988914983583804951dcdb9_53018655 */
?>
