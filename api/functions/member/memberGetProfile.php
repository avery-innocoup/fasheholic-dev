<?php


if($errorid == 0) {
	$member_id = $_SESSION['member_id'];
	
	$stmt = mysqli_stmt_init($link);
	$query = "SELECT member_email, member_name, member_username, member_logo_image_name, member_description FROM fash_member WHERE member_id = ? AND valid = 1";
	if(mysqli_stmt_prepare($stmt, $query)) {
		mysqli_stmt_bind_param($stmt, 'i', $member_id);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $member_email, $member_name, $member_username, $member_logo_image_name, $member_description);
		mysqli_stmt_store_result($stmt);
		
		$row = mysqli_stmt_num_rows($stmt);
		
		if($row > 0) {
			mysqli_stmt_fetch($stmt);
			
			
			$member_dir = "media/member/logo/";
			
			
			log_traffic($link, "memberGetProfile", "1", $member_id);
			
			$status = 'true';
			$message = 'Member Get Profile success';
			$data = '{"member_email": "'.$member_email.'", "member_name": "'.$member_name.'", "member_username": "'.$member_username.'", "member_dir": "'.$member_dir.'", "member_logo_image_name": "'.$member_logo_image_name.'", "member_description": "'.$member_description.'"}';
		} else {				
			log_traffic($link, "memberGetProfile", "0", $member_id);
			$message = 'Member Get Profile fail';
		}
		
		mysqli_stmt_free_result($stmt);
		mysqli_stmt_close($stmt);
	} else {
		//printf("Prepared Statement Error: %s\n", mysqli_error($link));
	}
}

?>