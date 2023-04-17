<?php
function sqlQuery($connector, $tb, $sql)
{
		if($do = $connector->query($sql))
		{
			$result = "<hr color = '#191'/>Table <font color = 'purple'>' $tb ' </font>created successfully </hr>";
		}
		else
		{
			$err = $connector->error;
			$result = "<hr color = '#191'/>Table <font color = 'red'>' $tb ' </font> was not created </hr>" . $err . '<hr>';
		}
	return $result;
		
}



	$db = "zpm_inventory_db";
	$s = "127.0.0.1";
	$u = "root";
	$p = "Root";
	
	$con = new mysqli($s, $u, $p, $db);
//tb 1
	$tb = 'zpm_admin';
	$sql = "CREATE TABLE $tb (id int(5) auto_increment, level int(1), randkey varchar(100), username varchar(15), password varchar(25), question_1 varchar(55), question_2 varchar(55), question_3 varchar(55), answer_1 varchar(55), answer_2 varchar(55), answer_3 varchar(55), token_1 varchar(55), name varchar(30), email varchar(45), phone varchar(14), address varchar(140), sex varchar(10), dateOfReg varchar(70), lastLogin varchar(55), nowLogin varchar(55), other varchar(500),  primary key(id))";
	
	//doin..
		$do = sqlQuery($con, $tb, $sql);
		echo $do;
//
//creating the config file
				$file = fopen('../config/config.php','w');
				//creating the variables
				//date first
				$intro = "Please don't modify this file \n \t \n";
				$end = '\n\ \n Thanks.';
				$date = date('l  jS F Y');
					$intro 	= 	"  \n ";
					$end = " \n ";
					$content = ("<?php $intro \n \n" . '$db = ' . "'$db' ;" . "\n" . "\n  \n". '$s = '. "'$s' ;" . "\n" . " \n" . '$u = ' . "'$u' ;" . "\n" . " \n" . '$p = ' . "'$p' ;" . "\n" . "$end \n ". " \n". " \n ". "\n  ?>");
	if ($file_write = fwrite($file,$content))
	{
		fclose($file);
	
			
			print "<script>alert('Installation Successful! Click OK to continue . . .'); </script>";
		session_destroy();
		exit;
		print "<script>window.location = 'install_admin.php'</script>";
		exit();
	}
	else
	{
		
		echo "Error creating configuration files. Please check your permission.access settings and try again.";
		echo "<a href = 'install_admin.php'>Try again </a>";
	}

?>