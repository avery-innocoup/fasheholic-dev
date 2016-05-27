<?php
session_start();

require_once('../include/open_db.php');
require_once('global_var.php');

function checkShopExist() {
	$shop_flag = 0;
	$member_id = $_SESSION['member_id'];
	
	// Get & store shop_id in session if exist
	$stmt2 = mysqli_stmt_init($link);
	$query2 = "SELECT shop_id FROM fash_shop WHERE member_id = ? AND valid = 1";
	if(mysqli_stmt_prepare($stmt2, $query2)) {
		mysqli_stmt_bind_param($stmt2, 'i', $member_id);
		mysqli_stmt_execute($stmt2);
		mysqli_stmt_bind_result($stmt2, $shop_id);
		mysqli_stmt_store_result($stmt2);
		
		$row = mysqli_stmt_num_rows($stmt2);
		
		if($row > 0) {
			mysqli_stmt_fetch($stmt2);
			
			$_SESSION['shop_id'] = $shop_id;
			
		} else {
			$_SESSION['shop_id'] = '';
		}
		
		mysqli_stmt_free_result($stmt2);
		mysqli_stmt_close($stmt2);
	} else {
		//printf("Prepared Statement Error: %s\n", mysqli_error($link));
	}
					
					
	if(isset($_SESSION['shop_id']) && $_SESSION['shop_id'] != '') {
		$shop_flag = 1;
	}
	
	return $shop_flag;
}
?>