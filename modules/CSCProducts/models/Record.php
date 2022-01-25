<?php
/*2021-08-18 Thet Phyo Wai Create CSC Product Module*/

class CSCProducts_Record_Model extends Vtiger_Record_Model {

    public function getUnitConversation() {
        $recordId = $this->getId();
        $UnitData = array();
        if ($recordId) {
            global $adb;
            $result = $adb->pquery('SELECT * FROM vtiger_cscproductunitconversion WHERE cscproductsid = ? ORDER BY sequence', array($recordId));
            while ($rowData = $adb->fetch_array($result)) {
                $UnitData[] = $rowData;
            }
        }
        return $UnitData;
    }

    public function getCurrencyAllName() {

        global $adb;
        $result = $adb->pquery('SELECT * FROM vtiger_currency_info', array());

        $currency_array  = [];
        for ($i = 0; $i < $adb->num_rows($result); $i++) {
            $currency_id = $adb->query_result($result, $i, 'id');
            $currency_name = $adb->query_result($result, $i, 'currency_name');
            $currency_array[$currency_id] = $currency_name;
        }

        return $currency_array;
    }
}