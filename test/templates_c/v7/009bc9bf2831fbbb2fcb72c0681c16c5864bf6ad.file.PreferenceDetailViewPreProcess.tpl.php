<?php /* Smarty version Smarty-3.1.7, created on 2022-01-27 16:17:19
         compiled from "E:\xampp\htdocs\CSC0tester\includes\runtime/../../layouts/v7\modules\Users\PreferenceDetailViewPreProcess.tpl" */ ?>
<?php /*%%SmartyHeaderCode:79673299761f26a271bde68-61195064%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '009bc9bf2831fbbb2fcb72c0681c16c5864bf6ad' => 
    array (
      0 => 'E:\\xampp\\htdocs\\CSC0tester\\includes\\runtime/../../layouts/v7\\modules\\Users\\PreferenceDetailViewPreProcess.tpl',
      1 => 1601907276,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '79673299761f26a271bde68-61195064',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_61f26a2777ef4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_61f26a2777ef4')) {function content_61f26a2777ef4($_smarty_tpl) {?>

<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("SettingsMenuStart.tpl",$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<div class="bodyContents"><div class=""><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("PreferenceDetailViewHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>