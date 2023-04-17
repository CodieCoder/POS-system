<?php

	//this is the  details class for staff..;.
class details_staff
{
	private $dbcon;
	private $tb;
	public $err_msg;
	public $err;
	public  $output;
	public  $level;
	
	public function __construct($con, $tb, $level)
	{
		//set vairables
		$this->err_msg = "Err[D 001]";//. Error initializing module.";
		$this->err = true;
		// $this->output = "No process found.";
		//create a database connection
		 $this->dbcon = $con;
		 $this->tb = $tb;
		$this->level = $level;
	}
	
	public function admin_details($nowkey, $nf)
	{
		$connec = $this->dbcon;
		$tb = $this->tb;
		$level = $this->level;
		$err = true;
		$output = "no";
		// $output = "Login not performed properly.";
		$err_msg = "Err[D 01-001]";//Login not performed properly.";
		
		//cleaning
		$nowkey = $connec->real_escape_string($nowkey);
		
		$nf = $connec->real_escape_string($nf);
			// if na password the pesin wan try collect....change am for am...
			$nf = $this->checkPass($nf);	//if na password the pesin wan try collect....change am for am...
			
		$output = array();
			// $output["success"] = "success";
		$sql = "select `username`, `randkey`, `name`,`email`,`phone`,`address`,`sex`,`dateOfReg`,`lastLogin`,`lockr`,`level`,`profile_pic` from `$tb` where `$nf` = '$nowkey'";
			if($sqldo = $connec->query($sql))
			{
				if($sqldo->num_rows == 1)
				{
					$sqlget = $sqldo->fetch_assoc();
						$output = $sqlget;
				}
				else
				{
					$err_msg = "Err[D 01-003]";//No such user
					$output = "no2";
				}
			}
			else
			{
				$er_msg = "Err[D 01-002]";//No such user;
					$output = "no2".$connec->error;
			}
			
		// $connec->close();
		
		$this->err = $err;
		$this->err_msg = $err_msg;
		$this->output = $output;
	}
	
	private function checkPass($data)
	{
		if($data == "password" || $data == "pwd" || $data == "pw" || $data == "passkey" || $data == "")
		{
			$data = "token_1";
		}
		else
		{
			
		}
		return $data;
	}
}
	
?>