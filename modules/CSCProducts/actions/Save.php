<?php
//2021-10-15 Thet Phyo Wai Product Info Transfer
class CSCProducts_Save_Action extends Vtiger_Save_Action {

	public function saveRecord($request) {
		$product_units = $request->get('product_units');

		$recordModel = parent::saveRecord($request);

		//Insert Product info Unit data
		if(sizeof($product_units)>0){
			$this->insertUnitInformation($recordModel->get('id'),$product_units);
		}
		
		return $recordModel;
	}

	//Insert Product info Unit data
	function insertUnitInformation($cscproductsId,$product_units) {
		global $adb;
		$adb->pquery("DELETE FROM `vtiger_cscproductunitconversion` WHERE cscproductsid=?", array($cscproductsId));
		
		$query = "INSERT INTO `vtiger_cscproductunitconversion`(`cscproductsid`, `usageunit`, `unitconversion`, `selling_price`, `currencyid`, `sequence`) VALUES (?,?,?,?,?,?)";
		foreach($product_units as $key=>$values){
			$params = array($cscproductsId, $values['usageunit'], $values['unitconversion'], $values['selling_price'], $values['currencyid'], $values['sequence']);
			$adb->pquery($query, $params);
		}
	}
}
