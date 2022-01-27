<?php /* Smarty version Smarty-3.1.7, created on 2022-01-26 10:14:25
         compiled from "E:\xampp\htdocs\CSC0tester\includes\runtime/../../layouts/v7\modules\CSCProducts\ProductPartsSummeryWidget.tpl" */ ?>
<?php /*%%SmartyHeaderCode:211102351261ee1afe924e30-50601706%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '185a501391fb0ff95031c4f52942305cbaa94c2f' => 
    array (
      0 => 'E:\\xampp\\htdocs\\CSC0tester\\includes\\runtime/../../layouts/v7\\modules\\CSCProducts\\ProductPartsSummeryWidget.tpl',
      1 => 1643097735,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '211102351261ee1afe924e30-50601706',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_61ee1afea251d',
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'RECORD' => 0,
    'PARTS' => 0,
    'RELATED_RECORD' => 0,
    'MODULE' => 0,
    'RELATED_MODULE' => 0,
    'PAGING_MODEL' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_61ee1afea251d')) {function content_61ee1afea251d($_smarty_tpl) {?>

<?php $_smarty_tpl->tpl_vars['MODULE_NAME'] = new Smarty_variable("CSCProducts", null, 0);?><div class="summaryWidgetContainer"><div class="widget_header clearfix"><h4 class="display-inline-block pull-left"><?php echo vtranslate('LBL_PRODUCTS_PARTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</h4><?php $_smarty_tpl->tpl_vars['SOURCE_MODEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value, null, 0);?></div><div class="widget_contents"><div class="row"><span class="col-sm-3"><strong><?php echo vtranslate('LBL_CSC_PRODUCT_NO',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></span><span class="col-sm-3"><strong><?php echo vtranslate('LBL_PRODUCT_NAME',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></span><span class="col-sm-3"><strong><?php echo vtranslate('LBL_PRODUCT_AVAILABLE_STATUS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></span><span class="col-sm-3"><strong><?php echo vtranslate('LBL_PRODUCT_GROUP',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></span></div><?php if (count($_smarty_tpl->tpl_vars['PARTS']->value)!='0'){?><?php  $_smarty_tpl->tpl_vars['RELATED_RECORD'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['RELATED_RECORD']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['PARTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['RELATED_RECORD']->key => $_smarty_tpl->tpl_vars['RELATED_RECORD']->value){
$_smarty_tpl->tpl_vars['RELATED_RECORD']->_loop = true;
?><div class="recentActivitiesContainer row"><ul class="" style="padding-left: 0px;list-style-type: none;"><li><div class="" id="documentRelatedRecord pull-left"><span class="col-sm-3 textOverflowEllipsis"><a href="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE']->value;?>
_Related_Record_<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('id');?>
" title="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue('cscproduct_no');?>
"><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue('cscproduct_no');?>
</a></span><span class="col-sm-3 textOverflowEllipsis" id="DownloadableLink"><a href="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDetailViewUrl();?>
" id="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['RELATED_MODULE']->value;?>
_Related_Record_<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('id');?>
" title="<?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue('product_name');?>
"><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->getDisplayValue('product_name');?>
</a></span><span class="col-sm-3 textOverflowEllipsis" id="DownloadableLink"><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('product_available_status');?>
</span><span class="col-sm-3 textOverflowEllipsis" id="DownloadableLink"><?php echo $_smarty_tpl->tpl_vars['RELATED_RECORD']->value->get('productcategory');?>
</span><span class="col-sm-2"></span></div></li></ul></div><?php } ?><?php }else{ ?><div class="summaryWidgetContainer noContent"><p class="textAlignCenter"><?php echo vtranslate('LBL_NO_PRODUCT_PARTS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</p></div><?php }?><?php if ($_smarty_tpl->tpl_vars['PAGING_MODEL']->value->isNextPageExists()){?><div class="row"><div class="textAlignCenter"><a href="javascript:void(0)" class="moreRecentActivities"><?php echo vtranslate('LBL_SHOW_MORE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</a></div></div><?php }?></div></div><?php }} ?>