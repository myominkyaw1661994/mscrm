<?php /* Smarty version Smarty-3.1.7, created on 2022-01-24 13:42:08
         compiled from "E:\xampp\htdocs\CSC0tester\includes\runtime/../../layouts/v7\modules\CSCSalesOrder\DetailViewFullContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:107591064161ee51486e1294-42153256%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bffcf54c8b10d71d87c3289af1caf8c672353c1f' => 
    array (
      0 => 'E:\\xampp\\htdocs\\CSC0tester\\includes\\runtime/../../layouts/v7\\modules\\CSCSalesOrder\\DetailViewFullContents.tpl',
      1 => 1635324442,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '107591064161ee51486e1294-42153256',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'RECORD_STRUCTURE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_61ee51488d90e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_61ee51488d90e')) {function content_61ee51488d90e($_smarty_tpl) {?>

<form id="detailView" method="POST">
    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('DetailViewBlockView.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0);?>

   
</form>
<?php }} ?>