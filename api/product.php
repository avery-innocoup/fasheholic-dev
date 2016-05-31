<?php
session_start();

use PHPImageWorkshop\ImageWorkshop; // Use the namespace of ImageWorkshop

require_once('../include/open_db.php');
require_once('global_var.php');
require_once('func_log_traffic.php');
require_once('check_login.php');
// require_once('check_shop.php');
require_once('class/PHPImageWorkshop/ImageWorkshop.php');

if(!isset($_REQUEST['action'])) {
	$errorid = 2;
	$message = getErrorMSG($errorid);
}


if($errorid == 0) {
	$action = clear_sql_inj($_REQUEST['action'], $link);
	
	include_once('functions/product/'.$action.'.php');
}

mysqli_close($link);

$output = '{"status": "'.$status.'", "message": "'.$message.'", "data": ['.$data.']}';
echo $output;
?>