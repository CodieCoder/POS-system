<?php
// echo "1";
	if(isset($_GET["idkey"]))
	{
			$key = $_GET["idkey"];
		if($key == $skey)
		{		//sending data through the login API
			// print_r ($_GET);
			// exit;
			$userkey = $_GET["idkey"];
			$ipaddress = $_SERVER["REMOTE_ADDR"];
			$postdata = [
				'chkkey' => $userkey,
				'ipaddress' => $ipaddress
			];
			// echo "2>>>>".strlen($_GET["idkey"]);
			// if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
			if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
			{
				$getter = json_decode($getter, true);
				// var_dump($getter);
				// exit;
				if($getter[1] == "success")
				{
					// echo "yep";
					if($getter[2] == "0" && $page_code == "0")
					{
						// header("location:../");
						// echo "yes";
					}
					else
					{
						echo "$access_err";
						// $_SESSION["auError"] = "$access_err";
						// header("location:../index.php");
						exit;
					}
				}
				else
				{
					echo "$access_err";
				// var_dump($getter);
					// $_SESSION["auError"] = "$access_err";
					// header("location:../index.php");
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
		}	
		else
		{
			echo $access_err;
			exit;
		}
	}
	else
	{
		echo "$login_form_error_network";
		// $_SESSION["auError"] = "$login_form_error_network";
		// header("location:index.php");
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