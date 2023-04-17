<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

$pagename = "Login";
	$sub_app_name = "Staff App";
	$sub_app_title = "STAFF LOGIN";
	$pagename = "staff";
require("templates/requirez.php");
// require ("$absoute_path/templates/language.php");
require ("templates/language.php");
// echo $sub_app_name;


//check for errorzz...and print out...
$auError = "";
if(isset($_SESSION["auError"]))
{
	$auError = $_SESSION["auError"];
}
else
{
	
}
	$_SESSION["login_try"] = 1;
	if(isset($_SESSION["userkey"]))
	{
		$userkey = $_SESSION["userkey"];
	}
	else
	{
		$userkey = "";
	}
	
	
	function fn_curl($data, $site)
	{
		try
		{
			$ch = curl_init($site);
			// $data = urlencode($data);
			$data_string = ($data);
			
			if(FALSE === $ch)
				throw new Exception("Failed to initialize.");
			
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			// curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
			curl_setopt($ch, CURLOPT_TIMEOUT, 5);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			
				$output = curl_exec($ch);
				
			if(FALSE   === $output)
			{
				throw new Exception(curl_error($ch), curl_errno($ch));
				
			}
			else
			{
				return  $output;
			}
			//process the output...
		}
		catch(Exception $e)
		{
			// trigger_error(sprintf(
				// "Curl failed with error #%d:%s", $e->getCode(), $e->getMessage()
			// ), E_USER_ERROR);
			
			$output = FALSE;
		}
				
			
		
	}
	/* $getter  = fn_curl($_POST, "http://127.0.0.1/hotel_1.0/hotel2.0/apis/login/staff_login_api.php");
		echo $getter;
	exit; */
	
	
	
	if(isset($_POST["un"]) && isset($_POST["pw"]) )
	{
		
		// print "1<br/>";
		// exit;
		//check if the user has tried to login 5 times...and let the user wait for 2 minutes before trying again ....
		if($_SESSION["login_try"] == 5)
		{
			// echo"nono";exit;
		}
		else
		{
			// echo"2";
			//sending data through the login API
			$ipaddress = $_SERVER["REMOTE_ADDR"];
			$postdata = [
				'username' => $_POST["un"],
				'password' => $_POST["pw"],
				'trytime' =>$_SESSION["login_try"] = 5,
				'ipaddress' => "$ipaddress",
			];
			// echo "3";
			if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
			// if($getter  = fn_curl($postdata, "http://127.0.0.1/hotel_1.0/hotel2.0/apis/login/staff_login_api.php"))
			{
				// echo "yes  :";
				echo"$getter";
				// $getter = explode(">>", $getter);
				$getter = json_decode($getter, true);
				
				// $getter3 = explode(" ", $getter3[0]);
				// print_r($getter);
				
					//converting it to json
						$result = $getter[1];
						$output = $getter[2];
						$username = $getter[3];
						$level = $getter[4];
						// echo $output;
							$_SESSION["idkey"]  = $output;
							
							$myjson = array("1" => "$result", "2" => "$output", "3" => "$username", "4"=>"$level");
							$myjson = json_encode($myjson);
							echo $myjson;
							
							
							// $myjson = "{'1': '$result', '2':'$output', '3':'$name' }";
							// $myjson = json_encode($getter);
							// print $myjson;
							exit;
			}
			else
			{
				//echo "no 2";
				// echo $login_form_error_network;
				echo "Error";
			}
		}
		
		exit;
	}
	else
	{
		//echo "$access_err";
	}
?>
<html>
	<head>
		<title>Zephyr || <?php echo "$sub_app_title";?> </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
		<meta http-equiv="EXPIRES" content="0">
		<meta http-equiv="pragma" content="no-cache">
		
		<link rel = "stylesheet" href = "css/z_header.css">
		<link rel = "stylesheet" href = "css/index.css">
		
		<script rel = "javascript" src = "js/jquery.js"></script>
	</head>
	<body>
		<div id = "full_body">
		 
		
			<?php require("pieces/z_header.php");?>
			
				
		<div id = "app_body">
			<div id = "login_form">
				<form name = "z_staff_login" method = "POST" action = "index4.php">
					<div id = "login_form_head">
						<?php echo "$sub_app_title"?>
					</div>
					<div id = "login_form_error_note" style = "display:">
						<?php echo $auError;?>
					</div>
					<div id = "login_form_credentials">
						<br/>
						<div class = "login_form_input_text">
							<span  class = "login_form_txt"><?php echo "$username" ?>
							<span  class = "login_form_input"><input = "text" name = "z_staff_login_username"  id = "z_staff_login_usernam" maxlength = "15" placeholder = "<?php echo"$username";?>" autocomplete = "off" title = "<?php echo $password_title;?>" autofocus required/>
						</div>
						<br/>
						<div class = "login_form_input_text">
							<span  class = "login_form_txt"><?php echo "$password" ?>&nbsp
							<span  class = "login_form_input"><input type = "password" name = "z_staff_login_password" id = "z_staff_login_pass" maxlength = "15" placeholder = "<?php echo "$password" ?>"  autocomplete = "off" title = "<?php echo $password_title;?>" required/>
						</div>
					</div>
					<div id = "login_form_submit">
						<span id = "login_form_forget_credentials"><?php echo $login_form_forget_credentials_txt;?></span><input type = "submit" name = "login_form_submit_button" id = "login_form_submit_btn" value = "<?php echo $login_form_submit_btn_txt;?>" title = "<?php echo $login_btn_title;?>"/>
					</div>
				</form>
			<div>
		</div>
		</div>
		
	</body>
	
<script>
	$(document).ready(function()
	{
		//alert("yo!");
		//alert to tell the user to contact Admin to recover credentials...
			$("#login_form_forget_credentials").click(function()
			{
				alert("<?php echo $login_form_forget_credentials_alert;?>");
			});
			
			//login function
			$("#login_form_submit_btn").click(function(e)
			{
				e.preventDefault();
				// e.defaultPrevented();
				var login_err = "1";
				// alert();
				//check if credentials are intact
					var uname  = $("#z_staff_login_usernam").val();
						var uname_l  = uname.length;
					var passw  = $("#z_staff_login_pass").val();
						var passw_l  = passw.length;
					//check length
						if(uname_l < 1 && passw_l < 1)
						{
							// alert(uname_l);
							$("#z_staff_login_usernam").css("border", "4px   solid rgba(255, 0, 0, 0.4)");
							$("#z_staff_login_pass").css("border", "4px   solid rgba(255, 0, 0, 0.4)");
							
						} 
						else if(uname_l < 1 )
						{
							// alert(uname_l);
							$("#z_staff_login_usernam").css("border", "4px   solid rgba(255, 0, 0, 0.4)");
							
						}
						else if(passw_l < 1)
						{
							// alert(passw_l);
							$("#z_staff_login_pass").css("border", "4px   solid rgba(255, 0, 0, 0.4)");
							
						}
						else
						{
							// alert("GOOD!!");
							$("#login_form_error_note").slideDown("fast");
							$("#login_form_error_note").css("background", "#0a0");
							$("#login_form_error_note").css("border-bottom", "2px solid #090");
							$("#login_form_error_note").text("<?php echo $login_form_working?>");
							
							//conecting to the server
							var server_url = "index.php";
							// $.post(server_url, $("#login_form").serialize(), function()
							$.post(server_url, {un:uname, pw:passw}, function()
							{
								
							})
							.done(function(data)
							{
								// alert(data);
								 data_json = JSON.parse(data);
								// var data_json = data;
									var data_result = data_json[1];
									// alert(data_json);
									// $("#login_form_error_note").text(data_output);
									var data_output = data_json[2];
									var data_uname = data_json[3];
									var data_url = data_json[4];
								if(data_result == "yes")
								{
									window.location = data_url + "?idkey=" + data_output + "&&user=" + data_uname + "&&get=" + data_result;
									// $("#login_form_error_note").html(data);
									// alert("kk");
								}
								else
								{
										
									$("#login_form_error_note").css("background", "#0a0");
									$("#login_form_error_note").css("border-bottom", "2px solid #090");
									$("#login_form_error_note").html(data_output);
									$("#login_form_credentials").fadeIn("fast");
									$("#login_form_submit").fadeIn("fast");
								}
							})
							.fail(function()
							{
								
								$("#login_form_error_note").css("background", "#d00");
								$("#login_form_error_note").css("border-bottom", "2px solid #a00");
								$("#login_form_error_note").text("yommm>><?php echo $login_form_error_network?>");
								$("#login_form_credentials").fadeIn("fast");
								$("#login_form_submit").fadeIn("fast");
							})
						}
			});
	});
</script>	
</html>
<?php
unset($_SESSION["auError"]);
?>