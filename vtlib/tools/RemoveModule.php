<?php

include_once 'vtlib/Vtiger/Module.php';

$Vtiger_Utils_Log = true;
//CSCProducts
//CSCSalesOrder
$module = Vtiger_Module::getInstance('CSCSalesOrder');
if ($module) $module->delete();

echo "End";
