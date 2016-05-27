<?php


if($errorid == 0) {
	$shop_id = $_SESSION['shop_id'];
	
	$stmt = mysqli_stmt_init($link);
	$query = "SELECT shop_banner_image_name FROM fash_shop WHERE shop_id = ? AND valid = 1";
	if(mysqli_stmt_prepare($stmt, $query)) {
		mysqli_stmt_bind_param($stmt, 'i', $shop_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $shop_banner_image_name);
		mysqli_stmt_store_result($stmt);
		
		$row = mysqli_stmt_num_rows($stmt);
		
		if($row > 0) {
			mysqli_stmt_fetch($stmt);
			
			
			$banner_dir = "media/shop/banner/";
			
			
			log_traffic($link, "shopGetBanner", "1", $shop_id);
			
			$status = 'true';
			$message = 'Shop Get Banner success';
			$data = '{"banner_dir": "'.$banner_dir.'", "shop_banner_image_name": "'.$shop_banner_image_name.'"}';
		} else {				
			log_traffic($link, "shopGetBanner", "0", $shop_id);
			$message = 'Shop Get Banner fail';
		}
		
		mysqli_stmt_free_result($stmt);
		mysqli_stmt_close($stmt);
	} else {
		//printf("Prepared Statement Error: %s\n", mysqli_error($link));
	}
}

?>