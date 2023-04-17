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
	$tb = 'zpm_sales';
	$sql = "CREATE TABLE $tb (id int(5) auto_increment, blockr varchar(55), block_name varchar(55), block_phone varchar(55), product varchar(30), category varchar(33), randkey varchar(100), user_add varchar(33), price varchar(10), qty int(10), date varchar(35), time varchar(25), lastmodify varchar(55), other varchar(120), primary key(id))";
	
	//doin..
		$do = sqlQuery($con, $tb, $sql);
		echo $do;

			print "<script>alert('Installation Successful! Click OK to continue . . .'); </script>";
		
		exit;
	//	print "<script>window.location = 'install_admin.php'</script>";
		exit();
	?>