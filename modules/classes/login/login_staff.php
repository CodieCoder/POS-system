<?Php
//this is the  login class for staff..;.
class staffLogin
{
	private $dbcon;
	private $tb;
	public $err_msg;
	public $err;
	public  $output;
	public  $lock;
	public  $level;
	
	public function __construct($con, $tb, $lock, $level)
	{
		//set vairables
		$this->err_msg = "Err[LS 001]";//. Error initializing module.";
		$this->err = true;
		// $this->output = "No process found.";
		//create a database connection
		 $this->dbcon = $con;
		 $this->tb = $tb;
		$this->lock = $lock;
		$this->level = $level;
	}
	
	
	public function loginRequest($uname, $pw, $uf, $pf, $name, $token)
	{
		$connec = $this->dbcon;
		$tb = $this->tb;
		$lock = $this->lock;
		$level = $this->level;
		$err = "true";
		$output = "";
		// $output = "Login not performed properly.";
		$err_msg = "Err[LS 01-001]";//Login not performed properly.";

		//cleaning
		$uname = $connec->real_escape_string($uname);
		$pw = $connec->real_escape_string($pw);
		$pf = $connec->real_escape_string($pf);
		$uf = $connec->real_escape_string($uf);
		$name = $connec->real_escape_string($name);
			//if na password the pesin wan try collect....change am for am...
			$name = $this->checkPass($name, $uf);
			
		$token = $connec->real_escape_string($token);
			// if na password the pesin wan try collect....change am for am...
			$token = $this->checkPass($token, $uf);
			
		
		//check if the credentials are valid....that's if the user actually exits with the given credentials
		$sql = "select `$uf`, `$name`, `$lock`, `$level`  from $tb where `$uf` = '$uname' AND `$pf`  = '$pw'";
		// $sql = "select `$uf` $tb where `$uf` = '$uname' AND `$pf`  = '$pw'";
		//query
		if($sqlDo = $connec->query($sql))
		{
			if($sqlDo->num_rows == 1)
			{
				// $err_msg = "";
				$output = $this->getUserDetails($sqlDo, $name);
				$erzr = $this->eraseFormerTmp($connec, $uname,$pw);
				$token_put = $this->setToken($connec, $tb, $token, $uf, $uname, $pf, $pw);
				if($token_put !== false)
				{
					if($output !== FALSE)
					{	//getting fields content...
							$sqlHandle = $sqlDo->fetch_assoc();

							$lockcheck = $sqlHandle['$lock'] ;
							$level_check = $sqlHandle['$level'] ;
							if($lockcheck == 0)
							{
								if($level_check == 0)
								{
									//everything worked..that is print out user data
									$err = false;
									$err_msg = "";
									$output = ["success"=>"Success", "name"=>"$output", "userkey"=>"$token_put", "level"=>"0"];
								
								}
								else if($level_check == 1)
								{
									//everything worked..that is print out user data
									$err = false;
									$err_msg = "";
									$output = ["success"=>"Success", "name"=>"$output", "userkey"=>"$token_put", "level"=>"1"];
								}
								else
								{
									//everything worked..that is print out user data
									$err = false;
									$err_msg = "";
									$output = ["success"=>"Success", "name"=>"$output", "userkey"=>"$token_put", "level"=>"error"];
								}
								
							}
							else
							{
								// $err_msg = $err_msg = "Err[LS 01-006]" . $sqlHandle;
								$err_msg = $err_msg = "Err[LS 01-006]";
							}
							
					}
					else
					{
						$err_msg = "Err[LS 01-005]";//Error retrieving user's data.
					}
				}
				else
				{
					$err_msg = "Err[LS 01-004]";//couldn't get  token.
				}
				
			}
			else
			{
				$err_msg = "Err[LS 01-003]";//Oops! No such user found.
			}
		}
		else
		{
			$err_msg = "Err[LS 01-002]";//Couldn't perform operation. Please try again.
		}
		//close db connection;
		$connec->close();
		
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	}
	
	//method for verification of token
	public function verifierRequest($rkey, $username, $fkey, $fuser)
	{
		$connec = $this->dbcon;
		$tb = $this->tb;
		$lock = $this->lock;
		$level = $this->level;
		$err = true;
		$output = "Err[LR 01-001]";
		// $output = "Login not performed properly.";
		$err_msg = "Err[LR 01-001]";//Verification not performed properly.";
	
		//cleaning
		$rkey = $connec->real_escape_string($rkey);
		$uname = $connec->real_escape_string($username);
		$uf = $connec->real_escape_string($fuser);
			//if na password the pesin wan try collect....change am for am...
			$uf = $this->checkPass($uf, $username);
			
		$fkey = $connec->real_escape_string($fkey);
			// if na password the pesin wan try collect....change am for am...
			$fkey = $this->checkPass($fkey, $username);
			
		
		//check if the credentials are valid....that's if the user actually exits with the given credentials
		$sql = "select `$fkey`, `$lock`, `$level` from $tb where `$fkey` = '$rkey' AND `$uf`  = '$uname'";// $sql = "select `$uf` $tb where `$uf` = '$uname' AND `$pf`  = '$pw'";
		//query
		if($sqlDo = $connec->query($sql))
		{
			if($sqlDo->num_rows == 1)
			{
				
					if($sqlHandle = $sqlDo->fetch_assoc())
					{
						//getting fields content...
						if($sqlHandle["$lock"] == 0)
						{
							$level = $sqlHandle["$level"];
							$err_msg = "";
							$err = false;
							$output = "$level";
						}
						else
						{
							$err_msg = "Err[LS 01-006]";
						}
						
					}
					else
					{
						$err_msg = "Err[LS 01-005]";
					}
			}
			else
			{
				$output = "Err[LR 01-002]";
				$err_msg = "Err[LR 01-002]";//Invalid Verification key.";
			}
			
		}	
		//close db connection;
		$connec->close();
		
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
			
	}
	
	public function verifierRequestMini($idkey, $token)
	{
		$connec = $this->dbcon;
		$tb = $this->tb;
		$lock = $this->lock;
		$level = $this->level;
		$err = true;
		$output = "Err[LRm 01-001]";
		// $output = "Login not performed properly.";
		$err_msg = "Err[LRm 01-001]";//Verification not performed properly.";
	
		//cleaning
		$rkey = $connec->real_escape_string($idkey);
			
		$token = $connec->real_escape_string($token);
			// if na password the pesin wan try collect....change am for am...
			$token = $this->checkPass($token, "token_1");
			
			$level = $connec->real_escape_string($level);
			// if na password the pesin wan try collect....change am for am...
			$level = $this->checkPass($level, "level");
			
			$lock = $connec->real_escape_string($lock);
			// if na password the pesin wan try collect....change am for am...
			$lock = $this->checkPass($lock, "lockr");
			
		
		//check if the credentials are valid....that's if the user actually exits with the given credentials
		$sql = "select `$lock`, `$level` from $tb where `$token` = '$idkey'";// $sql = "select `$uf` $tb where `$uf` = '$uname' AND `$pf`  = '$pw'";
		//query
		if($sqlDo = $connec->query($sql))
		{
			if($sqlDo->num_rows == 1)
			{
				
					if($sqlHandle = $sqlDo->fetch_assoc())
					{
						//getting fields content...
						if($sqlHandle["$lock"] == 0)
						{
							$level = $sqlHandle["$level"];
							$err_msg = "";
							$err = false;
							$output = "$level";
						}
						else
						{
							$err_msg = "Err[LRm 01-006]";//Account locked
						}
						
					}
					else
					{
						$err_msg = "Err[LRmS 01-005]";
					}
			}
			else
			{
				$output = "Err[LRm 01-002]";
				$err_msg = "Err[LRm 01-002]";//Invalid Verification key.";
			}
			
		}	
		//close db connection;
		$connec->close();
		
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
			
	}
	
	
	
	private function getUserDetails($sqlHandle, $name)
	{
		if($sqlHandle = $sqlHandle->fetch_assoc())
		{
			//getting fields content...
			$sqlHandle = $sqlHandle["$name"];
			return  $sqlHandle;
			exit;
		}
		else
		{
			return FALSE;
		}
	}
	
	
	private function eraseFormerTmp($con, $user, $pass)
	{
		$tb = "zpm_tmp_sales";
		// $doer = "jdskjdskjd";
			$sqql2 = "select `token_1` from `zpm_staffs` where `username` = '$user' AND `password` = '$pass'";
		if($sqql2 = $con->query($sqql2))
		{
			$sqlHandle = $sqql2->fetch_assoc();
				//getting field content...
				$doer = $sqlHandle["token_1"];
				
				$sqql = "delete from `$tb` where `user_add` = '$doer'";
				if($sqql = $con->query($sqql))
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
			return FALSE;
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
	
	private function setToken($connec, $tb, $tf, $uf, $un, $pf, $pw)
	{
		//generating token...random alphanumeric key
			$token_now = $this->getRandKey(33, $tb, $connec, $tf );
				if($token_now !== false)
				{
					$sql = "update `$tb` set `$tf` = '$token_now' where `$uf` = '$un' AND `$pf`  = '$pw'";
					//query
					if($sqlDo = $connec->query($sql))
					{
						$returned = $token_now;
					}
					else
					{
						$token_now = false;
					}
				}
				else
				{
					$token_now = false;
				}
		
		return $token_now;
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