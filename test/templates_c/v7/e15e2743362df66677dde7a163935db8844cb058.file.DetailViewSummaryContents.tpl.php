<?php /* Smarty version Smarty-3.1.7, created on 2022-01-24 13:40:53
         compiled from "E:\xampp\htdocs\CSC0tester\includes\runtime/../../layouts/v7\modules\CSCSalesOrder\DetailViewSummaryContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:203400220861ee50fdea98a4-15672312%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e15e2743362df66677dde7a163935db8844cb058' => 
    array (
      0 => 'E:\\xampp\\htdocs\\CSC0tester\\includes\\runtime/../../layouts/v7\\modules\\CSCSalesOrder\\DetailViewSummaryContents.tpl',
      1 => 1634104761,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '203400220861ee50fdea98a4-15672312',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_61ee50fe00d03',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_61ee50fe00d03')) {function content_61ee50fe00d03($_smarty_tpl) {?>


<form id="detailView" method="POST"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewWidgets.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form><?php }} ?>