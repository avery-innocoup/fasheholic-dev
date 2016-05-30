<?php

if(!isset(
$_POST['member_email'],
$_POST['member_name'],
$_POST['member_username'],
$_POST['member_desc']
// $_POST['member_image_base64'],
// $_POST['member_image_name']
)) {
	$errorid = 3;
	$message = getErrorMSG($errorid);
}


if($errorid == 0) {
	$member_email = clear_sql_inj($_POST['member_email'], $link);
	$member_name = clear_sql_inj($_POST['member_name'], $link);
	$member_username = clear_sql_inj($_POST['member_username'], $link);
	$member_desc = clear_sql_inj($_POST['member_desc'], $link);
	$member_image_base64 = $_POST['member_image_base64'];
	$member_image_name = clear_sql_inj($_POST['member_image_name'], $link);
		
	if(
	($member_email == '') ||
	($member_name == '') ||
	($member_username == '') ||
	($member_desc == '')
// 	($member_image_base64 == '') ||
// 	($member_image_name == '')
	) {
		$message = "Some fields are not filled";
	} else {
		$member_id = $_SESSION['member_id'];
		
		
		if ( ($member_image_base64) && ($member_image_name) ) {
			$dir_path = $_SERVER['DOCUMENT_ROOT']."/_fasheholic/media/member/logo/";
			
			$fp = fopen($dir_path.$member_image_name, "w+") or die("Unable to open file!");
			print_r(error_get_last());
			fwrite($fp, base64_decode($member_image_base64));
			
			$new_member_logoname = $member_id.'-'.$dt_micro.'-'.$member_image_name;
			rename($dir_path.$member_image_name,$dir_path.$new_member_logoname);
			
	// 		$chmod_file = $dir_path.$member_image_name;
			
			fclose($fp);
	// 		chmod($chmod_file, 0777);
	
			$stmt = mysqli_stmt_init($link);
			$query = "UPDATE fash_member SET member_email = ?, member_name = ?, member_username = ?, member_logo_image_name = ?, member_description = ? WHERE member_id = ?";
			
			if(mysqli_stmt_prepare($stmt, $query)) {
				mysqli_stmt_bind_param($stmt, 'sssssi', $member_email, $member_name, $member_username, $new_member_logoname, $member_desc, $member_id);
				mysqli_stmt_execute($stmt);
	
				if(mysqli_stmt_affected_rows($stmt) > 0) {
					
					log_traffic($link, "memberEditProfile", "1", $member_id);
					
					$status = 'true';
					$message = 'Member Edit success';
				} else {
					log_traffic($link, "memberEditProfile", "0", $member_id);
					$message = 'Member Edit fail';
				}
				mysqli_stmt_close($stmt);
			} else {
				//printf("Prepared Statement Error: %s\n", mysqli_error($link));
			}
		} else {
			$stmt = mysqli_stmt_init($link);
			$query = "UPDATE fash_member SET member_email = ?, member_name = ?, member_username = ?, member_description = ? WHERE member_id = ?";
			
			if(mysqli_stmt_prepare($stmt, $query)) {
				mysqli_stmt_bind_param($stmt, 'ssssi', $member_email, $member_name, $member_username, $member_desc, $member_id);
				mysqli_stmt_execute($stmt);
	
				if(mysqli_stmt_affected_rows($stmt) > 0) {
					
					log_traffic($link, "memberEditProfile", "1", $member_id);
					
					$status = 'true';
					$message = 'Member Edit success';
				} else {
					log_traffic($link, "memberEditProfile", "0", $member_id);
					$message = 'Member Edit fail';
				}
				mysqli_stmt_close($stmt);
			} else {
				//printf("Prepared Statement Error: %s\n", mysqli_error($link));
			}
		}
	}
}

?>