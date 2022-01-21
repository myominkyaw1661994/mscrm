<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class PurchaseOrder_GetTaxes_Action extends Inventory_GetTaxes_Action {

	function process(Vtiger_Request $request) {
		$decimalPlace = getCurrencyDecimalPlaces();
		$currencyId = $request->get('currency_id');
		$currencies = Inventory_Module_Model::getAllCurrencies();
		$conversionRate = $conversionRateForPurchaseCost = 1;

		$idList = $request->get('idlist');
		if (!$idList) {
			$recordId = $request->get('record');
			$idList = array($recordId);
		}

		$response = new Vtiger_Response();
		$namesList = $purchaseCostsList = $taxesList = $listPricesList = $listPriceValuesList = array();
		$descriptionsList = $quantitiesList = $imageSourcesList = $productIdsList = $baseCurrencyIdsList = array();

		foreach($idList as $id) {
			$recordModel = Vtiger_Record_Model::getInstanceById($id);
			$taxes = $recordModel->getTaxes();
			foreach ($taxes as $key => $taxInfo) {
				$taxInfo['compoundOn'] = json_encode($taxInfo['compoundOn']);
				$taxes[$key] = $taxInfo;
			}

			$taxesList[$id]				= $taxes;
			$namesList[$id]				= decode_html($recordModel->getName());
			$quantitiesList[$id]		= $recordModel->get('qtyinstock');
			$descriptionsList[$id]		= decode_html($recordModel->get('description'));

			$priceDetails = $recordModel->getPriceDetails();
			foreach ($priceDetails as $currencyDetails) {
				if ($currencyId == $currencyDetails['curid']) {
					$conversionRate = $currencyDetails['conversionrate'];
				}
			}

			/*2020-11-09 Thet Phyo Wai Purchase Cost Currency Change Start*/
			$purchaseCurrencyId = $recordModel->get('currency');
			$purchaseCurrency = getCurrencySymbolandCRate($purchaseCurrencyId);
			/*2020-11-09 Thet Phyo Wai Purchase Cost Currency Change End*/

			$listPricesList[$id] = (float)$recordModel->get('unit_price') * (float)$conversionRate;
			/*2020-11-09 Thet Phyo Wai Purchase Cost Currency Change Start*/
			/*$purchaseCostsList[$id] = round((float)$recordModel->get('purchase_cost') * (float)$conversionRate, $decimalPlace);*/
			$purchaseCostsList[$id] = round((float)$recordModel->get('purchase_cost') * ((float)$conversionRate/(float)$purchaseCurrency['rate']), $decimalPlace);
			/*2020-11-09 Thet Phyo Wai Purchase Cost Currency Change End*/
			$baseCurrencyIdsList[$id] = getProductBaseCurrency($id, $recordModel->getModuleName());

			/*2020-11-09 Thet Phyo Wai Purchase Cost Currency Change Start*/
			/*foreach($currencies as $currency) {
				$listPriceValuesList[$id][$currency['currency_id']] = $currency['conversionrate'] * (float)$recordModel->get('purchase_cost');
			}*/
			foreach($currencies as $currency) {
				$listPriceValuesList[$id][$currency['currency_id']] = (float)$recordModel->get('purchase_cost') * ($currency['conversionrate'] / $purchaseCurrency['rate']);
			}
			/*2020-11-05 Thet Phyo Wai Purchase Cost Currency Change End*/

			if ($recordModel->getModuleName() == 'Products') {
				$productIdsList[] = $id;
			}

		}

		if ($productIdsList) {
			$imageDetailsList = Products_Record_Model::getProductsImageDetails($productIdsList);

			foreach ($imageDetailsList as $productId => $imageDetails) {
				$imageSourcesList[$productId] = $imageDetails[0]['path'].'_'.$imageDetails[0]['orgname'];
			}
		}

		foreach($idList as $id) {
			$resultData = array(
								'id'					=> $id,
								'name'					=> $namesList[$id],
								'taxes'					=> $taxesList[$id],
								'listprice'				=> $listPricesList[$id],
								'listpricevalues'		=> $listPriceValuesList[$id],
								'purchaseCost'			=> $purchaseCostsList[$id],
								'description'			=> $descriptionsList[$id],
								'baseCurrencyId'		=> $baseCurrencyIdsList[$id],
								'quantityInStock'		=> $quantitiesList[$id],
								'imageSource'			=> $imageSourcesList[$id]
					);

			$info[] = array($id => $resultData);
		}
		$response->setResult($info);
		$response->emit();
	}
}
