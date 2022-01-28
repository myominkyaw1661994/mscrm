<!--2021-10-15 Thet Phyo Wai Sales Orders Data Transfer from MSCRM-->
<?php
class CSCSalesOrder_SelfTransfer_Action extends Vtiger_Action_Controller
{

	//Initial process function
	public function process(Vtiger_Request $request)
	{
		global $current_user, $adb;

		$this->logger('[SELF_START] Self Data Transfer Start');
		try {
			//Get All Create and Update Sale Order Data from Master Sales Order Module
			$saleorders = $this->getCreatedUpdatedSaleOrders();

			//Save all Sale Order to History
			$this->saveSalesOrder($saleorders);
		} catch (Exception $ex) {
			$this->logger('[ERROR]' . $ex->getMessage());
			$this->logger($ex->getTraceAsString());
		}
		$this->logger('[SELF_END] Self Data Transfer End');
	}

	//Get  All Create and Update Sale Order Data from Master Sales Order Module
	function getCreatedUpdatedSaleOrders()
	{
		global $adb;

		$saleorders = array();

		//Select Sale Order that transfer_to_info is not "1"
		$sql = "SELECT so.*,sob.*,sos.*,crm.*,soi.recurring_frequency,soi.start_period,soi.end_period,soi.payment_duration,soi.invoice_status FROM `vtiger_salesorder` AS so

				INNER JOIN `vtiger_crmentity` AS crm ON crm.crmid = so.salesorderid
				INNER JOIN `vtiger_sobillads` AS sob ON sob.sobilladdressid = so.salesorderid
				INNER JOIN `vtiger_soshipads` AS sos ON sos.soshipaddressid = so.salesorderid
				LEFT JOIN `vtiger_invoice_recurring_info` AS soi ON soi.salesorderid = so.salesorderid

				WHERE crm.deleted = 0 AND (so.transfer_to_history = 0 OR so.transfer_to_history IS NULL)";

		$result = $adb->pquery($sql, array());
		if ($adb->num_rows($result) > 0) {

			//loop for each sale order
			$i = 0;
			while ($result_set = $adb->fetch_array($result)) {
				$saleorderId = $result_set['salesorderid'];
				$saleorderCurrencyId = $result_set['currency_id'];
				$saleorderCurrencyname = $this->getCurrencyNameById($result_set['currency_id']);
				$taxType = $result_set['taxtype'];

				$saleorders[$i] = $result_set;

				//Get Product of sale order
				$sql = "SELECT cpd.cscproductsid,cpd.usageunit,ipd.listprice,ipd.quantity,ipd.tax4,ipd.discount_amount,ipd.comment FROM `vtiger_inventoryproductrel` AS ipd
						INNER JOIN `vtiger_products` AS mpd ON mpd.productid = ipd.productid
						INNER JOIN `vtiger_cscproducts` AS cpd ON cpd.cscproduct_no = mpd.product_no
						INNER JOIN `vtiger_crmentity` AS crm ON crm.crmid = cpd.cscproductsid and crm.deleted = 0
						WHERE id = ?";
				$productResult = $adb->pquery($sql, array($saleorderId));
				$productrel = array();
				$n = 0;
				while ($rowData = $adb->fetch_array($productResult)) {
					$productrel[$n]['productid'] = $rowData['cscproductsid'];
					$productrel[$n]['product_brand'] = null;
					$productrel[$n]['country_of_origin'] = null;
					$productrel[$n]['unit_type'] = $rowData['usageunit'];
					$productrel[$n]['selling_price'] = $rowData['listprice'];
					$productrel[$n]['quantity'] = $rowData['quantity'];
					$productrel[$n]['currency_type'] = $saleorderCurrencyname;
					//if tax type is group in SO, tax of each product = 0
					if ($taxType == "group") {
						$productrel[$n]['item_tax'] = 0;
						$saleorders[$i]['tax'] = $rowData['tax4'];
					} else {
						$productrel[$n]['item_tax'] = $rowData['tax4'];
					}
					$productrel[$n]['discount'] = $rowData['discount_amount'];
					$productrel[$n]['total'] = $rowData['listprice'] * $rowData['quantity'];
					$productrel[$n]['net_price'] = $productrel[$n]['total'] + $productrel[$n]['item_tax'] - $rowData['discount_amount'];
					$productrel[$n]['comment'] = $rowData['comment'];
					$n++;
				}
				$saleorders[$i]['cscsalesorderproductrel'] = $productrel;
				$i++;
			}
		}
		return $saleorders;
	}

	//Save Sale Order History
	private function saveSalesOrder($settingSalesOrders)
	{
		global $adb;

		//loop for each Sale Order
		foreach ($settingSalesOrders as $key => $SalesOrder) {

			$saleorderId = $SalesOrder['salesorderid'];
			$potential_data = $SalesOrder['potentialid'];
			$contact_data = $SalesOrder['contactid'];
			$account_data = $SalesOrder['accountid'];
			$currency_data = $SalesOrder['currency_id'];

			if (isset($currency_data)) {
				$currency_data = $this->getCurrencyNameById($currency_data);
			}

			//check the potential Id 
			if (isset($potentialId)) {
				$potential_data = $this->getPotentialById($potential_data);
			}

			//check the contact Id
			if (isset($contact_data)) {
				$contact_data = $this->getContactById($contact_data);
			}

			//check the account Id
			if (isset($account_data)) {
				$account_data = $this->getAccountById($account_data);
			}

			$save_saleorder = array(
				'module' 					=> 'CSCSalesOrder',
				'action' 					=> 'Save',
				'record' 					=> null,
				'visibility' 				=> 'Public',
				'cscsaleorder_no' 			=> $SalesOrder['salesorder_no'],
				'subject' 					=> $SalesOrder['subject'],
				'saleorder_type'			=> $SalesOrder['type'],
				'potential_name'			=> $potential_data,
				'contact_name'				=> $contact_data,
				'duedate'					=> $SalesOrder['duedate'],
				'carrier'					=> $SalesOrder['carrier'],
				'pending'					=> $SalesOrder['pending'],
				'sale_commission'			=> $SalesOrder['salescommission'],
				'excise_duty' 				=> $SalesOrder['exciseduty'],
				'sostatus'					=> $SalesOrder['sostatus'],
				'account_name'				=> $account_data,
				'order_receipt_person'		=> null,
				'order_issue_person'		=> null,
				'enable_recurring'			=> $SalesOrder['enable_recurring'],
				'recurring_frequency'		=> $SalesOrder['recurring_frequency'],
				'start_period' 				=> $SalesOrder['start_period'],
				'end_period'				=> $SalesOrder['end_period'],
				'payment_duration'			=> $SalesOrder['payment_duration'],
				'invoicestatus'				=> $SalesOrder['invoice_status'],
				'bill_street'				=> $SalesOrder['bill_street'],
				'bill_pobox'				=> $SalesOrder['bill_pobox'],
				'bill_city'					=> $SalesOrder['bill_city'],
				'bill_state'				=> $SalesOrder['bill_state'],
				'bill_postal_code'			=> $SalesOrder['bill_code'],
				'bill_country'				=> $SalesOrder['bill_country'],
				'ship_street'				=> $SalesOrder['ship_street'],
				'ship_pobox'				=> $SalesOrder['ship_pobox'],
				'ship_city'					=> $SalesOrder['ship_city'],
				'ship_state'				=> $SalesOrder['ship_state'],
				'ship_postal_code'			=> $SalesOrder['ship_code'],
				'ship_country'				=> $SalesOrder['ship_country'],
				'description'				=> $SalesOrder['description'],
				'currency_name'				=> $currency_data,
				'taxtype'					=> $SalesOrder['taxtype'],
				'item_total'				=> $SalesOrder['subtotal'],
				'discount_percent'			=> $SalesOrder['discount_percent'],
				'discount_amount'			=> $SalesOrder['discount_amount'],
				'excluding_tax_total'		=> $SalesOrder['subtotal'] - $SalesOrder['discount_amount'],
				'tax'						=> ($SalesOrder['subtotal'] - $SalesOrder['discount_amount']) * ($SalesOrder['tax'] / 100),
				'adjustment'				=> $SalesOrder['adjustment'],
				'grandtotal'				=> $SalesOrder['total'],
				'sourcefrom'				=> "MSCRM",
				'cscsalesorderproductrel'	=> $SalesOrder['cscsalesorderproductrel'],
			);

			//Check Sale Order Create or Update
			$sql = "SELECT cscsalesorderid FROM `vtiger_cscsalesorder` AS so 
				INNER JOIN vtiger_crmentity AS crm ON crm.crmid = so.cscsalesorderid 
				WHERE cscsaleorder_no = ? AND crm.deleted = 0";
			$historyExist = $adb->pquery($sql, array($SalesOrder['salesorder_no']));
			if ($adb->num_rows($historyExist) > 0) {
				$save_saleorder['record'] = $adb->query_result($historyExist, 0, 'cscsalesorderid');
			}

			//Save Sales Order History
			$saveAction = new CSCSalesOrder_Save_Action();
			try {
				$obj = $saveAction->saveRecord(new Vtiger_Request($save_saleorder, $save_saleorder));
			} catch (Exception $e) {
				$this->logger('[ERROR] Cannot Save Sale Order History ("Subject is ' . $SalesOrder['subject'] . '")');
				$this->logger($e->getTraceAsString());
				continue;
			}

			//Update Sales Order to Already transfer
			$sql = "UPDATE `vtiger_salesorder` SET transfer_to_history = 1 WHERE salesorderid = ?";
			$adb->pquery($sql, array($saleorderId));
		}
	}

	//Get Potential Name by Id
	function getPotentialById($id)
	{
		global $adb;
		$result = $adb->pquery("SELECT potentialname FROM vtiger_potential WHERE potentialid = ?", array($id));
		$potential_name = $adb->query_result($result, 0, 'potentialname');
		if ($potential_name == null) {
			return "";
		}

		return $potential_name;
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

	function getCurrencyNameById($id)
	{
		global $adb;
		$result = $adb->pquery("SELECT currency_name FROM vtiger_currency_info WHERE id = ?", array($id));
		$currency_name = $adb->query_result($result, 0, 'currency_name');
		return $currency_name;
	}

	//Get Contact Name by Id
	function getContactById($id)
	{
		global $adb;
		$result = $adb->pquery("SELECT lastname FROM vtiger_contactdetails WHERE contactid = ?", array($id));
		$contact_name = $adb->query_result($result, 0, 'lastname');
		if ($contact_name == null) {
			return "";
		}

		return $contact_name;
	}

	function logger($message)
	{
		global $saleorder_history_log_url, $default_timezone;
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone($default_timezone));

		$logmessage = '[' . $date->format('Y-m-d H:i:s') . ']' . mb_convert_encoding($message, "UTF-8", "auto") . "\r\n";
		file_put_contents($saleorder_history_log_url, $logmessage, FILE_APPEND | LOCK_EX);
	}
}
