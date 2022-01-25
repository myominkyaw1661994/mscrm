{*2021-10-11 Pyae Phyo Mon Create CSC SalesOrder Module*}
{strip}
{assign var=BLOCK_LABEL_KEY value="LBL_ITEMDETAIL_INFORMATION"}
{assign var=COL_SPAN1 value=0}
{assign var=COL_SPAN2 value=0}
{assign var=COL_SPAN3 value=2}
<div class="block block_{$BLOCK_LABEL_KEY}" data-block="{$BLOCK_LABEL_KEY}" data-blockid="165">
     
    <div class="lineItemTableDiv">
        <table class="table table-bordered lineItemsTable" style = "margin-top:15px">
            <thead>                
                <th colspan="{$COL_SPAN3}" class="lineItemBlockHeader">
                    {assign var=REGION_LABEL value=vtranslate('LBL_ITEM_DETAILS', $MODULE_NAME)}
                    
                    {$REGION_LABEL}
                </th>
                <th colspan="{$COL_SPAN3}" class="lineItemBlockHeader">
                    {assign var=CURRENCY_INFO value=$RECORD->getCurrencyAllName()}
                    {vtranslate('LBL_CURRENCY', $MODULE_NAME)} : {vtranslate($CURRENCY_INFO['currency_name'],$MODULE_NAME)}({$CURRENCY_INFO['currency_symbol']})
                </th>
                <th colspan="{$COL_SPAN3}" class="lineItemBlockHeader">
                    {vtranslate('LBL_TAX_MODE', $MODULE_NAME)} : {vtranslate($FINAL_DATA["taxtype"], $MODULE_NAME)}
                </th>
            </thead>
            <tbody>
                <tr>
                    <td class="lineItemFieldName">
                        <span class="redColor">*</span>
                        <strong>{vtranslate('LBL_ITEM_NAME',$MODULE_NAME)}</strong>
                    </td>
                    <td class="lineItemFieldName">
                        <strong>{vtranslate('LBL_UNIT_TYPE',$MODULE_NAME)}</strong>
                    </td>
                    <td class="lineItemFieldName">
                        <strong>{vtranslate('LBL_QUANTITY',$MODULE_NAME)}</strong>
                    </td>
                    <td class="lineItemFieldName">
                        <strong>{vtranslate('LBL_SELLING_PRICE',$MODULE_NAME)}
                        </strong>
                    </td>
                    <td class="lineItemFieldName">
                        <strong class="pull-right">{vtranslate('LBL_TOTAL',$MODULE_NAME)}</strong>
                    </td>
                    <td class="lineItemFieldName">
                        <strong class="pull-right">{vtranslate('LBL_NET_PRICE',$MODULE_NAME)}</strong>
                    </td>
                </tr>
              
                {foreach key=INDEX item=PRODUCT_DETAIL from=$RELATED_PRODUCT}
                 <tr>
                    <td><div><a class="fieldValue" href="index.php?module=CSCProducts&view=Detail&record={$PRODUCT_DETAIL["productid"]}" target="_blank">
                    {$PRODUCT_DETAIL["product_name"]}</a></div>
                        <div>{vtranslate('LBL_PRODUCT_BRAND',$MODULE_NAME)} : {$PRODUCT_DETAIL["product_brand"]}</div>
                        <div>{vtranslate('LBL_COUNTRY_OF_ORIGIN',$MODULE_NAME)} : {$PRODUCT_DETAIL["country_of_origin"]}</div>
                        <div>{$PRODUCT_DETAIL["comment"]}</div></td>
                    <td><div>{$PRODUCT_DETAIL["unit_type"]}</div>
                    <td><div> {Vtiger_Currency_UIType::transformDisplayValue($PRODUCT_DETAIL["quantity"], null, true)}</div></td>
                    <td><div>{Vtiger_Currency_UIType::transformDisplayValue($PRODUCT_DETAIL["selling_price"], null, true)} </div>
                        <div>{vtranslate('LBL_ITEM_TAX',$MODULE_NAME)} 
                                           {Vtiger_Currency_UIType::transformDisplayValue($PRODUCT_DETAIL["item_tax"], null, true)}</div></td>
                    <td><div align = right>{Vtiger_Currency_UIType::transformDisplayValue($PRODUCT_DETAIL["total"], null, true)}</div>
                        <div align = right>{vtranslate('LBL_DISCOUNT_AMOUNT',$MODULE_NAME)} :
                                           {Vtiger_Currency_UIType::transformDisplayValue($PRODUCT_DETAIL["discount"], null, true)}</div>
                    </td>
                    <td><div align = right>{Vtiger_Currency_UIType::transformDisplayValue($PRODUCT_DETAIL["net_price"], null, true)}</div></td>
                </tr>
                {/foreach}            
            </tbody>
        </table>
    </div>
    <table class="table table-bordered lineItemsTable">
        <tr>
            <td width="83%">
                <div class="pull-right">
                    <strong>{vtranslate('LBL_ITEMS_TOTAL',$MODULE_NAME)}</strong>
                </div>
            </td>
            <td>
                <span class="pull-right">
                    <strong>{Vtiger_Currency_UIType::transformDisplayValue($FINAL_DATA["item_total"], null, true)}</strong>
                </span>
            </td>
        </tr>
        <tr>
            <td width="83%">
                <div class="pull-right">
                    <strong>{vtranslate('LBL_OVERALL_DISCOUNT',$MODULE_NAME)}</strong>
                </div>
            </td>
            <td>
                <span class="pull-right">
                    {Vtiger_Currency_UIType::transformDisplayValue($FINAL_DATA["discount_amount"], null, true)}
                </span>
            </td>
        </tr>
        <tr>
            <td width="83%">
                <div class="pull-right">
                    <strong>{vtranslate('LBL_EXCLUDING_TAX_TOTAL',$MODULE_NAME)}</strong>
                </div>
            </td>
            <td>
                <span class="pull-right">

                    {Vtiger_Currency_UIType::transformDisplayValue($FINAL_DATA["excluding_tax_total"], null, true)}
                </span>
            </td>
        </tr>
        <tr>
            <td width="83%">
                <div class="pull-right">
                    <strong>{vtranslate('LBL_TAX',$MODULE_NAME)}</strong>
                </div>
            </td>
            <td>
                <span class="pull-right">

                   {Vtiger_Currency_UIType::transformDisplayValue($FINAL_DATA["tax"], null, true)}
                </span>
            </td>
        </tr>
         <tr>
            <td width="83%">
                <div align="right">
                    <strong>{vtranslate('LBL_ADJUSTMENT',$MODULE_NAME)}</strong>
                </div>
            </td>
            <td>
                <div align="right">
                    {Vtiger_Currency_UIType::transformDisplayValue($FINAL_DATA["adjustment"], null, true)}
                </div>
            </td>
        </tr>
        <tr>
            <td width="83%">
                <div align="right">
                    <strong>{vtranslate('LBL_GRAND_TOTAL',$MODULE_NAME)}</strong>
                </div>
            </td>
            <td>
                <div align="right">
                    {Vtiger_Currency_UIType::transformDisplayValue($FINAL_DATA["grandtotal"], null, true)}
                </div>
            </td>
        </tr>
    </table>
</div>
<br>
{/strip}
