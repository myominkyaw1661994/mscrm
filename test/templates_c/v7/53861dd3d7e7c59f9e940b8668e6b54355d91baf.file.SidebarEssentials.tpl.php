<?php /* Smarty version Smarty-3.1.7, created on 2021-06-24 10:13:54
         compiled from "F:\Project\MSCRM_Release\includes\runtime/../../layouts/v7\modules\ITS4YouReports\partials\SidebarEssentials.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12321736845f9fc1941cc4a6-32627582%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '53861dd3d7e7c59f9e940b8668e6b54355d91baf' => 
    array (
      0 => 'F:\\Project\\MSCRM_Release\\includes\\runtime/../../layouts/v7\\modules\\ITS4YouReports\\partials\\SidebarEssentials.tpl',
      1 => 1624506040,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12321736845f9fc1941cc4a6-32627582',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f9fc194232d8',
  'variables' => 
  array (
    'NO_LICENSE' => 0,
    'MODULE' => 0,
    'FOLDERS' => 0,
    'FOLDER' => 0,
    'VIEWNAME' => 0,
    'FOLDERID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f9fc194232d8')) {function content_5f9fc194232d8($_smarty_tpl) {?>

<?php if (1==$_smarty_tpl->tpl_vars['NO_LICENSE']->value){?><script type="text/javascript">jQuery('#sidebar-essentials').remove()</script><?php }else{ ?><div class="sidebar-menu sidebar-menu-full"><div class="module-filters" id="module-filters"><div class="sidebar-container lists-menu-container"><div class="sidebar-header clearfix" style="<?php if ('List'==$_REQUEST['view']){?>border-bottom:2px solid;<?php }?>"><h5 class="pull-left"><?php echo vtranslate('LBL_LIST_VIEW',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h5><button id="keyMetricsList" onclick='window.location.href="index.php?module=ITS4YouReports&view=List"' class="btn btn-default pull-right sidebar-btn" title="<?php echo vtranslate('LBL_KEY_METRICS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><div class="fa fa-chevron-right"></div></button></div><div class="sidebar-header clearfix" style="<?php if ('KeyMetricsList'==$_REQUEST['view']){?>border-bottom:2px solid;<?php }?>"><h5 class="pull-left"><?php echo vtranslate('LBL_KEY_METRICS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h5><button id="keyMetricsList" onclick='window.location.href="index.php?module=ITS4YouReports&view=KeyMetricsList"' class="btn btn-default pull-right sidebar-btn" title="<?php echo vtranslate('LBL_KEY_METRICS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><div class="fa fa-chevron-right"></div></button></div><?php if ('List'===$_REQUEST['view']){?><div class="sidebar-header clearfix"><h5 class="pull-left"><?php echo vtranslate('LBL_FOLDERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h5><button id="createFilter" onclick='ITS4YouReports_List_Js.triggerAddFolder("index.php?module=ITS4YouReports&view=EditFolder");' class="btn btn-default pull-right sidebar-btn" title="<?php echo vtranslate('LBL_ADD_NEW_FOLDER',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><div class="fa fa-plus" aria-hidden="true"></div></button></div><hr><div><input class="search-list" type="text" placeholder="<?php echo vtranslate('LBL_SEARCH_FOR_FOLDERS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></div><div class="menu-scroller mCustomScrollBox" data-mcs-theme="dark"><div class="mCustomScrollBox mCS-light-2 mCSB_inside" tabindex="0"><div class="mCSB_container" style="position:relative; top:0; left:0;"><div class="list-menu-content"><div class="list-group"><ul class="lists-menu"><li style="font-size:12px;" class="listViewFilter" ><a href="#" class='filterName' data-filter-id="All"><i class="fa fa-folder foldericon"></i>&nbsp;<?php echo vtranslate('LBL_ALL_REPORTS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><?php  $_smarty_tpl->tpl_vars['FOLDER'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['FOLDER']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['FOLDERS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["folderview"]['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['FOLDER']->key => $_smarty_tpl->tpl_vars['FOLDER']->value){
$_smarty_tpl->tpl_vars['FOLDER']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["folderview"]['iteration']++;
?><li style="font-size:12px;" class="listViewFilter <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['folderview']['iteration']>18){?> filterHidden hide<?php }?>" ><?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['FOLDER']->value->getName(),$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['VIEWNAME'] = new Smarty_variable($_tmp1, null, 0);?><a href="#" class='filterName' data-filter-id=<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->getId();?>
><i class="fa fa-folder foldericon"></i>&nbsp;<?php ob_start();?><?php echo strlen($_smarty_tpl->tpl_vars['VIEWNAME']->value)>50;?>
<?php $_tmp2=ob_get_clean();?><?php if ($_tmp2){?><?php echo substr($_smarty_tpl->tpl_vars['VIEWNAME']->value,0,45);?>
..<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['VIEWNAME']->value;?>
<?php }?></a><?php if (''!==$_smarty_tpl->tpl_vars['FOLDER']->value->getDescription()){?><i class="fa fa-info-circle" title="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->getDescription();?>
"></i><?php }?><div class="pull-right"><?php if ($_smarty_tpl->tpl_vars['FOLDER']->value->isEditable()&&$_smarty_tpl->tpl_vars['FOLDER']->value->isDeletable()){?><?php $_smarty_tpl->tpl_vars["FOLDERID"] = new Smarty_variable($_smarty_tpl->tpl_vars['FOLDER']->value->get('folderid'), null, 0);?><span class="js-popover-container"><span class="fa fa-angle-down" data-id="<?php echo $_smarty_tpl->tpl_vars['FOLDERID']->value;?>
" data-deletable="true" data-editable="true" rel="popover" data-toggle="popover" data-deleteurl="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->getDeleteUrl();?>
" data-editurl="<?php echo $_smarty_tpl->tpl_vars['FOLDER']->value->getEditUrl();?>
" data-toggle="dropdown" aria-expanded="true"></span></span><?php }?></div></li><?php } ?></ul><div id="filterActionPopoverHtml"><ul class="listmenu hide" role="menu"><li role="presentation" class="editFilter"><a role="menuitem"><i class="fa fa-pencil-square-o"></i>&nbsp;<?php echo vtranslate('LBL_EDIT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li><li role="presentation" class="deleteFilter"><a role="menuitem"><i class="fa fa-trash"></i>&nbsp;<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></li></ul></div><h5 class="toggleFilterSize" data-more-text="<?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
.." data-less-text="<?php echo vtranslate('LBL_LESS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
.."><?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['folderview']['iteration']>18){?><?php echo vtranslate('LBL_MORE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
..<?php }?></h5></div></div></div></div></div><?php }?></div></div></div><?php }?><?php }} ?>