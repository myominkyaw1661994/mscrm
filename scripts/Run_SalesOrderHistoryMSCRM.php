<?php
//2021-10-22 Thet Phyo Wai Sales Orders Data Transfer from MSCRM
require_once(dirname(__FILE__)."/../config.inc.php");//Load the CRM config file to get the $site_URL

$custom_import_url = $site_URL . 'index.php?module=CSCSalesOrder&action=SelfTransfer';
$login_url         = $site_URL . 'LoginAdapter.php?direct=1&username=Admin&password=12345678';

 $tmp_path = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'cookie.txt';
 $params='direct=1&username=admin&password=Admin@12345';
 

//Login with admin
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $login_url);
 curl_setopt ($ch,CURLOPT_POSTFIELDS,$params);
 curl_setopt($ch,CURLOPT_HEADER, true);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 // curl_setopt($ch,CURLOPT_COOKIEFILE,$tmp_path);
 curl_setopt($ch, CURLOPT_COOKIEJAR, $tmp_path);
 curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);

 $html =  curl_exec($ch);
 var_dump($html);
 curl_close($ch); //End


//Import process start
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $custom_import_url);
curl_setopt($ch,CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_COOKIEFILE,$tmp_path);
// curl_setopt($ch, CURLOPT_COOKIEJAR, $tmp_path);
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);

$html =  curl_exec($ch);
var_dump($html);
curl_close($ch); //End