<?php
/*2021-08-26 Thet Phyo Wai Create CSC Product Module*/
class CSCProducts_Relation_Model extends Vtiger_Relation_Model
{
	/**
	 * Function that deletes PriceBooks related records information
	 * @param <Integer> $sourceRecordId - Product/Service Id
	 * @param <Integer> $relatedRecordId - Related Record Id
	 */
	public function deleteRelation($sourceRecordId, $relatedRecordId)
	{
		$sourceModuleName = $this->getParentModuleModel()->get('name');
		$relatedModuleName = $this->getRelationModuleModel()->get('name');
		if ($sourceModuleName == $relatedModuleName && $this->get('source') != 'custom') {
			$this->deleteCSCProductToCSCProductRelation($sourceRecordId, $relatedRecordId);
		} else {
			$db = PearDatabase::getInstance();
			parent::deleteRelation($sourceRecordId, $relatedRecordId);
		}
	}

	/*Unlink Product and Parts relationship*/
	public function deleteCSCProductToCSCProductRelation($sourceRecordId, $relatedRecordId)
	{
		global $current_user, $adb;
		$currentTime = date('Y-m-d H:i:s');

		if (!empty($sourceRecordId) && !empty($relatedRecordId)) {

			$adb->pquery('DELETE FROM vtiger_crmentityrel WHERE crmid = ? AND relcrmid = ? AND module =? AND relmodule=?', array($sourceRecordId, $relatedRecordId, 'CSCProducts', 'CSCProducts'));

			$adb->pquery('UPDATE vtiger_crmentity SET modifiedtime = ?, modifiedby = ? WHERE crmid = ?', array($currentTime, $current_user->id, $sourceRecordId));

			$id = $adb->getUniqueId('vtiger_modtracker_basic');
			$adb->pquery('INSERT INTO vtiger_modtracker_basic(id, crmid, module, whodid, changedon, status) VALUES(?,?,?,?,?,?)', array($id, $sourceRecordId, 'CSCProducts', $current_user->id, $currentTime, '5'));

			$adb->pquery('INSERT INTO vtiger_modtracker_relations(id, targetmodule, targetid, changedon)
            	VALUES(?,?,?,?)', array($id, 'CSCProducts', $relatedRecordId, $currentTime));

			return true;
		}
	}
}
