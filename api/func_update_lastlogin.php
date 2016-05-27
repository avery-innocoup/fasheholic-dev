<?php
	
function update_lastlogin($link, $member_id, $dt_now){
	$stmt = mysqli_stmt_init($link);
	$query = "UPDATE fash_member SET dt_lastlogin = ? WHERE member_id = ?";
	
	if(mysqli_stmt_prepare($stmt, $query)) {
		mysqli_stmt_bind_param($stmt, 'si', $dt_now, $member_id);
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