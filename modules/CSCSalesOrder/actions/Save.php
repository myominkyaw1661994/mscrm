<?php
//2021-10-22 Thet Phyo Wai Sale Order Data Transfer
class CSCSalesOrder_Save_Action extends Vtiger_Save_Action {

	public function saveRecord($request) {
		$product_rel = $request->get('cscsalesorderproductrel');

		$recordModel = parent::saveRecord($request);

		//Insert Related Product of Sale Order History data
		if(sizeof($product_rel)>0){
			$this->insertProductRel($recordModel->get('id'),$product_rel);
		}
		
		return $recordModel;
	}

	//Insert Product info Unit data
	function insertProductRel($cscsalesorderid,$product_rel) {
		global $adb;
		$adb->pquery("DELETE FROM `vtiger_cscsalesorderproductrel` WHERE id=?", array($cscsalesorderid));
		
		$query = "INSERT INTO `vtiger_cscsalesorderproductrel` VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
		foreach($product_rel as $key=>$values){
			$params = array($cscsalesorderid);
			foreach($values as $k=>$v){
				$params[] = $v;
			}
			$adb->pquery($query, $params);
		}
	}
}
