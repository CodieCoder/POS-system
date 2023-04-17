<?php

		$ipaddress = $_SERVER["REMOTE_ADDR"];
		$postdata = [
			'idkey' => $userkey,
			'ipaddress' => $ipaddress
		];
		if($getter  = fn_curl($postdata, "$absoute_path/apis/details/get_details_admin.php"))
		{
			$getter = json_decode($getter, true);
			// var_dump($getter);
			// exit;
			if($getter["success"] == "success")
			{
				// echo "yep";
				$fullname = $getter["name"];
				$level = $getter["level"];
				$username = $getter["username"];
				$email = $getter["email"];
				$phone = $getter["phone"];
				$address = $getter["address"];
				$dateOfReg = $getter["dateOfReg"];
				$lastLogin = $getter["lastLogin"];
				$sex = $getter["sex"];
				$lock = $getter["lockr"];
				$profile_pic = $getter["profile_pic"];
			}
			else
			{
				// var_dump($getter);
				$_SESSION["auError"] = "$access_err";
				// echo "no";
				// print_r($getter);
				// exit;
				header("location:../index.php");
			}
		}
		else
		{
			// echo $login_form_error_network;
				$_SESSION["auError"] = "$login_form_error_network";
				header("location:../index.php");
		}

?>	