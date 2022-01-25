<?php
/*2021-08-18 Thet Phyo Wai Create CSC Product Module*/

class CSCProducts_Detail_View extends Vtiger_Detail_View {

    function showModuleDetailView(Vtiger_Request $request) {
        $this->showUnitConversationDetails($request);
        return parent::showModuleDetailView($request);
    }

    function showModuleSummaryView($request) {
        $recordId = $request->get('record');
        $moduleName = $request->getModule();

        if(!$this->record){
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

        $viewer->assign('PRODUCT_PARTS', $this->getProductParts($request));

        $currentUser = Users_Record_Model::getCurrentUserModel();
        $viewer->assign('IS_EDIT', FALSE);

        return $viewer->view('ModuleSummaryView.tpl', $moduleName, true);
    }

    public function getProductParts(Vtiger_Request $request) {
        $moduleName = 'CSCProducts';
        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);

        $currentUserPriviligesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
        if($currentUserPriviligesModel->hasModulePermission($moduleModel->getId())) {
            $moduleName = $request->getModule();
            $recordId = $request->get('record');

            $pageNumber = $request->get('page');
            if(empty ($pageNumber)) {
                $pageNumber = 1;
            }
            $pagingModel = new Vtiger_Paging_Model();
            $pagingModel->set('page', $pageNumber);
            $pagingModel->set('limit', 10);

            if(!$this->record) {
                $this->record = Vtiger_DetailView_Model::getInstance($moduleName, $recordId);
            }
            $recordModel = $this->record->getRecord();
            $moduleModel = $recordModel->getModule();

            $relatedParts = $moduleModel->getAllProductParts('part', $pagingModel, $recordId);

            $viewer = $this->getViewer($request);
            $viewer->assign('RECORD', $recordModel);
            $viewer->assign('MODULE_NAME', $moduleName);
            $viewer->assign('PAGING_MODEL', $pagingModel);
            $viewer->assign('PAGE_NUMBER', $pageNumber);
            $viewer->assign('PARTS', $relatedParts);

            return $viewer->view('ProductPartsSummeryWidget.tpl', $moduleName, true);
        }
    }

    function showUnitConversationDetails(Vtiger_Request $request) {
        $record = $request->get('record');
        $moduleName = $request->getModule();

        $unit_conversation = "";
        $recordModel =CSCProducts_Record_Model::getInstanceById($record);
        $unit_conversation = $recordModel->getUnitConversation();
        $currency_data = $recordModel->getCurrencyAllName();
        
        $viewer = $this->getViewer($request);
        $viewer->assign('CURRENCY_DATA', $currency_data);
        $viewer->assign('MODULE_NAME',$moduleName);
        $viewer->assign('UNIT_CONVERSATION',$unit_conversation);
    }
}
