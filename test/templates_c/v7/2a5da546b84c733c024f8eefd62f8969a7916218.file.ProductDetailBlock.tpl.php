<?php /* Smarty version Smarty-3.1.7, created on 2022-01-24 13:42:08
         compiled from "E:\xampp\htdocs\CSC0tester\includes\runtime/../../layouts/v7\modules\CSCSalesOrder\ProductDetailBlock.tpl" */ ?>
<?php /*%%SmartyHeaderCode:179528817161ee5148e1fee8-23866722%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a5da546b84c733c024f8eefd62f8969a7916218' => 
    array (
      0 => 'E:\\xampp\\htdocs\\CSC0tester\\includes\\runtime/../../layouts/v7\\modules\\CSCSalesOrder\\ProductDetailBlock.tpl',
      1 => 1635480911,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '179528817161ee5148e1fee8-23866722',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'BLOCK_LABEL_KEY' => 0,
    'COL_SPAN3' => 0,
    'MODULE_NAME' => 0,
    'REGION_LABEL' => 0,
    'RECORD' => 0,
    'CURRENCY_INFO' => 0,
    'FINAL_DATA' => 0,
    'RELATED_PRODUCT' => 0,
    'PRODUCT_DETAIL' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_61ee51490d0ba',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_61ee51490d0ba')) {function content_61ee51490d0ba($_smarty_tpl) {?>
<?php $_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY'] = new Smarty_variable("LBL_ITEMDETAIL_INFORMATION", null, 0);?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(0, null, 0);?><?php $_smarty_tpl->tpl_vars['COL_SPAN2'] = new Smarty_variable(0, null, 0);?><?php $_smarty_tpl->tpl_vars['COL_SPAN3'] = new Smarty_variable(2, null, 0);?><div class="block block_<?php echo $_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value;?>
" data-block="<?php echo $_smarty_tpl->tpl_vars['BLOCK_LABEL_KEY']->value;?>
" data-blockid="165"><div class="lineItemTableDiv"><table class="table table-bordered lineItemsTable" style = "margin-top:15px"><thead><th colspan="<?php echo $_smarty_tpl->tpl_vars['COL_SPAN3']->value;?>
" class="lineItemBlockHeader"><?php $_smarty_tpl->tpl_vars['REGION_LABEL'] = new Smarty_variable(vtranslate('LBL_ITEM_DETAILS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), null, 0);?><?php echo $_smarty_tpl->tpl_vars['REGION_LABEL']->value;?>
</th><th colspan="<?php echo $_smarty_tpl->tpl_vars['COL_SPAN3']->value;?>
" class="lineItemBlockHeader"><?php $_smarty_tpl->tpl_vars['CURRENCY_INFO'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD']->value->getCurrencyAllName(), null, 0);?><?php echo vtranslate('LBL_CURRENCY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 : <?php echo vtranslate($_smarty_tpl->tpl_vars['CURRENCY_INFO']->value['currency_name'],$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
(<?php echo $_smarty_tpl->tpl_vars['CURRENCY_INFO']->value['currency_symbol'];?>
)</th><th colspan="<?php echo $_smarty_tpl->tpl_vars['COL_SPAN3']->value;?>
" class="lineItemBlockHeader"><?php echo vtranslate('LBL_TAX_MODE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 : <?php echo vtranslate($_smarty_tpl->tpl_vars['FINAL_DATA']->value["taxtype"],$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</th></thead><tbody><tr><td class="lineItemFieldName"><span class="redColor">*</span><strong><?php echo vtranslate('LBL_ITEM_NAME',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></td><td class="lineItemFieldName"><strong><?php echo vtranslate('LBL_UNIT_TYPE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></td><td class="lineItemFieldName"><strong><?php echo vtranslate('LBL_QUANTITY',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></td><td class="lineItemFieldName"><strong><?php echo vtranslate('LBL_SELLING_PRICE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></td><td class="lineItemFieldName"><strong class="pull-right"><?php echo vtranslate('LBL_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></td><td class="lineItemFieldName"><strong class="pull-right"><?php echo vtranslate('LBL_NET_PRICE',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></td></tr><?php  $_smarty_tpl->tpl_vars['PRODUCT_DETAIL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->_loop = false;
 $_smarty_tpl->tpl_vars['INDEX'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RELATED_PRODUCT']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->key => $_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value){
$_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->_loop = true;
 $_smarty_tpl->tpl_vars['INDEX']->value = $_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->key;
?><tr><td><div><a class="fieldValue" href="index.php?module=CSCProducts&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value["productid"];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value["product_name"];?>
</a></div><div><?php echo vtranslate('LBL_PRODUCT_BRAND',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 : <?php echo $_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value["product_brand"];?>
</div><div><?php echo vtranslate('LBL_COUNTRY_OF_ORIGIN',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 : <?php echo $_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value["country_of_origin"];?>
</div><div><?php echo $_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value["comment"];?>
</div></td><td><div><?php echo $_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value["unit_type"];?>
</div><td><div> <?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value["quantity"],null,true);?>
</div></td><td><div><?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value["selling_price"],null,true);?>
 </div><div><?php echo vtranslate('LBL_ITEM_TAX',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value["item_tax"],null,true);?>
</div></td><td><div align = right><?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value["total"],null,true);?>
</div><div align = right><?php echo vtranslate('LBL_DISCOUNT_AMOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
 :<?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value["discount"],null,true);?>
</div></td><td><div align = right><?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['PRODUCT_DETAIL']->value["net_price"],null,true);?>
</div></td></tr><?php } ?></tbody></table></div><table class="table table-bordered lineItemsTable"><tr><td width="83%"><div class="pull-right"><strong><?php echo vtranslate('LBL_ITEMS_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></div></td><td><span class="pull-right"><strong><?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['FINAL_DATA']->value["item_total"],null,true);?>
</strong></span></td></tr><tr><td width="83%"><div class="pull-right"><strong><?php echo vtranslate('LBL_OVERALL_DISCOUNT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></div></td><td><span class="pull-right"><?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['FINAL_DATA']->value["discount_amount"],null,true);?>
</span></td></tr><tr><td width="83%"><div class="pull-right"><strong><?php echo vtranslate('LBL_EXCLUDING_TAX_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></div></td><td><span class="pull-right"><?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['FINAL_DATA']->value["excluding_tax_total"],null,true);?>
</span></td></tr><tr><td width="83%"><div class="pull-right"><strong><?php echo vtranslate('LBL_TAX',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></div></td><td><span class="pull-right"><?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['FINAL_DATA']->value["tax"],null,true);?>
</span></td></tr><tr><td width="83%"><div align="right"><strong><?php echo vtranslate('LBL_ADJUSTMENT',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></div></td><td><div align="right"><?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['FINAL_DATA']->value["adjustment"],null,true);?>
</div></td></tr><tr><td width="83%"><div align="right"><strong><?php echo vtranslate('LBL_GRAND_TOTAL',$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong></div></td><td><div align="right"><?php echo Vtiger_Currency_UIType::transformDisplayValue($_smarty_tpl->tpl_vars['FINAL_DATA']->value["grandtotal"],null,true);?>
</div></td></tr></table></div><br>
<?php }} ?>