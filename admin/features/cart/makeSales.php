<?php
if(isset($_POST["coms"]) && isset($_POST["keyer"]))
{
		require("../../../templates/requirez.php");
		
	if($_POST["coms"] == "go")
	{
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$postdata = [
			'ipaddress' => $ipaddress,
			'uskey' => $_POST["keyer"]
		];
		
		if($getter  = fn_curl($postdata, "$absoute_path/apis/sales/make_sale.php"))
		{
			// $getter  = json_decode($getter, true);
			print $getter;
			exit;
			
		}
		else
		{
			echo "Network Error";
				exit;
		}
	}
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