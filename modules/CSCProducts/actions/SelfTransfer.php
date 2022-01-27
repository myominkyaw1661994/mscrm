<!--2021-10-15 Thet Phyo Wai Product Data Transfer from MSCRM-->
<?php
class CSCProducts_SelfTransfer_Action extends Vtiger_Action_Controller
{

	//Initial process function
	public function process(Vtiger_Request $request)
	{
		global $current_user, $adb, $event_setting_log_url, $default_setting_month;

		$this->logger('[SELF_START] Self Data Transfer Start');
		try {
			//Get All Create and Update Products' Data from Master Product Module
			$products = $this->getCreatedUpdatedProducts();

			//Save all product info
			$this->saveProducts($products);
		} catch (Exception $ex) {
			$this->logger('[ERROR]' . $ex->getMessage());
			$this->logger($ex->getTraceAsString());
		}
		$this->logger('[SELF_END] Self Data Transfer End');
	}

	//Get Setting Event of Organization data
	function getCreatedUpdatedProducts()
	{
		global $adb;

		$products = array();

		//Select Product that transfer_to_info is not "1"
		$sql = "SELECT pd.*,pdt.taxpercentage,crm.* FROM `vtiger_products` AS pd
				
				INNER JOIN `vtiger_crmentity` AS crm ON crm.crmid = pd.productid
				LEFT JOIN `vtiger_producttaxrel` AS pdt ON pdt.productid = pd.productid AND taxid = 4
				
				WHERE crm.deleted = 0 AND (pd.transfer_to_info = 0 OR pd.transfer_to_info IS NULL)";

		$result = $adb->pquery($sql, array());
		if ($adb->num_rows($result) > 0) {

			//loop for each product
			$i = 0;
			while ($result_set = $adb->fetch_array($result)) {
				$productId = $result_set['productid'];

				$products[$i] = $result_set;

				//Get Product Unit Price data from Master Product
				$sql = "SELECT actual_price,currencyid FROM `vtiger_productcurrencyrel` WHERE productid = ?";
				$priceResult = $adb->pquery($sql, array($productId));
				$productUnitPrice = array();
				$n = 0;
				while ($rowData = $adb->fetch_array($priceResult)) {
					$productUnitPrice[$n]['selling_price'] = $rowData['actual_price'];
					$productUnitPrice[$n]['currencyid'] = $rowData['currencyid'];
					$productUnitPrice[$n]['sequence'] = 0;
					$productUnitPrice[$n]['unitconversion'] = 1;
					$productUnitPrice[$n]['usageunit'] = $result_set['usageunit'];
					$n++;
				}
				$products[$i]['product_units'] = $productUnitPrice;

				$i++;
			}
		}
		return $products;
	}

	//Save Product Info
	private function saveProducts($settingProducts)
	{
		global $adb;

		//loop for each Product
		foreach ($settingProducts as $key => $product) {
			$productId = $product['productid'];
			$vendor_id = $product['vendor_id'];

			//Get vendor name
			$vendor_name = $this->getVendorNameById($product['vendor_id']);

			$save_product = array(
				'module' 					=> 'CSCProducts',
				'action' 					=> 'Save',
				'record' 					=> null,
				'cscproduct_no' 			=> $product['product_no'],
				'cscproduct_number' 		=> $product['product_number'],
				'product_name'				=> $product['productname'],
				'product_part'				=> $product['product_part'],
				'product_available_status'	=> $product['product_available_status'],
				'productcategory'			=> $product['productcategory'],
				'vendorname'				=> $vendor_name,
				'website'					=> $product['website'],
				'manufacturer'				=> $product['manufacturer'],
				'sales_start_date' 			=> $product['sales_start_date'],
				'sales_end_date'			=> $product['sales_end_date'],
				'commissionrate'			=> $product['commissionrate'],
				'usageunit'					=> $product['usageunit'],
				'min_or_qty'				=> $product['min_or_qty'],
				'smownerid'					=> $product['smownerid'],
				'description'				=> $product['description'],
				'tax4' 						=> $product['taxpercentage'],
				'product_units'				=> $product['product_units'],
				'visibility' 				=> 'Public',
			);

			$sql = "SELECT cscproductsid FROM `vtiger_cscproducts` AS pd 
				INNER JOIN vtiger_crmentity AS crm ON crm.crmid = pd.cscproductsid 
				WHERE cscproduct_no = ? AND crm.deleted = 0";
			$infoExist = $adb->pquery($sql, array($product['product_no']));
			if ($adb->num_rows($infoExist) > 0) {
				$save_product['record'] = $adb->query_result($infoExist, 0, 'cscproductsid');
			}

			//Save Product Info
			$saveAction = new CSCProducts_Save_Action();
			try {
				$obj = $saveAction->saveRecord(new Vtiger_Request($save_product, $save_product));
			} catch (Exception $e) {
				$this->logger('[ERROR] Cannot Save Product Info ("Product Name is ' . $product['productname'] . '")');
				$this->logger($e->getTraceAsString());
				continue;
			}

			//Update Product to Already tranfer
			$sql = "UPDATE `vtiger_products` SET transfer_to_info = 1 WHERE productid = ?";
			$adb->pquery($sql, array($productId));
		}
	}

	//Get vendor name by Id
	function getVendorNameById($id)
	{
		global $adb;
		$result = $adb->pquery("SELECT vendorname FROM vtiger_vendor WHERE vendorid = ?", array($id));
		$vendor_name = $adb->query_result($result, 0, 'vendorname');
		if ($vendor_name == null) {
			return "";
		}

		return $vendor_name;
	}

	function logger($message)
	{
		global $product_info_log_url, $default_timezone;
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone($default_timezone));

		$logmessage = '[' . $date->format('Y-m-d H:i:s') . ']' . mb_convert_encoding($message, "UTF-8", "auto") . "\r\n";
		file_put_contents($product_info_log_url, $logmessage, FILE_APPEND | LOCK_EX);
	}
}
