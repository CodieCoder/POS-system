<?php
session_start();
error_reporting(E_ALL);

if(isset($_GET["?idkey"]) && isset($_GET["user"]) && isset($_GET["get"]))
{
	$url = "dashboard.php?idkey=" . $_GET["?idkey"] . "&&user=" . $_GET["user"] . "&&get=" . $_GET["get"];
		header("location:$url");
}
else
{
	print_r($_GET);
	exit;
	header("location:../index.php");
}
?>
