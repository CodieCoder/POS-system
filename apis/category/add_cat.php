<?php
session_start();
if(isset($_POST["new_cat"]) && isset($_POST["idkey"]))
{
	//db details
	require("../../config/dbcon.php");
	require("../../config/db_fields.php");
	require("../../modules/classes/category/index.php");
	if($dbcon === false)
		{
			echo "Opps!  Error connecting to the server. Please check your connection and try again.";
			exit;
		}
	else
	{
		$data_user = $_POST["idkey"];
		$data_name = $_POST["new_cat"];
		$userkey = getRandy($data_user, $dbcon, $tb, $level, $token);
		// echo "$userkey";
		// exit;
		
			if($userkey !== "no")
			{
					$work = new categories($dbcon, $category_tb);	
				$work_login = $work->addCategories($category_name, $category_randkey, $category_date, $category_time, $category_other, $category_user_add, $data_name, $data_user);
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
			else
			{
				echo "No";
			}
	
				
	}

}
else
{
	echo "No access";
}
	
	
	
	function getRandy($key, $dbcon, $tb, $level, $token)
	{ 
	
		require("../../modules/classes/details/details_staff.php");
		$result = "no";
		$class_init = new details_staff($dbcon, $tb, $level);
			$getdetails = $class_init->admin_details($key, $token);
				if($getdetails == false)
				{
					$dataz = $class_init->output;	
					 if($dataz["success"] = "success")
						{
							$result = $dataz["randkey"];
						}
						else
						{
							$result = "no";
						} 
						
						// var_dump($dataz);exit;
							// $result = $dataz["randkey"];
						// print_r($dataz);
						// exit;
				}
				else
				{
					
				}
		return $result;
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