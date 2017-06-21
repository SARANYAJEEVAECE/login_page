$(document).ready(function(){
	// $("#main_content").hide();
	// check();

	$("#signup").hide();
	$("#signup_title").hide();
	// $("#signup_form").hide();
	$("#otp").hide();
	$("#otp_title").hide();

	$("#login_click").addClass("active");
	
	$("#signup_click").click(function(){
		$("#signup_click").addClass("active");
		$("#login_click").removeClass("active");
		$("#signup").show();
		$("#signup_title").show();
		$("#login").hide();
		$("#login_title").hide();
	});
	$("#login_click").click(function(){
		$("#login_click").addClass("active");
		$("#signup_click").removeClass("active");
		$("#signup").hide();
		$("#signup_title").hide();
		$("#login").show();
		$("#login_title").show();
	});
	
	$("#login_form").submit(function(e){
		e.preventDefault();
		phone_no = document.getElementById('ph_no').value;  
		$.ajax({
			type : "POST",
			url : "../controller/login_otp.php",
			data : {phone_no : phone_no},
			success: function(data){
				if(data == "error"){
					document.getElementById('response').innerHTML = '<div class="alert alert-danger"><strong>Sorry!</strong> Signup your Account </div>' ;
					console.log("error");
				}else{
					console.log(data);
					$("#login_title").hide();
					$("#login").hide();
					$("#otp").show();
					$("#otp_title").show();
					$("#otp_form").submit(function(e){
						e.preventDefault();
						otp = $("#otp_content").val();
						if(data == otp){
							console.log("success");
						}else{
							$("#otp").hide();
							document.getElementById('response').innerHTML = '<div class="alert alert-danger"><strong>Sorry!</strong>Invalid OTP</div>' ; 
						}
					});
				}
			}
		});
	});	
	$("#signup_form").submit(function(e){
		e.preventDefault();
		name = document.getElementById('name').value;
		email = document.getElementById('email').value;
		phonenumber = document.getElementById('no').value;
		
		$.ajax({
			type : "POST",
			url : "../controller/signup_otp.php",
			data : { phonenumber : phonenumber},
			success: function(data){
				if(data == "error"){
					console.log("error");
					document.getElementById('response').innerHTML = '<div class="alert alert-primary"><strong>Sorry!</strong>User Already Exists</div>' ;
				}else{
					console.log(data);
					$("#signup_title").hide();
					$("#signup").hide();
					$("#otp").show();
					$("#otp_title").show();
					$("#otp_form").submit(function(e){
						e.preventDefault();
						otp = $("#otp_content").val();
						insert_user(data , otp);

					});
				}
			}
		});
	

		});

	
});

function insert_user(data , otp){
	name = document.getElementById('name').value;
	email = document.getElementById('email').value;
	phonenumber = document.getElementById('no').value;
	if(data == otp){
		// localStorage.setItem('user_number', phonenumber);
		$.ajax({
			type : "POST",
			url : "../controller/signup.php",
			data : { username : name,email_id: email,mobile_number : phonenumber},
			success: function(data){
				console.log(data);
				if(data == "error"){
					$("#otp").hide();
					document.getElementById('response').innerHTML = '<div class="alert alert-danger"><strong>Sorry!</strong>Invalid OTP</div>' ;
				}else{
					console.log(success);
					 
				}
			}
		});
	}
}


