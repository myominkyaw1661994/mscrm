<?php /* Smarty version Smarty-3.1.7, created on 2020-10-29 02:26:40
         compiled from "F:\Project\MSCRM_Rehearsal\includes\runtime/../../layouts/v7\modules\PDFMaker\DetailViewHeaderTitle.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4228390105f9a28608b8223-13394847%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a854e51c74226588f5aaef1382101db0eaf10cf8' => 
    array (
      0 => 'F:\\Project\\MSCRM_Rehearsal\\includes\\runtime/../../layouts/v7\\modules\\PDFMaker\\DetailViewHeaderTitle.tpl',
      1 => 1601907276,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4228390105f9a28608b8223-13394847',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'MODULE_NAME' => 0,
    'SELECTED_MENU_CATEGORY' => 0,
    'RECORD' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f9a28608e323',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f9a28608e323')) {function content_5f9a28608e323($_smarty_tpl) {?>
<div class="col-lg-6 col-md-6 col-sm-6"><div class="record-header clearfix"><?php if (!$_smarty_tpl->tpl_vars['MODULE']->value){?><?php $_smarty_tpl->tpl_vars['MODULE'] = new Smarty_variable($_smarty_tpl->tpl_vars['MODULE_NAME']->value, null, 0);?><?php }?><div class="hidden-sm hidden-xs recordImage bg_<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
 app-<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
"><div class="name"><span><strong><i class="vicon-<?php echo strtolower($_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i></strong></span></div></div><div class="recordBasicInfo"><div class="info-row"><h4><span class="recordLabel pushDown" title="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();?>
"><span><?php echo $_smarty_tpl->tpl_vars['RECORD']->value->getName();?>
</span>&nbsp;</span></h4></div><div class="info-row"><span class="modulename_label"><?php echo vtranslate('LBL_MODULENAMES',$_smarty_tpl->tpl_vars['MODULE']->value);?>
:</span>&nbsp;<?php echo vtranslate($_smarty_tpl->tpl_vars['RECORD']->value->get('module'),$_smarty_tpl->tpl_vars['RECORD']->value->get('module'));?>
</div></div></div></div><?php }} ?>