<?php
session_start();	
	$skey = $_SESSION["idkey"];
	$page_code = "0";
	$pagename = "Admin";
	require("../../templates/requirez.php");
	// require("$absoute_path/templates/requirez.php");
	require("../../templates/language.php");
	require("../scripts/check_user_across_pages.php");

?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			User : Add
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
		<meta http-equiv="EXPIRES" content="0">
		<meta http-equiv="pragma" content="no-cache">
		
		<link rel = "stylesheet" href = "css/new_user.css">
		
		<script rel = "javascript" src = "../../js/jquery.js"></script>
	</head>
<body>
	<div id = "usrbody">
		<div id = "usrbody_hd">
			Add User
		</div>
		
		<div id = "usr_div">
			<form method = "post" action = "engines/add_user.php" enctype = "multipart/form-data">
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Fullname
				</div>
				<div class = "us_s_input">
					<input type = "text" name = "new_name" id = "fullname" placeholder = "Enter the Staff name"  title = "Enter a unique name" maxlength = "45" required/>
				</div>
				<div class = "us_s_input_msg">
					
				</div>
			</div>
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Username
				</div>
				<div class = "us_s_input">
					<input type = "text" name = "new_username" id = "username" placeholder = "Enter a unique username"  title = "Enter a unique username" required/>
				</div>
				<div class = "us_s_input_msg">
					
				</div>
			</div>
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Password
				</div>
				<div class = "us_s_input">
					<input type = "password" name = "new_password" id = "password" placeholder = "Enter a unique password"  title = "Enter a unique password" required/>
				</div>
				<div class = "us_s_input_msg">
					
				</div>
			</div>
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Email
				</div>
				<div class = "us_s_input">
					<input type = "text" name = "new_email" id = "email" placeholder = "Enter a staff email"  title = "Enter a staff email" required/>
				</div>
			</div>
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Phone
				</div>
				<div class = "us_s_input">
					<input type = "text" name = "new_phone" id = "phone" placeholder = "Enter a staff phone number"  title = "Enter a staff phone number" required/>
				</div>
			</div>
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Address
				</div>
				<div class = "us_s_input">
					<input type = "text" name = "new_address" id = "address" placeholder = "Enter a staff address"  title = "Enter a staff address" required/>
				</div>
			</div>
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Passport
				</div>
				<div class = "us_s_input">
					<input type = "file" name = "new_passport" id = "passport" placeholder = "Choose Staff profile   picture"  title = "Choose Staff profile  picture" required/>
				</div>
			</div>
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Gender
				</div>
				<div class = "us_s_input">
					<select name = "new_sex" id = "sex" placeholder = "Choose Staff Gender">
						<option value = "Female">Female</option>
						<option value = "Male">Male</option>
					</select>
				</div>
			</div>
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Choose Level
				</div>
				<div class = "us_s_input">
					<select name = "new_level" id = "level" placeholder = "Choose Staff level">
						<option value = "0">Administrator</option>
						<option value = "1">Staff</option>
					</select>
				</div>
			</div>
				<div id = "us_s_submit">
					<input type = "text" id = "user_key" name = "user_key" value = "<?php echo $skey;?>" hidden/>
					<button id = "us_s_submit_btn"><img src = "../../iconz/profile.png" align = "left"><span id = "btn_txt">Add User</span></button>
				</div>
		</div>
			</form>
		</div>
	</div>
	<script>
		$(document).ready(function()
		{

			$("#us_s_submit_btn").click(function(e)
			{
				e.preventDefault();
				formSubmit_fn();
			});
			
			function formChk_fn()
			{
				var name = $("#fullname").val().length;
				var uname = $("#username").val().length;
				var pword = $("#password").val().length;
				var chkr = 0;
				
				// alert(pword);
				if(name < 4)
				{
					$("#fullname").css("border", "2px solid #900");
					$("#fullname").focus();
					$("#fullname").parent().parent().children(".us_s_input_msg").html("Staff name too short. Min = 4, Max = 45");
					chkr = 1;
				}
				if(uname < 5)
				{
					$("#username").css("border", "2px solid #900");
					$("#username").focus();
					$("#username").parent().parent().children(".us_s_input_msg").html("Username name too short. Min = 6, Max = 15");
					chkr = 1;
				}
				if(pword < 5)
				{
					$("#password").css("border", "2px solid #900");
					$("#password").focus();
					$("#password").parent().parent().children(".us_s_input_msg").html("Password name too short. Min = 10, Max = 25");
					chkr = 1;
				}
				
				return chkr;
			}
			
			function formSubmit_fn()
			{
				var chkr = formChk_fn();
				if(chkr == 0)
				{
					$("#us_s_submit_btn").prop("disabled", false);
					$("#btn_txt").text("Working...");
					$("form").submit();
				}
				else
				{
					alert("There's an error in your request.");
				}
			}
			
		});
	</script>
</body>
</html>