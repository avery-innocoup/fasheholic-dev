<?php
	
	require_once("credential.php");
	// Turn off error reporting
// 	error_reporting(0);
	
	// Report all errors
	error_reporting(E_ALL);
	
	$link = mysqli_connect($hostname, $username_db, $password_db, $database) or trigger_error(mysqli_error(), E_USER_ERROR);
	
	if (!$link) {
		die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
	}
	/*else
	{
		echo 'Success... ' . mysqli_get_host_info($link) . "\n";
	}*/
	
	//mysqli_close($link);

?>