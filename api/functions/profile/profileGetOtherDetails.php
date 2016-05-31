<?php
	
if(!isset(
$_POST['profile']
)) {
	$errorid = 3;
	$message = getErrorMSG($errorid);
}

if($errorid == 0) {
	$member_id = clear_sql_inj($_POST['profile'], $link);
	
	$total_product = 0;
	
	$stmt = mysqli_stmt_init($link);
	$query = "SELECT COUNT(product_id) AS total_product, shop_id
	FROM 
	fash_product 
	WHERE 
	member_id = ?
	AND is_deleted = 0 
	AND valid = 1";
	if(mysqli_stmt_prepare($stmt, $query)) {
		mysqli_stmt_bind_param($stmt, 'i', $member_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $total_product, $shop_id);
		mysqli_stmt_store_result($stmt);
		
		$row = mysqli_stmt_num_rows($stmt);
		
		if($row > 0) {
			mysqli_stmt_fetch($stmt);
			
		} else {
			
		}
		
		mysqli_stmt_free_result($stmt);
		mysqli_stmt_close($stmt);
	} else {
// 		printf("Prepared Statement Error: %s\n", mysqli_error($link));
	}
	
	
	

	if ($total_product) {
		$stmt = mysqli_stmt_init($link);
		$query = "SELECT a.product_id, a.product_name, a.product_desc, a.product_myr_price, a.product_usd_price, a.product_image_name, a.shop_id, b.shop_name, b.shop_country, b.shop_banner_image_name, c.member_logo_image_name, c.member_description 
		FROM 
		fash_product a, fash_shop b, fash_member c 
		WHERE 
		a.shop_id = b.shop_id 
		AND b.member_id = c.member_id
		AND b.shop_id = ? 
		AND a.valid = 1";
		if(mysqli_stmt_prepare($stmt, $query)) {
			mysqli_stmt_bind_param($stmt, 'i', $shop_id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $product_id, $product_name, $product_desc, $product_myr_price, $product_usd_price, $product_image_name, $shop_id, $shop_name, $shop_country, $shop_banner_image_name, $member_logo_image_name, $member_description);
			mysqli_stmt_store_result($stmt);
			
			$row = mysqli_stmt_num_rows($stmt);
			$first_row = 1;
			$product_obj = "";
			$product_dir = "media/catalog/product/";
			$banner_dir = "media/shop/banner/";
			$logo_dir = "media/member/logo/";
			
			if($row > 0) {
				while (mysqli_stmt_fetch($stmt))
				{
					if($first_row) {
						$first_row = 0;
					} else {
						$product_obj .= ',';
					}
					
					$product_obj .= '{"product_id": "'.$product_id.'", "product_name": "'.$product_name.'", "product_desc": "'.$product_desc.'", "product_myr_price": "'.$product_myr_price.'", "product_usd_price": "'.$product_usd_price.'", "product_image_name": "'.$product_image_name.'"}';
				}
				
// 				log_traffic($link, "productGetAll", "1", $product_id);
				
				$status = 'true';
				log_traffic($link, "profileGetOtherDetails", "1", $member_id);
				$message = 'Profile Get Other Details success';
				$data = '{"shop_name": "'.$shop_name.'", "shop_country": "'.$shop_country.'", "shop_banner_image_name": "'.$shop_banner_image_name.'", "member_logo_image_name": "'.$member_logo_image_name.'", "member_description": "'.$member_description.'", "banner_dir": "'.$banner_dir.'", "logo_dir": "'.$logo_dir.'", "total_product": "'.$total_product.'", "product_dir": "'.$product_dir.'", "product_obj": ['.$product_obj.']}';
			} else {				
				log_traffic($link, "profileGetOtherDetails", "0", $member_id);
				$message = 'Profile Get Other Details fail';
			}
			
			mysqli_stmt_free_result($stmt);
			mysqli_stmt_close($stmt);
		} else {
			//printf("Prepared Statement Error: %s\n", mysqli_error($link));
		}
	}

}

?>