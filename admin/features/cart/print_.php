<?php
session_start();	
if(!isset($_GET["datalink"]))
{
	// print_r($_SERVER);
	echo "Invalid access.";
	exit;
}
else
{
	// echo "Yes";
	// echo $_GET["datalink"];
}
	$skey = $_SESSION["idkey"];
	$page_code = "0";
	$pagename = "Admin";
	require("../../../templates/requirez.php");
	// require("$absoute_path/templates/requirez.php");
	require("../../../templates/language.php");
	require("../../scripts/check_user_across_pages.php");
	require("print_page.php");

?>
<html>
	<head>
		<title>
				<?php echo $company_name;?>
		</title>
		<link rel = "stylesheet" href = "../css/print_.css"/>
		<script rel = "javascript" src = "../../../js/jquery.js"></script>
	</head>
<body>
<font face = "cambria">
	<div id = "nt_body">
		<div id = "back_btn_div">
				<span id = "back_btn">
					<img src = "../../../iconz/back.png" align = "left"/>
				</span>
				<span id = "back_btn_txt">
					Back
				</span>
		</div>
		<br/>
		<br/>
		<div id= "nt_body_hd">
		
		
		<?php echo $company_name;?>
			<br>
			<div id = 'sales_re'> Sales Receipt</div>
			<div id = 'sales_add'> Address:19 Marba Road, Maraba, Abuja</div>
			<div id = 'sales_phon'> Phone: 07033918932</div>
			<div id = 'sales_email'> Email: nnalue.nonso@gmail.com</div>
			<br>
		</div>
		<div id = "receipt_no"><b>Receipt no.:</b> <?php echo $receipt_no;?></div>
		<br/>
		<div id = "recipient_details">
				<?php echo $block_details;?>
		</div>
		<div id = "print_this">
			
			<table border = "0">
				<?php echo $dataz;?>
				<tr>
					<td>
						Total :
					</td>
					<td>
						<font size = '1'>=N=</font><b><?php echo number_format($totalSalez);?></b>
					</td>
				</tr>
			</table>	
		</div>
		<div id = "print_btn">
			<button id = "do_print">Print</button>
		</div>
	</div>
<script>	
	$(document).ready(function()
	{
		$("#back_btn_div").click(function()
		{
			window.history.back();
		});
		
		$("#do_print").click(function()
		{
			doPrint_fn();
		});
		
		function doPrint_fn()
		{
			window.print();
		}
	});
	
</script>	
</body>	
</html>