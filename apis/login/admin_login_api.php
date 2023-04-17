<?php
session_start();
	//db details
	require("../../config/dbcon.php");
	require("../../config/db_fields.php");
	require("../../modules/classes/login/login_staff.php");
	
	
if(isset($_POST["username"]) && isset($_POST["password"]))
{
	$un = htmlentities($_POST["username"]);
	$pw = htmlspecialchars($_POST["password"]);
	$ip = htmlspecialchars($_POST["ipaddress"]);
	$tm = htmlspecialchars($_POST["trytime"]);
	
		
		if($dbcon === false)
		{
			echo "Opps!  Error connecting to the server. Please check your connection and try again.";
			exit;
		}
		else
		{
			$work = new staffLogin($dbcon, $tb, $lock);	
				$work_login = $work->loginRequest_Admin($un, $pw, $username, $password, $name, $token);
					if($work->err == false)
					{
						// print_r( $work->output);
						// [success] => Success [username] => admin1
						$suc = $work->output["success"];
						$name = $work->output["name"];
						$userkey = $work->output["userkey"];
						
						// print_r($suc);
						// print_r($name);
						// print_r($userkey);
						$_SESSION["userkey"] = $userkey;
						// $_SESSION["name"] = $name;
							$post_data = array("1" => "yes", "2" => "$userkey", "3" => "$un");
							$post_data = json_encode($post_data);
							print $post_data;
						// header("location:home.php?id=$userkey");
					}
					else
					{
						$err_2 = errorReporting($work->err_msg);
							$post_data = array("1" => "no", "2" => "$err_2", "3" => ".");
							$post_data = json_encode($post_data);
							print($post_data);
						// echo errorReporting($work->err_msg);
						// echo "..." . $work->output . "...";
						// echo "..." . $un . "$pw...";
					}
					
		}
}




//confirming staff' with temporary key
if(isset($_POST["idkey"]) && isset($_POST["username"]) && isset($_POST["ipaddress"]))
{
	$un = htmlentities($_POST["username"]);
	$idkey = htmlspecialchars($_POST["idkey"]);
	$ip = htmlspecialchars($_POST["ipaddress"]);
	// print("hello");
		if($dbcon === false)
		{
			echo "Opps!  Error connecting to the server. Please check your connection and try again.";
			exit;
		}
		else
		{
			$work = new staffLogin($dbcon, $tb, $lock);	
			// echo "($idkey, $un, $token, $username)";
				$work_login = $work->verifierRequest($idkey, $un, $token, $username);
				// echo "result=" . $work->output;
					if($work->err == false)
					{
						$suc = $work->output;
						
							$post_data = array("1" => "success", "2" => "$suc");
							$post_data = json_encode($post_data);
							print($post_data);
						// header("location:home.php?id=$userkey");
					}
					else
					{
						$err_2 = errorReporting($work->err_msg);
							$post_data = array("1" => "no", "2" => "no");
							$post_data = json_encode($post_data);
							print_r($post_data);
						// echo errorReporting($work->err_msg);
						// echo "..." . $work->output . "...";
						// echo "..." . $un . "$pw...";
					}
					
		}
}





function errorReporting($data)
{
	if($data == "Err[LS 001]")
	{
		$err_msg = "Error initializing module.";
	}
	else if($data == "Err[LS 01-001]")
	{
		$err_msg = "Login not performed properly.";
	}
	else if($data == "Err[LS 01-002]")
	{
		$err_msg = "Couldn't perform operation";
	}
	else if($data == "Err[LS 01-003]")
	{
		$err_msg = "Oops! No such user found.";
	}
	else if($data == "Err[LS 01-004]")
	{
		$err_msg =" Couldn't Authenticate user.";
	}
	else if($data == "Err[LS 01-005]")
	{
		$err_msg = "Error retrieving user's data.";
	}
	else if($data == "Err[LS 01-006]")
	{
		$err_msg = "Account Locked. Contact Administrator.";
	}
	else
	{
		// $err_msg = "Access Error";
		$err_msg = $data;
	}
	return $err_msg;
}
//getting the posted data
 // [username] => yyuyuyu [password] => yuyuuyuy [trytime] => 5 [ipaddress] => 127.0.0.1 
?>