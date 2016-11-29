<?php /* Smarty version 3.1.28-dev/54, created on 2016-11-07 19:38:04
         compiled from "/mnt/hgfs/linux/IhponeServer_cgame/views/From/FUserRetention.html" */ ?>
<?php
/*%%SmartyHeaderCode:6077781945820679ca4ce15_82062858%%*/
$_valid = $_smarty_tpl->decodeProperties(array (
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/54',
  'unifunc' => 'content_5820679cc667d7_77002212',
  'file_dependency' => 
  array (
    'd30bddeb6f47c9c0eb2fc82137495e16d41b5c17' => 
    array (
      0 => '/mnt/hgfs/linux/IhponeServer_cgame/views/From/FUserRetention.html',
      1 => 1478518673,
      2 => 'file',
    ),
    'e5c4e938efeade7c59ea10c55815a212f15abfad' => 
    array (
      0 => '/mnt/hgfs/linux/IhponeServer_cgame/views/From/index.html',
      1 => 1466661599,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:From/index.html' => 1,
  ),
  'isChild' => true,
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5820679cc667d7_77002212')) {
function content_5820679cc667d7_77002212 ($_smarty_tpl) {
ob_start();
$_smarty_tpl->compiled->nocache_hash = '6077781945820679ca4ce15_82062858';
?>

<?php 
$_smarty_tpl->_Block->registerBlock($_smarty_tpl, array('caching' => false, 'function' => 'block_function_bbb_5519361685820679cc2f951_29202023', 'name' => 'bbb'));
ob_end_clean();
/*  Call merged included template "From/index.html" */
$_smarty_tpl->_Inline->renderInline($_smarty_tpl, 'From/index.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 1, false, false, 'content_5820679cc39828_02265179', 'e5c4e938efeade7c59ea10c55815a212f15abfad');
/*  End of included template "From/index.html" */
}
}
?><?php
/*%%SmartyHeaderCode:6077781945820679ca4ce15_82062858%%*/
/* file:From/index.html */
if ($_valid && !is_callable('content_5820679cc39828_02265179')) {
function content_5820679cc39828_02265179 ($_smarty_tpl) {
?>
<?php
$_smarty_tpl->compiled->nocache_hash = '6077781945820679ca4ce15_82062858';
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
        .tt_right{float: right;margin-top: 10px;width: 150px;border-radius: 6px;background: #ffffff;height: 30px;margin-right: 30px;cursor: pointer}
        .ren_icon{height:15px;width: 15px;background: url("/views/img/iconC.png") -168px 0;float: left;margin:7px 10px 0 5px;}
        .tt_right_tt{float: left;font-size: 12px;line-height: 30px;}
        .select_icon{float: right;width: 20px;height: 30px;border-radius: 0 6px 6px 0;background: url("/views/img/select2.png") no-repeat #DEDEDE;}
        select,input{border: 1px solid #cccccc}
        .indexSpan{color:#438EB9;font-size: 18px;line-height: 27px;}
        .roleMessage{float: left;line-height: 30px;height: 30px;margin-top: 10px;}
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



        <div class="roleMessage"><?php echo $_smarty_tpl->tpl_vars['fromInfoS']->value;?>
</div>

        <div class="ttright">
            <div class="tt_right">
                <div class="ren_icon"></div>
                <div class="tt_right_tt"><?php echo $_smarty_tpl->tpl_vars['userName']->value;?>
,欢迎光临</div>
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
            <div class="list_x" style="border-radius: 8px 8px 0 0;">
                <div class="icon0"></div>
                <div class="list_x_tt">首 页</div>
            </div>
            <div class="list_m" <?php if ($_smarty_tpl->tpl_vars['xx']->value == 'e1') {?>style="display: block "<?php }?>>
                <div class="list_m_title"><div class='list_icon1'></div>首页</div>
                <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'a1') {?>style="display: block "<?php }?>>
                    <div class="list_m_list" ><a href="/FIndexFrom/?xx=e1&zz=a1&yy=1" >首页统计</a></div>
                </div>
            </div>
            <div class="list_x" style="border-radius: 8px 8px 0 0;">
                <div class="icon0"></div>
                <div class="list_x_tt">数 据</div>
            </div>
            <div class="list_m" <?php if ($_smarty_tpl->tpl_vars['xx']->value == 'e2') {?>style="display: block "<?php }?>>
                <div class="list_m_title"><div class='list_icon1'></div>运营数据</div>
                <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'e2a1') {?>style="display: block "<?php }?>>
                    <div class="list_m_list" ><a href="/FImportUser/?xx=e2&zz=e2a1&yy=1" >导入用户</a></div>
                    <div class="list_m_list" ><a href="/FUserRetention/?xx=e2&zz=e2a1&yy=1" >留存率</a></div>
                </div>
                <div class="list_m_title"><div class='list_icon1'></div>充值数据</div>
                <div class="list_m_select" <?php if ($_smarty_tpl->tpl_vars['zz']->value == 'e2c1') {?>style="display: block "<?php }?>>
                   <div class="list_m_list" ><a href="/FAllPayReport/?xx=e2&zz=e2c1&yy=1" >全服充值数据</a></div>
                   <div class="list_m_list" ><a href="/FPayListSelect/?xx=e2&zz=e2c1&yy=2" >充值订单</a></div>
                </div>
            </div>
        </div>
        <div class="right">
            <?php 
$_smarty_tpl->_Block->callBlock($_smarty_tpl, array('caching' => false, 'function' => 'block_function_bbb_17282355535820679cc584d2_59990319', 'name' => 'bbb'));
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
/*/%%SmartyNocache:6077781945820679ca4ce15_82062858%%*/
}
}
?><?php
/* block_function_bbb_5519361685820679cc2f951_29202023  file:From/FUserRetention.html */
if (!function_exists('block_function_bbb_5519361685820679cc2f951_29202023')) {
function block_function_bbb_5519361685820679cc2f951_29202023($_smarty_tpl, $block) {?>
<?php echo '<script'; ?>
 src="/views/dataTimeStyle/jquery.datetimepicker.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="/views/dataTimeStyle/jquery.datetimepicker.css" type="text/css" />
<style>
    .page_title{font-size: 14px;color: #438EB9;margin: 10px 0 0 0;height: 35px;line-height: 35px;background:#FAFAFA ;border: 1px solid #DEDEDE;border-radius: 6px;padding-left: 10px;}
    .page_title span{font-size: 18px;color: #438EB9;padding-left: 10px;height: 40px;line-height: 40px;font-weight: bold}
    .selectDiv{height: 50px;}
    .selectDiv span{display: block;float: left;line-height: 50px;height: 50px;margin-left: 10px;}
    .selectDiv select{display: block;float: left;margin-top: 10px;height: 30px;width: 150px;line-height: 30px;margin-left: 10px;}
    .selectDiv input{display: block;float: left;height: 28px;width: 150px;margin: 10px 0 0 10px;}
    .selectDiv_submit{float: left;height: 28px;margin-top: 10px;margin-left: 20px;background:#438EB9;color: #ffffff;line-height: 30px;text-align: center;width: 100px;font-size: 12px;cursor: pointer}
    .payList span{color:#438EB9}
    .ReportData{box-shadow: 0 4px 5px rgba(0, 0, 0, 0.15);border: 1px solid #DEDEDE;border-radius: 5px;padding-left: 10px;padding-right:10px; }
    .ReportDataTitle{height: 40px;}
    .ReportDataTitle_list{float: left;line-height: 40px;height: 40px;width: 150px;text-align: center;font-size: 14px;font-weight: 600}
    .ReportDataCenter{background:#F5F5F5;border-bottom:1px solid #DEDEDE;height: 30px;line-height: 30px;}
    .ReportDataCenter_list{float: left;line-height: 30px;height: 30px;width: 150px;text-align: center;font-size: 12px;}
</style>

<div class="page_title"><span><?php echo $_smarty_tpl->tpl_vars['objectName']->value;?>
</span> 平台->运营数据->用户留存率</div>
<div style="padding-top: 10px;">
    <div class="selectDiv">
        <span>服区*</span>
        <select class="serverIndex">
            <option value="0" <?php if ($_smarty_tpl->tpl_vars['serverIndex']->value == 0) {?>selected<?php }?>>选择服区</option>
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

    <table class="ReportData">
        <tr class="ReportDataTitle">
            <td class="ReportDataTitle_list">日期</td>
            <td class="ReportDataTitle_list">新建用户(人)</td>
            <td class="ReportDataTitle_list">+1留存率（%）</td>
            <td class="ReportDataTitle_list">+2留存率（%）</td>
            <td class="ReportDataTitle_list">+3留存率（%）</td>
            <td class="ReportDataTitle_list">+4留存率（%）</td>
            <td class="ReportDataTitle_list">+5留存率（%）</td>
            <td class="ReportDataTitle_list">+6留存率（%）</td>
            <td class="ReportDataTitle_list">+14日留存（%）</td>
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
                <tr class="ReportDataCenter">
                    <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['date'];?>
</td>
                    <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['thisUserSum'];?>
</td>
                    <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['CDayUserSumLV'];?>
</td>
                    <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['SDayUserSumLV'];?>
</td>
                    <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['DDayUserSumLV'];?>
</td>
                    <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['WDayUserSumLV'];?>
</td>
                    <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['EDayUserSumLV'];?>
</td>
                    <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['ZDayUserSumLV'];?>
</td>
                    <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['SWDayUserSumLV'];?>
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
        <tr class="ReportDataCenter"><td>没有数据！</td></tr>
        <?php }?>

        <tr class="ReportDataTitle">
            <tr class="ReportDataTitle">
                <td class="ReportDataTitle_list">汇总</td>
                <td class="ReportDataTitle_list"></td>
                <td class="ReportDataTitle_list"><?php echo $_smarty_tpl->tpl_vars['UserDayLV1']->value;?>
</td>
                <td class="ReportDataTitle_list"><?php echo $_smarty_tpl->tpl_vars['UserDayLV2']->value;?>
</td>
                <td class="ReportDataTitle_list"><?php echo $_smarty_tpl->tpl_vars['UserDayLV3']->value;?>
</td>
                <td class="ReportDataTitle_list"><?php echo $_smarty_tpl->tpl_vars['UserDayLV4']->value;?>
</td>
                <td class="ReportDataTitle_list"><?php echo $_smarty_tpl->tpl_vars['UserDayLV5']->value;?>
</td>
                <td class="ReportDataTitle_list"><?php echo $_smarty_tpl->tpl_vars['UserDayLV6']->value;?>
</td>
                <td class="ReportDataTitle_list"><?php echo $_smarty_tpl->tpl_vars['UserDayLV14']->value;?>
</td>
            </tr>
        </tr>

    </table>
</div>
<?php echo '<script'; ?>
>
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
            var startDay=$(".startDay").val();
            var endDay=$(".endDay").val();
            if(startDay && endDay && serverIndex){
                $(this).html('发送中...');
                $(this).css({"background":"#616161"});
                $.get("/FUserRetentionGet/",{"serverIndex":serverIndex,"startDay":startDay,'endDay':endDay},function(data){
                    var obj = jQuery.parseJSON(data);
                    if(obj.status!=2000){
                        alert(obj.message)
                    }
                    window.location.reload();
                })
            }else{
                alert("填写必须参数！")
            }

        })
    });

<?php echo '</script'; ?>
>
<?php
}
}
/*/ block_function_bbb_5519361685820679cc2f951_29202023 */
?>
<?php
/* block_function_bbb_17282355535820679cc584d2_59990319  file:From/index.html */
if (!function_exists('block_function_bbb_17282355535820679cc584d2_59990319')) {
function block_function_bbb_17282355535820679cc584d2_59990319($_smarty_tpl, $block) {?>
            <div class="title">首页</div>
            <div class="title_index_center">
                <div class="title_index_yh">欢迎来到本后台管理系统！</div>
                <p>您好，<span class="indexSpan"><?php echo $_smarty_tpl->tpl_vars['userName']->value;?>
</span>，您的角色是<span class="indexSpan"><?php echo $_smarty_tpl->tpl_vars['fromInfoS']->value;?>
</span>渠道管理。</p>
                <p>这里是高级管理界面。</p>
                <p>请从页面左上方的下拉框选择管理界面，从左侧的菜单选择功能。或者点选以下快捷链接</p>
            </div>
            <?php
}
}
/*/ block_function_bbb_17282355535820679cc584d2_59990319 */
?>
