<?php

if(!isset(
$_POST['product_id'],
$_POST['product_name'],
$_POST['product_desc'],
$_POST['product_myr_price'],
$_POST['product_usd_price']
)) {
	$errorid = 3;
	$message = getErrorMSG($errorid);
}


if($errorid == 0) {
	$product_id = clear_sql_inj($_POST['product_id'], $link);
	$product_name = clear_sql_inj($_POST['product_name'], $link);
	$product_desc = clear_sql_inj($_POST['product_desc'], $link);
	$product_myr_price = clear_sql_inj($_POST['product_myr_price'], $link);
	$product_usd_price = clear_sql_inj($_POST['product_usd_price'], $link);
	
	if(($product_id == '') || ($product_name == '') || ($product_desc == '') || ($product_myr_price == '') || ($product_usd_price == '')) {
		$message = "Some fields are not filled";
	} else {
		$stmt = mysqli_stmt_init($link);
		$query = "UPDATE fash_product SET product_name = ?, product_desc = ?, product_myr_price = ?, product_usd_price = ? WHERE product_id = ?";
		
		if(mysqli_stmt_prepare($stmt, $query)) {
			mysqli_stmt_bind_param($stmt, 'ssddi', $product_name, $product_desc, $product_myr_price, $product_usd_price, $product_id);
			mysqli_stmt_execute($stmt);

			if(mysqli_stmt_affected_rows($stmt) > 0) {
				
				log_traffic($link, "productEdit", "1", $product_id);
				
				$status = 'true';
				$message = 'Product Edit success';
			} else {
				log_traffic($link, "productEdit", "0", $product_id);
				$message = 'Product Edit fail';
			}
			mysqli_stmt_close($stmt);
		} else {
			//printf("Prepared Statement Error: %s\n", mysqli_error($link));
		}
	}
}

?>