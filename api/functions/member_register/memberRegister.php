<?php

if(!isset(
$_POST['email'], 
$_POST['name'],
$_POST['username'],
$_POST['password']
)) {
	$errorid = 3;
	$message = getErrorMSG($errorid);
}


if($errorid == 0) {
	$email = clear_sql_inj($_POST['email'], $link);
	$name = clear_sql_inj($_POST['name'], $link);
	$username = clear_sql_inj($_POST['username'], $link);
	$password = clear_sql_inj($_POST['password'], $link);
	
	if(($email == '') || ($name == '') || ($username == '') || ($password == '')) {
		$message = "Some fields are not filled";
	} else {
		$stmt = mysqli_stmt_init($link);
		$query = "SELECT member_id, member_email, member_username FROM fash_member WHERE member_email = ? OR member_username = ?";
		if(mysqli_stmt_prepare($stmt, $query)) {
			mysqli_stmt_bind_param($stmt, 'ss', $email, $username);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $member_id, $member_email, $member_username);
			mysqli_stmt_store_result($stmt);
			
			$row = mysqli_stmt_num_rows($stmt);
			
			if($row > 0) {
				mysqli_stmt_fetch($stmt);
				
				$duplicate_msg = '';
				
				if(($email == $member_email) && ($username == $member_username)) {
					$duplicate_msg = 'Email and Username already taken';
				} else {
					if($email == $member_email) {
						$duplicate_msg = 'Email already taken';
					} elseif($username == $member_username) {
						$duplicate_msg = 'Username already taken';
					}
				}
				
				$_SESSION['member_id'] = '';
				log_traffic($link, "memberRegister", "0", "Duplicate: ".$email.", ".$username);
				
				$message = 'Register duplicate';
				$data = '{"duplicate_msg": "'.$duplicate_msg.'"}';
			} else {
				$stmt = mysqli_stmt_init($link);
				$query = "INSERT INTO fash_member (member_email, member_name, member_username, member_password) VALUES(?, ?, ?, ?)";
				
				if(mysqli_stmt_prepare($stmt, $query)) {
					
					// Create a password hash
					$password_hash = password_hash($password, PASSWORD_BCRYPT);
					
					mysqli_stmt_bind_param($stmt, 'ssss', $email, $name, $username, $password_hash);
					mysqli_stmt_execute($stmt);
					
					if(mysqli_stmt_affected_rows($stmt) > 0) {
						$member_id = mysqli_insert_id($link);
						
// 						$_SESSION['member_id'] = $member_id;						
// 						update_lastlogin($link, $member_id, $dt_now);
						log_traffic($link, "memberRegister", "1", $member_id);
						
						$status = 'true';
						$message = 'Register success';
					} else {
						$_SESSION['member_id'] = '';
						log_traffic($link, "memberRegister", "0", "Register failed. Error: Insert no affected rows");
						$message = 'Register failed';
					}
					mysqli_stmt_close($stmt);
				} else {
					//printf("Prepared Statement Error: %s\n", mysqli_error($link));
				}
			}
			
			mysqli_stmt_free_result($stmt);
			mysqli_stmt_close($stmt);
		} else {
			//printf("Prepared Statement Error: %s\n", mysqli_error($link));
		}
	}
}

?>