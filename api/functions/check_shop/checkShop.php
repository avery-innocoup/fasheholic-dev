<?php
session_start();

require_once('../../../include/open_db.php');
require_once('../../global_var.php');

if(!isset($_SESSION['shop_id']) || $_SESSION['shop_id'] == '') {
	$errorid = 4;
	$message = getErrorMSG($errorid);
} else {
	$status = 'true';
	$message = 'Check Shop true';
}

mysqli_close($link);

$output = '{"status": "'.$status.'", "message": "'.$message.'", "data": ['.$data.']}';
echo $output;
?>