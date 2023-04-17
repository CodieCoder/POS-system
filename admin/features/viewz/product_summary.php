<?php
if(isset($_POST["commandd"]))
{
		require("../../../templates/requirez.php");
		
	if($_POST["commandd"] == "cat_get")
	{
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$postdata = [
			'ipaddress' => $ipaddress,
		];
			
		// echo "2>>>>".strlen($_GET["idkey"]);
		// if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
		if($getter  = fn_curl($postdata, "$absoute_path/apis/stocks/get_cat.php"))
		{
			$getter = json_decode($getter, true);
			// print_r($getter);
			// exit;
			// print "<hr/>";
			$chk = $getter["catz"];
			$chk = $chk[1];
			// print_r($chk);
			// print"<br/>".$chk;
			if($chk > 0)
			{
				$num = 1;
				$dataz = "";
				$catz = $getter["catz"];
				$randyz = $getter["idz"];
					unset($catz[1]);
					unset($randyz[1]);
				foreach($catz as $ref => $data)
				{
					$cat_name = $data;
					foreach($randyz as $ref2 => $data2)
					{
						$rany_keyz = $data2;
						
							break;
					}
					
				echo "<option value = '$rany_keyz'>$num. $cat_name</option>";
				
						unset($randyz[$ref2]);
				$num++;
				unset($catz[$ref]);
				}
			}
			else
			{
				echo "<option value = 'NULL'>Nothing to show.</option>";
			}
			
		}
		else
		{
			echo "Network Error";
				exit;
		}
	}
	else if($_POST["commandd"] == "get_prd" && isset($_POST["dataz"]))
	{
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$postdata = [
			'ipaddress' => $ipaddress,
			'cat' => $_POST["dataz"]
		];
			
			// print $_POST["dataz"];
		if($getter  = fn_curl($postdata, "$absoute_path/apis/stocks/view_cat_prd.php"))
		{
			// echo "Hello";exit;
			$getter = json_decode($getter, true);
			// var_dump($getter);exit;
			$chk = $getter["num"];
			if($chk > 0)
			{
				$num = 1;
				unset($getter["num"]);
				$dataz = "";
				foreach($getter as $ref => $data)
				{
					$randyz = $data["randy"];
					$namez = $data["name"];
						$prod_name = substr($namez, 0, 15);
						echo "<option value = '$randyz'>$prod_name</option>";
					
					$num++;
					// echo $dataz;
						unset($getter[$ref]);
				}
			}
			else
			{
				
			}
			
			
		}
		else
		{
			echo "Network Error";
				exit;
		}
	}
	else if($_POST["commandd"] == "qty_num")
	{
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$postdata = [
			'ipaddress' => $ipaddress,
		];
			
		// echo "2>>>>".strlen($_GET["idkey"]);
		// if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
		if($getter  = fn_curl($postdata, "$absoute_path/apis/stocks/view_now_qty.php"))
		{
			print $getter;
			exit;
			
		}
		else
		{
			echo "Network Error";
				exit;
		}
	}
	else if($_POST["commandd"] == "init_qty_num")
	{
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$postdata = [
			'ipaddress' => $ipaddress,
		];
			
		// echo "2>>>>".strlen($_GET["idkey"]);
		// if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
		if($getter  = fn_curl($postdata, "$absoute_path/apis/stocks/view_init_qty.php"))
		{
			print $getter;
			exit;
			
		}
		else
		{
			echo "Network Error";
				exit;
		}
	}
	else if($_POST["commandd"] == "all_sales")
	{
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$postdata = [
			'ipaddress' => $ipaddress,
		];
			
		// echo "2>>>>".strlen($_GET["idkey"]);
		// if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
		if($getter  = fn_curl($postdata, "$absoute_path/apis/stocks/view_prd_all.php"))
		{
			print $getter;
			exit;
			
		}
		else
		{
			echo "Network Error";
				exit;
		}
	}
	else if($_POST["commandd"] == "today_sales")
	{
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$postdata = [
			'ipaddress' => $ipaddress,
		];
			
		// echo "2>>>>".strlen($_GET["idkey"]);
		// if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
		if($getter  = fn_curl($postdata, "$absoute_path/apis/stocks/view_today_sales.php"))
		{
			print $getter;
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