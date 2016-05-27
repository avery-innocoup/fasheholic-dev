<?php
session_start();

require_once('../include/open_db.php');
require_once('global_var.php');
require_once('func_log_traffic.php');
require_once('check_login.php');
// require_once('check_shop.php');


if($errorid == 0) {
// 	$action = clear_sql_inj($_REQUEST['action'], $link);
	
	
	
	
	if (isset($_POST['submit'])) {
		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);
		
		$product_name = clear_sql_inj($_POST['product_name'], $link);
		$product_cat = clear_sql_inj($_POST['product_cat'], $link);
		$product_desc = clear_sql_inj($_POST['product_desc'], $link);
		$product_local_price = clear_sql_inj($_POST['product_local_price'], $link);
		$product_usd_price = clear_sql_inj($_POST['product_usd_price'], $link);
		
		
		if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
		) && ($_FILES["file"]["size"] < 100000)//Approx. 100kb files can be uploaded.
		&& in_array($file_extension, $validextensions)) {
			
			if ($_FILES["file"]["error"] > 0) {
// 				echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
				$message = "Return Code: " . $_FILES["file"]["error"];
			} else {
/*
				echo "<span>Your File Uploaded Succesfully...!!</span><br/>";
				echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
				echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
				echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
*/
				
				if (file_exists("upload/" . $_FILES["file"]["name"])) {
// 					echo $_FILES["file"]["name"] . " <b>already exists.</b> ";
					$message = "File name already exists."
				} else {



					if(($product_name == '') || ($product_desc == '') || ($product_local_price == '') || ($product_usd_price == '')) {
						$message = "Some fields are not filled";
					} else {
						
						move_uploaded_file($_FILES["file"]["tmp_name"], "media/catalog/product/" . $_FILES["file"]["name"]);
// 						$imgFullpath = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER["REQUEST_URI"].'?').'/'. "media/catalog/product/" . $_FILES["file"]["name"];
// 						echo "<b>Stored in:</b><a href = '$imgFullpath' target='_blank'> " .$imgFullpath.'<a>';



						$_SESSION['shop_id'] = $shop_id;
						
						$stmt = mysqli_stmt_init($link);
						$query = "INSERT INTO fash_product (product_name, product_category, product_desc, product_local_price, product_usd_price, product_image_name, shop_id) VALUES(?, ?, ?, ?, ?, ?, ?)";
						
						if(mysqli_stmt_prepare($stmt, $query)) {
							mysqli_stmt_bind_param($stmt, 'sssddsi', $product_name, $product_cat, $product_desc, $product_local_price, $product_usd_price, $_FILES["file"]["name"], $shop_id);
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
			}
		} else {
// 			echo "<span>***Invalid file Size or Type***<span>";
			$message = "Invalid file Size or Type";
		}
	}
}

mysqli_close($link);

$output = '{"status": "'.$status.'", "message": "'.$message.'", "data": ['.$data.']}';
echo $output;
?>