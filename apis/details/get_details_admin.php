<?php
//db details
	require("../../config/dbcon.php");
	require("../../config/db_fields.php");
	require("../../modules/classes/details/details_staff.php");
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
			$class_init = new details_staff($dbcon, $tb, $level);
				$getdetails = $class_init->admin_details($key, $token);
					if($getdetails == false)
					{
						$dataz = $class_init->output;	
							$dataz["success"] = "success";
							$dataz = json_encode($dataz);
							print_r($dataz);
							exit;
					}
					else
					{
						$dataz = array("success"=>"no");
						exit;
					}
		}
}
else
{
	$dataz = array("success"=>"no");
	exit;
}
?>
