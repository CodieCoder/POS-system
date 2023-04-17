<?php
//db details
	require("../../config/dbcon.php");
	require("../../config/db_fields.php");
	require("../../modules/classes/users/users.php");
if(isset($_POST["idkey"]))
{
	$key = $_POST["idkey"];
	if($dbcon === false)
		{
			echo "Opps!  Error connecting to the server. Please check your connection and try again.";
			exit;
		}
		else
		{
			$userkey = $_POST["idkey"];
			// var_dump($_POST);
			// exit;
			$class_init = new users($dbcon, $tb, $userkey);
				$getdetails = $class_init->customers_view();
						$chkr = $class_init->err;	
					if($chkr == false)
					{
						$output = json_encode($class_init->output);
						echo $output;
						exit;
					}
					else
					{
						echo $class_init->err_msg;	
						exit;
					}
		}
}
else
{
	echo "Access error";
	exit;
}
?>
