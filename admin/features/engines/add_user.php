<?php
	require("../../../templates/requirez.php");
// var_dump($_POST);
// echo"<br/>";
// var_dump($_FILES);

if(isset($_POST["new_name"]) && isset($_POST["new_username"]) && isset($_POST["new_password"]) && isset($_POST["user_key"]) && isset($_FILES["new_passport"]))
{
	$name = $_POST["new_name"];
	$uname = $_POST["new_username"];
	$password = $_POST["new_password"];
	$email = $_POST["new_email"];
	$phone = $_POST["new_phone"];
	$address = $_POST["new_address"];
	$sex = $_POST["new_sex"];
	$level = $_POST["new_level"];
	$userkey = $_POST["user_key"];
	$picFiles = $_FILES["new_passport"];
	if(strlen($name) < 4 && strlen($uname) < 6 && strlen($password))
	{
		echo "Error. Invalid request data";
		exit;
	}
	else
	{
		$pic = $_FILES["new_passport"];
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$postdata = [
		'ipaddress' => $ipaddress,
		'name' => $name,
		'uname' => $uname,
		'password' => $password,
		'email' => $email,
		'phone' => $phone,
		'address' => $address,
		'sex' => $sex,
		'level' => $level,
		'pic_tmpname' => $pic["tmp_name"],
		'pic_type' => $pic["type"],
		'pic_error' => $pic["error"],
		'pic_size' => $pic["size"],
		'idkey' => $userkey
	];
		if($getter  = fn_curl($postdata, "$absoute_path/apis/users/add_user.php"))
		{	
			if($getter == "Yes")
			{
				echo "<font color = '#2af' size = '3'>Staff [$name, $uname] Added</font>";
				echo "<br/><div style = 'color:#2af;font-weight:bold;cursor:pointer;width:6em;text-align:center;padding:1em;background:#ddd;' Onclick = \"window.history.back();\">Go back</div>";
				exit;
			}
			else
			{
				echo "<font color = '#900'>$getter</font>";
				echo "<br/><div style = 'color:#2af;font-weight:bold;cursor:pointer;width:6em;text-align:center;padding:1em;background:#ddd;' Onclick = \"window.history.back();\">Go back</div>";
				exit;
			}
		}
		else
		{
			echo "Error";
			exit;
		}
	}
}
else
{
	echo "Invalid access";
	exit;
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
			// curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Length: "));
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
	
?>