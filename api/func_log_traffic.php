<?php

function log_traffic($link, $event, $value, $remark){
	$ip = $_SERVER['REMOTE_ADDR'];
	//$value = "'".$event."','".$value."','".$remark."','".$ip."'";
	
	$stmt = mysqli_stmt_init($link);
	$query = "INSERT INTO fash_traffic_log (event, value, remark, ip) VALUES(?, ?, ?, ?)";
	
	if(mysqli_stmt_prepare($stmt, $query)) {
		mysqli_stmt_bind_param($stmt, 'ssss', $event, $value, $remark, $ip);
		mysqli_stmt_execute($stmt);
		
		if(mysqli_stmt_affected_rows($stmt) > 0) {
			$output = "Success";
		} else {
			$output = "Fail";
		}
		mysqli_stmt_close($stmt);
	} else {
		$output = 'Error';		
	}
	
// 	return $output;
}

?>