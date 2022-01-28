<?php /* Smarty version Smarty-3.1.7, created on 2022-01-27 09:32:36
         compiled from "E:\xampp\htdocs\CSC0tester\includes\runtime/../../layouts/v7\modules\CSCProducts\UnitConversionBlockDetail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19944940161ee1b1f982947-50971813%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8c71f3b1d1017a3f38ccc638738933aaabaa5de' => 
    array (
      0 => 'E:\\xampp\\htdocs\\CSC0tester\\includes\\runtime/../../layouts/v7\\modules\\CSCProducts\\UnitConversionBlockDetail.tpl',
      1 => 1643252520,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19944940161ee1b1f982947-50971813',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_61ee1b1facdb1',
  'variables' => 
  array (
    'BLOCK_LABEL_KEY' => 0,
    'MODULE_NAME' => 0,
    'UNIT_CONVERSATION' => 0,
    'UNIT_DETAIL' => 0,
    'PREVIOUS_UNIT' => 0,
    'CURRENCY_DATA' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_61ee1b1facdb1')) {function content_61ee1b1facdb1($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY'] = new Smarty_variable("LBL_UNIT_INFORMATION", null, 0);?><div class="block block_<?php echo $_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value;?>
" data-block="<?php echo $_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value;?>
" data-blockid="165"><h4 class="textOverflowEllipsis maxWidth50"><img class="cursorPointer alignMiddle blockToggle" src="<?php echo vimage_path('arrowRight.png');?>
" data-mode="hide" data-id=165><img class="cursorPointer alignMiddle blockToggle" src="<?php echo vimage_path('arrowdown.png');?>
" data-mode="show" data-id=165>&nbsp;<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value;?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp2=ob_get_clean();?><?php echo vtranslate($_tmp1,$_tmp2);?>
</h4><hr><div class="blockData"><table class="table detailview-table"><thead><tr><th class="fieldLabel"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp3=ob_get_clean();?><?php echo vtranslate('LBL_UNIT_QTY',$_tmp3);?>
</td><th class="fieldLabel"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp4=ob_get_clean();?><?php echo vtranslate('LBL_UNIT_TYPE',$_tmp4);?>
</td><th class="fieldLabel"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp5=ob_get_clean();?><?php echo vtranslate('LBL_UNIT_CONVERSATION',$_tmp5);?>
</td><th class="fieldLabel"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp6=ob_get_clean();?><?php echo vtranslate('LBL_SELLING_PRICE',$_tmp6);?>
</td><th class="fieldLabel"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['MODULE_NAME']->value;?>
<?php $_tmp7=ob_get_clean();?><?php echo vtranslate('LBL_CURRENCY',$_tmp7);?>
</td></tr></thead><tbody><?php $_smarty_tpl->tpl_vars['PREVIOUS_UNIT'] = new Smarty_variable('', null, 0);?><?php  $_smarty_tpl->tpl_vars['UNIT_DETAIL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['UNIT_DETAIL']->_loop = false;
 $_smarty_tpl->tpl_vars['INDEX'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['UNIT_CONVERSATION']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['UNIT_DETAIL']->key => $_smarty_tpl->tpl_vars['UNIT_DETAIL']->value){
$_smarty_tpl->tpl_vars['UNIT_DETAIL']->_loop = true;
 $_smarty_tpl->tpl_vars['INDEX']->value = $_smarty_tpl->tpl_vars['UNIT_DETAIL']->key;
?><tr><td class="fieldValue"><?php echo $_smarty_tpl->tpl_vars['UNIT_DETAIL']->value["unit_qty"];?>
</td><td class="fieldValue"><?php echo $_smarty_tpl->tpl_vars['UNIT_DETAIL']->value["usageunit"];?>
</td><td class="fieldValue"><?php if (!($_smarty_tpl->tpl_vars['UNIT_DETAIL']->value["sequence"]==0||$_smarty_tpl->tpl_vars['UNIT_DETAIL']->value["sequence"]==1)&&$_smarty_tpl->tpl_vars['PREVIOUS_UNIT']->value!=''){?><?php echo $_smarty_tpl->tpl_vars['UNIT_DETAIL']->value["unitconversion"];?>
 per <?php echo $_smarty_tpl->tpl_vars['PREVIOUS_UNIT']->value;?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['UNIT_DETAIL']->value["unitconversion"];?>
<?php }?></td><td class="fieldValue"><?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['UNIT_DETAIL']->value["selling_price"],null,true);?>
</td><td class="fieldValue"><?php echo $_smarty_tpl->tpl_vars['CURRENCY_DATA']->value[$_smarty_tpl->tpl_vars['UNIT_DETAIL']->value["currencyid"]];?>
</td></tr><?php $_smarty_tpl->tpl_vars['PREVIOUS_UNIT'] = new Smarty_variable($_smarty_tpl->tpl_vars['UNIT_DETAIL']->value["usageunit"], null, 0);?><?php } ?></tbody></table></div></div><br>
<?php }} ?>