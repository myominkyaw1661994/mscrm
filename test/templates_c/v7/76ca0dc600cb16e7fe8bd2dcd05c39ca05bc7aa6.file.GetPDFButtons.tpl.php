<?php /* Smarty version Smarty-3.1.7, created on 2020-10-30 10:35:18
         compiled from "F:\Project\MSCRM_Rehearsal_2\includes\runtime/../../layouts/v7\modules\PDFMaker\GetPDFButtons.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19468639015f9bec66b489d1-26259655%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '76ca0dc600cb16e7fe8bd2dcd05c39ca05bc7aa6' => 
    array (
      0 => 'F:\\Project\\MSCRM_Rehearsal_2\\includes\\runtime/../../layouts/v7\\modules\\PDFMaker\\GetPDFButtons.tpl',
      1 => 1601907276,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19468639015f9bec66b489d1-26259655',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ENABLE_PDFMAKER' => 0,
    'CRM_TEMPLATES_EXIST' => 0,
    'templateid' => 0,
    'itemArr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f9bec66b8d09',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f9bec66b8d09')) {function content_5f9bec66b8d09($_smarty_tpl) {?>

<?php if ($_smarty_tpl->tpl_vars['ENABLE_PDFMAKER']->value=='true'&&$_smarty_tpl->tpl_vars['CRM_TEMPLATES_EXIST']->value=='0'){?><div class="col-sm-4 pull-right" id="PDFMakerContentDiv"><div class="row clearfix"><div class="col-sm-6 padding0px pull-right"><div class="btn-group pull-right"><button class="btn btn-default selectPDFTemplates"><i title="<?php echo vtranslate('LBL_EXPORT_TO_PDF','PDFMaker');?>
" class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;<?php echo vtranslate('LBL_EXPORT_TO_PDF','PDFMaker');?>
</button><button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split PDFMoreAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo vtranslate('LBL_MORE','PDFMaker');?>
&nbsp;&nbsp;<span class="caret"></span></button></button><ul class="dropdown-menu"><li class="dropdown-header"><select class="form-control" name="use_common_template" id="use_common_template" multiple><?php  $_smarty_tpl->tpl_vars["itemArr"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["itemArr"]->_loop = false;
 $_smarty_tpl->tpl_vars["templateid"] = new Smarty_Variable;
 $_from = ($_smarty_tpl->tpl_vars['CRM_TEMPLATES']->value); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["itemArr"]->key => $_smarty_tpl->tpl_vars["itemArr"]->value){
$_smarty_tpl->tpl_vars["itemArr"]->_loop = true;
 $_smarty_tpl->tpl_vars["templateid"]->value = $_smarty_tpl->tpl_vars["itemArr"]->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['templateid']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['itemArr']->value['title']!=''){?>title="<?php echo $_smarty_tpl->tpl_vars['itemArr']->value['title'];?>
"<?php }?> <?php if ($_smarty_tpl->tpl_vars['itemArr']->value['is_default']=='1'||$_smarty_tpl->tpl_vars['itemArr']->value['is_default']=='3'){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['itemArr']->value['templatename'];?>
</option><?php } ?></select></li><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("GetPDFActions.tpl",'PDFMaker'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</ul></div></div></div></div></div><?php }?><?php }} ?>