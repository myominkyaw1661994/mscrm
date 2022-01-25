{*2021-08-27 Thet Phyo Wai Create New CSCProduct Module Create*}
{*<!--
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*
********************************************************************************/
-->*}
{strip}
	{assign var=MODULE_NAME value="CSCProducts"}
	<div class="summaryWidgetContainer">
		<div class="widget_header clearfix">
			<h4 class="display-inline-block pull-left">{vtranslate('LBL_PRODUCTS_PARTS',$MODULE_NAME)}</h4>
			
			{assign var=SOURCE_MODEL value=$RECORD}
		</div>
		<div class="widget_contents">
		<div class="row">
		<span class="col-sm-3"><strong>{vtranslate('LBL_CSC_PRODUCT_NO',$MODULE_NAME)}</strong></span>
		<span class="col-sm-3"><strong>{vtranslate('LBL_PRODUCT_NAME',$MODULE_NAME)}</strong></span>
		<span class="col-sm-3"><strong>{vtranslate('LBL_PRODUCT_AVAILABLE_STATUS',$MODULE_NAME)}</strong></span>
		<span class="col-sm-3"><strong>{vtranslate('LBL_PRODUCT_GROUP',$MODULE_NAME)}</strong></span>
		</div>
			{if count($PARTS) neq '0'}
				{foreach item=RELATED_RECORD from=$PARTS}
				<div class="recentActivitiesContainer row">
					<ul class="" style="padding-left: 0px;list-style-type: none;">
					<li>
					<div class="" id="documentRelatedRecord pull-left">
						<span class="col-sm-3 textOverflowEllipsis">
							<a href="{$RELATED_RECORD->getDetailViewUrl()}" id="{$MODULE}_{$RELATED_MODULE}_Related_Record_{$RELATED_RECORD->get('id')}" title="{$RELATED_RECORD->getDisplayValue('cscproduct_no')}">
								{$RELATED_RECORD->getDisplayValue('cscproduct_no')}
							</a>
						</span>
                        <span class="col-sm-3 textOverflowEllipsis" id="DownloadableLink">
                            <a href="{$RELATED_RECORD->getDetailViewUrl()}" id="{$MODULE}_{$RELATED_MODULE}_Related_Record_{$RELATED_RECORD->get('id')}" title="{$RELATED_RECORD->getDisplayValue('product_name')}">
								{$RELATED_RECORD->getDisplayValue('product_name')}
							</a>
						</span>
                        <span class="col-sm-3 textOverflowEllipsis" id="DownloadableLink">
                            {$RELATED_RECORD->get('product_available_status')} 
						</span>
                        <span class="col-sm-3 textOverflowEllipsis" id="DownloadableLink">
                            {$RELATED_RECORD->get('productcategory')} 
						</span>
                        <span class="col-sm-2">
                            
                        </span>
					</div>
					</li>
					</ul>
				</div>
				{/foreach}
		{else}
			<div class="summaryWidgetContainer noContent">
				<p class="textAlignCenter">{vtranslate('LBL_NO_PRODUCT_PARTS',$MODULE_NAME)}</p>
			</div>
		{/if}
		{if $PAGING_MODEL->isNextPageExists()}
			<div class="row">
				<div class="textAlignCenter">
					<a href="javascript:void(0)" class="moreRecentActivities">{vtranslate('LBL_SHOW_MORE',$MODULE_NAME)}</a>
				</div>
			</div>
		{/if}
	</div>
</div>
{/strip}