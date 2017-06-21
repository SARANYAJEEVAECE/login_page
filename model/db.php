<?php 
	include_once 'curd_operations.php';
	session_start();
	function db_connect(){
		$connection = mysqli_connect("localhost", "root", "","sigi_admin");
		if (!$connection) {
		    die("Connection failed: " . mysqli_connect_error());
		    exit();
		}
		return $connection;
		// echo "string";
	}

	function execute_query($query, $link){
		if(!empty($link)){
			return mysqli_query($link, $query);
		}else{
			return mysqli_query(db_connect(), $query);
		}
	}

	function get_array_from_object($result){
		return mysqli_fetch_array($result, MYSQLI_ASSOC);
	}

	function get_total_reference($id){
		$con = db_connect();
		$total_refered_count = select('total_refered_count', 'users', array("id"=>$id), $con);
		return $total_refered_count['0']['total_refered_count'];
	}

	function get_name($id){
		$con = db_connect();
		$name = select('username', 'users', array("id"=>$id), $con);
		return $name['0']['username'];
	}
	function is__array($value){
		return is_array($value);
	}
	function emptty($value){
		return empty($value);
	}

	function send_message($phone_number,$otp){
			// header('location:../view/otp.php ');
		//palaniM@67

	}
	function otp_code(){
			$string = '0123456789';
			$string_shuffled = str_shuffle($string);
			$otp_code = substr($string_shuffled, 1, 4);
			$_SESSION["otp"] = $otp_code;
			// send_message($phone_number,$otp_code)
	}
	function get_vehicle_name($phoneno){
			$con=db_connect();
			$id=$_SESSION['user_details']['id'];
			$condition=" `user_id` = '".$id."'";
			$selected_row=select('vehicle_no','vehicle_detail',$condition,$con);
			return $selected_row;

	}
	function log_out(){
			session_destroy();
			header('Location:../index.php');
	}
	function get_user_detail($phone_number,$con){
			$condition=" `phonenumber` = '".$phone_number."'";
			$selected_row = select('*', 'users',$condition, $con);
			$user_detail= $selected_row['0'];
			$_SESSION["user_detail"] = $user_detail;
	}

	
	function get_time(){
	$_SESSION['timenow'] = time();
	$time = $_SESSION['timenow']-$_SESSION['start'];
	return $time;
	}
	function sanitize($input, $con){
		return mysqli_real_escape_string($con, $input);
	}

