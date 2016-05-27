<?php
	
	require_once('class/PHPMailerAutoload.php');
	date_default_timezone_set('Asia/Kuala_Lumpur');

	$status = 'false';
	$message = '';
	$data = '';
	$action = '';
	$errorid = 0;
	$dt_now = date("Y-m-d H:i:s");
	$dt_date_now = date("Y-m-d");
	$dt_micro = date("YmdHis") . substr((string)microtime(), 2, 6);
	
	$err_msg_arr = array("No error"); //0
	array_push($err_msg_arr, "Member not login"); //1
	array_push($err_msg_arr, "Missing action param"); //2
	array_push($err_msg_arr, "Missing input param"); //3
	array_push($err_msg_arr, "Member no shop"); //4
		
	function getErrorMSG($err_id) {
		global $err_msg_arr;
		return $err_msg_arr[$err_id];
	}
	
	function clear_sql_inj($param, $link) {
		$find_arr = array("/r", "\r", "\\", "'", "<script", "</script");
		$replace_arr = array("", "", "", "", "", "");
		$param = str_replace($find_arr, $replace_arr, $param);
		$param = mysqli_real_escape_string($link, $param);
		$param = trim($param);
		$param = preg_replace('/\s+/', ' ', $param);
		
		return $param;
	}
	
	function emailAdmin($from_email, $from_name, $email_subject, $email_message) {    
		$body = $email_message;
		$to_email = 'jeremy.siow@averyinnocoup.com.my';
		$to_name = 'Jeremy Siow';
		
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		$mail->IsHTML(true); 
		//Set who the message is to be sent from
		$mail->setFrom($from_email, $from_name);
		//Set an alternative reply-to address
		$mail->addReplyTo($from_email, $from_name);
		//Set who the message is to be sent to
		$mail->addAddress($to_email, $to_name);
		//Add attachment
//         $mail->AddAttachment($pdf_name);
		//Set the subject line
		$mail->Subject = $email_subject;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		$mail->msgHTML($body);
		//Replace the plain text body with one created manually
		$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
		
		//send the message, check for errors
		if (!$mail->send()) {
			$data = '{"status": "false", "Mailer Error": "'.$mail->ErrorInfo.'"}';
		} else {
			$data = '{"status": "true"}';
		}
		
		return $data;
	}
	
	function getMemberProfile($link, $member_id) {
		$stmt = mysqli_stmt_init($link);
		$query = "SELECT member_email, member_name, member_username, is_shop FROM fash_member WHERE member_id = ? AND valid = 1";
		if(mysqli_stmt_prepare($stmt, $query)) {
			mysqli_stmt_bind_param($stmt, 'i', $member_id);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_bind_result($stmt, $member_email, $member_name, $member_username, $is_shop);
			mysqli_stmt_store_result($stmt);
			
			$row = mysqli_stmt_num_rows($stmt);
			
			if($row > 0) {
				mysqli_stmt_fetch($stmt);
				
				$message = "Success";
				$member_profile = '{"message": "'.$message.'", "member_email": "'.$member_email.'", "member_name": "'.$member_name.'", "member_username": "'.$member_username.'", "is_shop": "'.$is_shop.'"}';
				
			} else {
				$message = "Fail";
				$member_profile = '{"message": "'.$message.'"}';
			}
			
			mysqli_stmt_free_result($stmt);
			mysqli_stmt_close($stmt);
		
		}
		
		return $member_profile;
	}
	
	/*
	function is_json($string, $return_data = false) {
		$data = json_decode($string);
		return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : TRUE) : FALSE;
	}
	*/

?>