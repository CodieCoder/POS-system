<?php

class cart
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
	
	public function view($sales_key)
	{
		$connec = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "Error";
		// $output = "Operation not performed properly.";
		$err_msg = "Err[D 01-001]";//Operation not performed properly.";
		
		// $output = "Great";
		$sales_key = $connec->real_escape_string($sales_key);
			$sqll = "select `blockr`, `block_name`, `block_phone`, `product`, `randkey`, `category`, `user_add`, `price`, `qty`, `date`, `time`, `id` from `$tb` where `user_add` = '$sales_key'";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$err = false;
						$num = $dosql->num_rows;
						$cat_array = array();
						$id_array = array();
						$price_array = array();
						$name_array = array();
						$qty_array = array();
						$randy_array = array();
						$date_array = array();
						$time_array = array();
						$numz = 2;
						$cat_array[1] = $num;
						while($arraydata = $dosql->fetch_assoc())
						{
							$block_get = $arraydata["blockr"];
								$block_get = $this->block_name_get($block_get);
							$cat_get = $arraydata["category"];
								$cat_get = $this->cat_name_get($cat_get);
							$name_get = $arraydata["product"];
							$name_get = $this->prod_name_get($name_get);
							if($name_get !== false && $cat_get !== false)
							{
								$block_array[] = $block_get;
								$name_array[] = $name_get;
								$cat_array[] = $cat_get;
								$block_name_array[] = $arraydata["block_name"];
								$block_phone_array[] = $arraydata["block_phone"];
								$price_array[] = $arraydata["price"];
								$qty_array[] = $arraydata["qty"];
								$randy_array[] = $arraydata["randkey"];
								$date_array[] = $arraydata["date"];
								$time_array[] = $arraydata["time"];
								$numz++;
								$outchk = true;
							}
							else
							{
								$outchk = false;
							}
							
						}
						if($outchk == true)
						{
							$total = array("blockz"=>$block_array, "blk_name"=>$block_name_array, "blk_phone"=>$block_phone_array, "cat"=>$cat_array, "pricez"=>$price_array, "qtyz"=>$qty_array, "name"=>$name_array, "randyz"=>$randy_array, "datez"=>$date_array, "timez"=>$time_array);
							$output = $total;
						}
						else
						{
							$output = "No";
							$err_msg = "No";
						}
					}
					else
					{
						// $output =  "No";
						// $output =  false . $connec->error;
						$output =  "Empty";
						$err_msg = "Empty";
					}
				}
				else
				{
					$err_msg = "Error";
				}
			// $connec->close();
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	
	
	}



	public function print_view($sales_key, $cart_link)
	{
		$connec = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "Error";
		// $output = "Operation not performed properly.";
		$err_msg = "Err[D 01-001]";//Operation not performed properly.";
		
		// $output = "Great";
		$sales_key = $connec->real_escape_string($sales_key);
			$sales_key = $this->getUserKey($sales_key);
		$cart_link = $connec->real_escape_string($cart_link);
			$sqll = "select `blockr`, `block_name`, `block_phone`,  `product`, `receipt_no`, `category`, `user_add`, `price`, `qty`, `date`, `time`, `id` from `$tb` where `user_add` = '$sales_key' AND `receipt_no` = '$cart_link'";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$err = false;
						$num = $dosql->num_rows;
						$id_array = array();
						$price_array = array();
						$name_array = array();
						$qty_array = array();
						$randy_array = array();
						$date_array = array();
						$time_array = array();
						$numz = 2;
						$cat_array[1] = $num;
						while($arraydata = $dosql->fetch_assoc())
						{
							$block_get = $arraydata["blockr"];
								$block_get = $this->block_name_get($block_get);
							$cat_get = $arraydata["category"];
								$cat_get = $this->cat_name_get($cat_get);
							$name_get = $arraydata["product"];
							$name_get = $this->prod_name_get($name_get);
							if($name_get !== false && $cat_get !== false)
							{
								$block_array[] = $block_get;
								$name_array[] = $name_get;
								$cat_array[] = $cat_get;
								$block_name_array[] = $arraydata["block_name"];
								$block_phone_array[] = $arraydata["block_phone"];
								$price_array[] = $arraydata["price"];
								$qty_array[] = $arraydata["qty"];
								$randy_array[] = $arraydata["receipt_no"];
								$date_array[] = $arraydata["date"];
								$time_array[] = $arraydata["time"];
								$numz++;
								$outchk = true;
							}
							else
							{
								$outchk = false;
							}
							
						}
						if($outchk == true)
						{
							$total = array("blockz"=>$block_array, "blk_name"=>$block_name_array, "blk_phone"=>$block_phone_array, "cat"=>$cat_array, "pricez"=>$price_array, "qtyz"=>$qty_array, "name"=>$name_array, "randyz"=>$randy_array, "datez"=>$date_array, "timez"=>$time_array);
							$output = $total;
						}
						else
						{
							$output = "No";
							$err_msg = "No";
						}
					}
					else
					{
						// $output =  "No";
						// $output =  false . $connec->error;
						$output =  "Empty";
						$err_msg = "Empty";
					}
				}
				else
				{
					$err_msg = "Error";
				}
			// $connec->close();
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	
	
	}
	
	
	
	private function getUserKey($tmpkey)
	{
		$connec = $this->dbcon;
		$tb = "zpm_staffs";
		$sql = "select `randkey` from `$tb` where `token_1` = '$tmpkey'";
			if($sqldo = $connec->query($sql))
			{
				if($sqldo->num_rows == 1)
				{
					$sqlget = $sqldo->fetch_assoc();
						$output = $sqlget["randkey"];
						return $output;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
	}
	
	
	private function prod_name_get($data)
	{
		
		$connec = $this->dbcon;
		$tb = "zpm_products";
		$output = false;
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Login not performed properly.";
		
		
		$data = $connec->real_escape_string($data);
			
			$sqll = "select `other` from `$tb` where `randkey` = '$data'";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$arraydata = $dosql->fetch_assoc();
						$output = $arraydata["other"];
					}
					else
					{
						$err = false;
					}
					
				}
				else
				{
					$err_msg = "Error checking";
				}
			// $connec->close();
			return $output;
	}
	
	private function cat_name_get($data)
	{
		
		$connec = $this->dbcon;
		$tb = "zpm_categoriez";
		$output = false;
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Login not performed properly.";
		
		
		$data = $connec->real_escape_string($data);
			
			$sqll = "select `cat_name` from `$tb` where `randkey` = '$data'";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$arraydata = $dosql->fetch_assoc();
						$output = $arraydata["cat_name"];
					}
					else
					{
						$err = false;
					}
					
				}
				else
				{
					$err_msg = "Error checking";
				}
			// $connec->close();
			return $output;
	}
	
	
	
	
	private function block_name_get($data)
	{
		
		$connec = $this->dbcon;
		$tb = "zpm_staffs";
		$output = false;
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Login not performed properly.";
		
		
		$data = $connec->real_escape_string($data);
			
			$sqll = "select `name` from `$tb` where `randkey` = '$data'";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$arraydata = $dosql->fetch_assoc();
						$output = $arraydata["name"];
					}
					else
					{
						$err = false;
					}
					
				}
				else
				{
					$err_msg = "Error checking";
				}
			// $connec->close();
			return $output;
	}
	
	
	
	public function deleting($data)
	{
		$connec = $this->dbcon;
		$tb = "zpm_tmp_sales";
		$output = true;
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Login not performed properly.";
		
		
		$data = $connec->real_escape_string($data);
			
			$sqll = "delete from `$tb` where `randkey` = '$data'";
				if($dosql = $connec->query($sqll))
				{
					$output = "Yes";
					$err = false;
				}
				else
				{
					$err_msg = "Error checking";
				}
			$connec->close();
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
	
}
?>