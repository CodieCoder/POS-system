<?php
//connectionz
require('config.php');
$con = new mysqli($s, $u, $p, $db);
if($con->connect_error)
{
	// echo "Please there was an error connecting to the server. Click here to try again </a>";
	//echo "Go back to. <a href = ../index.php'> home </a>";
	// exit;	$dbcon = false;
}else{	$dbcon = $con;}
?>