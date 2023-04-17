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
			View Stock
		</title>
		<link rel = "stylesheet" href = "css/add_stock.css"/>
		<link rel = "stylesheet" href = "css/view_stock.css"/>
		<script rel = "javascript" src = "../../js/jquery.js"></script>
	</head>
<body>
	<div id = "nt_body">
		<div id= "nt_body_hd">
			View Stocks
		</div>
		<div id = "add_stock_div">
			<div class = "info_talk" id = "info_talk_hd">
				Get Detailed Information about stock.
			</div>
			<div id = "add_stock_form">
				
				<div id = "v_s_categoriez" class = "v_s_c_div">
					<div class = "view_secz_hdz">
						Stock summary
					</div>
					<div class = "view_secz_loaderz">
						<div class = "view_secz_loaderz_tp" title = "Total categories in the database">Total Categories: </div>
						<div id = "vs_stock_summary_1a" class = "view_secz_loaderz_data">Loading...</div>
					</div>
					<div class = "view_secz_loaderz">
						<div class = "view_secz_loaderz_tp" title = "Total amount of products stored in the database">Total Products: </div>
						<div id = "vs_stock_summary_1b" class = "view_secz_loaderz_data">Loading...</div>
					</div>
					<div class = "view_secz_loaderz">
						<div class = "view_secz_loaderz_tp" title = "The amount of products that was stored in the database during the last stock add">Initial Quantities: </div>
						<div id = "vs_stock_summary_1d" class = "view_secz_loaderz_data">Loading...</div>
					</div>
					<div class = "view_secz_loaderz">
						<div class = "view_secz_loaderz_tp" title = "The amount of products remaining from the database after making transfers from the Initial Stocks">Remaining Quantities: </div>
						<div id = "vs_stock_summary_1c" class = "view_secz_loaderz_data">Loading...</div>
					</div>
					<div class = "view_secz_loaderz">
						<div class = "view_secz_loaderz_tp" title = "The total amount of successful transfers done in this software">Total Transfer: </div>
						<div id = "vs_stock_summary_1e" class = "view_secz_loaderz_data">Loading...</div>
					</div>
					<div class = "view_secz_loaderz">
						<div class = "view_secz_loaderz_tp" title = "Total transfers done today">Today Transfer: </div>
						<div id = "vs_stock_summary_1f" class = "view_secz_loaderz_data">Loading...</div>
					</div>
				</div>
				
				<br/>
				
				
				<div id = "v_s_categoriez" class = "v_s_c_div">
					<div class = "view_secz_hdz">
						Categories summary
					</div>
					<div class = "view_secz_left">
						<div class = "view_secz_catz_hd">Categories select</div>
						<select class = "v_s_c_loader" id = "v_s_c_select" onChange = getPrd_fn()>
							<option value = "NULL">Loading category</option>
						</select>
					</div>
					<div class = "view_secz_left">
						<div class = "view_secz_catz_hd">Product select</div>
						<select class = "v_s_p_loader" id = "v_s_p_select">
							
						</div>
					</div>
					<div class = "view_secz_detailz">
						<div class = "view_secz_catz_hd">Product details</div>
						<div class = "v_s_d_loader"></div>
					</div>
				</div>
			</div>
				
		</div>
		
	</div>
	
<script>
	$(document).ready(function()
	{
		getStockSummary("cat_num", "vs_stock_summary_1a");
		getStockSummary("prdt_num", "vs_stock_summary_1b");
		getStockSummary("qty_num", "vs_stock_summary_1c");
		getStockSummary("init_qty_num", "vs_stock_summary_1d");
		getStockSummary("all_sales", "vs_stock_summary_1e");
		getStockSummary("today_sales", "vs_stock_summary_1f");
		
		getCat_fn("cat_get", "v_s_c_select");
		
		
		function getStockSummary(commd, div)
		{
			var giurl = "viewz/stock_summary.php";
			
			$.post(giurl, {commandd:commd}, function()
				{
					$("#" + div).html("Connecting");
				})
				.done(function(data)
				{
					$("#" + div).html(data);
				})
				.fail(function()
				{
					$("#" + div).html("Could not connect. Check connection.");
				})
		}

		function getCat_fn(commd, div)
		{
			var giurl = "viewz/product_summary.php";
			
			$.post(giurl, {commandd:commd}, function()
				{
					$("#" + div).html("Connecting");
				})
				.done(function(data)
				{
					$("#" + div).append(data);
				getPrd_fn();
				})
				.fail(function()
				{
					alert("Could not connect. Check connection.");
					$("#" + div).html("Could not connect. Check connection.");
				})
				
		}
		
		
	});
		function getPrd_fn()
		{
			var giurl = "viewz/product_summary.php";
			var selectd = $("#v_s_c_select").val();
					// alert(selectd);
			$.post(giurl, {commandd:"get_prd", dataz:selectd}, function()
				{
					$("#v_s_p_select").html("Connecting");
				})
				.done(function(data)
				{
					$("#v_s_p_select").html(data);
				})
				.fail(function()
				{
					$("#v_s_p_select").html("Could not connect. Check connection.");
				})
		}
</script>	
</body>	
</html>