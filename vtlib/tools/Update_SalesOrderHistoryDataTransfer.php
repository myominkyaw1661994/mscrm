<!---2021-10-22 Thet Phyo Wai Create data base coulmn in Sales Orders Module for Data transfer Start-->
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

$log->debug("[START] Add New Database Column in Master Sales Order Table");

//Add new database column in master products module
$adb->query('ALTER TABLE `vtiger_salesorder` ADD `transfer_to_history` INT(3)');

$log->debug("[END] Add New Database Column in Master Sales Order Table");
?>
<!---2021-10-22 Thet Phyo Wai Create data base coulmn in Sales Orders Module for Data transfer Start-->