<?php
// session_start();
if(isset($_POST["pro_new"]) && isset($_POST["cat_sel"]))
{
	require("../../../templates/requirez.php");
	$ipaddress = $_SERVER["REMOTE_ADDR"];
	$postdata = [
		'ipaddress' => $ipaddress,
		'pro_name' => $_POST["pro_new"],
		'cat_name' => $_POST["cat_sel"]
	];
		
	// echo "2>>>>".strlen($_GET["idkey"]);
	// if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
	if($getter  = fn_curl($postdata, "$absoute_path/apis/product/product_chk.php"))
	{
		// $getter = json_encode($getter);
		print_r($getter);
		exit;
		
	}
	else
	{
		echo "Network Error";
			exit;
	}
}
else
{
	echo "Invalid Access";
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