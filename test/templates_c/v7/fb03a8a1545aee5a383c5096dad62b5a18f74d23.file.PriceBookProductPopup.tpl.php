<?php /* Smarty version Smarty-3.1.7, created on 2020-09-25 10:10:23
         compiled from "/var/www/html/maintcrm20i15/includes/runtime/../../layouts/v7/modules/Products/PriceBookProductPopup.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16921006015f6dc20f20aa39-29728569%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fb03a8a1545aee5a383c5096dad62b5a18f74d23' => 
    array (
      0 => '/var/www/html/maintcrm20i15/includes/runtime/../../layouts/v7/modules/Products/PriceBookProductPopup.tpl',
      1 => 1600071949,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16921006015f6dc20f20aa39-29728569',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'SOURCE_MODULE' => 0,
    'PARENT_MODULE' => 0,
    'SOURCE_RECORD' => 0,
    'SOURCE_FIELD' => 0,
    'GETURL' => 0,
    'MULTI_SELECT' => 0,
    'CURRENCY_ID' => 0,
    'RELATED_PARENT_MODULE' => 0,
    'RELATED_PARENT_ID' => 0,
    'VIEW' => 0,
    'RELATION_ID' => 0,
    'POPUP_CLASS_NAME' => 0,
    'LISTVIEW_ENTRIES_COUNT' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f6dc20f250da',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f6dc20f250da')) {function content_5f6dc20f250da($_smarty_tpl) {?>



<script type="text/javascript" src="<?php echo vresource_url('layouts/v7/modules/PriceBooks/resources/PriceBooksPopup.js');?>
"></script><div class="modal-dialog modal-lg"><div class="modal-content"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("ModalHeader.tpl",$_smarty_tpl->tpl_vars['MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('TITLE'=>$_smarty_tpl->tpl_vars['MODULE']->value), 0);?>
<form id="popupPage" action="javascript:void(0)"><div class="modal-body"><div id="popupPageContainer" class="contentsDiv"><input type="hidden" id="parentModule" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_MODULE']->value;?>
"/><input type="hidden" id="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
"/><input type="hidden" id="parent" value="<?php echo $_smarty_tpl->tpl_vars['PARENT_MODULE']->value;?>
"/><input type="hidden" id="sourceRecord" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_RECORD']->value;?>
"/><input type="hidden" id="sourceField" value="<?php echo $_smarty_tpl->tpl_vars['SOURCE_FIELD']->value;?>
"/><input type="hidden" id="url" value="<?php echo $_smarty_tpl->tpl_vars['GETURL']->value;?>
" /><input type="hidden" id="multi_select" value="<?php echo $_smarty_tpl->tpl_vars['MULTI_SELECT']->value;?>
" /><input type="hidden" id="currencyId" value="<?php echo $_smarty_tpl->tpl_vars['CURRENCY_ID']->value;?>
" /><input type="hidden" id="relatedParentModule" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_PARENT_MODULE']->value;?>
"/><input type="hidden" id="relatedParentId" value="<?php echo $_smarty_tpl->tpl_vars['RELATED_PARENT_ID']->value;?>
"/><input type="hidden" id="view" value="<?php echo $_smarty_tpl->tpl_vars['VIEW']->value;?>
"/><input type="hidden" id="relationId" value="<?php echo $_smarty_tpl->tpl_vars['RELATION_ID']->value;?>
" /><input type="hidden" id="selectedIds" name="selectedIds"><?php if (!empty($_smarty_tpl->tpl_vars['POPUP_CLASS_NAME']->value)){?><input type="hidden" id="popUpClassName" value="<?php echo $_smarty_tpl->tpl_vars['POPUP_CLASS_NAME']->value;?>
"/><?php }?><div id="popupContents" class=""><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('PriceBookProductPopupContents.tpl',$_smarty_tpl->tpl_vars['PARENT_MODULE']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div></div></div><div class = "modal-footer"><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRIES_COUNT']->value!='0'){?><center><footer><button class="btn btn-success addProducts" type="submit"><i class="fa fa-plus"></i>&nbsp;&nbsp;<strong><?php echo vtranslate('LBL_ADD_TO_PRICEBOOKS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></button><a class="cancelLink" data-dismiss="modal"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></footer></center><?php }?></div></form></div></div>
<?php }} ?>