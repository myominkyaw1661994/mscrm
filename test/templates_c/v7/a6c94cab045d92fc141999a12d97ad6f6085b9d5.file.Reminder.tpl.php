<?php /* Smarty version Smarty-3.1.7, created on 2020-09-19 05:04:05
         compiled from "/var/www/html/maintcrm20i15/includes/runtime/../../layouts/v7/modules/Settings/ITS4YouInstaller/Reminder.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1672622775f6591457cc343-62605417%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6c94cab045d92fc141999a12d97ad6f6085b9d5' => 
    array (
      0 => '/var/www/html/maintcrm20i15/includes/runtime/../../layouts/v7/modules/Settings/ITS4YouInstaller/Reminder.tpl',
      1 => 1600491838,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1672622775f6591457cc343-62605417',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'QUALIFIED_MODULE' => 0,
    'ALERTS' => 0,
    'ALERT' => 0,
    'MODULE_MODEL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_5f659145812f9',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5f659145812f9')) {function content_5f659145812f9($_smarty_tpl) {?>
<li class="its4you_installer_menu"><div class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><a href="#" class="installer_icon"><div class="its4you_installer_badge numberCircle hide"></div></a></div><ul class="dropdown-menu its4you_installer_dropdown"><div id="its4you_installer_title"><div class="its4you_installer_icon"></div><div class="its4you_installer_text"><b><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_ALERTS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></div></div><hr><div style="padding:5px 15px"><div class="its4you_installer_alerts"><?php  $_smarty_tpl->tpl_vars['ALERT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ALERT']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALERTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ALERT']->key => $_smarty_tpl->tpl_vars['ALERT']->value){
$_smarty_tpl->tpl_vars['ALERT']->_loop = true;
?><div class="its4you_installer_alert clearfix <?php if ($_smarty_tpl->tpl_vars['ALERT']->value['status']!=1){?>installer_new_alert<?php }?>"><div class="pull-left installer_alert_icon"><i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['ALERT']->value['icon'];?>
"></i></div><div class="pull-left" style="max-width: 300px;"><div><b><?php echo vtranslate($_smarty_tpl->tpl_vars['ALERT']->value['alert_type'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b>&nbsp;<a style="padding: 0" href="<?php if ($_smarty_tpl->tpl_vars['ALERT']->value['link']!=''){?><?php echo $_smarty_tpl->tpl_vars['ALERT']->value['link'];?>
<?php }else{ ?>#<?php }?>"><span><?php echo $_smarty_tpl->tpl_vars['ALERT']->value['message'];?>
</span></a></div><div style="color: #888"><?php if (!empty($_smarty_tpl->tpl_vars['ALERT']->value['createdtime'])){?><span><?php echo Vtiger_Util_Helper::formatDateIntoStrings($_smarty_tpl->tpl_vars['ALERT']->value['createdtime']);?>
</span>&nbsp;&nbsp;<?php }?></div></div></div><?php } ?></div><br><div style="text-align:center;"><a style="padding: 5px 12px;" href="<?php echo $_smarty_tpl->tpl_vars['MODULE_MODEL']->value->getDefaultUrl();?>
" class="btn btn-primary"><?php echo vtranslate('LBL_MANAGE_MODULES',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</a></div></div></ul><style>.installer_icon {display: inline-block;height: 45px;width: 45px;background: no-repeat url('layouts/v7/modules/Settings/ITS4YouInstaller/images/ITS4YouIcon.png') center center / 15px 15px;}.its4you_installer_alerts {/*max-height: 500px;overflow: auto;*/width: 400px;}.its4you_installer_alert {padding: 0 0 10px 0;}#its4you_installer_title {display: block;position: relative;line-height: 50px;vertical-align: top;height: 50px;margin: 4px 10px;background: #EFEFEF;}.its4you_installer_text {line-height: 48px;display: inline-block;padding: 0 15px;font-size: 15px;margin: 0 0 0 50px;}.its4you_installer_icon {background: no-repeat url("layouts/v7/modules/Settings/ITS4YouInstaller/images/ITS4YouIcon50x50.png") center center / 50px 50px;color: #fff;text-align: center;vertical-align: middle;display: inline-block;line-height: 50px;width: 50px;height: 50px;position: absolute;}.installer_alert_icon .fa-warning{color: #ff0000;}.installer_alert_icon .fa-info-circle{color: #0088ff;}.installer_alert_icon .fa-refresh{color: #00aa00;}.installer_alert_icon .fa-question{color: #ffaa00;}.installer_alert_icon .fa-bell{color: #fd7e14;}.installer_alert_icon {width: 24px;height: 24px;margin: 12px 22px 12px 12px;}.installer_alert_icon .fa {font-size: 24px;}.its4you_installer_badge {position: absolute;right: 0;bottom: 0;border-radius: 10px;font: bold 10px Arial;padding: 3px 5px;background: #0088cc none repeat scroll 0 0;margin: 0 0 9px 0;}</style></li><?php }} ?>