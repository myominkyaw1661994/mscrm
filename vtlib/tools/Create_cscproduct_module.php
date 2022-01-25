<!---2021-07-28 Thet Phyo Wai  Create New CSC Product Module Add start -->
<?php

$Vtiger_Utils_Log = true;
include_once('vtlib/Vtiger/Menu.php');
include_once('vtlib/Vtiger/Module.php');
include_once('vtlib/Vtiger/Package.php');
include_once('modules/PickList/DependentPickListUtils.php');
include_once('modules/ModTracker/ModTracker.php');
include_once('include/utils/CommonUtils.php');
include_once('include/Webservices/Utils.php');
include_once('includes/main/WebUI.php');

global $adb, $log;

$log->debug("[START] Create CSC Products Module");

$module_name = 'CSCProducts';
$table_name = 'vtiger_cscproducts';

$unit_table = "vtiger_cscproductunitconversion";

//If module table exist, Delete table
$adb->query('DROP TABLE IF EXISTS ' . $table_name);
$adb->query('DROP TABLE IF EXISTS ' . $table_name . 'cf');

$module = new Vtiger_Module();
$module->name = $module_name;
$module->parent = "Support";
$module->save();
$module->initTables();

//create product detail block
$blockInstance = new Vtiger_Block();
$blockInstance->label = 'LBL_PRODUCT_DETAILS';
$module->addBlock($blockInstance);
echo "\n";

//create product no field
$field = new Vtiger_Field();
$field->name = 'cscproduct_no';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'V~O';
$field->label = "LBL_CSC_PRODUCT_NO";
$blockInstance->addField($field);
echo "\n";

//create product number field
$field = new Vtiger_Field();
$field->name = 'cscproduct_number';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'V~O';
$field->label = "LBL_CSC_PRODUCT_NUMBER";
$blockInstance->addField($field);
echo "\n";

//create product name field
$field = new Vtiger_Field();
$field->name = 'product_name';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(200)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'V~M';
$field->label = "LBL_PRODUCT_NAME";
$blockInstance->addField($field);
$module->setEntityIdentifier($field);
echo "\n";

//create product part field
$field = new Vtiger_Field();
$field->name = 'product_part';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->typeofdata = 'V~O';
$field->masseditable = 0;
$field->quickcreate = 1;
$field->summaryfield = 1;
$field->label = 'LBL_PRODUCT_PART';
$blockInstance->addField($field);
echo "\n";

//create product available status field
$field = new Vtiger_Field();
$field->name = 'product_available_status';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->typeofdata = 'V~O';
$field->masseditable = 0;
$field->quickcreate = 1;
$field->summaryfield = 0;
$field->label = 'LBL_PRODUCT_AVAILABLE_STATUS';
$blockInstance->addField($field);
echo "\n";

//create product group field
$field = new Vtiger_Field();
$field->name = 'productcategory';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(200)';
$field->uitype = 3;
$field->typeofdata = 'V~O';
$field->masseditable = 0;
$field->quickcreate = 1;
$field->summaryfield = 1;
$field->label = 'LBL_PRODUCT_GROUP';
$blockInstance->addField($field);
echo "\n";

/*Create Vendor Name need to compline*/
$field = new Vtiger_Field();
$field->name = 'vendorname';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'int(19)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'I~O';
$field->label = "LBL_VENDOR_NAME";
$blockInstance->addField($field);
echo "\n";

//create product category 1 field
$field = new Vtiger_Field();
$field->name = 'productcategory1';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(200)';
$field->uitype = 3;
$field->typeofdata = 'V~O';
$field->masseditable = 0;
$field->quickcreate = 1;
$field->summaryfield = 0;
$field->label = 'LBL_PRODUCT_CATEGORY_ONE';
$blockInstance->addField($field);
echo "\n";

//create product category 2 field
$field = new Vtiger_Field();
$field->name = 'productcategory2';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(200)';
$field->uitype = 3;
$field->typeofdata = 'V~O';
$field->masseditable = 0;
$field->quickcreate = 1;
$field->summaryfield = 0;
$field->label = 'LBL_PRODUCT_CATEGORY_TWO';
$blockInstance->addField($field);
echo "\n";

//create website field
$field = new Vtiger_Field();
$field->name = 'website';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_WEBSITE";
$blockInstance->addField($field);
echo "\n";

//create manufacture field
$field = new Vtiger_Field();
$field->name = 'manufacturer';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(200)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'I~O';
$field->label = "LBL_MANUFACTURER";
$blockInstance->addField($field);
echo "\n";

//create sale start date field
$field = new Vtiger_Field();
$field->name = 'sales_start_date';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'date';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'D~O';
$field->label = "LBL_SALE_START_DATE";
$blockInstance->addField($field);
echo "\n";

//create sale end date field
$field = new Vtiger_Field();
$field->name = 'sales_end_date';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'date';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'D~O~OTH~GE~sales_start_date~Sales Start Date';
$field->label = "LBL_SALE_END_DATE";
$blockInstance->addField($field);
echo "\n";

//create partner field
$field = new Vtiger_Field();
$field->name = 'partner';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(200)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_PARTNER";
$blockInstance->addField($field);
echo "\n";
/*------------------------------------------------------------------------------------------*/

//create unit information block
$blockInstance = new Vtiger_Block();
$blockInstance->label = 'LBL_UNIT_INFORMATION';
$module->addBlock($blockInstance);
echo "\n";
/*------------------------------------------------------------------------------------------*/


//create stock information block
$blockInstance = new Vtiger_Block();
$blockInstance->label = 'LBL_STOCK_INFORMATION';
$module->addBlock($blockInstance);
echo "\n";

//create Tax(%) field
$field = new Vtiger_Field();
$field->name = 'tax4';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'decimal(18,3)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_TAX";
$blockInstance->addField($field);
echo "\n";

//create commission rate field
$field = new Vtiger_Field();
$field->name = 'commissionrate';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'decimal(7,3)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'N~O';
$field->label = "LBL_COMMISSION_RATE";
$blockInstance->addField($field);
echo "\n";

//create Minimun Order Unit field
$field = new Vtiger_Field();
$field->name = 'usageunit';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(200)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~M';
$field->label = "LBL_USAGEUNIT";
$blockInstance->addField($field);
echo "\n";

//create Minimun Order Quantity field
$field = new Vtiger_Field();
$field->name = 'min_or_qty';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'int(10)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'NN~M~10,0';
$field->label = "LBL_MIN_OR_QTY";
$blockInstance->addField($field);
echo "\n";

//create Handlar field
$field = new Vtiger_Field();
$field->name = 'assigned_user_id';
$field->table = 'vtiger_crmentity';
$field->column = 'smownerid';
$field->columntype = 'int(11)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~M';
$field->label = "LBL_ASSIGNED_USER_ID";
$blockInstance->addField($field);
echo "\n";

//create description details block
$blockInstance = new Vtiger_Block();
$blockInstance->label = 'LBL_DESCRIPTION_DETAILS';
$module->addBlock($blockInstance);
echo "\n";

//create description field
$field = new Vtiger_Field();
$field->name = 'description';
$field->table = 'vtiger_crmentity';
$field->column = 'description';
$field->columntype = 'mediumtext';
$field->uitype = 19;
$field->summaryfield = 0;
$field->typeofdata = 'N~O';
$field->label = "LBL_DESCRIPTION";
$blockInstance->addField($field);
echo "\n";
/*------------------------------------------------------------------------------------------*/

//get all filter of module
$filter = new Vtiger_Filter();
//delete module's all filter
$filter->deleteForModule($module);

//create new filter
$filter = new Vtiger_Filter();
$filter->name = 'All';
$filter->isdefault = true;
$module->addFilter($filter);

$filter_columns = array(
	'cscproduct_no',
	'product_name',
	'product_part',
	'product_available_status',
	'productcategory'
);

$field_list = array();
foreach ($filter_columns as $columnname) {
	$field_list[] = Vtiger_Field::getInstance($columnname, $module);
}

foreach ($field_list as $index => $column) {
	$filter->addField($column, ($index + 1));
}
echo "\n";
/*------------------------------------------------------------------------------------------*/

//Set Module Sharing Access
$module->setDefaultSharing('Public_ReadWriteDelete');

//Add and remove Module default function
$module->enableTools(array('Import', 'Export'));
$module->disableTools(array('Merge', 'DuplicatesHandling'));

//Adding Update History Tab for module
ModTracker::disableTrackingForModule($module->id);
ModTracker::enableTrackingForModule($module->id);

$module->initWebservice();
echo "\n";
/*------------------------------------------------------------------------------------------*/

//Add module in parent menu
Settings_MenuEditor_Module_Model::addModuleToApp($module->name, $module->parent);
/*------------------------------------------------------------------------------------------*/

// Add Related Module for document
$documentsModule = Vtiger_Module::getInstance('Documents');
$module->unsetRelatedList($documentsModule, 'Documents', 'get_attachments');
echo "\n";
$module->setRelatedList($documentsModule, 'Documents', array('ADD', 'SELECT'), 'get_attachments');
echo "\n";

// Add Related Module for Parent Products
$module->unsetRelatedList($module, 'Parent Product', 'get_parent_cscproducts');
echo "\n";
$module->setRelatedList($module, 'Parent Product', array(), 'get_parent_cscproducts');
echo "\n";

// Add Related Module for Products Parts
$module->unsetRelatedList($module, 'Product Parts', 'get_part_cscproducts');
echo "\n";
$module->setRelatedList($module, 'Product Parts', array('SELECT'), 'get_part_cscproducts');
echo "\n";

/*------------------------------------------------------------------------------------------*/
//create new table for unit conversation of product
$adb->query('DROP TABLE IF EXISTS ' . $unit_table);
$adb->pquery("CREATE TABLE " . $unit_table . " (cscproductsid int(11), usageunit varchar(200), unitconversion varchar(100), selling_price decimal(18,3), currencyid int(11), sequence int(11))", array());
echo "Create Unit Conversation Table.....<BR>\n";

$log->debug("[END] Create CSC Products Module");
?>
<!--2021-07-28 Thet Phyo Wai  Create New CSC Product Module Add End-->