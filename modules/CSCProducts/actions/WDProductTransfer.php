<!--2021-10-15 Thet Phyo Wai Product Data Transfer from MSCRM-->
<?php
class CSCProducts_WDProductTransfer_Action extends Vtiger_Action_Controller
{

	private $product_part_objs;

	//Initial process function
	public function process(Vtiger_Request $request)
	{
		global $current_user, $adb;

		$this->logger('[WD_START] WD Product Data Transfer Start');
		try {
			//Get Product Info From WD
			$productsFromWD = $this->getProductsInfoFromWD();

			//Save all product info
			$this->saveProducts($productsFromWD);
		} catch (Exception $ex) {
			$this->logger('[ERROR]' . $ex->getMessage());
			$this->logger($ex->getTraceAsString());
		}
		$this->logger('[WD_END] WD Product Data Transfer End');
	}

	//Get Products info From WD Product by Using API
	function getProductsInfoFromWD()
	{
		global $wd_product_url;

		$products = array();

		//Get Product info from WD using API
		$DataFromWD = $this->file_contents($wd_product_url, json_encode(array("Module" => "Product")));
		$productFromWD = json_decode($DataFromWD)->Product;
		$porductPartFromWD = json_decode($DataFromWD)->ProductPart;
		$product_objs = json_decode($productFromWD);
		$this->product_part_objs = json_decode($porductPartFromWD);

		$previous_number = "";
		$old_key = 0;
		//Loop for Each Product
		foreach ($product_objs as $key => $product_obj) {
			$currencyId = $this->fetchCurrencyInfoByWDCurrencyId($product_obj->STANDARD_SELL_PRICE_CURRENCY);

			//if product is already exist, add only product unit information.
			if ($product_obj->PRODUCT_ID == $previous_number) {
				$products[$old_key]['product_units'][] = array(
					'selling_price' 	=> $product_obj->STANDARD_SELL_PRICE,
					'currencyid' 		=> $currencyId,
					'sequence' 			=> $product_obj->ORDER_SEQ,
					'unitconversion' 	=> $product_obj->UNIT_TYPE_CONVERSATION,
					'usageunit' 		=> $product_obj->UNIT_TYPE_NAME,
					'qtyinstock'		=> $product_obj->QTY
				);
			} else {
				$products[$key] = array(
					'cscproduct_no' 			=> $product_obj->PRODUCT_ID,
					'cscproduct_number' 		=> $product_obj->PRODUCT_ID,
					'product_name'				=> $product_obj->PRODUCT_NAME,
					'product_part'				=> $product_obj->PRODUCT_PART,
					'product_available_status'	=> $product_obj->PRODUCT_AVAL_STATUS,
					'productcategory'			=> $product_obj->PRODUCT_GROUP_NAME,
					'vendorid'					=> $this->fetchVendorIdByWDSupplierId($product_obj->SUPPLIER_ID),
					'website'					=> null,
					'manufacturer'				=> null,
					'sales_start_date' 			=> null,
					'sales_end_date'			=> null,
					'commissionrate'			=> null,
					'usageunit'					=> $product_obj->MINIMUM_ORD_UNIT_TYPE_NAME,
					'min_or_qty'				=> $product_obj->MINIMUM_ORD_QTY,
					'description'				=> $product_obj->REMARK,
					'tax4' 						=> 0,
					'product_units'				=> array([
						'selling_price' 	=> $product_obj->STANDARD_SELL_PRICE,
						'currencyid' 		=> $currencyId,
						'sequence' 			=> $product_obj->ORDER_SEQ,
						'unitconversion' 	=> $product_obj->UNIT_TYPE_CONVERSATION,
						'usageunit' 		=> $product_obj->UNIT_TYPE_NAME,
						'qtyinstock'		=> $product_obj->QTY
					]),
				);
				$old_key = $key; //save old product key for next unit type
			}
			$previous_number = $product_obj->PRODUCT_ID; //save product number to check with next number
		}
		return $products;
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

	//get MSCRM Vendor ID from WD Supplier ID
	private function fetchVendorIdByWDSupplierId($WDSupplierId)
	{
		global $log, $adb;;
		$sql = <<< EOM
SELECT vendorid
FROM vtiger_vendor as vd
INNER JOIN vtiger_crmentity AS crm ON crm.crmid = vd.vendorid
WHERE vendor_number = ? AND crm.deleted = 0;
EOM;

		$result = $adb->pquery($sql, array($WDSupplierId));
		if ($adb->num_rows($result) > 0) {
			$row = $adb->query_result_rowdata($result);
			$vendor_id = $row['vendorid'];
			return $vendor_id;
		}
	}

	//Save Product Info
	private function saveProducts($settingProducts)
	{
		global $adb;

		//loop for each Product
		foreach ($settingProducts as $key => $product) {

			$save_product = array(
				'module' 					=> 'CSCProducts',
				'action' 					=> 'Save',
				'record' 					=> null,
				'visibility' 				=> 'Public',
			);

			//get data from wd product array
			foreach ($product as $k => $v) {
				$save_product[$k] = $v;
			}

			//check Create or Update action for product info by cscproduct_no
			$sql = "SELECT cscproductsid FROM `vtiger_cscproducts` AS pd 
				INNER JOIN vtiger_crmentity AS crm ON crm.crmid = pd.cscproductsid 
				WHERE cscproduct_no = ? AND crm.deleted = 0";
			$infoExist = $adb->pquery($sql, array($product['cscproduct_no']));
			if ($adb->num_rows($infoExist) > 0) {
				$save_product['record'] = $adb->query_result($infoExist, 0, 'cscproductsid');
			}

			//Save Product Info
			$saveAction = new CSCProducts_Save_Action();
			try {
				$obj = $saveAction->saveRecord(new Vtiger_Request($save_product, $save_product));
			} catch (Exception $e) {
				$this->logger('[ERROR] Cannot Save Product Info ("Product Name is ' . $product['product_name'] . '")');
				$this->logger($e->getTraceAsString());
				continue;
			}
		}


		foreach ($this->product_part_objs as $product_part_obj) {

			//Get CSCProducts Module model
			$CSCProductModuleModel = Vtiger_Module_Model::getInstance('CSCProducts');
			//Get CSCProducts product and part relation Module model
			$relationModel = Vtiger_Relation_Model::getInstance($CSCProductModuleModel, $CSCProductModuleModel);
			$wd_parent_id = $product_part_obj->PRODUCT_ID;
			$wd_part_id = $product_part_obj->PRODUCT_PART_ID;

			$crm_parent_id = $this->getCSCProductid($wd_parent_id);
			$crm_part_id = $this->getCSCProductid($wd_part_id);

			if ($crm_parent_id != null && $crm_part_id != null) {
				if ($this->checkProductRelation($crm_parent_id, $crm_part_id)) {
					$relationModel->addRelation($crm_parent_id, $crm_part_id);
				}
			}
		}
	}


	function getCSCProductid($product_number)
	{
		global $adb;
		$result = $adb->pquery("SELECT cscproductsid FROM vtiger_cscproducts  WHERE cscproduct_number = ?", array($product_number));
		$csc_product_id = $adb->query_result($result, 0, 'cscproductsid');

		if ($csc_product_id ==  null) {
			return "";
		}

		return $csc_product_id;
	}

	function checkProductRelation($product_id, $part_id)
	{
		global $adb;
		$result = $adb->pquery("SELECT * FROM vtiger_crmentityrel  WHERE crmid = ? and relcrmid = ?", array($product_id, $part_id));

		if ($adb->num_rows($result) > 0) {
			return false;
		}

		return true;
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
