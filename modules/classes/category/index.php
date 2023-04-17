<?php

class categories
{
	private $dbcon;
	private $tb;
	public $err_msg;
	public $err;
	public  $output;
	
	
	public function __construct($con, $tb)
	{
		//set vairables
		$this->err_msg = "Err[C 001]";//. Error initializing module.";
		$this->err = true;
		$this->output = "No process found.";
		//create a database connection
		 $this->dbcon = $con;
		 $this->tb = $tb;
	}
	
	public function getCategories($field)
	{
		$doer = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "";
		$output = "Function not performed properly.";
		$err_msg = "Err[CS 01-001]";//Function not performed properly.";
		
		$field = $doer->real_escape_string($field);
			// if na password the pesin wan try collect....change am for am...
			$field = $this->checkPass($field, "name");
			
			$dosql = "select `$field`, `randkey` from `$tb`";
			if($dosql = $doer->query($dosql))
			{
				$err = false;
				$num = $dosql->num_rows;
				$cat_array = array();
				$id_array = array();
				$numz = 2;
				$cat_array[1] = $num;
				$id_array[1] = $num;
				// $cat_array[] = array("quantity"=>"$num");
				while($arraydata = $dosql->fetch_assoc())
				{
					$cat_array[] = $arraydata["$field"];
					$id_array[] = $arraydata["randkey"];
						// print_r($arraydata);
					// }
					$numz++;
				}
				// $total1 = array($cat_array);
				// $total2 = array($id_array);
				$total = array("idz"=>$id_array, "catz"=>$cat_array);
				$output = $total;
			}
			else
			{
				$err_msg = "Err[CS 01-002]".$doer->error;
			}
			
			//close db connection;
		$doer->close();
		
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	
	}
	

	public function addCategories($field, $category_randkey, $category_date, $category_time, $category_other, $category_user_add, $data_name, $data_user)
	{
		$doer = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "";
		$output = "Function not performed properly.";
		$err_msg = "Err[CS 01-001]";//Function not performed properly.";
		
		$data_name = $doer->real_escape_string($data_name);
		$data_user = $doer->real_escape_string($data_user);
		
		$field = $doer->real_escape_string($field);
			// if na password the pesin wan try collect....change am for am...
			$field = $this->checkPass($field, "name");
			
			$randkey = $this->getRandKey(22, $tb, $doer, $category_randkey);
			$date = date("l F Y");
			$time = date("h : s A");
			$dosql = "insert into `$tb` (`$field`, `$category_randkey`, `$category_date`, `$category_time`, `$category_user_add`) values ('$data_name', '$randkey', '$date', '$time', '$data_user')";
			if($dosql = $doer->query($dosql))
			{
				$err = false;
				$output = "Yes";
			}
			else
			{
				$err_msg = "category exist.";
			}
			
			//close db connection;
		$doer->close();
		
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	}


private function checkPass($data, $un)
	{
		if($data == "password" || $data == "pwd" || $data == "pw" || $data == "passkey" || $data == "")
		{
			$data = "$un";
		}
		else
		{
			
		}
		return $data;
	}


	private function getRandKey($len, $tb, $con, $tf)
	{	
		$randkey0 = substr(md5 (rand()), 0, 9);
		$randkey1 = substr(md5 (rand()), 0, 10);
		$randkey2 = substr(md5 (rand()), 2, 11);
		$randkey = "$randkey0".$randkey1.$randkey2;
		$randkey = sha1($randkey);
		$randkey = md5($randkey);
		$randkey = substr($randkey,0, $len);
		//check if it already exists
		$conc = $con;
		$rnd = "SELECT `$tf` FROM $tb WHERE `$tf` = '$randkey'";
		if($rnd = $conc->query($rnd))
		{
			$num = $rnd->num_rows;
			if($num > 0)
			{
				$randkey = $this->getRandKey($len, $tb, $con, $tf);
			}
			else
			{
				
			}
		}
		else
		{
			$randkey = false;
		}
		return $randkey;
	}
}
?>