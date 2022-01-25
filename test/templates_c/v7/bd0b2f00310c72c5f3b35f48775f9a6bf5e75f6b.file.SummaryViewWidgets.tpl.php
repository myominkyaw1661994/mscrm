<?php /* Smarty version Smarty-3.1.7, created on 2022-01-24 13:40:54
         compiled from "E:\xampp\htdocs\CSC0tester\includes\runtime/../../layouts/v7\modules\CSCSalesOrder\SummaryViewWidgets.tpl" */ ?>
<?php /*%%SmartyHeaderCode:90184497361ee50fe01b319-59336179%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd0b2f00310c72c5f3b35f48775f9a6bf5e75f6b' => 
    array (
      0 => 'E:\\xampp\\htdocs\\CSC0tester\\includes\\runtime/../../layouts/v7\\modules\\CSCSalesOrder\\SummaryViewWidgets.tpl',
      1 => 1635323014,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '90184497361ee50fe01b319-59336179',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'MODULE_SUMMARY' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_61ee50fe0e5ed',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_61ee50fe0e5ed')) {function content_61ee50fe0e5ed($_smarty_tpl) {?>

<div class="left-block col-lg-5"><div class="summaryView"><div class="summaryViewHeader"><h4><?php echo vtranslate('LBL_KEY_FIELDS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4></div><div class="summaryViewFields"><?php echo $_smarty_tpl->tpl_vars['MODULE_SUMMARY']->value;?>
</div></div></div><?php }} ?>