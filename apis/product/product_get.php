<?php
session_start();
	require("../../modules/classes/category/product_check.php");
	require("../../config/dbcon.php");
	require("../../config/db_fields.php");
if(isset($_POST["cat_name"]))
{
	//db details
	if($dbcon === false)
		{
			echo "Opps!  Error connecting to the server. Please check your connection and try again.";
			exit;
		}
	else
	{
		$work = new productz($dbcon, $product_tb);
			$cat_data = $_POST["cat_name"];
				$work_login = $work->product_get($cat_data, $product_cat);
				// var_dump($work->output);exit;
				if($work->err == false)
				{
					if($work->output !== false)
					{
						$result = $work->output;
						$result = json_encode($result);
						echo $result;
					}
					else
					{
						echo "Empty";
						
					}
					
				}
				else
				{
					echo "No";
				}
			
	}
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