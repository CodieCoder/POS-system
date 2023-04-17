<?php
if(isset($_POST["commandd"]))
{
		require("../../../templates/requirez.php");
		
	if($_POST["commandd"] == "cat_num")
	{
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$postdata = [
			'ipaddress' => $ipaddress,
		];
			
		// echo "2>>>>".strlen($_GET["idkey"]);
		// if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
		if($getter  = fn_curl($postdata, "$absoute_path/apis/stocks/view_stock.php"))
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
	else if($_POST["commandd"] == "prdt_num")
	{
		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$postdata = [
			'ipaddress' => $ipaddress,
		];
			
		// echo "2>>>>".strlen($_GET["idkey"]);
		// if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
		if($getter  = fn_curl($postdata, "$absoute_path/apis/stocks/view_stock_prd.php"))
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