<?php
require("../../../templates/requirez.php");
	$ipaddress = $_SERVER["REMOTE_ADDR"];
	$postdata = [
		'ipaddress' => $ipaddress
	];
		
	// echo "2>>>>".strlen($_GET["idkey"]);
	// if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
	if($getter  = fn_curl($postdata, "$absoute_path/apis/category/get_cat.php"))
	{
		// var_dump($getter);exit;
		$getter = json_decode($getter, true);
		// $chk = $getter["idz"] ;
		// print_r($chk);
		// exit;
		$catz = $getter["catz"];
		$idz = $getter["idz"];
		//converting string number to int
			$chk = $catz[1];
		if($chk > 0)
		{
			// echo "yep";
			$num = 1;
			//removing the first values which holds the number of rows returned
			unset($catz[1]);
			unset($idz[1]);
			// print_r($catz);exit;
			$dataz = "";
			foreach($catz as $ref => $data)
			{
				$data = ucwords($data);
				foreach($idz as $ref2 => $data2)
				{
					echo "<option value = '$data2'>$num. $data </option>";
					break;
				}
					// $dataz = $dataz . "<option value = '$data2'>$num. $data [$data2]</option>";
				unset($idz[$ref2]);
				$num++;
				// continue;
			}
			
			// echo $dataz;
			exit;
		}
		else
		{
			echo "<option>Empty</option>";
			exit;
		}
	}
	else
	{
		echo "$login_form_error_network";
		// echo $login_form_error_network;
			// $_SESSION["auError"] = "$login_form_error_network";
			// header("location:../index.php");
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