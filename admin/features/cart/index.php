<?php
// session_start();
if(isset($_POST["sales_key"]))
{
	require("../../../templates/requirez.php");
	$ipaddress = $_SERVER["REMOTE_ADDR"];
	$postdata = [
		'ipaddress' => $ipaddress,
		'sales_key' => $_POST["sales_key"],
		
	];
		
	// echo "2>>>>".strlen($_GET["idkey"]);
	// $getter  = fn_curl($postdata, "$absoute_path/apis/sales/cart_view.php");print($getter);exit;
	if($getter  = fn_curl($postdata, "$absoute_path/apis/sales/cart_view.php"))
	{
		// echo "yo000<br/>";
		// echo($getter);exit;
		if($getter == "No")
		{
			echo "Could not perform request.";
			exit;
		}
		else if($getter == "Error")
		{
			echo "Fatal Error.";exit;
		}
		else if($getter == "Empty")
		{
			echo "No record to display.";exit;
		}
		else
		{
			$getter = json_decode($getter, true);
			// $chk = $getter["qtyz"] ;
			// print_r($chk);
			// exit;
			$block_no = $getter["blockz"];
			$blk_name = $getter["blk_name"];
			$blk_phone = $getter["blk_phone"];
			$name = $getter["name"];
			$catz = $getter["cat"];
			$pricez = $getter["pricez"];
			$qtyz = $getter["qtyz"];
			$rand = $getter["randyz"];
			$datez = $getter["datez"];
			$timez = $getter["timez"];
			//converting string number to int
			// var_dump($catz);exit;
				$chk = $catz[1];	
			if($chk > 0)
			{
				$num = 1;
				//removing the first values which holds the number of rows returned
				unset($catz[1]);
				// print_r($catz);exit;
				$dataz = "";
				foreach($catz as $ref => $data)
				{
					$data1 = ucwords($data);
					foreach($block_no as $refb => $data_blk)
					{
						$block_noz = $data_blk;
					}
					foreach($blk_name as $refn => $data_blkname)
					{
						$blk_namez = $data_blkname;
					}
					foreach($blk_phone as $ref3p=> $data_blkphone)
					{
						$blk_phonez = $data_blkphone;
					}
					
					foreach($pricez as $ref3 => $data_pri)
					{
						$data2 = $data_pri;
					}
					unset($pricez[$ref3]);
					
					foreach($name as $ref4 => $data_name)
					{
						$data_name = $data_name;
					}
					unset($name[$ref4]);
					
					foreach($rand as $ref6 => $data_rand)
					{
						$data_randy = $data_rand;
					}
					unset($rand[$ref6]);
					
					foreach($datez as $ref7 => $data_date)
					{
						$data_datez = $data_date;
					}
					unset($datez[$ref7]);
					
					foreach($timez as $ref7 => $data_time)
					{
						$data_timez = $data_time;
					}
					unset($timez[$ref7]);
					
					foreach($qtyz as $ref5 => $data_qty)
					{
						
					}
					unset($qtyz[$ref5]);
					
					$data_name_cut = substr($data_name, 0, 15);
						$total_m = number_format($data2 * $data_qty);
						$data2 = number_format($data2);
						$dataz = $dataz . "<div class = 'cart_prod_itms' title = '$data_name'id = '$num" . "_cart_div'><span  onClick = \"showCartItems_fn('$num')\"class = 'cart_prod_itms_num'>$num.</span> <span class = 'cart_prod_itms_z' onClick = \"showCartItems_fn('$num')\" >$data_name_cut</span>
							<div class = 'cart_items_hidden'>
								<span class = 'cart_prod_itms_values'>Price : <font size='1'>=N=</font> $data2</span>
								<span class = 'cart_prod_itms_values'>Quantity : $data_qty</span>
								<span class = 'cart_prod_itms_values'>Total : <font size='1'>=N=</font> $total_m</span>
								<span class = 'cart_prod_itms_values'>Date : $data_datez</span>
								<span class = 'cart_prod_itms_values'>Time : $data_timez</span>
								<div class = 'cart_prod_delete_itms' title = 'Permanently remove this item from the current cart' onClick = \"deleteCart_fn('$num')\">Remove from cart</div>
								<div id = '$num"."_delete_div' class = 'cart_prod_delete_div'>
									<span class = 'delete_div_yes' onClick = \"yesDelete_fn('$num','$data_randy')\" title = 'Permanently remove this item from the current cart'>Yes</span>
									<span class = 'delete_div_no' onClick = \"closeDelete_fn('$num')\" title = 'Cancel remove'>Cancel</span>
								</div>
							</div>	
						</div>";
						
						$block_details = "<div class = 'block_details'>
						<span class = 'block_span'>Block : $block_noz<span>
							<br/>
						<span class = 'block_span'>Recipient name: $blk_namez</span>
							<br/>
						<span class = 'block_span'>Recipient Phone: $blk_phonez</span>
						</div>";
						// break;
						unset($catz[$ref]);
					$num++;
					// continue;
				}
				
				echo $block_details . $dataz;
				exit;
			}
			else
			{
				echo "<div class = 'cat_prod_itms'><span class = 'cat_prod_itms_z'>Nothing to show</span>
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