<?php /* Smarty version Smarty-3.1.7, created on 2020-09-19 06:17:45
         compiled from "/var/www/html/maintcrm20i15/includes/runtime/../../layouts/v7/modules/HelpDesk/ListPriceUpdate.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12332635135f65a289b30322-38285537%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd3fd00f154a0cf13243263879b2477f3b5251007' => 
    array (
      0 => '/var/www/html/maintcrm20i15/includes/runtime/../../layouts/v7/modules/HelpDesk/ListPriceUpdate.tpl',
      1 => 1600483963,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12332635135f65a289b30322-38285537',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'HEADER_TITLE' => 0,
    'PRICEBOOK_ID' => 0,
    'REL_ID' => 0,
    'CURRENT_QTY' => 0,
    'CURRENT_PRICE' => 0,
    'USER_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f65a289b739e',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f65a289b739e')) {function content_5f65a289b739e($_smarty_tpl) {?>




<div class="modal-dialog modelContainer modal-content modal-md" id="listPriceUpdateContainer"><?php ob_start();?><?php echo vtranslate('LBL_EDIT_LIST_PRICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['HEADER_TITLE'] = new Smarty_variable($_tmp1, null, 0);?><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['HEADER_TITLE']->value), 0);?>
<form class="form-horizontal" id="listPriceUpdate" method="post" action="index.php"><div class="modal-body"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="action" value="RelationAjax" /><input type="hidden" name="src_record" value="<?php echo $_smarty_tpl->tpl_vars['PRICEBOOK_ID']->value;?>
" /><input type="hidden" name="relid" value="<?php echo $_smarty_tpl->tpl_vars['REL_ID']->value;?>
" /><div class="form-group"><label class="col-sm-4 control-label"><?php echo vtranslate('LBL_EDIT_QTY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span>&nbsp;</label><div class="controls col-sm-4"><input type="text" name="currentQty" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_QTY']->value;?>
" data-rule-required="true" class="inputElement" data-rule-currency="true"/></div></div><div class="form-group"><label class="col-sm-4 control-label"><?php echo vtranslate('LBL_EDIT_LIST_PRICE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <span class="redColor">*</span>&nbsp;</label><div class="controls col-sm-4"><input type="text" name="currentPrice" value="<?php echo $_smarty_tpl->tpl_vars['CURRENT_PRICE']->value;?>
" data-rule-required="true" class="inputElement" data-rule-currency="true"data-decimal-separator='<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_decimal_separator');?>
' data-group-separator='<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_grouping_separator');?>
' /></div></div><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalFooter.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form></div></div><?php }} ?>