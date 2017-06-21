<?php 
	include_once '../model/db.php';
	include_once '../model/curd_operations.php';

	$username = $_REQUEST['username'];
	$email = $_REQUEST['email_id'];
	$phone_no= $_REQUEST['mobile_number'];
	$con = db_connect();
	$result = insert('`sigi_login`',array('username','email_id','mobile_no'),array($username,$email,$phone_no),$con);
	if ($result == 'inserted') {
		echo "inserted";
	}else{
		echo "error";
	}