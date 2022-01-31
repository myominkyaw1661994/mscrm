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

$log->debug("[START] Create CSC CSC Sale Order Module");

$module_name = 'CSCSalesOrder';
$table_name = 'vtiger_cscsalesorder';
$detail_table = "vtiger_cscsalesorderproductrel";

//If module table exist, Delete table
$adb->query('DROP TABLE IF EXISTS ' . $table_name);
$adb->query('DROP TABLE IF EXISTS ' . $table_name . 'cf');

$module = new Vtiger_Module();
$module->name = $module_name;
$module->parent = "Support";
$module->save();
$module->initTables();

//create Sale Order detail block
$blockInstance = new Vtiger_Block();
$blockInstance->label = 'LBL_SALEORDER_DETAILS';
$module->addBlock($blockInstance);
echo "\n";

//create product no field
$field = new Vtiger_Field();
$field->name = 'cscsaleorder_no';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'V~O';
$field->label = "LBL_CSC_SALEORDER_NO";
$blockInstance->addField($field);
echo "\n";

//create subject field
$field = new Vtiger_Field();
$field->name = 'subject';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'V~O';
$field->label = "LBL_SUBJECT";
$blockInstance->addField($field);
$module->setEntityIdentifier($field);
echo "\n";

//create sale order type field
$field = new Vtiger_Field();
$field->name = 'saleorder_type';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(200)';
$field->uitype = 3;
$field->masseditable = 0;
$field->quickcreate = 1;
$field->summaryfield = 1;
$field->typeofdata = 'V~O';
$field->label = "LBL_SALEORDER_TYPE";
$blockInstance->addField($field);
echo "\n";

//Create Opportunity Name field
$field = new Vtiger_Field();
$field->name = 'potential_name';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'V~O';
$field->masseditable = 0;
$field->quickcreate = 1;
$field->summaryfield = 1;
$field->label = 'LBL_POTENTIAL_NAME';
$blockInstance->addField($field);
echo "\n";

//Create Contact Name field
$field = new Vtiger_Field();
$field->name = 'contact_name';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->typeofdata = 'V~O';
$field->quickcreate = 1;
$field->summaryfield = 0;
$field->label = 'LBL_CONTACT_NAME';
$blockInstance->addField($field);
echo "\n";

//create due date field
$field = new Vtiger_Field();
$field->name = 'duedate';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->typeofdata = 'V~O';
$field->summaryfield = 1;
$field->label = 'LBL_DUE_DATE';
$blockInstance->addField($field);
echo "\n";

//create carrier field
$field = new Vtiger_Field();
$field->name = 'carrier';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->masseditable = 0;
$field->quickcreate = 1;
$field->typeofdata = 'V~O';
$field->label = "LBL_VENDOR_NAME";
$blockInstance->addField($field);
echo "\n";

//ccreate pending field
$field = new Vtiger_Field();
$field->name = 'pending';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(200)';
$field->uitype = 3;
$field->typeofdata = 'V~O';
$field->summaryfield = 0;
$field->label = 'LBL_PENDING';
$blockInstance->addField($field);
echo "\n";

//create sale commission field
$field = new Vtiger_Field();
$field->name = 'sale_commission';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->typeofdata = 'V~O';
$field->summaryfield = 1;
$field->label = 'LBL_SALE_COMMISSION';
$blockInstance->addField($field);
echo "\n";

//create excise_duty Field 
$field = new Vtiger_Field();
$field->name = 'excise_duty';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(200)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->masseditable = 0;
$field->quickcreate = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_EXCISE_DUTY";
$blockInstance->addField($field);
echo "\n";

//create status field
$field = new Vtiger_Field();
$field->name = 'sostatus';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->masseditable = 0;
$field->quickcreate = 1;
$field->typeofdata = 'V~O';
$field->label = "LBL_STATUS";
$blockInstance->addField($field);
echo "\n";

//Create Organization Name field
$field = new Vtiger_Field();
$field->name = 'account_name';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'V~O';
$field->label = "LBL_ACCOUNT_NAME";
$blockInstance->addField($field);
echo "\n";

//create order receipt persion field
$field = new Vtiger_Field();
$field->name = 'order_receipt_person';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_ORDER_RECEIPT_PERSON";
$blockInstance->addField($field);
echo "\n";

//create assing to field
$field = new Vtiger_Field();
$field->name = 'assigned_user_id';
$field->table = 'vtiger_crmentity';
$field->column = 'smownerid';
$field->columntype = 'int(11)';
$field->uitype = 53;
$field->summaryfield = 0;
$field->typeofdata = 'V~M';
$field->label = "LBL_ASSIGNED_TO";
$blockInstance->addField($field);
echo "\n";



//create order issue persion field
$field = new Vtiger_Field();
$field->name = 'order_issue_person';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_ORDER_ISSUE_PERSON";
$blockInstance->addField($field);
echo "\n";


/* created time */
$field = new Vtiger_Field();
$field->name = 'createdtime';
$field->table = 'vtiger_crmentity';
$field->column = $field->name;
$field->columntype = 'createdtime';
$field->uitype = 70;
$field->typeofdata = 'DT~O';
$field->masseditable = 0;
$field->quickcreate = 3;
$field->summaryfield = 0;
$field->displaytype = 2;
$field->label = "LBL_CREATED_TIME";
$blockInstance->addField($field);

/* modified time */
$field = new Vtiger_Field();
$field->name = 'modifiedtime';
$field->table = 'vtiger_crmentity';
$field->column = $field->name;
$field->columntype = 'modifiedtime';
$field->uitype = 70;
$field->typeofdata = 'DT~O';
$field->masseditable = 0;
$field->quickcreate = 3;
$field->summaryfield = 0;
$field->displaytype = 2;
$field->label = "LBL_MODIFIED_TIME";
$blockInstance->addField($field);
/*------------------------------------------------------------------------------------------*/

//create Recurring Invoice Information block
$blockInstance = new Vtiger_Block();
$blockInstance->label = 'LBL_RECURRING_INVOICE_INFORMATION';
$module->addBlock($blockInstance);
echo "\n";

//create enable recurring field
$field = new Vtiger_Field();
$field->name = 'enable_recurring';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_ENABLE_RECURRING";
$blockInstance->addField($field);
echo "\n";

//create frequency field
$field = new Vtiger_Field();
$field->name = 'recurring_frequency';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->typeofdata = 'V~O';
$field->masseditable = 0;
$field->quickcreate = 1;
$field->summaryfield = 0;
$field->label = 'LBL_SCHEDULE_FREQUENCY';
$blockInstance->addField($field);
echo "\n";


//create start period field
$field = new Vtiger_Field();
$field->name = 'start_period';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'V~O';
$field->label = "LBL_START_PERIOD";
$blockInstance->addField($field);
echo "\n";

//create end period field
$field = new Vtiger_Field();
$field->name = 'end_period';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 1;
$field->typeofdata = 'V~O';
$field->label = "LBL_END_PERIOD";
$blockInstance->addField($field);
echo "\n";

//create payment duration field
$field = new Vtiger_Field();
$field->name = 'payment_duration';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->typeofdata = 'V~O';
$field->masseditable = 0;
$field->quickcreate = 1;
$field->summaryfield = 0;
$field->label = 'LBL_PAYMENT_DURATION';
$blockInstance->addField($field);
echo "\n";


//create Invoice Status field
$field = new Vtiger_Field();
$field->name = 'invoicestatus';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->typeofdata = 'V~O';
$field->masseditable = 0;
$field->quickcreate = 1;
$field->summaryfield = 0;
$field->label = 'LBL_INVOICE_STATUS';
$blockInstance->addField($field);
echo "\n";

//create description details block
$blockInstance = new Vtiger_Block();
$blockInstance->label = 'LBL_ADDRESS_DETAIL';
$module->addBlock($blockInstance);
echo "\n";

//create Billing Address field
$field = new Vtiger_Field();
$field->name = 'bill_street';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(250)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_BILLING_ADDRESS";
$blockInstance->addField($field);
echo "\n";


//create Shipping Address field
$field = new Vtiger_Field();
$field->name = 'ship_street';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(250)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_SHIPPING_ADDRESS";
$blockInstance->addField($field);
echo "\n";

//create Billing PO Box field
$field = new Vtiger_Field();
$field->name = 'bill_pobox';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_BILLING_PO_BOX";
$blockInstance->addField($field);
echo "\n";


//create Shipping PO Box field
$field = new Vtiger_Field();
$field->name = 'ship_pobox';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_SHIPPING_PO_BOX";
$blockInstance->addField($field);
echo "\n";

//create Billing City field
$field = new Vtiger_Field();
$field->name = 'bill_city';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_BILLING_CITY";
$blockInstance->addField($field);
echo "\n";


//create Ship City field
$field = new Vtiger_Field();
$field->name = 'ship_city';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_SHIPPING_CITY";
$blockInstance->addField($field);
echo "\n";

//create Billing State field
$field = new Vtiger_Field();
$field->name = 'bill_state';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_BILLING_STATE";
$blockInstance->addField($field);
echo "\n";


//create Shipping State field
$field = new Vtiger_Field();
$field->name = 'ship_state';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_SHIPPING_STATE";
$blockInstance->addField($field);
echo "\n";

//create Billing Postal Code field
$field = new Vtiger_Field();
$field->name = 'bill_postal_code';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_BILLING_POSTAL_CODE";
$blockInstance->addField($field);
echo "\n";

//create Shipping Postal Code field
$field = new Vtiger_Field();
$field->name = 'ship_postal_code';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_SHIPPING_POSTAL_CODE";
$blockInstance->addField($field);
echo "\n";

//create Billing Country field
$field = new Vtiger_Field();
$field->name = 'bill_country';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_BILLING_COUNTRY";
$blockInstance->addField($field);
echo "\n";

//create Shipping Country field
$field = new Vtiger_Field();
$field->name = 'ship_country';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_SHIPPING_COUNTRY";
$blockInstance->addField($field);
echo "\n";

/*------------------------------------------------------------------------------------------*/

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
$field->typeofdata = 'V~O';
$field->label = "LBL_DESCRIPTION";
$blockInstance->addField($field);
echo "\n";
/*------------------------------------------------------------------------------------------*/

//create Sale Order detail block
$blockInstance = new Vtiger_Block();
$blockInstance->label = 'LBL_ITEM_DETAILS';
$module->addBlock($blockInstance);
echo "\n";

// Currency 
$field = new Vtiger_Field();
$field->name = 'currency_id';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_CURRENCY_ID";
$blockInstance->addField($field);
echo "\n";

// TaxType
$field = new Vtiger_Field();
$field->name = 'taxtype';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(30)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_TAXTYPE";
$blockInstance->addField($field);
echo "\n";


//Item Total
$field = new Vtiger_Field();
$field->name = 'item_total';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_ITEM_TOTAL";
$blockInstance->addField($field);
echo "\n";

//Discount Percent
$field = new Vtiger_Field();
$field->name = 'discount_percent';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_DISCOUNT_PERCENT";
$blockInstance->addField($field);
echo "\n";


//Discount Amount
$field = new Vtiger_Field();
$field->name = 'discount_amount';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_DISCOUNT_AMOUNT";
$blockInstance->addField($field);
echo "\n";


//Excluding Tax Total
$field = new Vtiger_Field();
$field->name = 'excluding_tax_total';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_EXCLUSING_TAX_TOTAL";
$blockInstance->addField($field);
echo "\n";

//TAX
$field = new Vtiger_Field();
$field->name = 'tax';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_TAX";
$blockInstance->addField($field);
echo "\n";


//Adjustment
$field = new Vtiger_Field();
$field->name = 'adjustment';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_ADJUSTMENT";
$blockInstance->addField($field);
echo "\n";

//GrnadTotal
$field = new Vtiger_Field();
$field->name = 'grandtotal';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_GRNAD_TOTAL";
$blockInstance->addField($field);
echo "\n";

//sourcefrom
$field = new Vtiger_Field();
$field->name = 'sourcefrom';
$field->table = $module->basetable;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_SOURCEFROM";
$blockInstance->addField($field);
echo "\n";

//create new table for unit conversation of product
$adb->query('DROP TABLE IF EXISTS ' . $detail_table);

$adb->pquery("CREATE TABLE " . $detail_table . " (id int(19), 
productid int(19),
product_brand nvarchar(50),
country_of_origin nvarchar(50),
unit_type varchar(200),
selling_price decimal(27,8),
quantity int(10),
currency_type int(19),
item_tax decimal(7,3),
discount decimal(27,8),
total decimal(27,8),
net_price decimal(27,8),
comment text)", array());

echo "Create Sale Order Detail Table.....<BR>\n";


// productid
$field = new Vtiger_Field();
$field->name = 'productid';
$field->table = $detail_table;
$field->column = $field->name;
$field->columntype = 'int(19)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_PRODUCT";
$blockInstance->addField($field);
$field->setRelatedModules(array('CSCProducts'));
echo "\n";

// Product Brand
$field = new Vtiger_Field();
$field->name = 'product_brand';
$field->table = $detail_table;
$field->column = $field->name;
$field->columntype = 'nvarchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_PRODUCT_BRAND";
$blockInstance->addField($field);
echo "\n";

// Country of Origin
$field = new Vtiger_Field();
$field->name = 'country_of_origin';
$field->table = $detail_table;
$field->column = $field->name;
$field->columntype = 'nvarchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_COUNTRY_OF_ORIGIN";
$blockInstance->addField($field);
echo "\n";

// Unit Type
$field = new Vtiger_Field();
$field->name = 'unit_type';
$field->table = $detail_table;
$field->column = $field->name;
$field->columntype = 'varchar(200)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_UNIT_TYPE";
$blockInstance->addField($field);
echo "\n";

// Selling Price
$field = new Vtiger_Field();
$field->name = 'selling_price';
$field->table = $detail_table;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_SELLING_PRICE";
$blockInstance->addField($field);
echo "\n";

// Quantity
$field = new Vtiger_Field();
$field->name = 'quantity';
$field->table = $detail_table;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_QUANTITY";
$blockInstance->addField($field);
echo "\n";

// Currency Type
$field = new Vtiger_Field();
$field->name = 'currency_type';
$field->table = $detail_table;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_CURRENCY_TYPE";
$blockInstance->addField($field);
echo "\n";

// Item Tax
$field = new Vtiger_Field();
$field->name = 'item_tax';
$field->table = $detail_table;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_ITEM_TAX";
$blockInstance->addField($field);
echo "\n";

// Discount
$field = new Vtiger_Field();
$field->name = 'discount';
$field->table = $detail_table;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_DISOUNT";
$blockInstance->addField($field);
echo "\n";

// Total
$field = new Vtiger_Field();
$field->name = 'total';
$field->table = $detail_table;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_TOTAL";
$blockInstance->addField($field);
echo "\n";

// Net Price
$field = new Vtiger_Field();
$field->name = 'net_price';
$field->table = $detail_table;
$field->column = $field->name;
$field->columntype = 'varchar(100)';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_NET_PRICE";
$blockInstance->addField($field);
echo "\n";

//create Comment field
$field = new Vtiger_Field();
$field->name = 'comment';
$field->table = $detail_table;
$field->column =  $field->name;
$field->columntype = 'mediumtext';
$field->uitype = 3;
$field->summaryfield = 0;
$field->typeofdata = 'V~O';
$field->label = "LBL_COMMENT";
$blockInstance->addField($field);
echo "\n";


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
    'cscsaleorder_no',
    'subject',
    'account_name',
    'saleorder_type',
    'sostatus'
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

echo "Added Column in CSC Sales Order Table.....<BR>\n";
/*------------------------------------------------------------------------------------------*/

//Add module in parent menu
Settings_MenuEditor_Module_Model::addModuleToApp($module->name, $module->parent);
/*------------------------------------------------------------------------------------------*/

echo "End of the line";

$log->debug("[END] Create CSC Sale Order Module");
?>
<!--2021-07-28 Thet Phyo Wai  Create New CSC Product Module Add End-->