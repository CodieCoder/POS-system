<?php
if(!isset($_GET["datalink"]))
{
	echo "No data to display. <br/> Please go back";
	exit;
}
// sess$ipaddress = $_SERVER["REMOTE_ADDR"];
// echo $_GET["datalink"];
// echo "<br/>".$skey;
	$postdata = [
		'ipaddress' => $ipaddress,
		'sales_key' => $skey,
		'cart_key' => $_GET["datalink"]
	];
		
	// echo "2>>>>".strlen($_GET["idkey"]);
	// $getter  = fn_curl($postdata, "$absoute_path/apis/sales/cart_view.php");print($getter);exit;
	if($getter  = fn_curl($postdata, "$absoute_path/apis/sales/print_view.php"))
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
				$totalSalez = 0;
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
					
					// $data_name_cut = substr($data_name, 0, 15);
						$total_m = ($data2 * $data_qty);
						$data2 = number_format($data2);
						$dataz = $dataz . "
						<tr>  <td>$num.</td> 
							<td width = '10em'><font size = '3'><b>$data_name</b></font></td>
							<td width = '3em'></td>
							<td><font size = '2'>
								<span>Price : <font size='1'>=N=</font> $data2</span>
									<br/>
								<span class = 'print_prod_itms_values'>Quantity : $data_qty</span>
									<br/>
								<span class = 'print_prod_itms_values'>Total : <font size='1'>=N=</font> $total_m</span>
							</font></td>	
						</tr>
						<tr></tr>
						<tr>
							<td><br/></td>
						</tr>
						";
						$totalSalez = $totalSalez + $total_m;
						$receipt_no = $data_randy;
						// break;
						$block_details = "<div>
						<span>Recipient : $block_noz <span>
						<br/>
						<span>Recipient name : $blk_namez	</span>
						<span>Recipient Phone : $blk_phonez</span>
						</div>";
						unset($catz[$ref]);
					$num++;
					// continue;
				}
				
				// echo $dataz;
				// exit;
			}
			else
			{
				echo "<div class = 'cat_prod_itms'><span class = 'cat_prod_itms_z'>[1].Nothing to show</span>
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
	

?>