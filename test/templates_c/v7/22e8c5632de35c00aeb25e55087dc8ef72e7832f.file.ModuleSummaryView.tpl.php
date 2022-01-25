<?php /* Smarty version Smarty-3.1.7, created on 2022-01-24 13:40:53
         compiled from "E:\xampp\htdocs\CSC0tester\includes\runtime/../../layouts/v7\modules\CSCSalesOrder\ModuleSummaryView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:86073981561ee50fdbe58a2-61191174%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22e8c5632de35c00aeb25e55087dc8ef72e7832f' => 
    array (
      0 => 'E:\\xampp\\htdocs\\CSC0tester\\includes\\runtime/../../layouts/v7\\modules\\CSCSalesOrder\\ModuleSummaryView.tpl',
      1 => 1634104812,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '86073981561ee50fdbe58a2-61191174',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_61ee50fdbf660',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_61ee50fdbf660')) {function content_61ee50fdbf660($_smarty_tpl) {?>

<div class="recordDetails"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewContents.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><?php }} ?>