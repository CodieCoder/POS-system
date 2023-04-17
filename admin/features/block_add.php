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
			Add Block
		</div>
		
		<div id = "usr_div">
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Block name
				</div>
				<div class = "us_s_input">
					<input type = "text" name = "new_block_name" id = "name" placeholder = "Enter the block name"  title = "Enter a new block name" maxlength = "45" required/>
				</div>
				<div class = "us_s_input_msg">
					
				</div>
			</div>
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Block description
				</div>
				<div class = "us_s_input">
					<input type = "text" name = "new_block_desc" id = "desc" placeholder = "Enter a unique description"  title = "Enter a unique description of the block" required/>
				</div>
				<div class = "us_s_input_msg">
					
				</div>
			</div>
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Block Location
				</div>
				<div class = "us_s_input">
					<input type = "text" name = "new_block_addr" id = "addr" placeholder = "Enter the block location"  title = "Enter the block accurate location" required/>
				</div>
				<div class = "us_s_input_msg">
					
				</div>
			</div>
			<div class = "u_d_secz">
				<div class = "us_s_txt">
					Other
				</div>
				<div class = "us_s_input">
					<input type = "text" name = "new_other" id = "other" placeholder = "Enter any other information"  title = "Enter any other information to help you identify the block" required/>
				</div>
			</div>
			<!--<div class = "u_d_secz">
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
			!-->
				<div id = "us_s_submit">
					<input type = "text" id = "user_key" name = "user_key" value = "<?php echo $skey;?>" hidden/>
					<button id = "us_s_submit_btn"><img src = "../../iconz/profile.png" align = "left"><span id = "btn_txt">Add Block</span></button>
				</div>
		</div>
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
				var name = $("#name").val().length;
				var uname = $("#desc").val().length;
				var pword = $("#addr").val().length;
				var chkr = 0;
				
				// alert(pword);
				if(name < 4)
				{
					$("#name").css("border", "2px solid #900");
					$("#name").focus();
					$("#name").parent().parent().children(".us_s_input_msg").html("Staff name too short. Min = 4, Max = 45");
					chkr = 1;
				}
				if(uname < 5)
				{
					$("#desc").css("border", "2px solid #900");
					$("#desc").focus();
					$("#desc").parent().parent().children(".us_s_input_msg").html("Username name too short. Min = 6, Max = 15");
					chkr = 1;
				}
				if(pword < 5)
				{
					$("#addr").css("border", "2px solid #900");
					$("#addr").focus();
					$("#addr").parent().parent().children(".us_s_input_msg").html("Address name too short. Min = 10, Max = 25");
					chkr = 1;
				}
				
				return chkr;
			}
			
			function formSubmit_fn()
			{
				var chkr = formChk_fn();
				if(chkr == 0)
				{
					// $("#btn_txt").text("Working...");
					var name = $("#name").val();
					var desc = $("#desc").val();
					var addr = $("#addr").val();
					var other = $("#other").val();
					var user_key = "<?php echo $skey;?>";
					var goer = "engines/add_block.php";
					$.post(goer, {blcname:name, blcdesc:desc, blcloc:addr, blcother:other, userkey:user_key}, function()
					{
						// $("#btn_txt").text("Connecting...");
					})
					.done(function(data)
					{
						if(data == "Yes")
						{
							alert("Block successfully added.");
						}
						else
						{
							alert(data);
						}
						
						$("#us_s_submit_btn").prop("disabled", false);
					})
					.fail(function()
					{
						alert("Error connecting to server.");
						$("#us_s_submit_btn").prop("disabled", false);
					})
						// $("#btn_txt").text("Add Block ");
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