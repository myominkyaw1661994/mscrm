<?php /* Smarty version Smarty-3.1.7, created on 2022-01-24 09:50:31
         compiled from "E:\xampp\htdocs\CSC0tester\includes\runtime/../../layouts/v7\modules\CSCProducts\DetailViewSummaryContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:81874685861ee1aff0199e4-51238594%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43eba2146775d2729c524ecd5e770f479bbd85e5' => 
    array (
      0 => 'E:\\xampp\\htdocs\\CSC0tester\\includes\\runtime/../../layouts/v7\\modules\\CSCProducts\\DetailViewSummaryContents.tpl',
      1 => 1630297195,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '81874685861ee1aff0199e4-51238594',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_61ee1aff0bbca',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_61ee1aff0bbca')) {function content_61ee1aff0bbca($_smarty_tpl) {?>

<form id="detailView" method="POST"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewWidgets.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form><?php }} ?>