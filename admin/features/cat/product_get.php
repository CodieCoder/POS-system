<?php
// session_start();
if(isset($_POST["cat_sel"]))
{
	require("../../../templates/requirez.php");
	$ipaddress = $_SERVER["REMOTE_ADDR"];
	$postdata = [
		'ipaddress' => $ipaddress,
		'cat_name' => $_POST["cat_sel"]
	];
		
	// echo "2>>>>".strlen($_GET["idkey"]);
	// if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
	if($getter  = fn_curl($postdata, "$absoute_path/apis/product/product_get.php"))
	{
		if($getter == "Empty")
		{
			echo "Empty";
			exit;
		}
		else if($getter == "No")
		{
			echo "error";exit;
		}
		else
		{
				// var_dump($getter);exit;
			$getter = json_decode($getter, true);
// echo "<br/>";
		// var_dump($getter);exit;
			// $chk = $getter["idz"] ;
			// print_r($chk);
			// exit;
			//converting string number to int
			// var_dump($catz);exit;
				$chk = $getter['num'];	
			if($chk > 0)
			{
				$num = 1;
				//removing the first values which holds the number of rows returned
				unset($getter["num"]);
				// print_r($catz);exit;
				$dataz = "";
				foreach($getter as $ref => $data)
				{
					$name = $data["name"];
					$price = $data["price"];
					$price = $data["price"];
					$randy = $data["randy"];
					$qty = $data["qty"];
						$data_cut = substr($name, 0, 15);
						$dataz = $dataz . "<div class = 'cat_prod_itms' title = '$name' onClick = \"product_select('$num')\" id = '$num" . "_div'><span class = 'cat_prod_itms_num'>$num.</span> <span class = 'cat_prod_itms_z'>$data_cut</span>
						<span class = 'cat_prod_itms_values'><input value = '$randy' id = '$num" . "_key' class = 'cat_prod_itms_valz'/>
						<input value = '$price' id = '$num" . "_price' class = 'cat_prod_itms_valz'/>
						<input value = '$qty' id = '$num" . "_qty' class = 'cat_prod_itms_valz'/></span>
						</div>";
					
					$num++;
				}
				
				echo $dataz;
				exit;
			}
			else
			{
				echo "<div class = 'cat_prod_itms'><span calss = 'cat_prod_itms_z'>Nothing to show</span>
						</div>";
				exit;
			}
		}
		
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