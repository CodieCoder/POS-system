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
	$tb = 'zpm_products';
	$sql = "CREATE TABLE $tb (id int(5) auto_increment, category varchar(33), randkey varchar(100), user_add varchar(33), date varchar(35), time varchar(25), lastmodify varchar(55), price varchar(10), initial_qty int(10), now_qty varchar(10), other varchar(120), primary key(id))";
	
	//doin..
		$do = sqlQuery($con, $tb, $sql);
		echo $do;

			print "<script>alert('Installation Successful! Click OK to continue . . .'); </script>";
		
		exit;
	//	print "<script>window.location = 'install_admin.php'</script>";
		exit();
	?>