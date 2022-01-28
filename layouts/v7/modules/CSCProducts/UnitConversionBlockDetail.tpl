{*2021-08-17 Thet Phyo Wai Create CSC Product Module*}
{strip}
{assign var=BLOCK_LABEL_KEY value="LBL_UNIT_INFORMATION"}
<div class="block block_{$BLOCK_LABEL_KEY}" data-block="{$BLOCK_LABEL_KEY}" data-blockid="165">
	<h4 class="textOverflowEllipsis maxWidth50">
		<img class="cursorPointer alignMiddle blockToggle" src="{vimage_path('arrowRight.png')}" data-mode="hide" data-id=165>
		<img class="cursorPointer alignMiddle blockToggle" src="{vimage_path('arrowdown.png')}" data-mode="show" data-id=165>&nbsp;
		{vtranslate({$BLOCK_LABEL_KEY},{$MODULE_NAME})}
	</h4>
	<hr>
	<div class="blockData">
		<table class="table detailview-table">
			<thead>
				<tr>
					<th class="fieldLabel">{vtranslate(LBL_UNIT_QTY, {$MODULE_NAME})}</td>
					<th class="fieldLabel">{vtranslate(LBL_UNIT_TYPE,{$MODULE_NAME})}</td>
					<th class="fieldLabel">{vtranslate(LBL_UNIT_CONVERSATION,{$MODULE_NAME})}</td>
					<th class="fieldLabel">{vtranslate(LBL_SELLING_PRICE,{$MODULE_NAME})}</td>
					<th class="fieldLabel">{vtranslate(LBL_CURRENCY,{$MODULE_NAME})}</td>
				</tr>
			</thead>
			<tbody>
			{assign var=PREVIOUS_UNIT value=""}
				{foreach key=INDEX item=UNIT_DETAIL from=$UNIT_CONVERSATION}
				<tr>
					<td class="fieldValue">{$UNIT_DETAIL["unit_qty"]}</td>
					<td class="fieldValue">{$UNIT_DETAIL["usageunit"]}</td>

					<td class="fieldValue">
					{if !($UNIT_DETAIL["sequence"] eq 0 or $UNIT_DETAIL["sequence"] eq 1) and $PREVIOUS_UNIT neq ""}
					{$UNIT_DETAIL["unitconversion"]} per {$PREVIOUS_UNIT}
					{else}
					{$UNIT_DETAIL["unitconversion"]}
					{/if}
					</td>
					<td class="fieldValue">{Vtiger_Currency_UIType::transformDisplayValue($UNIT_DETAIL["selling_price"], null, true)}</td>
					<td class="fieldValue">{$CURRENCY_DATA[$UNIT_DETAIL["currencyid"]]}</td>
				</tr>
				{$PREVIOUS_UNIT=$UNIT_DETAIL["usageunit"]}
				{/foreach}
			</tbody>
		</table>
	</div>
</div>
<br>
{/strip}
