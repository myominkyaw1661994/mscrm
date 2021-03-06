<?php
/* +**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.2
 * ("License.txt"); You may not use this file except in compliance with the License
 * The Original Code is: Vtiger CRM Open Source
 * The Initial Developer of the Original Code is Vtiger.
 * Portions created by Vtiger are Copyright (C) Vtiger.
 * All Rights Reserved.
 * ***********************************************************************************/

class Portal_FetchShortcuts_API extends Portal_Default_API {

	// 2020/12/18 sulatt Customer portal can't at php 7 MSCRM start
	// public function process($request) { 
	public function process(Portal_Request $request) { 
	// 2020/12/18 sulatt Customer portal can't at php 7 MSCRM end

		$response = new Portal_Response();
		$result = Vtiger_Connector::getInstance()->fetchShortcuts();
		$response->setResult($this->processShortcuts($result));
		return $response;
	}

	public function processShortcuts($result) {
		$shortcuts = array();
		foreach ($result as $key => $value) {
			foreach ($value as $module => $shortcut) {
				foreach ($shortcut as $moduleName => $action) {
					$shortcuts['shortcut'][$moduleName] = $shortcut[$moduleName];
				}
			}
		}
		return $shortcuts;
	}

}
