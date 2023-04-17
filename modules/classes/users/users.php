<?php

class users 
{
	
	private $dbcon;
	private $tb;
	public $err_msg;
	public $err;
	public  $output;
	private  $tmpkey;
	private  $receipt_no;
	
	
	public function __construct($con, $tb, $tmpkey)
	{
		//set vairables
		$this->err_msg = "Err[C 001]";//. Error initializing module.";
		$this->err = true;
		$this->output = "No process found.";
		//create a database connection
		 $this->dbcon = $con;
		 $this->tb = $tb;
		 $this->tmpkey = $tmpkey;
	}
	
	public function users_add($fname, $usrname, $passkey, $email, $phn, $addrs, $sx, $lvls, $pic_tmpname, $pic_type, $pic_error, $pic_size, $admin_id)
		{
			$doer = $this->dbcon;
			$tb = $this->tb;
			$err = true;
			$output = "";
			$output = "Function not performed properly.";
			$err_msg = "Err[CS 01-001]";//Function not performed properly.";
			
			$fname = $doer->real_escape_string($fname);
			$usrname = $doer->real_escape_string($usrname);
			$passkey = $doer->real_escape_string($passkey);
			$email = $doer->real_escape_string($email);
			$phn = $doer->real_escape_string($phn);
			$addrs = $doer->real_escape_string($addrs);
			$sx = $doer->real_escape_string($sx);
			$lvls = $doer->real_escape_string($lvls);
			$admin_id = $doer->real_escape_string($admin_id);
			// $profile_pic = $doer->real_escape_string($profile_pic);
			
			
				$randkey = $this->getRandKey(22, $tb, $doer, "randkey");
				$chkr_usr = $this->chkUsr($usrname, $fname, $doer, $tb);
				$admin_id = $this->getUserKey();
					if($chkr_usr == true)
					{
							
						$date = date("l F Y");
						$dosql = "insert into `$tb` (`level`, `randkey`, `username`,  `password`, `name`, `email`, `phone`,  `address`, `sex`, `dateOfReg`, `lastLogin`, `lockr`, `admin_add`) values ('$lvls', '$randkey', '$usrname', '$passkey', '$fname', '$email', '$phn', '$addrs', '$sx', '$date', '$date', '0', '$admin_id')";
						if($dosql = $doer->query($dosql))
						{
							// $result = $this->profile_pic($pic_tmpname, $pic_type, $pic_error, $pic_size, $admin_id, $usrname);
							// if($result[0] === true)
							// {
								// $output = $result[1];
								$err = false;
								$output = "Yes";
							// }
							// else
							// {
								// $err_msg = $result[1];
							// }
							
						}
						else
						{
							$err_msg = "Could not make transfer.";
						}
					}
					else
					{
						$err_msg = "Staff already exist";
					}
				
				//close db connection;
			$doer->close();
			
			$this->err = $err;
			$this->err_msg = $err_msg;
			$this->output = $output;
		}

		


	public function user_view()
	{
		$connec = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "Error";
		// $output = "Operation not performed properly.";
		$err_msg = "Err[D 01-001]";//Operation not performed properly.";
		
		// $output = "Great";
			$sqll = "select `name`, `level`, `username`, `profile_pic`, `email`, `phone`, `address`, `sex`, `dateOfReg`, `lastLogin`, `lockr`, `admin_add`, `randkey` from `$tb`";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$num = $dosql->num_rows;
						$name_array = array();
						$level_array = array();
						$username_array = array();
						$pic_array = array();
						$email_array = array();
						$phone_array = array();
						$address_array = array();
						$sex_array = array();
						$dateofreg_array = array();
						$lastlogin_array = array();
						$lock_array = array();
						$admin_array = array();
						$randy_array = array();
						$numz = 2;
						while($arraydata = $dosql->fetch_assoc())
						{
								$name_array[] = $arraydata["name"];
								$level_array[] = $arraydata["level"];
								$username_array[] = $arraydata["username"];
								$pic_array[] = $arraydata["profile_pic"];
								$email_array[] = $arraydata["email"];
								$phone_array[] = $arraydata["phone"];
								$address_array[] = $arraydata["address"];
								$sex_array[] = $arraydata["sex"];
								$dateofreg_array[] = $arraydata["dateOfReg"];
								$lastlogin_array[] = $arraydata["lastLogin"];
								$lock_array[] = $arraydata["lockr"];
								$admin_arrayget = $arraydata["admin_add"];
								$admin_array[] = $this->getAdminName($admin_arrayget);
									// $admin_array[] = $arraydata["admin_add"];
								$randy_array[] = $arraydata["randkey"];
								$numz++;
							
						}
						$err = false;
							$total = ["numz" => $num ,"name"=>$name_array, "level"=>$level_array, "username"=>$username_array, "pic"=>$pic_array, "email"=>$email_array, "phone"=>$phone_array, "address"=>$address_array, "sex"=>$sex_array, "datereg"=>$dateofreg_array, "lastonline"=>$lastlogin_array, "lock"=>$lock_array, "admin_add"=>$admin_array, "randy"=>$randy_array];
							// $output = $total;
							// $total = [$name_array, $level_array, $username_array, $pic_array, $email_array, $phone_array, $address_array, $sex_array, $dateofreg_array, $lastlogin_array, $lock_array, $admin_array, $randy_array];
							$output = $total;
						
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
	
	
	public function customers_view()
	{
		$connec = $this->dbcon;
		$tb = $this->tb;
		$err = true;
		$output = "Error";
		// $output = "Operation not performed properly.";
		$err_msg = "Err[D 01-001]";//Operation not performed properly.";
		
		// $output = "Great";
			$sqll = "select `name`, `level`, `profile_pic`, `address`, `other`, `dateOfReg`, `admin_add`, `randkey` from `$tb` where `level` = '5'";
				if($dosql = $connec->query($sqll))
				{
					if($dosql->num_rows > 0)
					{
						$num = $dosql->num_rows;
						// $name_array = array();
						// $level_array = array();
						// $desc_array = array();
						// $address_array = array();
						// $other_array = array();
						// $dateofreg_array = array();
						// $admin_array = array();
						// $randy_array = array();
						$numz = 1;
						while($arraydata = $dosql->fetch_assoc())
						{
								$name_array = $arraydata["name"];
								$level_array = $arraydata["level"];
								$desc_array = $arraydata["profile_pic"];
								$address_array = $arraydata["address"];
								$other_array = $arraydata["other"];
								$dateofreg_array = $arraydata["dateOfReg"];
								$admin_arrayget = $arraydata["admin_add"];
								$admin_array = $this->getAdminName($admin_arrayget);
									// $admin_array[] = $arraydata["admin_add"];
								$randy_array = $arraydata["randkey"];
								$total[] = ["numz" => $num ,"name"=>$name_array, "level"=>$level_array,  "desc"=>$desc_array, "address"=>$address_array, "other"=>$other_array, "datereg"=>$dateofreg_array, "admin_add"=>$admin_array, "randy"=>$randy_array];
								$numz++;
							
						}
						$err = false;
							// $total = ["numz" => $num ,"name"=>$name_array, "level"=>$level_array, "username"=>$username_array, "pic"=>$pic_array, "email"=>$email_array, "phone"=>$phone_array, "address"=>$address_array, "sex"=>$sex_array, "datereg"=>$dateofreg_array, "lastonline"=>$lastlogin_array, "lock"=>$lock_array, "admin_add"=>$admin_array, "randy"=>$randy_array];
							// $output = $total;
							// $total = [$name_array, $level_array, $username_array, $pic_array, $email_array, $phone_array, $address_array, $sex_array, $dateofreg_array, $lastlogin_array, $lock_array, $admin_array, $randy_array];
							$output = $total;
						
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
	
	
	
	public function customers_add($name_, $desc_, $addr_, $other_, $admin_id)
		{
			$doer = $this->dbcon;
			$tb = $this->tb;
			$err = true;
			$output = "";
			$output = "Function not performed properly.";
			$err_msg = "Err[CS 01-001]";//Function not performed properly.";
			
			$name_ = $doer->real_escape_string($name_);
			$desc_ = $doer->real_escape_string($desc_);
			$addr_ = $doer->real_escape_string($addr_);
			$other_ = $doer->real_escape_string($other_);
			$admin_id = $doer->real_escape_string($admin_id);
				$randkey = $this->getRandKey(22, $tb, $doer, "randkey");
				$admin_id = $this->getUserKey();
						$date = date("l F Y");
						$dosql = "insert into `$tb` (`randkey`, `name`, `address`, `level`, `profile_pic`, `dateOfReg`, `other`, `admin_add`) values ('$randkey', '$name_', '$addr_', '5', '$desc_', '$date', '$other_', '$admin_id')";
						if($dosql = $doer->query($dosql))
						{
								$err = false;
								$output = "Yes";
						}
						else
						{
							$err_msg = "Could not Create Block.";
						}
				
				//close db connection;
			$doer->close();
			
			$this->err = $err;
			$this->err_msg = $err_msg;
			$this->output = $output;
		}

		
		
		
	private function profile_pic($pic_tmpname, $pic_type, $pic_error, $pic_size, $postkey, $posttitle)
	{
		// var_dump ($pic_data);
		// exit;
		$result = false;
		$conc = $this->dbcon;
		//checking files
		$msg = "Fatal Error. Nothing was done!";
		$pic_tmp_name = $pic_tmpname;
		$pic_size = $pic_size;
		$pic_type = $pic_type;
		$pic_error = $pic_error;
		$max = 2097152;
		$min = 20971;
			//checking ...
			
		//getting extension
		$pic_type = explode("/", $pic_type);
			$pic_type = $pic_type[1];
			$pic_type =  "." . $pic_type;
			if($pic_type == ".jpeg")
			{
				$pic_type = ".jpg";
			}
		if(!$pic_error == "0")
		{
			$msg = "File could not be uploaded because of invalid file upload mechanisim or corrupted file.";
		}
		else if($pic_size > 2097152 || $pic_size < 20971)
		{
			$msg = "Invalid file size. Maximum picture size is " . $max . "Bytes or 2MB and minimum size is " . $min . "Bytes or 100KB. Uploaded is " . $pic_size . "Bytes.";
		}
		else if(!$pic_type == ".png" || !$pic_type == ".jpeg" || !$pic_type == ".jpg" || !$pic_type == ".gif")
		{
			$msg = " Invalid image type. Accepted image format/extension: .jpg, .jpeg, .png, .gif. Uploaded file type is " . $pic_type;
		}
		else
		{
			//where pics go go . . .
			$ds = DIRECTORY_SEPARATOR;
			$folder = 'profile_picz';
			$target = dirname('_FILE_').$ds.$folder.$ds;
			$targeted = ".." . $ds . ".." . $ds .  ".".$target .  '_' . $postkey . "_" . $posttitle . '' . $pic_type;
			$targeted =  $ds . ".."  . $ds ."profile_picz" .  $ds . '_' . $postkey . "_" . $posttitle . '' . $pic_type;
			
			$tb = "zpm_staffs";
			$db_target = '_' . $postkey . "_" . $posttitle . '.' . $pic_type;
			$db_target = $conc->real_escape_string($db_target);
			$sql_task = "update `$tb` set `profile_pic` = '$db_target' where randkey = '$postkey'";
				
					if(move_uploaded_file($pic_tmp_name, $targeted))
					{
						if($sql_task = $conc->query($sql_task))
						{
							$result = true;
							$msg = "Photo uploaded successfully.";
						}
						else
						{
							// $msg = "Error querying DB. " . $conc->error;
							$msg = "Error querying DB. ";
						}
					}
					else
					{/* 
						if(is_file($pic_tmp_name))
						{
							$msge = "yeppy!";
						} */
						// $msg = "Could not move temporary file. > $targeted ? $pic_tmp_name ? $pic_size";
						$msg = "Could not upload file. > $targeted ? $pic_tmp_name ? $pic_size <img src = '$targeted'>";
						
					}
				
		}
		
			return array($result,$msg);
	}

	
	
		private function chkUsr($usr, $name, $con, $tb)
		{	
			$rnd = "SELECT `name` FROM $tb WHERE `name` = '$name' OR `username` = '$usr'";
			if($rnd = $con->query($rnd))
			{
				$num = $rnd->num_rows;
				if($num == 0)
				{
					$result = true;
				}
				else
				{
					$result = false;
				}
			}
			else
			{
				$result = false;
			}
			return $result;
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
	
	private function getAdminName($randkey)
	{
		$connec = $this->dbcon;
		$tb = $this->tb;
		$sql = "select `name` from `$tb` where `randkey` = '$randkey'";
			if($sqldo = $connec->query($sql))
			{
				if($sqldo->num_rows == 1)
				{
					$sqlget = $sqldo->fetch_assoc();
						$output = $sqlget["name"];
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