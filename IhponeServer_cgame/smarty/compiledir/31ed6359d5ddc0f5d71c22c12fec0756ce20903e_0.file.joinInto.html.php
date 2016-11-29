<?php /* Smarty version 3.1.28-dev/54, created on 2016-11-07 19:18:01
         compiled from "/mnt/hgfs/linux/IhponeServer_cgame/views/Admin/joinInto.html" */ ?>
<?php
/*%%SmartyHeaderCode:1334135492582062e98543c5_53346819%%*/
$_valid = $_smarty_tpl->decodeProperties(array (
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/54',
  'unifunc' => 'content_582062e98bff96_30064617',
  'file_dependency' => 
  array (
    '31ed6359d5ddc0f5d71c22c12fec0756ce20903e' => 
    array (
      0 => '/mnt/hgfs/linux/IhponeServer_cgame/views/Admin/joinInto.html',
      1 => 1473400788,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
  'isChild' => false,
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_582062e98bff96_30064617')) {
function content_582062e98bff96_30064617 ($_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1334135492582062e98543c5_53346819';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <style>
        body{background: url("/views/img/join_bj.jpg") center 0 #63a7e6}
        .title{text-align: center;font-size: 28px;height: 60px;color: #FFFFFF;}
        .content{width: 600px;height: 270px;margin: 0 auto;    border: 1px solid rgba(0, 0, 0, 0.05);  background-color: #f5f5f5;box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);border-radius: 4px;}
        .inputtile{color:  #438EB9;margin-top: 20px;margin-left: 20px;clear: both;height: 30px;}
        .cha{background: url("/views/img/chabei.png") no-repeat;height: 30px;width: 30px;float: left;}
        .message{float: left;line-height: 30px;height: 30px;font-size: 13px;}
        .input_div{height: 60px;}
        .inputlist{display: block;width: 240px;height: 30px;margin-top: 20px;margin-left: 10px;border-radius: 4px;border: 1px solid #cccccc;font-size: 13px;float: left;padding-left: 5px;line-height: 30px;}
        .inputsubmit{display: block;background: #438EB9;color: #ffffff;font-size: 14px;line-height: 30px;height: 30px;width: 210px;border: none;margin:20px auto 0 auto;cursor:pointer;border-radius: 4px;}
        .user_icon{height:32px;width: 32px;background: url("/views/img/iconC.png") -160px 8px no-repeat;float: left;margin:7px 10px 0 5px;border: #cccccc 1px solid;margin-top: 20px;border-radius: 4px;margin-left: 50px;}
        .password_icon{height:32px;width: 32px;background: url("/views/img/iconC.png") -280px -17px no-repeat;float: left;margin:7px 10px 0 5px;border: #cccccc 1px solid;margin-top: 20px;border-radius: 4px;margin-left: 50px;}
    </style>
    <?php echo '<script'; ?>
 src="/views/js/jquery-1.7.2.min.js"><?php echo '</script'; ?>
>
</head>
<body style="padding-top: 200px;">
    <div class="title">后台管理系统</div>
    <div class="content">
        <div class="inputtile">
            <div class="cha"></div>
            <div class="message">请输入你的账户和密码信息。</div>
        </div>
        <form method="post" action="/Login/">
            <div class="input_div">
                <div class="user_icon"></div>
                <input type="text" name="name" class="inputlist" placeholder="登入账号名" >
            </div>
            <div class="input_div">
                <div class="password_icon"></div>
                <input type="password" name="password" class="inputlist" placeholder="登录密码">
            </div>
            <div class="input_div">
                <input type="submit" class="inputsubmit" value="登录" >
            </div>
        </form>
    </div>

    <?php echo '<script'; ?>
>
        $(function(){
            $("input").each(function(index){
                $(this).blur(function(){
                    $(this).css({"border":' #438EB9 1px solid '})
                })
            });
            $(".inputsubmit").click(function(index){
                $(this).css({"background":"#DEDEDE"});
            });
            var window_y=$(window).height();
            $("body").css({paddingTop:(window_y-420)/2+"px"})
        });
    <?php echo '</script'; ?>
>
</body>
</html><?php }
}
?>