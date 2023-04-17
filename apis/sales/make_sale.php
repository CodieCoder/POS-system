<?php
session_start();
	//db details
	require("../../config/dbcon.php");
	require("../../config/db_fields.php");
	
	if(isset($_POST["uskey"]))
	{
		if($dbcon === false)
		{
			echo "Opps!  Error connecting to the server. Please check your connection and try again.";
			exit;
		}
		else
		{
			require("../../modules/classes/sales/index.php");
			$user_id = $_POST["uskey"];
			$work = new sales($dbcon, $product_tb);	
				$work_ = $work->makeSales($user_id);
					if($work->err == false)
					{
						$output = $work->output;
							$ans = "Yes";
					}
					else
					{
						$output = errorReporting($work->err_msg);
							$ans = "No";
					}
					$output = ["1"=>$ans, "2"=>$output];
						$output = json_encode($output);
							echo $output;
					exit;
		}
	}
	else
	{
		echo "Fatal error";
		exit;
	}
	

	
	
	function errorReporting($data)
{
	if($data == "Err[LS 001]")
	{
		$err_msg = "Error initializing module.";
	}
	else if($data == "Err[LS 01-001]")
	{
		$err_msg = "Login not performed properly.";
	}
	else if($data == "Err[LS 01-002]")
	{
		$err_msg = "Couldn't perform operation";
	}
	else if($data == "Err[LS 01-003]")
	{
		$err_msg = "Oops! No such user found.";
	}
	else if($data == "Err[LS 01-004]")
	{
		$err_msg =" Couldn't Authenticate user.";
	}
	else if($data == "Err[LS 01-005]")
	{
		$err_msg = "Error retrieving user's data.";
	}
	else if($data == "Err[LS 01-006]")
	{
		$err_msg = "Account Locked. Contact Administrator.";
	}
	else
	{
		// $err_msg = "Access Error";
		$err_msg = $data;
	}
	return $err_msg;
}

?>