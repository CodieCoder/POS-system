<?php
// error_reporting(0);
session_start();
	$page_code = "0";
	$pagename = "Dashboard";
	$sub_app_name = "Admin App";
	$sub_app_title = "Dashboard";
	$pagename = "Admin";
	require("../templates/requirez.php");
	$profile_pic = "$absoute_path/iconz/profile.png";
	// require("$absoute_path/templates/requirez.php");
	require("../templates/language.php");
	require("scripts/check_user.php");
	require("scripts/get_details.php");
	
	// $_SESSION["idkey"] = $userkey;
	// print_r($_GET);
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Zephyr || <?php echo "$sub_app_title";?> </title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
		<meta http-equiv="EXPIRES" content="0">
		<meta http-equiv="pragma" content="no-cache">
		
		<link rel = "stylesheet" href = "../css/z_header.css">
		<link rel = "stylesheet" href = "css/dashboard.css">
		
		<script rel = "javascript" src = "../js/jquery.js"></script>
	</head>
	<body>
		<div id = "full_body">
		
			<div id = "dashboard_hd">
				
			</div>
		 
			<div id = "z_header" style = "display:none;"><?php require("../pieces/z_header.php");?></div>
			<div id = "app_body">
			
			
				<div id = "left_pane">
					
					<div id = "left_pane_head">
						<div id = "left_pane_head_top"> 
							<img src = "../profile_picz/<?php echo $profile_pic; ?>"/>
						</div>
						<div id = "left_pane_head_bottom"> 
							<div id = "left_pane_head_bottom_name" title = "Your name"><?php echo $fullname?></div>
							<div id = "left_pane_head_bottom_usr" title = "Your username">@<?php echo $username?></div>
						</div>

					</div>
					
						<div id = "left_pane_navz_list"> 
							<div class = "left_pane_navz_main">
								<div class = "left_pane_navz_main_block">
									<div class = "left_pane_navz_main_hd"><span class = "nav_list_iconz"><img src = "../iconz/clipboard.png" align = "left"></span><span class = "nav_list_txt"> Supplies</span></div>
									<div class = "left_pane_navz_main_list_show" style = "display:block">
											
										<div class = "left_pane_navz_main_list" Onclick = iframeURL('features/add_stock.php')><span class = "nav_list_iconz" ><img src = "../iconz/arrow-down.png" align = "left"></span><span class = "nav_list_txt">Add Stocks</span></div>
										<div class = "left_pane_navz_main_list" Onclick = iframeURL('features/newtransaction.php')><span class = "nav_list_iconz"><img src = "../iconz/arrow-up.png" align = "left"></span><span class = "nav_list_txt">Transfer Stocks</span></div>
										<div class = "left_pane_navz_main_list" Onclick = iframeURL('features/view_stock.php')><span class = "nav_list_iconz"><img src = "../iconz/focus.png" align = "left"></span><span class = "nav_list_txt">View Stocks</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/compose.png" align = "left"></span><span class = "nav_list_txt">Edit Stocks</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/x.png" align = "left"></span><span class = "nav_list_txt">Delete Stocks</span></div>
									</div>
								</div>
							</div>
							
							<div class = "left_pane_navz_main">
								<div class = "left_pane_navz_main_block">
									<div class = "left_pane_navz_main_hd"><span class = "nav_list_iconz"><img src = "../iconz/profile.png" align = "left"></span><span class = "nav_list_txt"> Users</span></div>
									<div class = "left_pane_navz_main_list_show">
											
										<div class = "left_pane_navz_main_list" Onclick = iframeURL('features/user_add.php')><span class = "nav_list_iconz"><img src = "../iconz/arrow-down.png" align = "left"></span><span class = "nav_list_txt">Add User</span></div>
										<div class = "left_pane_navz_main_list" Onclick = iframeURL('features/user_view.php')><span class = "nav_list_iconz"><img src = "../iconz/browser.png" align = "left"></span><span class = "nav_list_txt">View User</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/compose.png" align = "left"></span><span class = "nav_list_txt">Edit User</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/x.png" align = "left"></span><span class = "nav_list_txt">Delete User</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/unlocked.png" align = "left"></span><span class = "nav_list_txt">Lock/Unlock User</span></div>
									</div>
								</div>
							</div>
							
							<!--<div class = "left_pane_navz_main">
								<div class = "left_pane_navz_main_block">
									<div class = "left_pane_navz_main_hd"><span class = "nav_list_iconz"><img src = "../iconz/barchart.png" align = "left"></span><span class = "nav_list_txt"> Statistics</span></div>
									<div class = "left_pane_navz_main_list_show">
											
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/bookshelf.png" align = "left"></span><span class = "nav_list_txt">View Today</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/clock.png" align = "left"></span><span class = "nav_list_txt">View Yesterday</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/calendar.png" align = "left"></span><span class = "nav_list_txt">This Month(<?php echo date("F"); ?>)</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/calendar.png" align = "left"></span><span class = "nav_list_txt">Last Month(<?php echo date('F', strtotime(date('Y-m')." -1 month")); ?>)</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/news.png" align = "left"></span><span class = "nav_list_txt">More</span></div>
									</div>
								</div>
							</div>
							!-->
							<div class = "left_pane_navz_main">
								<div class = "left_pane_navz_main_block">
									<div class = "left_pane_navz_main_hd"><span class = "nav_list_iconz"><img src = "../iconz/calculator.png" align = "left"></span><span class = "nav_list_txt"> Finance</span></div>
									<div class = "left_pane_navz_main_list_show">
											
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/bookshelf.png" align = "left"></span><span class = "nav_list_txt">Daily</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/clock.png" align = "left"></span><span class = "nav_list_txt">Weekly</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/calendar.png" align = "left"></span><span class = "nav_list_txt">Monthly</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/calendar.png" align = "left"></span><span class = "nav_list_txt">Yearly(<?php echo date('F', strtotime(date('Y-m')." -1 month")); ?>)</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/news.png" align = "left"></span><span class = "nav_list_txt">More</span></div>
									</div>
								</div>
							</div>
							
							<div class = "left_pane_navz_main">
								<div class = "left_pane_navz_main_block">
									<div class = "left_pane_navz_main_hd" ><span class = "nav_list_iconz"><img src = "../iconz/crossroads.png" align = "left"></span><span class = "nav_list_txt"> Customers</span></div>
									<div class = "left_pane_navz_main_list_show">
											
										<div class = "left_pane_navz_main_list" Onclick = iframeURL('features/block_add.php')><span class = "nav_list_iconz"><img src = "../iconz/crossroads.png" align = "left"></span><span class = "nav_list_txt">Add Block</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/focus.png" align = "left"></span><span class = "nav_list_txt">View block</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/compose.png" align = "left"></span><span class = "nav_list_txt">Edit block</span></div>
										<div class = "left_pane_navz_main_list"><span class = "nav_list_iconz"><img src = "../iconz/x.png" align = "left"></span><span class = "nav_list_txt">Delete Block</span></div>
									</div>
								</div>
							</div>
							<div class = "left_pane_navz_main"></div>
						</div>
				</div>
				
				
				<div id = "right_pane">
					<div id = "right_pane_top">
						Administrator Dashboard
					</div>
					<br/>
					<div id = "right_pane_loader">
						<iframe name = "right_pane_loader_frame_name" id =  "right_pane_loader_frame" src = "features/newtransaction.php?idkey=<?php echo $userkey;?>">
						
						</iframe>
					</div>
					<div id = "right_pane_right_features">
						<div id = "right_pane_right_features_right">
							<div class = "right_pane_right_features_boxes">
							
								<div class = "right_pane_right_features_boxes_hd">Total Categories</div>
								<div class = "right_pane_right_features_boxes_con" id = "vs_stock_summary_1a"></div>
							</div>
							<div class = "right_pane_right_features_boxes">
								<div class = "right_pane_right_features_boxes_hd">Total Products</div>
								<div class = "right_pane_right_features_boxes_con" id = "vs_stock_summary_1b"></div>
							</div>
						</div>
						<div id = "right_pane_right_features_left">
							<div class = "right_pane_right_features_boxes">
								
								<div class = "right_pane_right_features_boxes_hd">Remaining Quantities</div>
								<div class = "right_pane_right_features_boxes_con" id = "vs_stock_summary_1c"></div>
							</div>
							<div class = "right_pane_right_features_boxes">
								
								<div class = "right_pane_right_features_boxes_hd">Total Transfer</div>
								<div class = "right_pane_right_features_boxes_con" id = "vs_stock_summary_1d"></div>
							</div>
							<div class = "right_pane_right_features_boxes">
								
								<div class = "right_pane_right_features_boxes_hd">Today Transfer</div>
								<div class = "right_pane_right_features_boxes_con" id = "vs_stock_summary_1f"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
<script>
	$(document).ready(function()
	{
		
		$(".left_pane_navz_main_hd").click(function()
		{
			$(this).parent("div").children(".left_pane_navz_main_list_show").slideToggle(300);
		});
		
		getStockSummary("cat_num", "vs_stock_summary_1a");
		getStockSummary("prdt_num", "vs_stock_summary_1b");
		getStockSummary("qty_num", "vs_stock_summary_1c");
		getStockSummary("all_sales", "vs_stock_summary_1d");
		getStockSummary("today_sales", "vs_stock_summary_1f");
	});
	
function iframeURL(url)
{
// alert();
	var url = url + "?idkey=" + "<?php echo $userkey;?>";
	// $("#right_pane_loader_frame_name").blur();
	$("#right_pane_loader_frame").attr('src', url);
	// $("ifame").attr('src', url);
}

		
		
		
function getStockSummary(commd, div)
{
	var giurl = "features/viewz/stock_summary.php";
	
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
			$("#" + div).html("COuld not connect. Check connection.");
		})
}
</script>		
	</body>
</html>		