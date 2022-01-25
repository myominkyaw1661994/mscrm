<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

include_once 'modules/Vtiger/CRMEntity.php';

class CSCProducts extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_cscproducts';
	var $table_index= 'cscproductsid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array('vtiger_cscproductscf', 'cscproductsid');

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_cscproducts', 'vtiger_cscproductscf', 'vtiger_cscproductunitconversion');

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_cscproducts' => 'cscproductsid',
		'vtiger_cscproductunitconversion' => 'cscproductsid',
		'vtiger_cscproductscf'=>'cscproductsid');

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = Array (
		/* Format: Field Label => Array(tablename, columnname) */
		// tablename should not have prefix 'vtiger_'
		'' => Array('cscproducts', ''),
		'Assigned To' => Array('crmentity','smownerid')
	);
	var $list_fields_name = Array (
		/* Format: Field Label => fieldname */
		'' => '',
		'Assigned To' => 'assigned_user_id',
	);

	// Make the field link to detail view
	var $list_link_field = '';

	// For Popup listview and UI type support
	var $search_fields = Array(
		/* Format: Field Label => Array(tablename, columnname) */
		// tablename should not have prefix 'vtiger_'
		'' => Array('cscproducts', ''),
		'Assigned To' => Array('vtiger_crmentity','assigned_user_id'),
	);
	var $search_fields_name = Array (
		/* Format: Field Label => fieldname */
		'' => '',
		'Assigned To' => 'assigned_user_id',
	);

	// For Popup window record selection
	var $popup_fields = Array ('');

	// For Alphabetical search
	var $def_basicsearch_col = '';

	// Column value to use on detail view record text display
	var $def_detailview_recname = '';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = Array('','assigned_user_id');

	var $default_order_by = '';
	var $default_sort_order='ASC';

	/**
	* Invoked when special actions are performed on the module.
	* @param String Module name
	* @param String Event Type
	*/

	function save_module($module)
	{
	}


	function vtlib_handler($moduleName, $eventType) {
		global $adb;
 		if($eventType == 'module.postinstall') {
			// TODO Handle actions after this module is installed.
		} else if($eventType == 'module.disabled') {
			// TODO Handle actions before this module is being uninstalled.
		} else if($eventType == 'module.preuninstall') {
			// TODO Handle actions when this module is about to be deleted.
		} else if($eventType == 'module.preupdate') {
			// TODO Handle actions before this module is updated.
		} else if($eventType == 'module.postupdate') {
			// TODO Handle actions after this module is updated.
		}
 	}

 	/*Get Product part relation list*/
 	function get_part_cscproducts($id, $cur_tab_id, $rel_tab_id, $actions=false) {
		global $log, $singlepane_view,$currentModule,$current_user;
		$log->debug("Entering get_products(".$id.") method ...");
		$this_module = $currentModule;

		$related_module = vtlib_getModuleNameById($rel_tab_id);
		require_once("modules/$related_module/$related_module.php");
		$other = new $related_module();
		vtlib_setup_modulevars($related_module, $other);
		$singular_modname = vtlib_toSingular($related_module);

		//$parenttab = getParentTab();

		$query = "SELECT vtiger_cscproducts.cscproductsid, vtiger_cscproducts.product_name,
			vtiger_cscproducts.commissionrate, 
			vtiger_crmentity.crmid, vtiger_crmentity.smownerid
			FROM vtiger_cscproducts
			INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_cscproducts.cscproductsid
			INNER JOIN vtiger_crmentityrel ON vtiger_crmentityrel.relcrmid = vtiger_crmentity.crmid
			INNER JOIN vtiger_cscproductscf
				ON vtiger_cscproducts.cscproductsid = vtiger_cscproductscf.cscproductsid
			LEFT JOIN vtiger_users
				ON vtiger_users.id=vtiger_crmentity.smownerid
			LEFT JOIN vtiger_groups
				ON vtiger_groups.groupid = vtiger_crmentity.smownerid
			WHERE vtiger_crmentity.deleted = 0 AND vtiger_crmentityrel.crmid = $id AND vtiger_crmentity.crmid != $id";

		$return_value = GetRelatedList($this_module, $related_module, $other, $query, $button, $returnset);

		if($return_value == null) $return_value = Array();
		$return_value['CUSTOM_BUTTON'] = $button;

		$log->debug("Exiting get_products method ...");
		return $return_value;
	}

	function get_parent_cscproducts($id)
	{
		global $log, $singlepane_view;
				$log->debug("Entering get_products(".$id.") method ...");

		global $app_strings;

		$focus = new CSCProducts();

		$button = '';

		

		$query = "SELECT vtiger_cscproducts.cscproductsid, vtiger_cscproducts.product_name,
			vtiger_cscproducts.commissionrate, 
			vtiger_crmentity.crmid, vtiger_crmentity.smownerid
			FROM vtiger_cscproducts
			INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_cscproducts.cscproductsid
			INNER JOIN vtiger_crmentityrel ON vtiger_crmentityrel.crmid = vtiger_crmentity.crmid
			INNER JOIN vtiger_cscproductscf
				ON vtiger_cscproducts.cscproductsid = vtiger_cscproductscf.cscproductsid
			LEFT JOIN vtiger_users
				ON vtiger_users.id=vtiger_crmentity.smownerid
			LEFT JOIN vtiger_groups
				ON vtiger_groups.groupid = vtiger_crmentity.smownerid
			WHERE vtiger_crmentity.deleted = 0 AND vtiger_crmentityrel.relcrmid = $id AND vtiger_crmentity.crmid != $id ";

		$log->debug("Exiting get_products method ...");
		return GetRelatedList('CSCProducts','CSCProducts',$focus,$query,$button,$returnset);
	}
}