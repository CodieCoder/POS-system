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
			Add Stock
		</title>
		<link rel = "stylesheet" href = "css/add_stock.css"/>
		<script rel = "javascript" src = "../../js/jquery.js"></script>
	</head>
<body>
	<div id = "nt_body">
		<div id= "nt_body_hd">
			Add Stocks
		</div>
		<div id = "add_stock_div">
			<div class = "info_talk" id = "info_talk_hd">
				Update stock into database. Old and new supplies.
			</div>
			<div id = "add_stock_form">
				<div id = "a_s_category">
					<div id = "as_old_cat">
						<span class = "as_form_talk">
							Select an existing category
						</span>
						<br/>
						<select id = "as_cat_select">
						</select>
						<span class = "input_chk_loading"><img src = "../../iconz/loading.gif"  class = "as_form_iconz"/></span>
					</div>
					<div id = "as_new_cat">
						<div id = "as_new_cat_put">
							<span class = "as_form_talk">
								Create a new category
							</span><br/>
							<span id = "as_new_cat_input">
								<input type = "text" id = "as_new_cat_input_f" class = "as_form_inputz" maxlength = "34" />
							</span>
						</div>
						<div id = "as_new_cat_save">
							<button id = "as_new_cat_btn">
								<img src = "../../iconz/memorycard.png" class = "as_form_iconz" align = "left">Save category
							</button>
					</div>
					</div>
					
					
				</div>
				<div id = "a_s_prduct">
						<div id = "as_products_txt">
							<span class = "as_form_talk">
								Product name
							</span><br/>
						</div>
						<input type = "text" name = "as_product_input" class = "as_form_inputz" id = "as_product_input" />
						<span class = "input_chk_loading"><img src = "../../iconz/loading.gif"  class = "as_form_iconz"/></span>
						<span class = "input_chk_loading" id = "sec_loading"><img src = "../../iconz/good_2.png"  class = "as_form_iconz" id = "as_product_good"/></span>
						<span id = "product_msg" class = "as_form_msg"></span>
						</div>
				<div id = "a_s_qty">
					<div id = "as_qty_txt">
						<span class = "as_form_talk">
							Quantity
						</span><br/>
						<input type = "number" class = "as_form_inputz" id = "as_qty_input"   value = "0" maxlength = "8"/>
						<span class = "input_chk_loading"><img src = "../../iconz/loading.gif"  class = "as_form_iconz"/></span>
					</div>
				</div>
				<div id = "a_s_price">
					<div id = "as_price_txt">
						<span class = "as_form_talk">
							Price <font size = "1">(=N=)</font>
						</span><br/>
						<input type = "number" class = "as_form_inputz" id = "as_price_input"  value = "0" maxlength = "8"/>
						<span class = "input_chk_loading"><img src = "../../iconz/loading.gif"  class = "as_form_iconz"/></span>
					</div>
				</div>
				<div id = "a_s_submit">
					<div id = "as_submit_txt">
						<button id = "as_form_btn">
							<img src = "../../iconz/cart.png" class = "as_form_iconz" align = "left"/>Add stock
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
		
		$("#as_new_cat_btn").click(function()
		{
			addCat_fn();
		});
		
		
		$("#as_product_input").keyup(function()
		{
			productChk_fn();
		});
		
		
		$("#as_submit_txt").click(function()
		{
			createNew();
		});
		
		
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
					$("#as_cat_select").html(data);
				})
				.fail(function()
				{
					$("#as_old_cat .input_chk_loading").attr("src", "../../iconz/error.png");
				})
		}
		
		function addCat_fn()
		{
			// alert();
			var newcat= $("#as_new_cat_input_f").val();
			var gourl = "cat/add_category.php";
			usrkey = "<?php echo $skey;?>";
			$.post(gourl, {userid:usrkey, new_cat:newcat}, function()
			{
				
				$("#as_new_cat_btn").html("<img src = '../../iconz/loading.gif' class = 'as_form_iconz' align = 'left'>Saving");
				
				$("#as_new_cat_btn").attr("disabled", "disabled");

				$("#as_new_cat_input_f").attr("disabled", "disabled");
			})
				.done(function(data)
				{
					if(data == "Yes")
					{
						alert("Category added successfully!");
					}
					else
					{
						alert(data);
					}
					
					$("#as_new_cat_btn").attr("disabled", false);
					$("#as_new_cat_input_f").attr("disabled", false);
					$("#as_new_cat_btn").html("<img src = '../../iconz/memorycard.png' class = 'as_form_iconz' align = 'left'>Save category");
					
					catGet_fn();
				})
				.fail(function()
				{
					alert("Category not added!");
					$("#as_new_cat_btn").attr("disabled", false);
					$("#as_new_cat_input_f").attr("disabled", false);
					$("#as_new_cat_btn").html("<img src = '../../iconz/memorycard.png' class = 'as_form_iconz' align = 'left'>Save category");
				})	
		}
		
		function productChk_fn()
		{
			
			var gourl = "cat/product_check.php";
			var dataz  = $("#as_product_input").val();
			var cat_dataz  = $("#as_cat_select").val();
			// alert(cat_dataz);
			$.post(gourl, {pro_new:dataz, cat_sel:cat_dataz}, function()
			{
				$("#a_s_prduct .input_chk_loading").show();
			})
				.done(function(data)
				{
					//
					// alert(data);
					var data_json = JSON.parse(data);
						data2 = data_json[2]; 
						// alert(data.length);
						// alert(data2);
					if(data2  == "Yes")
					{
						$("#a_s_prduct .as_form_msg").html("This product name already exist.");
						$("#a_s_prduct .as_form_msg").show();
						$("#a_s_prduct .input_chk_loading").hide();
					}
					else if(data2 == "No")
					{
						// alert("not exist");
						$("#as_product_good").show();
						$("#a_s_prduct .as_form_msg").hide();
						$("#a_s_prduct .input_chk_loading").hide();
						$("#a_s_prduct #sec_loading").show();
					}
					else
					{
						$("#a_s_prduct .input_chk_loading").hide();
						$("#a_s_prduct .as_form_msg").show();
						$("#a_s_prduct .as_form_msg").html(data2);
					}
				})
				.fail(function()
				{
					$("#as_products_txt .input_chk_loading").hide();
				})
		}
		
		function formChk_fn()
		{
				chk_p = "1";
				chk_q = "1";
				chk_pi = "1";
			var chk_prod = $("#as_product_input").val();
			var chk_qty = $("#as_qty_input").val();
			var chk_price = $("#as_price_input").val();
			if(chk_prod.length < 2)
			{
				$("#a_s_prduct .as_form_msg").html("Product name too short.");
				$("#a_s_prduct .as_form_msg").show();
				$("#as_product_input").css("border",   "2px solid #d00");
				chk_p = "0";
			}
			if(parseInt(chk_qty) < 1 || (chk_qty).length < 1)
			{
				chk_q = "0";
				$("#as_qty_input").prop("placeholder",   "Invalid Price");
				$("#as_qty_input").css("border",   "2px solid #d00");
			}
			if(parseInt(chk_price) < 5 || (chk_price).length < 1)
			{
				chk_pi = "0";
				$("#as_price_input").prop("placeholder",   "Invalid Price");
				$("#as_price_input").css("border",   "2px solid #d00");
			}
			if(chk_p == "0" || chk_q == "0" || chk_pi == "0")
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		
		
		function createNew()
		{
			var form_chk = formChk_fn();
			if(form_chk === false)
			{
				alert("Please there's an error with your details.");
			}
			else
			{
						$("#as_form_btn").hide();
				var chk_cat = $("#as_cat_select").val();
				var chk_prod = $("#as_product_input").val();
				var chk_qty = $("#as_qty_input").val();
				var chk_price = $("#as_price_input").val();
				var userdo = "<?php echo $skey;?>";
				var url = "cat/new_product_submit.php";
				
				$.post(url, {cat:chk_cat, prod:chk_prod, qty:chk_qty, pric:chk_price, userd:userdo}, function()
					{
						
					})
					.done(function(data)
					{
						// alert(data);
						var dat = JSON.parse(data);
						if(dat["1"] == "Yes")
						{
							alert("Product added successfully!");
							$(".as_form_inputz").val("");
						}
						else if(dat["1"] == "No")
						{
							alert(dat["2"]);
							// $("#a_s_prduct .as_form_msg").html("Product already exist!");
							$("#a_s_prduct .as_form_msg").show();
							$("#as_product_input").css("border",   "2px solid #d00");
						}
						else
						{
							alert(data["2"]);
						}
						$("#as_form_btn").show();
					})
					.fail(function()
					{
						$("#as_form_btn").show();
					})
			}
			
			
		}
	});
</script>	
</body>	
</html>