<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class ITS4YouReports_DeleteAjax_Action extends Vtiger_DeleteAjax_Action
{

    function checkPermission(Vtiger_Request $request)
    {
        // checked in process
    }

    public function process(Vtiger_Request $request)
    {
        $parentModule = $request->getModule();

        $reportsDeleteDenied = [];
        $recordId = $request->get('record');
        $recordModel = ITS4YouReports_Record_Model::getInstanceById($recordId);

        if (!$recordModel->isDefault() && $recordModel->isEditable()) {
            $success = $recordModel->delete();
            if (!$success) {
                $reportsDeleteDenied[] = vtranslate($recordModel->getName(), $parentModule);
            }
        } else {
            $reportsDeleteDenied[] = vtranslate($recordModel->getName(), $parentModule);
        }
        $response = new Vtiger_Response();
        if (empty ($reportsDeleteDenied)) {
            $response->setResult([vtranslate('LBL_REPORTS_DELETED_SUCCESSFULLY', $parentModule)]);
        } else {
            $response->setError($reportsDeleteDenied, vtranslate('LBL_DENIED_REPORTS', $parentModule));
        }

        $response->emit();
    }

    public function validateRequest(Vtiger_Request $request)
    {
        $request->validateWriteAccess();
    }
}
