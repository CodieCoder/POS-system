<?php

class productz
{
		private $dbcon;
	private $tb;
	public $err_msg;
	public $err;
	public  $output;
	
	public function __construct($con, $tb)
	{
		//set vairables
		$this->err_msg = "Err[D 001]";//. Error initializing module.";
		$this->err = true;
		// $this->output = "No process found.";
		//create a database connection
		 $this->dbcon = $con;
		 $this->tb = $tb;
	}
	
	public function product_chk($data, $df, $cat_, $cat_key)
	{
		$connec = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "Error";
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Login not performed properly.";
		
		//cleaning
		$data = $connec->real_escape_string($data);
		$cat_ = $connec->real_escape_string($cat_);
		
		$df = $connec->real_escape_string($df);
			// if na password the pesin wan try collect....change am for am...
			$df = $this->checkPass($df, "other");	//if na password the pesin wan try collect....change am for am...
			
			$cat_key = $connec->real_escape_string($cat_key);
			// if na password the pesin wan try collect....change am for am...
			$cat_key = $this->checkPass($cat_key, "randkey");	//if na password the pesin wan try collect....change am for am...
			
			$sqll = "select `$df`, `$cat_key` from `$tb` where `$df` = '$data' AND `$cat_key` = '$cat_'";
				if($sqll = $connec->query($sqll))
				{
					if($sqll->num_rows > 0)
					{
						$output =  "Yes";
						$err = false;
					}
					else
					{
						// $output =  "No";
						$output =  "No";
						$err = false;
					}
					
				}
				else
				{
					$err_msg = "Error checking";
				}
			// $connec->close();
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	}
	
	
	public function product_add($prod_name, $qty, $price, $user_key, $cat_key)
	{
		$connec = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "Error";
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Login not performed properly.";
		
		//cleaning
		$data = $connec->real_escape_string($prod_name);
		$qty = $connec->real_escape_string($qty);
		$user_key = $connec->real_escape_string($user_key);
		$price = $connec->real_escape_string($price);
		$cat_key = $connec->real_escape_string($cat_key);
		
		//check if e dey first...
			$sqll = "select `other` from `$tb` where `other` = '$prod_name' AND `category` = '$cat_key'";
				if($sqll = $connec->query($sqll))
				{
					if($sqll->num_rows > 0)
					{
						// $output =  "Yes";
						// $err = false;
						$err_msg = "Already exists!";
					}
					else
					{
						$randkey = $this->getRandKey(22, $tb, $connec, 'randkey');
						$date = date("l F Y");
						$time = date("h : s A");
					
						$sqll = "insert into `$tb` (`other`, `initial_qty`, `now_qty`, `price`, `user_add`, `category`, `date`, `time`, `randkey`) values ('$prod_name', '$qty', '$qty', '$price', '$user_key', '$cat_key', '$date', '$time', '$randkey')";
							if($sqll = $connec->query($sqll))
							{
									$output =  "Yes";
									$err = false;
							}
							else
							{
								$err_msg = "Error adding stock." . $connec->error;
							}
					}
				}
				else
				{
					$err_msg = "Error adding stock." . $connec->error;
				}
				
			
			$connec->close();
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	}
	
	public function product_get($cat_data, $product_cat)
	{
		
		$connec = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "Error";
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Login not performed properly.";
		
		
		$cat_data = $connec->real_escape_string($cat_data);
			// if na password the pesin wan try collect....change am for am...
			$product_cat = $connec->real_escape_string($product_cat);
			// if na password the pesin wan try collect....change am for am...
			$product_cat = $this->checkPass($product_cat, "category");	//if na password the pesin wan try collect....change am for am...
			
			$sqll = "select `other`, `randkey`, `price`, `now_qty` from `$tb` where `$product_cat` = '$cat_data'";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$err = false;
						$num = $dosql->num_rows;
						$cat_array = array();
						$id_array = array();
						$price_array = array();
						$qty_array = array();
						
						$componet_arrray = array();
						$componet_arrray['num'] = $num;
						
						$numz = 2;
						// $cat_array[1] = $num;
						while($arraydata = $dosql->fetch_assoc())
						{
							// $cat_array[] = $arraydata["other"];
							$name = $arraydata["other"];
							// $id_array[] = $arraydata["randkey"];
							$rand = $arraydata["randkey"];
							// $price_array[] = $arraydata["price"];
							$price = $arraydata["price"];
							// $qty_array[] = $arraydata["now_qty"];
							$qty = $arraydata["now_qty"];
									
									$componet_arrray[] = ["randy"=>$rand, "name"=>$name, "price"=>$price, "qty"=>$qty];
									
								// print_r($arraydata);
							// }
							$numz++;
						}
						// $total = array("idz"=>$id_array, "catz"=>$cat_array, "pricez"=>$price_array, "qtyz"=>$qty_array);
						// $total = array("num"=>$num, "data"=>$componet_arrray);
						// $output = $total;
						$output = $componet_arrray;
					}
					else
					{
						// $output =  "No";
						$output =  false;
						$err = false;
					}
					
				}
				else
				{
					$err_msg = "Error checking";
				}
			// $connec->close();
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	}
	
	
	public function all_product_calc()
	{
		
		$connec = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "Error";
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Could not performed operation properly.";
		
			$sqll = "select `other` from `$tb` ORDER BY `id` DESC";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$err = false;
						$num = $dosql->num_rows;
						$output = $num;
					}
					else
					{
						// $output =  "No";
						// $output =  false;
						$err_msg = "Could not get data.";
					}
					
				}
				else
				{
					$err_msg = "Error checking";
				}
			// $connec->close();
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	}
	
	
	public function all_product_now_qty()
	{
		
		$connec = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "Error";
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Could not performed operation properly.";
		
			$sqll = "select `now_qty` from `$tb`";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$calc_total = 0;
						while($calc = $dosql->fetch_assoc())
						{
							$calc1 = $calc["now_qty"];
								$calc_total = $calc_total  + $calc1;
						}
						
						$err = false;
						// $num = $dosql->num_rows;
						$output = number_format($calc_total);
					}
					else
					{
						// $output =  "No";
						// $output =  false;
						$err_msg = "Could not get data.";
					}
					
				}
				else
				{
					$err_msg = "Error checking";
				}
			// $connec->close();
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	}
	
	public function all_sales_calc()
	{
		
		$connec = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "Error";
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Could not performed operation properly.";
		
			$sqll = "select `qty` from `$tb`";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$calc_total = $dosql->num_rows;
						$err = false;
						// $num = $dosql->num_rows;
						$output = number_format($calc_total);
					}
					else
					{
						// $output =  "No";
						// $output =  false;
						$err_msg = "Could not get data.";
					}
					
				}
				else
				{
					$err_msg = "Error checking";
				}
			// $connec->close();
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	}
	
	
	public function today_sales_calc()
	{
		
		$connec = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "Error";
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Could not performed operation properly.";
			$today  = date("l F Y");
			$sqll = "select `date` from `$tb` where date = '$today'";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$calc_total = $dosql->num_rows;
						$err = false;
						// $num = $dosql->num_rows;
						$output = number_format($calc_total);
					}
					else
					{
						// $output =  "No";
						// $output =  false;
						$err_msg = "0 ";
					}
					
				}
				else
				{
					$err_msg = "Error checking";
				}
			// $connec->close();
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	}
	
	
	public function all_product_initial_qty()
	{
		
		$connec = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "Error";
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Could not performed operation properly.";
		
			$sqll = "select `initial_qty` from `$tb`";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$calc_total = 0;
						while($calc = $dosql->fetch_assoc())
						{
							$calc1 = $calc["initial_qty"];
								$calc_total = $calc_total  + $calc1;
						}
						
						$err = false;
						// $num = $dosql->num_rows;
						$output = number_format($calc_total);
					}
					else
					{
						// $output =  "No";
						// $output =  false;
						$err_msg = "Could not get data.";
					}
					
				}
				else
				{
					$err_msg = "Error checking";
				}
			// $connec->close();
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