<?php
	include_once'../model/curd_operations.php';
	include_once '../model/db.php';
	$phone_number=$_REQUEST['phonenumber'];
	$con=db_connect();
	$condition=" `mobile_no` = '".$phone_number."'";
	$selected_row = select('mobile_no', 'sig_login',$condition, $con);
	if ($selected_row == "empty") {
		$string = '0123456789';
		$string_shuffled = str_shuffle($string);
		$otp_code = substr($string_shuffled, 1, 4);
		// send_message($phone_number,$otp_code)
		 echo $otp_code;
	}else{
		echo "error";
	}
	