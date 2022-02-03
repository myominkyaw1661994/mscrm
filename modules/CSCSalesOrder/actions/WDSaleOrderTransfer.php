<!--2021-10-23 Thet Phyo Wai Sale Order Data Transfer from WD-->
<?php
class CSCSalesOrder_WDSaleOrderTransfer_Action extends Vtiger_Action_Controller
{

	//Initial process function
	public function process(Vtiger_Request $request)
	{
		global $current_user, $adb;

		$this->logger('[WD_START] WD Sale Order Data Transfer Start');
		try {
			//Get Sale Order From WD
			$saleordersFromWD = $this->getSaleOrderFromWD();

			//Save all Sales Order to History
			$this->saveSalesOrder($saleordersFromWD);
		} catch (Exception $ex) {
			$this->logger('[ERROR]' . $ex->getMessage());
			$this->logger($ex->getTraceAsString());
		}
		$this->logger('[WD_END] WD Sale Order Data Transfer End');
	}

	//Get Sale Order From WD's Sale Order by Using API
	function getSaleOrderFromWD()
	{
		global $wd_saleorder_url;

		$saleorders = array();

		//Get Sale Order from WD using API
		$DataFromWD = $this->file_contents($wd_saleorder_url, json_encode(array()));
		$saleorderFromWD = json_decode($DataFromWD)->SaleOrder;
		$saleorder_objs = json_decode($saleorderFromWD);

		$previous_number = "";
		$old_key = 0;
		foreach ($saleorder_objs as $key => $saleorder_obj) {

			//if product is already exist, add only product unit information.
			if ($saleorder_obj->SALES_ORDER_ID == $previous_number) {
				$saleorders[$old_key]['cscsalesorderproductrel'][] = array(
					'productid' 		=> $this->fetchProductInfoIdByWDProductId($saleorder_obj->PRODUCT_ID),
					'product_brand' 	=> $saleorder_obj->PRODUCT_BRAND,
					'country_of_origin' => $saleorder_obj->MADE_IN,
					'unit_type' 		=> $saleorder_obj->UNIT_TYPE_NAME,
					'selling_price' 	=> $saleorder_obj->PRICE,
					'quantity' 			=> $saleorder_obj->QTY,
					'currency_type' 	=> $this->fetchCurrencyInfoByWDCurrencyId($saleorder_obj->CURRENCY_TYPE),
					'item_tax' 			=> $saleorder_obj->DETAIL_TAX,
					'discount' 			=> $saleorder_obj->TRADE_DISCOUNT,
					'total' 			=> $saleorder_obj->AMOUNT,
					'net_price' 		=> $saleorder_obj->TOTAL,
					'comment' 			=> $saleorder_obj->DETAIL_REMARK,
				);
			} else {
				$saleorders[$key] = array(
					'cscsaleorder_no' 			=> $saleorder_obj->SALES_ORDER_ID,
					'subject' 					=> $saleorder_obj->SUBJECT,
					'saleorder_type'			=> $saleorder_obj->SALES_ORDER_TYPE,
					'potential_id'				=> null,
					'contact_id'				=> null,
					'duedate'					=> $saleorder_obj->ORDER_DATE,
					'carrier'					=> null,
					'pending'					=> null,
					'sale_commission'			=> null,
					'excise_duty' 				=> null,
					'sostatus'					=> $saleorder_obj->SALES_ORDER_STATUS,
					'account_name'				=> $this->getAccountById($this->fetchOrgIdByWDCustomerId($saleorder_obj->CUSTOMER_ID)),
					'order_receipt_person'		=> $saleorder_obj->ORDER_RECEIPT_PERSON,
					'order_issue_person'		=> $saleorder_obj->ORDER_ISSUE_PERSON,
					'enable_recurring'			=> null,
					'recurring_frequency' 		=> null,
					'start_period' 				=> null,
					'end_period' 				=> null,
					'payment_duration' 			=> null,
					'invoicestatus' 			=> null,
					'description'				=> $saleorder_obj->REMARK,
					//address information
					'bill_street' 				=> $saleorder_obj->ADDRESS,
					'bill_pobox'				=> null,
					'bill_city'					=> $saleorder_obj->CITY,
					'bill_state'				=> $saleorder_obj->STATE,
					'bill_postal_code'			=> null,
					'bill_country'				=> $saleorder_obj->COUNTRY,
					'ship_street'				=> null,
					'ship_pobox'				=> null,
					'ship_city'					=> null,
					'ship_state'				=> null,
					'ship_postal_code'			=> null,
					'ship_country'				=> null,
					//sale order total detail
					'currency_id'				=> $this->fetchCurrencyInfoByWDCurrencyId($saleorder_obj->SELL_CURRENCY_TYPE_ID),
					'discount_percent'			=> $saleorder_obj->DISCOUNT_PERCENT,
					'discount_amount'			=> $saleorder_obj->CASH_DISCOUNT,
					'item_total'				=> $saleorder_obj->TOTAL_AMOUNT,
					'excluding_tax_total'		=> $saleorder_obj->EXCLUDING_TAX_TOTAL,
					'tax'						=> $saleorder_obj->TAX,
					'grandtotal'				=> $saleorder_obj->GRAND_TOTAL,
					'taxtype'					=> $saleorder_obj->TAX_TYPE,
					'sourcefrom'				=> $saleorder_obj->SOURCEFROM,
					'adjustment'				=> $saleorder_obj->ADDITIONAL,
					//sale order item detail
					'cscsalesorderproductrel'				=> array([
						'productid' 		=> $this->fetchProductInfoIdByWDProductId($saleorder_obj->PRODUCT_ID),
						'product_brand' 	=> $saleorder_obj->PRODUCT_BRAND,
						'country_of_origin' => $saleorder_obj->MADE_IN,
						'unit_type' 		=> $saleorder_obj->UNIT_TYPE_NAME,
						'selling_price' 	=> $saleorder_obj->PRICE,
						'quantity' 			=> $saleorder_obj->QTY,
						'currency_type' 	=> $this->fetchCurrencyInfoByWDCurrencyId($saleorder_obj->CURRENCY_TYPE),
						'item_tax' 			=> $saleorder_obj->DETAIL_TAX,
						'discount' 			=> $saleorder_obj->TRADE_DISCOUNT,
						'total' 			=> $saleorder_obj->AMOUNT,
						'net_price' 		=> $saleorder_obj->TOTAL,
						'comment' 			=> $saleorder_obj->DETAIL_REMARK,
					]),
				);
				$old_key = $key; //save old sale order key for next related product
			}

			$previous_number = $saleorder_obj->SALES_ORDER_ID; //save sale order number to check with next number
		}
		return $saleorders;
	}

	//Get data from API
	function file_contents($url, $data, $username = null, $password = null)
	{

		//Start Get method
		$opts = array(
			'http' =>
			array(
				'method'  => 'GET',
				'header'  => "Content-type: application/json\r\n"
			)
		);

		//If user name and password required
		if ($username && $password) {
			$opts['http']['header'] .= ("Authorization: Basic " . base64_encode("$username:$password")); // .= to append to the header array element
		}

		$context = stream_context_create($opts);
		return file_get_contents($url, false, $context);
	}

	//get MSCRM Currency ID from WD Currency ID
	private function fetchCurrencyInfoByWDCurrencyId($WDCurrencyId)
	{
		global $log, $adb;;
		$sql = <<< EOM
SELECT *
FROM vtiger_currency_info
WHERE wd_currency_id = ? AND currency_status = 'Active';
EOM;

		$result = $adb->pquery($sql, array($WDCurrencyId));
		if ($adb->num_rows($result) > 0) {
			$row = $adb->query_result_rowdata($result);
			$currency_id = $row['id'];
			return $currency_id;
		}
	}

	//get Product Info ID from WD Product ID
	private function fetchProductInfoIdByWDProductId($WDProductId)
	{
		global $log, $adb;;
		$sql = <<< EOM
SELECT cscproductsid
FROM vtiger_cscproducts as pd
INNER JOIN vtiger_crmentity AS crm ON crm.crmid = pd.cscproductsid
WHERE cscproduct_no = ? AND crm.deleted = 0;
EOM;

		$result = $adb->pquery($sql, array($WDProductId));
		if ($adb->num_rows($result) > 0) {
			$row = $adb->query_result_rowdata($result);
			$productinfo_id = $row['cscproductsid'];
			return $productinfo_id;
		}
	}

	//get Organization ID from WD Cutomer ID
	private function fetchOrgIdByWDCustomerId($WDCustomerId)
	{
		global $log, $adb;;
		$sql = <<< EOM
SELECT accountid
FROM vtiger_account as org
INNER JOIN vtiger_crmentity AS crm ON crm.crmid = org.accountid
WHERE account_number = ? AND crm.deleted = 0;
EOM;

		$result = $adb->pquery($sql, array($WDCustomerId));
		if ($adb->num_rows($result) > 0) {
			$row = $adb->query_result_rowdata($result);
			$account_id = $row['accountid'];
			return $account_id;
		}
	}

	//Save Sale Order History
	private function saveSalesOrder($settingSalesOrder)
	{
		global $adb;

		//loop for each Sales Order
		foreach ($settingSalesOrder as $key => $saleorder) {

			$save_saleorder = array(
				'module' 					=> 'CSCSalesOrder',
				'action' 					=> 'Save',
				'record' 					=> null,
				'visibility' 				=> 'Public',
			);

			//get data from wd sale order array
			foreach ($saleorder as $k => $v) {

				$save_saleorder[$k] = $v;
			}

			//check Create or Update action for Sale Order History by cscsaleorder_no
			$sql = "SELECT cscsalesorderid FROM `vtiger_cscsalesorder` AS so 
				INNER JOIN vtiger_crmentity AS crm ON crm.crmid = so.cscsalesorderid 
				WHERE cscsaleorder_no = ? AND crm.deleted = 0";
			$infoExist = $adb->pquery($sql, array($saleorder['cscsaleorder_no']));
			if ($adb->num_rows($infoExist) > 0) {
				$save_saleorder['record'] = $adb->query_result($infoExist, 0, 'cscsalesorderid');
			}

			//Save Sales Order History
			$saveAction = new CSCSalesOrder_Save_Action();
			try {
				$obj = $saveAction->saveRecord(new Vtiger_Request($save_saleorder, $save_saleorder));
			} catch (Exception $e) {
				$this->logger('[ERROR] Cannot Save Sales Order History ("Sale Order Number is ' . $saleorder['cscsaleorder_no'] . '")');
				$this->logger($e->getTraceAsString());
				continue;
			}
		}
	}

	function logger($message)
	{
		global $saleorder_history_log_url, $default_timezone;
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone($default_timezone));

		$logmessage = '[' . $date->format('Y-m-d H:i:s') . ']' . mb_convert_encoding($message, "UTF-8", "auto") . "\r\n";
		file_put_contents($saleorder_history_log_url, $logmessage, FILE_APPEND | LOCK_EX);
	}

	//Get Account Name by Id
	function getAccountById($id)
	{
		global $adb;
		$result = $adb->pquery("SELECT accountname FROM vtiger_account WHERE accountid = ?", array($id));
		$account_name = $adb->query_result($result, 0, 'accountname');
		if ($account_name == null) {
			return "";
		}

		return $account_name;
	}
}
