<?php
	require("../../../templates/requirez.php");
// var_dump($_POST);
// echo"<br/>";
// var_dump($_FILES);

if(isset($_POST["blcname"]) && isset($_POST["blcdesc"]) && isset($_POST["blcloc"]) && isset($_POST["userkey"]) && isset($_POST["blcother"]))
{
	$name = $_POST["blcname"];
	$desc = $_POST["blcdesc"];
	$loc = $_POST["blcloc"];
	$other = $_POST["blcother"];
	$userkey = $_POST["userkey"];
	if(strlen($name) < 4)
	{
		echo "Error. Invalid request data";
		exit;
	}
	else
	{
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$postdata = [
		'ipaddress' => $ipaddress,
		'name' => $name,
		'desc' => $desc,
		'loc' => $loc,
		'other' => $other,
		'idkey' => $userkey
	];
		if($getter  = fn_curl($postdata, "$absoute_path/apis/users/add_block.php"))
		{	
			if($getter == "Yes")
			{
				echo "Yes";
				exit;
			}
			else
			{
				echo "$getter";
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