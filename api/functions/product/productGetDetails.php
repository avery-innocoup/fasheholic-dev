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
		$query = "SELECT a.product_name, a.product_desc, a.product_myr_price, a.product_usd_price, b.shop_name, b.shop_country FROM fash_product a, fash_shop b WHERE a.shop_id = b.shop_id AND a.product_id = ? AND a.valid = 1";
		if(mysqli_stmt_prepare($stmt, $query)) {
			mysqli_stmt_bind_param($stmt, 'i', $product_id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $product_name, $product_desc, $product_myr_price, $product_usd_price, $product_image_name, $shop_name, $shop_country);
			mysqli_stmt_store_result($stmt);
			
			$row = mysqli_stmt_num_rows($stmt);
			
			if($row > 0) {
				mysqli_stmt_fetch($stmt);
				
				
				log_traffic($link, "productGetDetails", "1", $product_id);
				
				$status = 'true';
				$message = 'Product Get Details success';
				$data = '{"product_name": "'.$product_name.'", "product_desc": "'.$product_desc.'", "product_myr_price": "'.$product_myr_price.'", "product_usd_price": "'.$product_usd_price.'", "product_image_name": "'.$product_image_name.'", "shop_name": "'.$shop_name.'", "shop_country": "'.$shop_country.'"}';
			} else {				
				log_traffic($link, "productGetDetails", "0", $product_id);
				$message = 'Product Get Details fail';
			}
			
			mysqli_stmt_free_result($stmt);
			mysqli_stmt_close($stmt);
		} else {
			//printf("Prepared Statement Error: %s\n", mysqli_error($link));
		}
	}
}

?>