<?php
session_start();
	require("../../modules/classes/category/product_check.php");
	require("../../config/dbcon.php");
	require("../../config/db_fields.php");
if(isset($_POST["pro_name"]) && isset($_POST["cat_name"]))
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
			$data = $_POST["pro_name"];
			$cat_data = $_POST["cat_name"];
				$work_login = $work->product_chk($data, $product_name, $cat_data, $product_cat);
				// var_dump($work->output);exit;
				if($work->err == false)
				{
					// var_dump($work->output);exit;
					$output = $work->output;
					if($output == "Yes")
					{
						$result = ["1"=>"Yes", "2"=>"Yes"];
						// exit;
					}
					else if($output  == "No")
					{
						$result = ["1"=>"Yes","2"=>"No"];
						// exit;
					}
					else
					{
						$result = ["1"=>"No", "2"=>$work->err_msg];
						// exit;
					}
					$result = json_encode($result);
						echo $result;
					exit;
				}
			
	}
}	
else if(isset($_POST["product_name"]) && isset($_POST["cat_key"]) && isset($_POST["price"]) && isset($_POST["qty"]) && isset($_POST["user_key"]))
	{
		$work = new productz($dbcon, $product_tb);	
			$data = $_POST["product_name"];
			$cat_data = $_POST["cat_key"];
			$price = $_POST["price"];
			$qty = $_POST["qty"];
			$user_key = $_POST["user_key"];
				$work_login = $work->product_add($data, $qty, $price, $user_key, $cat_data);
				// var_dump($work->output);exit;
				if($work->err == false)
				{
					// var_dump($work->output);exit;
					$output = $work->output;
					if($output == "Yes")
					{
						$result = ["1"=>"Yes", "2"=>"Yes"];
						// exit;
					}
					else
					{
						$result = ["1"=>"No", "2"=>$work->err_msg];
						// exit;
					}
					$result = json_encode($result);
						echo $result;
					exit;
				}
				else
				{
					$result = ["1"=>"No", "2"=>$work->err_msg];
					$result = json_encode($result);
						echo $result;
					exit;
				}
			
		
	
	}
	else
	{
		echo "No access";exit;
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