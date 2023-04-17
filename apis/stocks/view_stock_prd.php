<?php
session_start();
	//db details
	require("../../config/dbcon.php");
	require("../../config/db_fields.php");
	require("../../modules/classes/category/product_check.php");
if($dbcon === false)
	{
		echo "Opps!  Error connecting to the server. Please check your connection and try again.";
		exit;
	}
	else
	{
		$work = new productz($dbcon, $product_tb);	
			$work_login = $work->all_product_calc();
				if($work->err == false)
				{
					$output = $work->output;
						echo $output;
						exit;
				}
				else
				{
					$err_2 = errorReporting($work->err_msg);
						print($err_2);
						exit;
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