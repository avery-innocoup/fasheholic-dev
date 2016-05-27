<?php
session_start();

require_once('../include/open_db.php');
require_once('global_var.php');

if(!isset($_SESSION['member_id']) && $_SESSION['member_id'] == '') {
	$errorid = 1;
	$message = getErrorMSG($errorid);
}
?>