<?php
/*2021-10-11 Pyae Phyo Mon Create CSC SalesOrder Module*/

class CSCSalesOrder_Detail_View extends Vtiger_Detail_View {

    function showModuleDetailView(Vtiger_Request $request) {
        $this->showProductDetails($request);
        return parent::showModuleDetailView($request);
    }

    function showModuleSummaryView($request) {
        $recordId = $request->get('record');
        $moduleName = $request->getModule();

        if (!$this->record) {
            $this->record = Vtiger_DetailView_Model::getInstance($moduleName, $recordId);
        }
        $recordModel = $this->record->getRecord();
        $recordStrucure = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_SUMMARY);

        $moduleModel = $recordModel->getModule();
        $viewer = $this->getViewer($request);
        $viewer->assign('RECORD', $recordModel);
        $viewer->assign('BLOCK_LIST', $moduleModel->getBlocks());
        $viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());

        $viewer->assign('MODULE_NAME', $moduleName);
        $viewer->assign('IS_AJAX_ENABLED', $this->isAjaxEnabled($recordModel));
        $viewer->assign('SUMMARY_RECORD_STRUCTURE', $recordStrucure->getStructure());
        $viewer->assign('RELATED_ACTIVITIES', $this->getActivities($request));

        $currentUser = Users_Record_Model::getCurrentUserModel();
        $viewer->assign('IS_EDIT', FALSE);

        return $viewer->view('ModuleSummaryView.tpl', $moduleName, true);
    }

    function showProductDetails(Vtiger_Request $request) {
        
        $record = $request->get('record');
        $moduleName = $request->getModule();
        $unit_conversation = "";
        $recordModel =CSCProducts_Record_Model::getInstanceById($record);
        $detail_product = $recordModel->getProductRecord();
        $currency_data = $recordModel->getCurrencyAllName();
        $amountdata = $recordModel->getAmountData();
        $viewer = $this->getViewer($request);
        $viewer->assign('CURRENCY_DATA', $currency_data);
        $viewer->assign('MODULE_NAME',$moduleName);
        $viewer->assign('RELATED_PRODUCT',$detail_product);
        $viewer->assign('FINAL_DATA',$amountdata);       
    }
}