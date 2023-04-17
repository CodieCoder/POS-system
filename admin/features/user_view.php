<?php
session_start();	
	$skey = $_SESSION["idkey"];
	$page_code = "0";
	$pagename = "Admin";
	require("../../templates/requirez.php");
	// require("$absoute_path/templates/requirez.php");
	require("../../templates/language.php");
	require("../scripts/check_user_across_pages.php");

?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			User : Add
		</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
		<meta http-equiv="EXPIRES" content="0">
		<meta http-equiv="pragma" content="no-cache">
		
		<link rel = "stylesheet" href = "css/new_user.css">
		<link rel = "stylesheet" href = "css/view_user.css">
		
		<script rel = "javascript" src = "../../js/jquery.js"></script>
	</head>
<body>
	<div id = "usrbody">
		<div id = "usrbody_hd">
			View Staffs
		</div>
		
		<div id = "usr_div">
			
		</div>
	</div>
	<script>
		$(document).ready(function()
		{
			getUserz_fn();
			function getUserz_fn()
			{
				var gourl = "viewz/user_view.php";
				$.post(gourl, {commandd:"get_all", keyr:"<?php echo $skey;?>"}, function()
					{
						
					})
					.done(function(data)
					{
						$("#usr_div").html(data);
						detailsUp();
					})
					.fail(function()
					{
						$("#usr_div").html("Could not connect to server.");	
					})
			}
			
		function detailsUp()
		{
			// alert();
			$(".cat_prod_itms_values").slideUp("slow");
		}
		});
		
		
			
		function user_click(div)
		{
			// alert();
			$("#" + div + "_div").children(".cat_prod_itms_values").slideToggle();
		}
		
		
	</script>
</body>
</html>