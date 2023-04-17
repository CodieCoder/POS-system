<?php

class sales 
{
	
	private $dbcon;
	private $tb;
	public $err_msg;
	public $err;
	public  $output;
	private  $tmpkey;
	private  $receipt_no;
	
	
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
	
	public function addSales($bl_no, $bl_name, $bl_phone, $prod, $cate, $price, $qty, $user_id)
		{
			$doer = $this->dbcon;
			$tb = $this->tb;
			$err = true;
			$output = "";
			$output = "Function not performed properly.";
			$err_msg = "Err[CS 01-001]";//Function not performed properly.";
			
			$bl_no = $doer->real_escape_string($bl_no);
			$bl_name = $doer->real_escape_string($bl_name);
			$bl_phone = $doer->real_escape_string($bl_phone);
			$prod = $doer->real_escape_string($prod);
			$cate = $doer->real_escape_string($cate);
			$price = $doer->real_escape_string($price);
			$qty = $doer->real_escape_string($qty);
			$user_id = $doer->real_escape_string($user_id);
			
			
				$randkey = $this->getRandKey(22, $tb, $doer, "randkey");
				
				$date = date("l F Y");
				$time = date("h : s A");
				$dosql = "insert into `$tb` (`blockr`, `block_name`, `block_phone`, `product`, `category`, `randkey`,  `price`, `qty`, `time`, `date`, `user_add`) values ('$bl_no', '$bl_name', '$bl_phone', '$prod', '$cate', '$randkey', '$price', '$qty', '$time', '$date', '$user_id')";
				if($dosql = $doer->query($dosql))
				{
					$err = false;
					$output = "Yes";
				}
				else
				{
					$err_msg = "Could not make transfer.".$doer->error;
				}
				
				//close db connection;
			$doer->close();
			
			$this->err = $err;
			$this->err_msg = $err_msg;
			$this->output = $output;
		}


	public function makeSales($user_id)
		{
			$doer = $this->dbcon;
			$tb = $this->tb;
			$err = true;
			$output = "";
			$output = "Function not performed properly.";
			$err_msg = "Err[CS 01-001]";//Function not performed properly.";
			
			
				$sale_randkey = $this->getRandKey(13, $tb, $doer, "randkey");
					$this->receipt_no = $sale_randkey;
				$user_id = $doer->real_escape_string($user_id);
				$this->tmpkey = $user_id;
			$sqll = "select `blockr`, `block_name`, `block_phone`,`product`, `category`, `price`, `qty` from `zpm_tmp_sales` where `user_add` = '$user_id'";
				if($dosql = $doer->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$num = $dosql->num_rows;
						$err_1 = true;
						while($arraydata = $dosql->fetch_assoc())
						{
							$pro = $arraydata["product"];
							$cat = $arraydata["category"];
							$price = $arraydata["price"];
							$qty = $arraydata["qty"];
							$blockr = $arraydata["blockr"];
							$block_name = $arraydata["block_name"];
							$block_phone = $arraydata["block_phone"];
							$do = $this->makySales($blockr, $block_name, $block_phone, $pro, $cat, $price, $qty, $sale_randkey);
							if($do == true)
							{
								$err_1 = false;
							}
							else
							{
								$err_1 = true;
							}
						}
						
						if($err_1 == false)
						{
							$erzr = $this->eraseTmp();
							if($erzr == "Yes")
							{
								$err = false;
								$output = $sale_randkey;
							}
							else
							{
								$err_msg = "Could not clean cart right now.";
							}
							
						}
						else
						{
							$err_msg = "Could not make requested sales.";
						}
					}
				//close db connection;
			$doer->close();
			
			$this->err = $err;
			$this->err_msg = $err_msg;
			$this->output = $output;
		}
	}

	private function makySales($blockr, $block_name, $block_phone, $pro, $cat, $price, $qty, $receipt_no)
	{
		$tb = "zpm_sales";
		$con = $this->dbcon;
		$userkey = $this->getUserKey();
		$date = date("l F Y");
		$time = date("h : s A");
		$sale_randkey = $this->getRandKey(22, $tb, $con, "randkey");
		
		$sqldo = "insert into `$tb`(`blockr`, `block_name`, `block_phone`, `product`, `category`, `user_add`, `price`, `qty`, `date`, `time`, `randkey`, `receipt_no` )values('$blockr', '$block_name', '$block_phone','$pro', '$cat', '$userkey', '$price', '$qty', '$date', '$time', '$sale_randkey', '$receipt_no')";
			if($sqldo = $con->query($sqldo))
			{
				$qtydo = $this->updateQty($qty, $pro);
				if($qtydo == true)
				{
					return true;
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
	
	private function eraseTmp()
	{
		$tb = "zpm_tmp_sales";
		$doer = $this->tmpkey;
		$con = $this->dbcon;
			$sqql = "delete from `$tb` where `user_add` = '$doer'";
			if($sqql = $con->query($sqql))
			{
				return "Yes";
			}
			else
			{
				return "No";
			}
	
		
	}
	
	private function updateQty($qty, $prod)
	{
		$tb = "zpm_products";
		$con = $this->dbcon;
			$sqql = "select `now_qty` from `$tb` where `randkey` = '$prod'";
			if($sqql = $con->query($sqql))
			{
				$initial_qty = $sqql->fetch_assoc();
					$initial_qty = $initial_qty["now_qty"];
					
					$qty = $initial_qty - $qty;
					
				$sqql2 = "update `$tb` set `now_qty` = '$qty' where `randkey` = '$prod'";
				if($sqql2 = $con->query($sqql2))
				{
					return true;
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
	
	private function getUserKey()
	{
		$connec = $this->dbcon;
		$tb = "zpm_staffs";
		$tmpkey = $this->tmpkey;
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