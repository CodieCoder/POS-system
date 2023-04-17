<?php
session_start();	
	$skey = $_SESSION["idkey"];
	$page_code = "0";
	$pagename = "Admin";
	require("../../../templates/requirez.php");
	// require("$absoute_path/templates/requirez.php");
	require("../../../templates/language.php");
	require("../../scripts/check_user_across_pages.php");

?>
<html>
	<head>
		<title>
			New Transaction
		</title>
		<link rel = "stylesheet" href = "../css/newtransaction.css"/>
		<link rel = "stylesheet" href = "../css/add_stock.css"/>
		<link rel = "stylesheet" href = "../css/view_print.css"/>
		<script rel = "javascript" src = "../../../js/jquery.js"></script>
	</head>
<body>
	<div id = "nt_body">
		<div id= "nt_body_hd">
			View | Print Cart
		</div>
		<div id = "add_stock_div">
			<div id = "back_btn_div">
				<span id = "back_btn">
					<img src = "../../../iconz/back.png" align = "left"/>
				</span>
				<span id = "back_btn_txt">
					Back
				</span>
			</div>
			<div id = "add_stock_form">
				
				<div id = "a_s_selected">
					<div id = "as_qty_txt">
						<span class = "as_form_talk">
							Selected Stock | Details
						</span><br/>
						
							<div id = "as_product_loader_selected"></div>
					</div>
				</div>
				
				
				<div id = "a_s_submit">
					<div id = "as_submit_txt">
						<button id = "as_print_btn" title = "When you Add transfer/Print receipt the transfer is added to database">
							<img src = "../../../iconz/document.png" class = "as_form_iconz" align = "left"/>Add Transfer/ Receipt
						</button>
					</div>
				</div>
				<div id = 'err_msg'></div>
			</div>
		</div>
	</div>
<script>	
	$(document).ready(function()
	{
		
		getCart_fn();
		
		$("#back_btn_div").click(function()
		{
			window.history.back();
		});
		
	});
	
	
		function getCart_fn()
		{
			var dikey = "<?php echo $skey;?>";
			var uurl  = "index.php";
			
			$.post(uurl,{sales_key:dikey},function()
				{
					
				})
				.done(function(data)
				{
					// alert(data);
					$("#as_product_loader_selected").html(data);
					$("#a_s_selected").fadeIn();
					// $(".cart_items_hidden").slideDown();
	
				})
				.fail(function()
				{
					
				})
			
		}
		
		function showCartItems_fn(div)
		{
			// alert(div);
			$(".cart_items_hidden").not($("#" + div + "_cart_div .cart_items_hidden")).slideUp();
			// $("#" + div + "_cart_div .cart_items_hidden").slideToggle();
			$("#" + div + "_cart_div .cart_items_hidden").slideToggle();
		}
		
		function deleteCart_fn(div)
		{
			$("#" + div + "_cart_div .cart_items_hidden").slideDown();
			$("#" + div + "_delete_div").slideToggle("fast");
			$("#" + div + "_cart_div .cart_prod_delete_itms").css("background-color", "#900");
		}
		
		function closeDelete_fn(div)
		{
			$("#" + div + "_cart_div .cart_items_hidden").slideDown();
			$("#" + div + "_delete_div").slideToggle("fast");
			$("#" + div + "_cart_div .cart_prod_delete_itms").css("background-color", "#2af");
		}
		
		function yesDelete_fn(div, carty)
		{
			$("#" + div + "_cart_div").html("Loading...");
			$("#" + div + "_cart_div").css("background", "#aaa");
			$("#" + div + "_cart_div").css("color", "#777");
			$("#" + div + "_cart_div").css("box-shadow", "inset 0px 0px 10px #000");
			
			var giurl = "delete_cart.php";
				$.post(giurl, {cartyz:carty}, function()
				{
				})
				.done(function(data)
				{
					$("#a_s_selected").fadeOut();
					getCart_fn();
				})
				.fail(function()
				{
					getCart_fn();
				})
		}
		
		$("#as_print_btn").click(function()
		{
			goPrint_fn();
		});
		
		function goPrint_fn()
		{
			addsales_fn();
		}
		
		function addsales_fn()
		{
			var cart_key = "<?php echo $skey?>";
			var urli = "makeSales.php";
				$.post(urli, {coms:'go', keyer:cart_key}, function()
				{
					
				})
				.done(function(data)
				{
					// alert(data);
						var jsondata = JSON.parse(data);
						var data_chk = jsondata["1"];
						var data_linkref = jsondata["2"];
						if(data_chk == "Yes")
						{
							// alert(data_linkref);
							window.location = "print_.php?idkey=" + cart_key + "&print=yes&&datalink=" + data_linkref + "&&done=print";
						}
						else
						{
							alert(data_linkref);
							$("#err_msg").html(data_linkref);
						}
						
				})
				.fail(function()
				{
					
				})
		}
		
</script>	
</body>	
</html>