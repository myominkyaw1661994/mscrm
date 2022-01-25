<?php
$username='';
$password='';

$is_direct=$_GET['direct'];
if($is_direct == '1') {
	$username=$_GET['username'];
	$password=$_GET['password'];
}
else {
	//URL generation for automatic login
	$username=$_GET['USRID'];
	$password = 'WmgRyxd8M5aZ';
}
$url = 'index.php?module=Users&action=Login&windowsize=1024&username='.$username.'&password='.$password;

//Direct
header('Location:'.$url);
exit;

