<?php
// session_start();
if(isset($_POST["commandd"]) && isset($_POST["keyr"]))
{
	require("../../../templates/requirez.php");
	$ipaddress = $_SERVER["REMOTE_ADDR"];
	$postdata = [
		'ipaddress' => $ipaddress,
		'idkey' => $_POST["keyr"]
	];
		
	// echo "2>>>>".strlen($_GET["idkey"]);
	// if($getter  = fn_curl($postdata, "$absoute_path/apis/login/staff_login_api.php"))
	if($getter  = fn_curl($postdata, "$absoute_path/apis/users/view_users.php"))
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
		// var_dump($getter);
		// exit;
			// $chk = $getter["idz"] ;
			// print_r($chk);
			// exit;
			//converting string number to int
			// var_dump($catz);exit;
				// $chk = $getter["numz"];	
				$chk = $getter["numz"];	
				// echo $chk;
				// exit;
			if($chk > 0)
			{
				$num = 1;
				$dataz = "";
				
				$name = $getter["name"];
				// var_dump($name);
				// exit;
				$level = $getter["level"];
				$username = $getter["username"];
				$pic = $getter["pic"];
				$phonez = $getter["phone"];
				$emailz = $getter["email"];
				$sexz = $getter["sex"];
				$addressz = $getter["address"];
				$dateregz = $getter["datereg"];
				$lastonline = $getter["lastonline"];
				$admin_addz = $getter["admin_add"];
				$lockz = $getter["lock"];
				
				foreach($name as $ref => $data)
				{
					
						// print $data."<br/>";
					foreach($level as $ref2 => $data2)
					{
						break;
					}
					foreach($username as $ref3 => $data3)
					{
						// print $data."<br/>";
						// print $data2."<br/>";
						break;
					}
					foreach($pic as $ref4 => $data4)
					{
						break;
					}
					foreach($phonez as $ref5 => $data5)
					{
						break;
					}
					foreach($emailz as $ref6 => $data6)
					{
						break;
					}
					foreach($sexz as $ref7 => $data7)
					{
						break;
					}
					foreach($addressz as $ref8 => $data8)
					{
						break;
					}
					foreach($dateregz as $ref9 => $data9)
					{
						break;
					}
					foreach($lastonline as $ref10 => $data10)
					{
						break;
					}
					foreach($admin_addz as $ref11 => $data11)
					{
						break;
					}
					foreach($lockz as $ref12 => $data12)
					{
						break;
					}
				// print $data."<br/>";
					// print $data2."<br/>";
					// print $data3."<br/>";
					// print $data4."<br/>";
					// print $data5."<br/>";
					// print $data6."<br/>";
					// print $data7."<br/>";
					// print $data8."<br/>";
					// print $data9."<br/>";
					// print $data10."<br/>";
					// print $data11."<br/>";
					// print $data12."<br/>";
						$data_cut = substr($data, 0, 15);
						$dataz = "<div class = 'userz_list' title = '$data' onClick = \"user_click('$num')\" id = '$num" . "_div'><span class = 'cat_prod_itms_num'>$num.</span> <span class = 'cat_prod_itms_z'>$data_cut</span>
							<div class = 'cat_prod_itms_values'>
							<div class = 'users_listz'>Fullname : $data</div>
							<div class = 'users_listz'>Level : $data2</div>
							<div class = 'users_listz'>Username : $data3</div>
							<div class = 'users_listz'>Phone : $data5</div>
							<div class = 'users_listz'>Email : $data6</div>
							<div class = 'users_listz'>Address : $data8</div>
							<div class = 'users_listz'>Sex : $data7</div>
							<div class = 'users_listz'>Locked  : $data12</div>
							<div class = 'users_listz'>Date registered  : $data9</div>
							<div class = 'users_listz'>Last online  : $data10</div>
							<div class = 'users_listz'>Added by  : $data11</div>
						</div>
					</div>"; 
					echo $dataz;
						// print "<hr/>";
					unset($level[$ref2]);
					unset($username[$ref3]);
					unset($pic[$ref4]);
					unset($phonez[$ref5]);
					unset($emailz[$ref6]);
					unset($sexz[$ref7]);
					unset($addressz[$ref8]);
					unset($dateregz[$ref9]);
					unset($lastonline[$ref10]);
					unset($admin_addz[$ref11]);
					unset($lockz[$ref12]);
					
					
					unset($name[$ref]);
					$num++;
				}
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
	echo "Invalid Access";
	exit;
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