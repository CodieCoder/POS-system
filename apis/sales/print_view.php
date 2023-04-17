<?php
session_start();
if(isset($_POST["sales_key"]) && isset($_POST["cart_key"]))
{
	//db details
	require("../../config/dbcon.php");
	require("../../config/db_fields.php");
	require("../../modules/classes/sales/cart.php");
	if($dbcon === false)
		{
			echo "Opps!  Error connecting to the server. Please check your connection and try again.";
			exit;
		}
	else
	{
		$sales_key = $_POST["sales_key"];
		$cart_key = $_POST["cart_key"];
		
			$work = new cart($dbcon, $sales_tb);	
				$work_login = $work->print_view($sales_key, $cart_key);
				if($work->err == false)
				{
					$output = $work->output;
					
					// var_dump($output);exit;
					if($output == "No")
					{
						echo "No";
						exit;
					}
					else if($output == "Empty")
					{
						echo "Empty";
						exit;
					}
					else
					{
						// var_dump($output);exit;
						$output = json_encode($output);
						echo $output;
						exit;
					}
				}
				else
				{
					echo ".";
					// echo $work->err_msg;
					exit;
				}
		
			
	
				
	}

}
else
{
	echo "No access";
}
	
	function errorReporting($data)
{
	if($data == "Err[LS 001]")
	{
		$err_msg = "Error initializing module.";
	}
	else if($data == "Err[LS 01-001]")
	{
		$err_msg = "Function not performed properly.";
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
		$err_msg =" Couldn't Authenticate .";
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