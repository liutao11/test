<?php /* Smarty version 3.1.28-dev/54, created on 2016-11-28 10:54:11
         compiled from "/mnt/hgfs/linux/IhponeServer_cgame/views/Data/LevelCountShowList.html" */ ?>
<?php
/*%%SmartyHeaderCode:1463167013583b9c53528209_30024407%%*/
$_valid = $_smarty_tpl->decodeProperties(array (
  'has_nocache_code' => false,
  'version' => '3.1.28-dev/54',
  'unifunc' => 'content_583b9c535d9146_94602560',
  'file_dependency' => 
  array (
    'd91a3d738ee17d56059c43cc1e2c30ee3c201f91' => 
    array (
      0 => '/mnt/hgfs/linux/IhponeServer_cgame/views/Data/LevelCountShowList.html',
      1 => 1466650845,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
  'isChild' => false,
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_583b9c535d9146_94602560')) {
function content_583b9c535d9146_94602560 ($_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '1463167013583b9c53528209_30024407';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        .ReportDataTitle{height: 40px;}
        .ReportDataCenter{background:#F5F5F5;border-bottom:1px solid #DEDEDE;height: 30px;}
        .ReportDataCenter_list{float: left;line-height: 30px;height: 30px;width: 150px;text-align: center;font-size: 12px;}
        .ReportDataTitle_list{float: left;line-height: 40px;height: 40px;width: 150px;text-align: center;font-size: 14px;font-weight: 600}
    </style>
</head>
<body>
<table>
    <tr class="ReportDataTitle">
        <td class="ReportDataTitle_list">角色名</td>
        <td class="ReportDataTitle_list">账号</td>
        <td class="ReportDataTitle_list">性别</td>
        <td class="ReportDataTitle_list">等级</td>
        <td class="ReportDataTitle_list">创建时间</td>
        <td class="ReportDataTitle_list">更新时间</td>
        <td class="ReportDataTitle_list">转身等级</td>
        <td class="ReportDataTitle_list">金币</td>
        <td class="ReportDataTitle_list">元宝</td>
    </tr>
<?php
$_from = $_smarty_tpl->tpl_vars['data']->value;
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
    <tr class="ReportDataCenter">
        <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['sChrName'];?>
</td>
        <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['sAccount'];?>
</td>
        <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['btSex'];?>
</td>
        <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['Level'];?>
</td>
        <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['CreateDay'];?>
</td>
        <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['UpdateDay'];?>
</td>
        <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['btRelevel'];?>
</td>
        <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['nGold'];?>
</td>
        <td class="ReportDataCenter_list"><?php echo $_smarty_tpl->tpl_vars['vv']->value['nGameGold'];?>
</td>
    </tr>
<?php
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_0_saved_local_item;
}
}
if ($__foreach_vv_0_saved_item) {
$_smarty_tpl->tpl_vars['vv'] = $__foreach_vv_0_saved_item;
}
?>

</table>

</body>
</html><?php }
}
?>