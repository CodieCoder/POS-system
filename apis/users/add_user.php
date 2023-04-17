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
			$uname = $_POST["uname"];
			$password = $_POST["password"];
			$email = $_POST["email"];
			$phone = $_POST["phone"];
			$address = $_POST["address"];
			$sex = $_POST["sex"];
			$level = $_POST["level"];
			$userkey = $_POST["idkey"];
			$pic_tmpname = $_POST["pic_tmpname"];
			$pic_type = $_POST["pic_type"];
			$pic_error = $_POST["pic_error"];
			$pic_size = $_POST["pic_size"];
			// var_dump($_POST);
			// exit;
			$class_init = new users($dbcon, $tb, $userkey);
				$getdetails = $class_init->users_add($name, $uname, $password, $email, $phone, $address, $sex, $level, $pic_tmpname, $pic_type, $pic_error, $pic_size, $userkey);
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
