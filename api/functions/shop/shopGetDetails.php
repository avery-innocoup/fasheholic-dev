<?php

if($errorid == 0) {
	$is_shop = checkShopExist();
	
	if ($is_shop) {
		$shop_id = $_SESSION['shop_id'];
		
		$stmt = mysqli_stmt_init($link);
		$query = "SELECT shop_name, shop_country, shop_url FROM fash_shop WHERE shop_id = ? AND valid = 1";
		if(mysqli_stmt_prepare($stmt, $query)) {
			mysqli_stmt_bind_param($stmt, 'i', $shop_id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $shop_name, $shop_country, $shop_url);
			mysqli_stmt_store_result($stmt);
			
			$row = mysqli_stmt_num_rows($stmt);
			
			if($row > 0) {
				mysqli_stmt_fetch($stmt);
				
				
				log_traffic($link, "shopGetDetails", "1", $shop_id);
				
				$status = 'true';
				$message = 'Shop Get Details success';
				$data = '{"shop_name": "'.$shop_name.'", "shop_country": "'.$shop_country.'", "shop_url": "'.$shop_url.'"}';
			} else {				
				log_traffic($link, "shopGetDetails", "0", $shop_id);
				$message = 'Shop Get Details fail';
			}
			
			mysqli_stmt_free_result($stmt);
			mysqli_stmt_close($stmt);
		} else {
			//printf("Prepared Statement Error: %s\n", mysqli_error($link));
		}
	} else {
		$message = "No Shop yet";
	}
}

?>