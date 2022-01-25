{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}
{strip}
<!--LIST VIEW RECORD ACTIONS-->

<div class="table-actions">
    {if !$SEARCH_MODE_RESULTS}
    <span class="input" >
        <input type="checkbox" value="{$LISTVIEW_ENTRY->getId()}" class="listViewEntriesCheckBox"/>
    </span>
    {/if}
    {if $LISTVIEW_ENTRY->get('starred') eq vtranslate('LBL_YES', $MODULE)}
        {assign var=STARRED value=true}
    {else}
        {assign var=STARRED value=false}
    {/if}
    {if $QUICK_PREVIEW_ENABLED eq 'true'}
		<span>
			<a class="quickView fa fa-eye icon action" data-app="{$SELECTED_MENU_CATEGORY}" title="{vtranslate('LBL_QUICK_VIEW', $MODULE)}"></a>
		</span>
    {/if}
	{if $MODULE_MODEL->isStarredEnabled()}
		<span>
			<a class="markStar fa icon action {if $STARRED} fa-star active {else} fa-star-o{/if}" title="{if $STARRED} {vtranslate('LBL_STARRED', $MODULE)} {else} {vtranslate('LBL_NOT_STARRED', $MODULE)}{/if}"></a>
		</span>
	{/if}
    <span class="more dropdown action">
        <span href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-ellipsis-v icon"></i></span>
        <ul class="dropdown-menu">
            <li><a data-id="{$LISTVIEW_ENTRY->getId()}" href="{$LISTVIEW_ENTRY->getFullDetailViewUrl()}&app={$SELECTED_MENU_CATEGORY}">{vtranslate('LBL_DETAILS', $MODULE)}</a></li>
			{if $RECORD_ACTIONS}
            {*2021-10-12 Pyae Phyo Mon Remove Edit button of CSC SalesOrder Module Start*}
            {*2021-08-31 Thet Phyo Wai Remove Edit button of CSC Products Module Start*}
				{*{if $RECORD_ACTIONS['edit']}*}                
                {* {if $RECORD_ACTIONS['edit'] and !($IS_EDIT and (($MODULE eq 'PurchaseOrder' and $LISTVIEW_ENTRY->get('approve') eq 'Yes') or ($MODULE eq 'Invoice' and $LISTVIEW_ENTRY->get('invoicestatus') eq 'Paid') )) and $MODULE neq 'CSCProducts'} *}
               {*  Disable Edit in the record of Listing (:) *}
                {if $RECORD_ACTIONS['edit'] and !($IS_EDIT and (($MODULE eq 'PurchaseOrder' and $LISTVIEW_ENTRY->get('approve') eq 'Yes') or ($MODULE eq 'Invoice' and $LISTVIEW_ENTRY->get('invoicestatus') eq 'Paid') )) and $MODULE neq 'CSCProducts' and $MODULE neq 'CSCSalesOrder' }
            {*2021-08-31 Thet Phyo Wai Remove Edit button of CSC Products Module End*}
            {*2021-10-12 Pyae Phyo Mon Remove Edit button of CSC SalesOrder Module End*}
					<li><a data-id="{$LISTVIEW_ENTRY->getId()}" href="javascript:void(0);" data-url="{$LISTVIEW_ENTRY->getEditViewUrl()}&app={$SELECTED_MENU_CATEGORY}" name="editlink">{vtranslate('LBL_EDIT', $MODULE)}</a></li>
				{/if}
            {*2021-10-12 Pyae Phyo Mon Remove Delete button of CSC SalesOrder Module Start*}
            {*  Disable Delete in the record of Listing (:) *}
				{* {if $RECORD_ACTIONS['delete']} *}
                {if $RECORD_ACTIONS['delete'] and $MODULE neq 'CSCSalesOrder'}
            {*2021-10-12 Pyae Phyo Mon Remove Edit button of CSC SalesOrder Module End*}
					<li><a data-id="{$LISTVIEW_ENTRY->getId()}" href="javascript:void(0);" class="deleteRecordButton">{vtranslate('LBL_DELETE', $MODULE)}</a></li>
				{/if}
			{/if}
        </ul>
    </span>

    <div class="btn-group inline-save hide">
        {*2021-10-12 Pyae Phyo Mon Remove Edit button of CSC Sales Order Module Start*}
        {*2021-08-31 Thet Phyo Wai Remove Edit button of CSC Products Module Start*}
        {*{if $MODULE neq 'CSCProducts'} *}
        {* Disable Save button when double click record in listing page *}
        {if $MODULE neq 'CSCProducts' and $MODULE neq 'CSCSalesOrder' }
        {*2021-08-31 Thet Phyo Wai Remove Edit button of CSC Products Module End*}
        {*2021-10-12 Pyae Phyo Mon Remove Edit button of CSC Sales Order Module End*}
        <button class="button btn-success btn-small save" type="button" name="save"><i class="fa fa-check"></i></button>
        {*2021-08-31 Thet Phyo Wai Remove Edit button of CSC Products Module Start*}
        {/if}
        {*2021-08-31 Thet Phyo Wai Remove Edit button of CSC Products Module End*}
        <button class="button btn-danger btn-small cancel" type="button" name="Cancel"><i class="fa fa-close"></i></button>
    </div>
</div>
{/strip}
