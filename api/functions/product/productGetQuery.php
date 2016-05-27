<?php

if(!isset(
$_POST['q']
)) {
	$errorid = 3;
	$message = getErrorMSG($errorid);
}

if($errorid == 0) {
	$total_product = 0;
	
	$q = clear_sql_inj($_POST['q'], $link);
	
	$stmt = mysqli_stmt_init($link);
	$query = "SELECT COUNT(product_id) AS total_product FROM fash_product WHERE is_deleted = 0 AND valid = 1 AND product_name LIKE '%$q%'";
	if(mysqli_stmt_prepare($stmt, $query)) {
// 		mysqli_stmt_bind_param($stmt, 's', '%$q%');
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $total_product);
		mysqli_stmt_store_result($stmt);
		
		$row = mysqli_stmt_num_rows($stmt);
		
		if($row > 0) {
			mysqli_stmt_fetch($stmt);
			
		} else {				
			
		}
		
		mysqli_stmt_free_result($stmt);
		mysqli_stmt_close($stmt);
	} else {
		//printf("Prepared Statement Error: %s\n", mysqli_error($link));
	}
	
	
	if ($total_product) {
		$stmt = mysqli_stmt_init($link);
		$query = "SELECT a.product_name, a.product_desc, a.product_myr_price, a.product_usd_price, a.product_image_name, a.shop_id, b.shop_name, b.shop_country, c.member_logo_image_name 
		FROM fash_product a, fash_shop b, fash_member c
		WHERE a.shop_id = b.shop_id 
		AND b.member_id = c.member_id
		AND a.valid = 1
		AND a.product_name LIKE '%$q%'
		ORDER BY a.dt_add DESC";
		if(mysqli_stmt_prepare($stmt, $query)) {
// 			mysqli_stmt_bind_param($stmt, 's', '%$q%');
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $product_name, $product_desc, $product_myr_price, $product_usd_price, $product_image_name, $shop_id, $shop_name, $shop_country, $member_logo_image_name);
			mysqli_stmt_store_result($stmt);
			
			$row = mysqli_stmt_num_rows($stmt);
			$first_row = 1;
			$product_obj = "";
			$product_dir = "media/catalog/product/";
			$logo_dir = "media/member/logo/";
			
			if($row > 0) {
				while (mysqli_stmt_fetch($stmt))
				{
					if($first_row) {
						$first_row = 0;
					} else {
						$product_obj .= ',';
					}
					
					$product_obj .= '{"product_name": "'.$product_name.'", "product_desc": "'.$product_desc.'", "product_myr_price": "'.$product_myr_price.'", "product_usd_price": "'.$product_usd_price.'", "product_image_name": "'.$product_image_name.'", "shop_id": "'.$shop_id.'", "shop_name": "'.$shop_name.'", "shop_country": "'.$shop_country.'", "member_logo_image_name": "'.$member_logo_image_name.'"}';
				}
				
				log_traffic($link, "productGetQuery", "1", $q);
				
				$status = 'true';
				$message = 'Product Get Query success';
				$data = '{"total_product": "'.$total_product.'", "logo_dir": "'.$logo_dir.'", "product_dir": "'.$product_dir.'", "product_obj": ['.$product_obj.']}';
			} else {				
				log_traffic($link, "productGetQuery", "0", $q);
				$message = 'Product Get Query fail';
			}
			
			mysqli_stmt_free_result($stmt);
			mysqli_stmt_close($stmt);
		} else {
			printf("Prepared Statement Error: %s\n", mysqli_error($link));
		}
	}
}

?>