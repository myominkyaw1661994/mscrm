<?php
/*2021-10-11 Pyae Phyo Mon Create CSC SalesOrder Module*/
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * ************************************************************************************/

class CSCSalesOrder_Module_Model extends Vtiger_Module_Model {

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
}
