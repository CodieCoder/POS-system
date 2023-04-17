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
			$name = $_POST["name"];
			$desc = $_POST["desc"];
			$loc = $_POST["loc"];
			$other = $_POST["other"];
			$userkey = $_POST["idkey"];
			// var_dump($_POST);
			// exit;
			$class_init = new users($dbcon, $tb, $userkey);
				$getdetails = $class_init->customers_add($name, $desc, $loc, $other, $userkey);
						$chkr = $class_init->err;	
					if($chkr == false)
					{
							if($class_init->output == "Yes")
							{
								echo "Yes";
							}
							else
							{
								echo $class_init->err_msg;	
								exit;
							}
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
