<?php
session_start();
if(isset($_POST["block"]) && isset($_POST["b_name"]) && isset($_POST["b_phone"]) && isset($_POST["cat_key"]) && isset($_POST["product_name"]) && isset($_POST["price"]) && isset($_POST["qty"]) && isset($_POST["user_key"]))
{
	//db details
	require("../../config/dbcon.php");
	require("../../config/db_fields.php");
	require("../../modules/classes/sales/index.php");
	if($dbcon === false)
		{
			echo "Opps!  Error connecting to the server. Please check your connection and try again.";
			exit;
		}
	else
	{
		$data_block = $_POST["block"];
		$data_name = $_POST["b_name"];
		$data_phone = $_POST["b_phone"];
		$data_catz = $_POST["cat_key"];
		$data_prod = $_POST["product_name"];
		$data_pricez = $_POST["price"];
		$data_qtyz = $_POST["qty"];
		$data_userd = $_POST["user_key"];
		
			$work = new sales($dbcon, $tmp_tb);	
				$work_login = $work->addSales($data_block, $data_name, $data_phone, $data_prod, $data_catz, $data_pricez, $data_qtyz, $data_userd);
				if($work->err == false)
				{
					$output = $work->output;
					if($output == "Yes")
					{
						echo "Yes";
					}
					else
					{
						echo $work->err_msg;
					}
				}
				else
				{
					echo $work->err_msg;
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