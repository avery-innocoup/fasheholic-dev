<?php

if(!isset(
$_POST['shop_name'], 
$_POST['shop_country'],
$_POST['shop_url']
)) {
	$errorid = 3;
	$message = getErrorMSG($errorid);
}


if($errorid == 0) {
	$shop_name = clear_sql_inj($_POST['shop_name'], $link);
	$shop_country = clear_sql_inj($_POST['shop_country'], $link);
	$shop_url = clear_sql_inj($_POST['shop_url'], $link);
	
	if(($shop_name == '') || ($shop_country == '')) {
		$message = "Some fields are not filled";
	} else {
		$is_shop = checkShopExist();

		if ($is_shop) {
			$shop_id = $_SESSION['shop_id'];
			
			$stmt = mysqli_stmt_init($link);
			$query = "UPDATE fash_shop SET shop_name = ?, shop_country = ?, shop_url = ? WHERE shop_id = ? AND valid = 1";
			if(mysqli_stmt_prepare($stmt, $query)) {
				mysqli_stmt_bind_param($stmt, 'sssi', $shop_name, $shop_country, $shop_url, $shop_id);
				mysqli_stmt_execute($stmt);
				
				if(mysqli_stmt_affected_rows($stmt) > 0) {
					
					log_traffic($link, "shopEdit", "1", $shop_id);
					
					$status = 'true';
					$message = 'Shop Edit success';
				} else {
					log_traffic($link, "shopEdit", "0", $shop_id);
					$message = 'Shop Edit failed';
				}
				
				mysqli_stmt_close($stmt);
			} else {
				//printf("Prepared Statement Error: %s\n", mysqli_error($link));
			}
			
		} else {
			$member_id = $_SESSION['member_id'];
			$insert_success = false;
			
			$stmt = mysqli_stmt_init($link);
			$query = "INSERT INTO fash_shop (shop_name, shop_country, shop_url, member_id) VALUES(?, ?, ?, ?)";
			
			if(mysqli_stmt_prepare($stmt, $query)) {
				mysqli_stmt_bind_param($stmt, 'sssi', $shop_name, $shop_country, $shop_url, $member_id);
				mysqli_stmt_execute($stmt);
				
				if(mysqli_stmt_affected_rows($stmt) > 0) {
					$shop_id = mysqli_insert_id($link);
					$_SESSION['shop_id'] = $shop_id;
					
					$insert_success = true;
						
					
				} else {
					
				}
				mysqli_stmt_close($stmt);
			} else {
				//printf("Prepared Statement Error: %s\n", mysqli_error($link));
			}
			
			
			if ($insert_success) {
				$stmt = mysqli_stmt_init($link);
				$query = "UPDATE fash_member SET is_shop = 1 WHERE member_id = ? AND valid = 1";
				if(mysqli_stmt_prepare($stmt, $query)) {
					mysqli_stmt_bind_param($stmt, 'i', $member_id);
					mysqli_stmt_execute($stmt);
					
					if(mysqli_stmt_affected_rows($stmt) > 0) {
						
						log_traffic($link, "shopAdd", "1", $shop_id);
						
						$status = 'true';
						$message = 'Shop Add success';
					} else {
						$_SESSION['shop_id'] = '';
						log_traffic($link, "shopAdd", "0", "Shop add failed. Error: Insert no affected rows");
						$message = 'Shop Add failed';
					}
					
					mysqli_stmt_close($stmt);
				} else {
					//printf("Prepared Statement Error: %s\n", mysqli_error($link));
				}
			}
		}
	}
}

?>