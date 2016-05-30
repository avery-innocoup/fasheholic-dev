<?php

if(!isset(
$_POST['banner_image_base64'],
$_POST['banner_image_name']
)) {
	$errorid = 3;
	$message = getErrorMSG($errorid);
}


if($errorid == 0) {
	$banner_image_base64 = $_POST['banner_image_base64'];
	$banner_image_name = clear_sql_inj($_POST['banner_image_name'], $link);
	if(
	($banner_image_base64 == '') ||
	($banner_image_name == '')
	) {
		$message = "Some fields are not filled";
	} else {
		$shop_id = $_SESSION['shop_id'];
		
		$dir_path = $_SERVER['DOCUMENT_ROOT']."/_fasheholic/media/shop/banner/";
		
		$fp = fopen($dir_path.$banner_image_name, "w+") or die("Unable to open file!");
// 		print_r(error_get_last());
		fwrite($fp, base64_decode($banner_image_base64));
		
		$new_banner_name = $shop_id.'-'.$dt_micro.'-'.$banner_image_name;
		rename($dir_path.$banner_image_name,$dir_path.$new_banner_name);
		
// 		$chmod_file = $dir_path.$banner_image_name;
		
		fclose($fp);
// 		chmod($chmod_file, 0777);

		
		$stmt = mysqli_stmt_init($link);
		$query = "UPDATE fash_shop SET shop_banner_image_name = ? WHERE shop_id = ? AND valid = 1";
		if(mysqli_stmt_prepare($stmt, $query)) {
			mysqli_stmt_bind_param($stmt, 'si', $new_banner_name, $shop_id);
			mysqli_stmt_execute($stmt);
			
			if(mysqli_stmt_affected_rows($stmt) > 0) {
				
				log_traffic($link, "shopEditBanner", "1", $shop_id);
				
				$status = 'true';
				$message = 'Shop Edit Banner success';
			} else {
				log_traffic($link, "shopEditBanner", "0", $shop_id);
				$message = 'Shop Edit Banner failed';
			}
			
			mysqli_stmt_close($stmt);
		} else {
			//printf("Prepared Statement Error: %s\n", mysqli_error($link));
		}
	}
}

?>