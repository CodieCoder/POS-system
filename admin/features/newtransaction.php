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
<html>
	<head>
		<title>
			New Transaction
		</title>
		<link rel = "stylesheet" href = "css/newtransaction.css"/>
		<link rel = "stylesheet" href = "css/add_stock.css"/>
		<script rel = "javascript" src = "../../js/jquery.js"></script>
	</head>
<body>
	<div id = "nt_body">
		<div id= "nt_body_hd">
			Transfer Stocks
		</div>
		
		<div id = "nt_body_hr_menu">
			<div class = "nt_body_hr_menuz" title = "Start a fresh transfer">
				Start new transfer
			</div>
			<div class = "nt_body_hr_menuz" title = "Resume ongoing transfer">
				Resume transfer
			</div>
			<div class = "nt_body_hr_menuz" title = "View last transfer">
				Last transfer
			</div>
		</div>
		<br/>
		<br/>
		<div id = "add_stock_div">
			<div class = "info_talk" id = "info_talk_hd">
				New Transaction : Transfer Stock.
			</div>
			<div id = "add_stock_form">
				<div id = "a_s_recipient">
					<span class = "as_form_talk">
						Stock Destination
					</span>
					<br/>
					<select id = "as_destination_select">
						
					</select>
					<br>
					<br>
					<div id = "as_d_details">
						<span class = "as_form_talk">
						Name 
					</span>
						<input type = "text" name = "dest_name" id = "desti_name" class = "as_form_inputz" />
						<br/>
						<br/>
					<span class = "as_form_talk">
						Phone
					</span>
						<input type = "text" name = "dest_phone" id = "desti_phone" class = "as_form_inputz" />
					</div>
				</div>
				<div id = "a_s_category">
					<div id = "as_old_cat">
						<span class = "as_form_talk">
							Select product category
						</span>
						<br/>
						<select id = "as_cat_select" onchange = "catLabel_fn()">
						</select>
						<span class = "input_chk_loading"><img src = "../../iconz/loading.gif"  class = "as_form_iconz"/></span>
					</div>
					
					
				</div>
				<div id = "a_s_prduct">
						<div id = "as_products_txt">
							<span class = "as_form_talk">
								Search Product
							</span><br/>
							<span id = "as_product_search">
								<input type = "text" id = "as_product_search_data" class = "as_form_inputz" name = "as_product_search_data"/>
							</span>
						</div>
						<br/>
						<div id = "as_product_loader">
							<div id = "as_product_loader_hd"></div>
							<div id = "as_product_loader_data"></div>
						</div>
						</div>
				<div id = "a_s_qty">
					<div id = "as_qty_txt">
						<span class = "as_form_talk" style = "clear:both;">
							Quantity
							<br/><span id = "as_form_talk_details"></span>
						</span>
						<br/>
						<br/>
						<div id = "as_s_qty_input">
							<input type = "number"  id = "hidden_price_input"   value = "" hidden/>
							<input type = "text"  id = "hidden_prod_input"   value = "" hidden/>
							<input type = "number" class = "as_form_inputz" id = "as_qty_input"   value = "0" maxlength = "8"style = "clear:both;" onkeyUp = "qtyCal_fn()"/>
							<span id = "total_qty" class = "as_form_talk">Total: <span id = "total_qty_details" class = "as_form_talk"></span></span>
							<br/>
							<br/>
							<span class = "qty_btn">
							<button id = "as_qty_btn" title = "Add this item to cart">
								<img src = "../../iconz/cart.png" class = "as_form_iconz" align = "left"/>Add to cart
							</button></span>
						</div>
					</div>
				</div>
				
				<div id = "a_s_selected">
					<div id = "as_qty_txt">
						<span class = "as_form_talk">
							Selected Stock | Details
						</span><br/>
						
						
							<div class = "as_form_talk" id = "clean_cart_btn" title = "Remove everything from the current cart">
							Clean cart
						</div><br/>
							<div id = "as_product_loader_selected"></div>
							<br/>
					</div>
				</div>
				<br/>
				<br/>
				<div id = "a_s_submit">
					<div id = "as_submit_txt">
						<button id = "as_form_btn">
							<img src = "../../iconz/cart.png" class = "as_form_iconz" align = "left"/>View Cart/Print
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>	
	$(document).ready(function()
	{
		catGet_fn();
		
		$("#a_s_qty").hide();
		$("#a_s_selected").hide();
		
		
		
		function catGet_fn()
		{
			
			
			var gourl = "cat/category_select.php";
			usrkey = "<?php echo $skey;?>";
			$.post(gourl, {userid:usrkey}, function()
			{
				$("#as_old_cat .input_chk_loading").show();
			})
				.done(function(data)
				{
					// alert(data);
					$("#as_old_cat .input_chk_loading").hide();
					$("#as_cat_select").html("<option value = 'x' selected>Select Category</option>"+ data);
				})
				.fail(function()
				{
					$("#as_old_cat .input_chk_loading").attr("src", "../../iconz/error.png");
				})
				
				catItems_fn();
		}
		
		blockGet_fn();
		function blockGet_fn()
		{
			
			
			var gourl = "users/block_select.php";
			usrkey = "<?php echo $skey;?>";
			$.post(gourl, {userid:usrkey}, function()
			{
				// $("#as_old_cat .input_chk_loading").show();
			})
				.done(function(data)
				{
					// alert(data);
					// $("#as_old_cat .input_chk_loading").hide();
					$("#as_destination_select").html("<option value = 'x' selected>Select Block</option>"+ data);
				})
				.fail(function()
				{
					// $("#as_destination_select .input_chk_loading").attr("src", "../../iconz/error.png");
				})
				
				catItems_fn();
		}
		
		
		
	});
	
	catLabel_fn();
	function catLabel_fn()
		{
			var cati = $("#as_cat_select option:selected").text();
				$("#as_product_loader_hd").html("Choose item from <b><i>[" + cati + "]</i></b>");
				catItems_fn();
		}
		
		function catItems_fn()
		{
			
			$("#a_s_qty").hide();
			var gourl = "cat/product_get.php";
			var cat_dataz  = $("#as_cat_select").val();
			// alert(cat_dataz);
			$.post(gourl, {cat_sel:cat_dataz}, function()
			{
				$("#a_s_prduct .input_chk_loading").show();
			})
				.done(function(data)
				{
					// alert(data);
					$("#as_product_loader_data").html(data);
				})
				.fail(function()
				{
					$("#as_product_loader_data").html("Could not connect to server. Please check your connection");
				})
		}
		
		function product_select(div)
		{
			var pr_name = $("#"+div + "_div").attr("title");
			
			
			$(".cat_prod_itms").css("box-shadow", "");
			$(".cat_prod_itms").css("border", "");
			$("#"+div + "_div").css("box-shadow", "inset 0px 0px 10px #000");
			$("#"+div + "_div").css("border", "3px solid #2af");
			
			var pr_key = $("#"+div + "_key").val();
			var price = $("#"+div + "_price").val();
			var qty = $("#"+div + "_qty").val();
			
			// alert(div);
			
			$("#a_s_qty").show();
			// alert(pr_key);
			$("#hidden_prod_input").val(pr_key);
			$("#hidden_price_input").val(price);
			$("#total_qty_details").html("");
			qtyCal_fn();
			$("#as_form_talk_details").html("<div class = 'cat_prod_itms_sel'>" + pr_name + "</div>[Price:<font size = '1'>=N=</font>" + price + " Quantity left:" + qty + "]<input type = 'number' value = '" + qty + "' id = 'retrived_qty' hidden/>");
			
			$("#as_qty_input").val("");
			$("#as_qty_input").focus();
		}
		
		function qtyCal_fn()
		{
			var price = parseInt($("#hidden_price_input").val());
			var qty = parseInt($("#as_qty_input").val());
			$("#as_qty_input").val(qty);
				var qtotal = price * qty;
		var qty_text = "[ " + price + " + " + qty + " ] = " + qtotal ;
				// alert(qty_text);
				$("#total_qty_details").html(qty_text)
		}
		
		$("#as_qty_btn").click(function()
		{
			addToCart_fn();
		})
		

		function formChk_fn()
		{
				chk_q = "1";
				chk_pi = "1";
			var chk_qty = $("#as_qty_input").val();
			var chk_init_qty = $("#retrived_qty").val();
			if(parseInt(chk_qty) < 1 || (chk_qty).length < 1)
			{
				chk_q = "0";
				$("#as_qty_input").prop("placeholder",   "Invalid Price");
				$("#as_qty_input").css("border",   "2px solid #d00");
			}
			if(parseInt(chk_qty) > parseInt(chk_init_qty))
			{
				chk_pi = "0";
				$("#as_price_input").prop("placeholder",   "Invalid Price");
				$("#as_price_input").css("border",   "2px solid #d00");
				alert("Not enough quantity left");
			}
			if(chk_q == "0" || chk_pi == "0")
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		function addToCart_fn()
		{
			var chkr = formChk_fn();
			if(!chkr)
			{
				alert("Invalid transfer. Please check your transfer details and try agian.");
			}
			else
			{
				
				usrkey = "<?php echo $skey;?>";
				var blck = $("#as_destination_select").val();
				var blck_name = $("#desti_name").val();
				var blck_phone = $("#desti_phone").val();
				var cat = $("#as_cat_select").val();
				var price = parseInt($("#hidden_price_input").val());
				var prod = $("#hidden_prod_input").val();
				var qty = parseInt($("#as_qty_input").val());
				// alert(prod);
				var  gourli = "engines/transfer_stock.php";
				$.post(gourli, {blockr:blck, b_name:blck_name, b_phone:blck_phone, catz:cat, pricez:price, prodz:prod, qtyz:qty, userd:usrkey}, function()
					{
						
					})
					.done(function(data)
					{
						if(data == "Yes")
						{
							alert("Stock added to Cart"); 
							getCart_fn(usrkey);
						}
						else
						{
							alert(data);
						}
					})
					.fail(function()
					{
						alert("An error occurred!");
					})
			}
		}
		
		
		getCart_fn();
		
		function getCart_fn()
		{
			var dikey = "<?php echo $skey;?>";
			var uurl  = "cart/index.php";
			
			$.post(uurl,{sales_key:dikey},function()
				{
					
				})
				.done(function(data)
				{
					// alert(data);
					$("#as_product_loader_selected").html(data);
					$("#a_s_selected").fadeIn();
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
			// alert("");
			$("#" + div + "_cart_div").html("Loading...");
			$("#" + div + "_cart_div").css("background", "#aaa");
			$("#" + div + "_cart_div").css("color", "#777");
			$("#" + div + "_cart_div").css("box-shadow", "inset 0px 0px 10px #000");
			
			var giurl = "cart/delete_cart.php";
				$.post(giurl, {cartyz:carty}, function()
				{
					// alert();
					
				})
				.done(function(data)
				{
					// alert(data);
					$("#a_s_selected").fadeOut	();
					getCart_fn();
				})
				.fail(function()
				{
					getCart_fn();
				})
		}
		
		$("#as_form_btn").click(function()
		{
			view_printCart_fn()
		});
		function view_printCart_fn()
		{
			var skey =  "<?php echo $skey;?>";
			window.location = "cart/view_print.php?idkey=" + skey + "&&action=view_print";
		}
</script>	
</body>	
</html>