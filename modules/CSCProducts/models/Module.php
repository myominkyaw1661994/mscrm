<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * ************************************************************************************/

class CSCProducts_Module_Model extends Vtiger_Module_Model {

	/*Remove Quick Create*/
	public function isQuickCreateSupported(){
		return false;
	}

	/*Remove Duplicate Action*/
	public function isDuplicateOptionAllowed($action, $recordId) {
		return false;
	}


	/*Remove Add Record Button*/
	public function getModuleBasicLinks(){
		$createPermission = Users_Privileges_Model::isPermitted($this->getName(), 'CreateView');
		$basicLinks = array();
		if($createPermission) {
			$importPermission = Users_Privileges_Model::isPermitted($this->getName(), 'Import');
			if($importPermission && $createPermission) {
				$basicLinks[] = array(
					'linktype' => 'BASIC',
					'linklabel' => 'LBL_IMPORT',
					'linkurl' => $this->getImportUrl(),
					'linkicon' => 'fa-download'
				);
			}
		}
		return $basicLinks;
	}

	function getAllProductParts($mode, $pagingModel, $recordId = false) {
		$currentUser = Users_Record_Model::getCurrentUserModel();
		$db = PearDatabase::getInstance();

		$nowInUserFormat = Vtiger_Datetime_UIType::getDisplayDateTimeValue(date('Y-m-d H:i:s'));
		$nowInDBFormat = Vtiger_Datetime_UIType::getDBDateTimeValue($nowInUserFormat);
		list($currentDate, $currentTime) = explode(' ', $nowInDBFormat);

        $params = array();

		$query = "SELECT DISTINCT vtiger_crmentity.crmid, vtiger_crmentity.smownerid, vtiger_cscproducts.*
			FROM vtiger_cscproducts
			INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_cscproducts.cscproductsid
			INNER JOIN vtiger_crmentityrel ON vtiger_crmentityrel.relcrmid = vtiger_crmentity.crmid
			INNER JOIN vtiger_cscproductscf
				ON vtiger_cscproducts.cscproductsid = vtiger_cscproductscf.cscproductsid
			LEFT JOIN vtiger_users
				ON vtiger_users.id=vtiger_crmentity.smownerid
			LEFT JOIN vtiger_groups
				ON vtiger_groups.groupid = vtiger_crmentity.smownerid";
		$query .= Users_Privileges_Model::getNonAdminAccessControlQuery('CSCProducts');
		$query .= " WHERE vtiger_crmentity.deleted = 0 AND vtiger_crmentityrel.crmid = ? AND vtiger_crmentity.crmid != ? ";
		array_push($params, $recordId);
		array_push($params, $recordId);

		$query .= " LIMIT " . $pagingModel->getStartIndex() . ", " . ($pagingModel->getPageLimit() + 1);

		$result = $db->pquery($query, $params);
		$numOfRows = $db->num_rows($result);

		$groupsIds = Vtiger_Util_Helper::getGroupsIdsForUsers($currentUser->getId());
		$parts = array();
		$recordsToUnset = array();
		for ($i = 0; $i < $numOfRows; $i++) {
			$newRow = $db->query_result_rowdata($result, $i);
			$model = Vtiger_Record_Model::getCleanInstance('CSCProducts');
			$ownerId = $newRow['smownerid'];
			$currentUser = Users_Record_Model::getCurrentUserModel();
			$visibleFields = array('cscproduct_no', 'product_name', 'product_available_status', 'productcategory', 'smownerid', 'crmid');

			foreach ($newRow as $data => $value) {
				if (in_array($data, $visibleFields) != -1) {
					unset($newRow[$data]);
				}
			}
			//$newRow['subject'] = vtranslate('Busy', 'Events') . '*';
			
			$model->setData($newRow);
			$model->setId($newRow['crmid']);
			$parts[$newRow['crmid']] = $model;
		}

		$pagingModel->calculatePageRange($parts);
		if ($numOfRows > $pagingModel->getPageLimit()) {
			array_pop($parts);
			$pagingModel->set('nextPageExists', true);
		} else {
			$pagingModel->set('nextPageExists', false);
		}
		//after setting paging model, unsetting the records which has no permissions
		foreach ($recordsToUnset as $record) {
			unset($parts[$record]);
		}
		return $parts;
	}

}
