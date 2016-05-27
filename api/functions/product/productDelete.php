<?php

if(!isset(
$_POST['product_id']
)) {
	$errorid = 3;
	$message = getErrorMSG($errorid);
}


if($errorid == 0) {
	$product_id = clear_sql_inj($_POST['product_id'], $link);
	
	if(($product_id == '')) {
		$message = "Some fields are not filled";
	} else {
		$stmt = mysqli_stmt_init($link);
		$query = "UPDATE fash_product SET is_deleted = ? WHERE product_id = ?";
		
		if(mysqli_stmt_prepare($stmt, $query)) {
			mysqli_stmt_bind_param($stmt, 'i', $product_id);
			mysqli_stmt_execute($stmt);

			if(mysqli_stmt_affected_rows($stmt) > 0) {
				
				log_traffic($link, "productDelete", "1", $product_id);
				
				$status = 'true';
				$message = 'Product Delete success';
			} else {
				log_traffic($link, "productDelete", "0", $product_id);
				$message = 'Product Delete fail';
			}
			mysqli_stmt_close($stmt);
		} else {
			//printf("Prepared Statement Error: %s\n", mysqli_error($link));
		}
	}
}

?>