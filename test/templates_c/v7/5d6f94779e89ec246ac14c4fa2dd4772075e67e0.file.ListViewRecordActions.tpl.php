<?php /* Smarty version Smarty-3.1.7, created on 2022-01-24 15:35:17
         compiled from "E:\xampp\htdocs\CSC0tester\includes\runtime/../../layouts/v7\modules\Vtiger\ListViewRecordActions.tpl" */ ?>
<?php /*%%SmartyHeaderCode:57939170761ea4ad82520c7-22250422%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5d6f94779e89ec246ac14c4fa2dd4772075e67e0' => 
    array (
      0 => 'E:\\xampp\\htdocs\\CSC0tester\\includes\\runtime/../../layouts/v7\\modules\\Vtiger\\ListViewRecordActions.tpl',
      1 => 1635737405,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '57939170761ea4ad82520c7-22250422',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_61ea4ad8333f6',
  'variables' => 
  array (
    'SEARCH_MODE_RESULTS' => 0,
    'LISTVIEW_ENTRY' => 0,
    'MODULE' => 0,
    'QUICK_PREVIEW_ENABLED' => 0,
    'SELECTED_MENU_CATEGORY' => 0,
    'MODULE_MODEL' => 0,
    'STARRED' => 0,
    'RECORD_ACTIONS' => 0,
    'IS_EDIT' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_61ea4ad8333f6')) {function content_61ea4ad8333f6($_smarty_tpl) {?>
<!--LIST VIEW RECORD ACTIONS--><div class="table-actions"><?php if (!$_smarty_tpl->tpl_vars['SEARCH_MODE_RESULTS']->value){?><span class="input" ><input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" class="listViewEntriesCheckBox"/></span><?php }?><?php if ($_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('starred')==vtranslate('LBL_YES',$_smarty_tpl->tpl_vars['MODULE']->value)){?><?php $_smarty_tpl->tpl_vars['STARRED'] = new Smarty_variable(true, null, 0);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['STARRED'] = new Smarty_variable(false, null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['QUICK_PREVIEW_ENABLED']->value=='true'){?><span><a class="quickView fa fa-eye icon action" data-app="<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
" title="<?php echo vtranslate('LBL_QUICK_VIEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></a></span><?php }?><?php if ($_smarty_tpl->tpl_vars['MODULE_MODEL']->value->isStarredEnabled()){?><span><a class="markStar fa icon action <?php if ($_smarty_tpl->tpl_vars['STARRED']->value){?> fa-star active <?php }else{ ?> fa-star-o<?php }?>" title="<?php if ($_smarty_tpl->tpl_vars['STARRED']->value){?> <?php echo vtranslate('LBL_STARRED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php }else{ ?> <?php echo vtranslate('LBL_NOT_STARRED',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?>"></a></span><?php }?><span class="more dropdown action"><span href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v icon"></i></span><ul class="dropdown-menu"><li><a data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" href="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getFullDetailViewUrl();?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
"><?php echo vtranslate('LBL_DETAILS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php if ($_smarty_tpl->tpl_vars['RECORD_ACTIONS']->value){?><?php if ($_smarty_tpl->tpl_vars['RECORD_ACTIONS']->value['edit']&&!($_smarty_tpl->tpl_vars['IS_EDIT']->value&&(($_smarty_tpl->tpl_vars['MODULE']->value=='PurchaseOrder'&&$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('approve')=='Yes')||($_smarty_tpl->tpl_vars['MODULE']->value=='Invoice'&&$_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->get('invoicestatus')=='Paid')))&&$_smarty_tpl->tpl_vars['MODULE']->value!='CSCProducts'&&$_smarty_tpl->tpl_vars['MODULE']->value!='CSCSalesOrder'){?><li><a data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" href="javascript:void(0);" data-url="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getEditViewUrl();?>
&app=<?php echo $_smarty_tpl->tpl_vars['SELECTED_MENU_CATEGORY']->value;?>
" name="editlink"><?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php }?><?php if ($_smarty_tpl->tpl_vars['RECORD_ACTIONS']->value['delete']&&$_smarty_tpl->tpl_vars['MODULE']->value!='CSCSalesOrder'){?><li><a data-id="<?php echo $_smarty_tpl->tpl_vars['LISTVIEW_ENTRY']->value->getId();?>
" href="javascript:void(0);" class="deleteRecordButton"><?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php }?><?php }?></ul></span><div class="btn-group inline-save hide"><?php if ($_smarty_tpl->tpl_vars['MODULE']->value!='CSCProducts'&&$_smarty_tpl->tpl_vars['MODULE']->value!='CSCSalesOrder'){?><button class="button btn-success btn-small save" type="button" name="save"><i class="fa fa-check"></i></button><?php }?><button class="button btn-danger btn-small cancel" type="button" name="Cancel"><i class="fa fa-close"></i></button></div></div>
<?php }} ?>