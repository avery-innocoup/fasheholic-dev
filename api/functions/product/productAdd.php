<?php

if(!isset(
$_POST['product_name'],
$_POST['product_cat'],
$_POST['product_desc'],
$_POST['product_myr_price'],
$_POST['product_usd_price'],
$_POST['product_image_base64'],
$_POST['product_image_name'],
$_POST['product_image_ext']
)) {
	$errorid = 3;
	$message = getErrorMSG($errorid);
}


if($errorid == 0) {
	$product_name = clear_sql_inj($_POST['product_name'], $link);
	$product_cat = clear_sql_inj($_POST['product_cat'], $link);
	$product_desc = clear_sql_inj($_POST['product_desc'], $link);
	$product_myr_price = clear_sql_inj($_POST['product_myr_price'], $link);
	$product_usd_price = clear_sql_inj($_POST['product_usd_price'], $link);
	$product_image_base64 = $_POST['product_image_base64'];
	$product_image_name = clear_sql_inj($_POST['product_image_name'], $link);
	$product_image_ext = clear_sql_inj($_POST['product_image_ext'], $link);
	
// 	echo $product_image_base64.'<br>';
// 	echo $product_image_name.'<br>';
// 	echo $product_image_ext.'<br>';
	
	if(
	($product_name == '') ||
	($product_cat == '') ||
	($product_desc == '') ||
	($product_myr_price == '') ||
	($product_usd_price == '') ||
	($product_image_base64 == '') ||
	($product_image_name == '') ||
	($product_image_ext == '')
	) {
		$message = "Some fields are not filled";
	} else {
		$shop_id = $_SESSION['shop_id'];
		$member_id = $_SESSION['member_id'];
		
		
		$dir_path = $_SERVER['DOCUMENT_ROOT']."/_staging2/media/catalog/product/";
		
		$fp = fopen($dir_path.$product_image_name, "w+") or die("Unable to open file!");
// 		print_r(error_get_last());
		fwrite($fp, base64_decode($product_image_base64));
		
		$new_product_name = $shop_id.'-'.$dt_micro.'-'.$product_image_name;
		rename($dir_path.$product_image_name,$dir_path.$new_product_name);
		
// 		$chmod_file = $dir_path.$product_image_name;
		
		fclose($fp);
// 		chmod($chmod_file, 0777);
		
		
		
		
		$stmt = mysqli_stmt_init($link);
		$query = "INSERT INTO fash_product (product_name, product_category, product_desc, product_myr_price, product_usd_price, product_image_name, shop_id, member_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
		
		if(mysqli_stmt_prepare($stmt, $query)) {
			mysqli_stmt_bind_param($stmt, 'sssddsii', $product_name, $product_cat, $product_desc, $product_myr_price, $product_usd_price, $new_product_name, $shop_id, $member_id);
			mysqli_stmt_execute($stmt);

			if(mysqli_stmt_affected_rows($stmt) > 0) {
				$product_id = mysqli_insert_id($link);
				log_traffic($link, "productAdd", "1", $product_id);
				
				$status = 'true';
				$message = 'Product Add success';
			} else {
				log_traffic($link, "productAdd", "0", "Product add failed. Error: Insert no affected rows");
				$message = 'Product Add fail';
			}
			mysqli_stmt_close($stmt);
		} else {
			//printf("Prepared Statement Error: %s\n", mysqli_error($link));
		}
	}
}

?>