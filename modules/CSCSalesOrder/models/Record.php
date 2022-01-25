<?php
/*2021-10-11 Pyae Phyo Mon Create CSC SalesOrder Module*/

class CSCSalesOrder_Record_Model extends Vtiger_Record_Model {

    // Get SaleOrder related Product Detail Record
    public function getProductRecord() {
        $numOfCurrencyDecimalPlaces = getCurrencyDecimalPlaces();
        $recordId = $this->getId();
        $Product = array();
        $ProductData = array();
        $ProductResult = array();
        if ($recordId) {
            global $adb;
            $prorelresult = $adb->pquery('SELECT vtiger_cscsalesorderproductrel.*,vtiger_cscproducts.product_name FROM vtiger_cscsalesorderproductrel Join vtiger_cscproducts ON vtiger_cscsalesorderproductrel.productid = vtiger_cscproducts.cscproductsid WHERE id = ?', array($recordId));

            $i = 0;
            while ($rowData = $adb->fetch_array($prorelresult)) {
                $ProductData[$i] = $rowData;
                // Change price to decimal format
                $ProductData[$i]['quantity'] = number_format($ProductData[$i]['quantity'], $numOfCurrencyDecimalPlaces, '.', '');
                $ProductData[$i]['selling_price'] = number_format($ProductData[$i]['selling_price'], $numOfCurrencyDecimalPlaces, '.', '');
                $ProductData[$i]['total'] = number_format($ProductData[$i]['total'], $numOfCurrencyDecimalPlaces, '.', '');
                $ProductData[$i]['item_tax'] = number_format($ProductData[$i]['item_tax'], $numOfCurrencyDecimalPlaces, '.', '');
                $ProductData[$i]['discount'] = number_format($ProductData[$i]['discount'], $numOfCurrencyDecimalPlaces, '.', '');
                $ProductData[$i]['net_price'] = number_format($ProductData[$i]['net_price'], $numOfCurrencyDecimalPlaces, '.', '');
                $i++;
            }           
        }
        return $ProductData;
    }

    // get sales order price 
    public function getAmountData(){
        $recordId = $this->getId();
        $numOfCurrencyDecimalPlaces = getCurrencyDecimalPlaces();

        $FinalData = array();
        if ($recordId) {
             global $adb;
             $soresult = $adb->pquery('SELECT taxtype,item_total,discount_percent,discount_amount,excluding_tax_total,tax,adjustment,grandtotal FROM vtiger_cscsalesorder WHERE cscsalesorderid = ?', array($recordId));

             $Data = $adb->fetch_array($soresult);
             foreach ($Data as $key => $sodata) {
                if($key == 'taxtype')
                {
                    $FinalData[$key] = $Data[$key];
                }
                else
                {
                    $FinalData[$key] =number_format($Data[$key], $numOfCurrencyDecimalPlaces, '.', '');
                }
             }
        }
        return $FinalData;
    }

    // get related currency id and name of saled order
    public function getCurrencyAllName() {

        $recordId = $this->getId();
        global $adb;
        $result = $adb->pquery('SELECT  currency_id,vtiger_currency_info.* FROM vtiger_cscsalesorder 
                  join vtiger_currency_info on vtiger_cscsalesorder.currency_id = vtiger_currency_info.id
                            where cscsalesorderid=?', array($recordId));

        $currency_info = array();
        $currency_info['currency_id'] = $adb->query_result($result,0,'currency_id');
        $currency_info['currency_name'] = $adb->query_result($result,0,'currency_name');
        $currency_info['currency_code'] = $adb->query_result($result,0,'currency_code');
        $currency_info['currency_symbol'] = $adb->query_result($result,0,'currency_symbol');

        return $currency_info; 
    }
}