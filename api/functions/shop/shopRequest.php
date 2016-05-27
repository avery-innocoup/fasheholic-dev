<?php

if($errorid == 0) {
	
	$is_shop = checkShopExist();
	
	if ($is_shop) {		
		log_traffic($link, "shopRequest", "0", 'Shop Exist for member_id '.$member_id);
		$message = 'Shop Request failed. Shop exist.';
	} else {
		$member_id = $_SESSION['member_id'];
		
		
		$member_profile = getMemberProfile($link, $member_id);
		$member_email;
		$member_name;
		
		$stmt = mysqli_stmt_init($link);
		$query = "UPDATE fash_member SET is_POSTshop = ? WHERE member_id = ?";
		if(mysqli_stmt_prepare($stmt, $query)) {
			mysqli_stmt_bind_param($stmt, 'ii', 1, $member_id);
			mysqli_stmt_execute($stmt);
			
			if(mysqli_stmt_affected_rows($stmt) > 0) {
				$email_message = '<table width="100%" border=0>
				
				
				Hi Fasheholic,<br/><br/>
				There is a request to open a shop.<br/><br/>
				Member ID: '.$member_id.'<br/>
				Name: '.$member_name.'<br/>
				Email: '.$member_email.'<br/>
				
				
	            </table>
	            ';
	            
	            
	            
	            
				
				$email_status = emailAdmin($from_email, $from_name, $email_subject, $email_message);
				
				log_traffic($link, "shopRequest", "1", $member_id);
				
				$status = 'true';
				$message = 'Shop Request success';
				$data = '{"email_status": "'.$email_status.'"}';
			} else {
				log_traffic($link, "shopRequest", "0", $member_id);
				$message = 'Shop Request failed';
			}
			
			mysqli_stmt_close($stmt);
		} else {
			//printf("Prepared Statement Error: %s\n", mysqli_error($link));
		}
	}
}

?>