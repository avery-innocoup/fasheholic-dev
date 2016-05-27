<?php

if(!isset(
$_POST['username'],
$_POST['password']
)) {
	$errorid = 3;
	$message = getErrorMSG($errorid);
}

if($errorid == 0) {
	$username = clear_sql_inj($_POST['username'], $link);
	$password = clear_sql_inj($_POST['password'], $link);
	
	if(($username == '') || ($password == '')) {
		$message = "Some fields are not filled";
	} else {
		$stmt = mysqli_stmt_init($link);
		$query = "SELECT member_id, member_password FROM fash_member WHERE member_username = ? AND valid = 1";
		if(mysqli_stmt_prepare($stmt, $query)) {
			mysqli_stmt_bind_param($stmt, 's', $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $member_id, $member_password);
			mysqli_stmt_store_result($stmt);
			
			$row = mysqli_stmt_num_rows($stmt);
			
			if($row > 0) {
				mysqli_stmt_fetch($stmt);
				
				// Create a password hash
// 				$password_hash = password_hash($password, PASSWORD_BCRYPT);
				
				// Verify password hash
				if(password_verify($password, $member_password)) {
					
					$_SESSION['member_id'] = $member_id;
					
					update_lastlogin($link, $member_id, $dt_now);
					log_traffic($link, "memberLogin", "1", $member_id);
					
					
					
					
					// Get & store shop_id in session if exist
					$stmt2 = mysqli_stmt_init($link);
					$query2 = "SELECT shop_id FROM fash_shop WHERE member_id = ? AND valid = 1";
					if(mysqli_stmt_prepare($stmt2, $query2)) {
						mysqli_stmt_bind_param($stmt2, 'i', $member_id);
						mysqli_stmt_execute($stmt2);
						mysqli_stmt_bind_result($stmt2, $shop_id);
						mysqli_stmt_store_result($stmt2);
						
						$row = mysqli_stmt_num_rows($stmt2);
						
						if($row > 0) {
							mysqli_stmt_fetch($stmt2);
							
							$_SESSION['shop_id'] = $shop_id;
							
						} else {
							$_SESSION['shop_id'] = '';
						}
						
						mysqli_stmt_free_result($stmt2);
						mysqli_stmt_close($stmt2);
					} else {
						//printf("Prepared Statement Error: %s\n", mysqli_error($link));
					}
					
					
					$status = 'true';
					$message = 'Login success';
	// 				$data = '{"name": "'.$name.'", "first_login": "'.$first_login.'"}';
				} else {
					$_SESSION['member_id'] = '';
					log_traffic($link, "memberLogin", "0", "Invalid password. Memberid: ".$member_id);
					$message = 'Invalid username or password';
				}
				
			} else 	{
				$_SESSION['member_id'] = '';
				log_traffic($link, "memberLogin", "0", "Invalid username: ".$username);
				$message = 'Invalid username or password';
			}
			
			mysqli_stmt_free_result($stmt);
			mysqli_stmt_close($stmt);
		} else {
			//printf("Prepared Statement Error: %s\n", mysqli_error($link));
		}
	}
}

?>