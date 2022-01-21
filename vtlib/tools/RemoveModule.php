<?php

include_once 'vtlib/Vtiger/Module.php';

$Vtiger_Utils_Log = true;
//CSCProducts
//
$module = Vtiger_Module::getInstance('CSCProducts');
if ($module) $module->delete();

echo "End";
