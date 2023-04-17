<?php
error_reporting(0);
session_start();
	$pagename = "Dashboard";
	$sub_app_name = "Staff App";
	$sub_app_title = "Dashboard";
	$pagename = "staff";
	require("../templates/requirez.php");
	$profile_pic = "$absoute_path/iconz/profile.png";
	// require("$absoute_path/templates/requirez.php");
	require("../templates/language.php");
	// require("scripts/check_user.php");
	
	
	// print_r($_GET);
	
?>
<!DOCTYPE html/>
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
							<img src = "<?php echo $profile_pic; ?>"/>
						</div>
						<div id = "left_pane_head_bottom"> 
							<span class = "left_pane_head_bottom_txt"><?php echo $fullname?></span>
						</div>
					</div>
					
				</div>
				
				
				<div id = "right_pane">
					<div id = "right_pane_top">
						Staff Dashboard
					</div>
					<br/>
					<div id = "right_pane_loader">
						<iframe name = "right_pane_loader_frame_name" id "right_pane_loader_frame" src = "$absolute_path/staff/features/newtransaction.php?idkey=<?php $userkey;?>">
						
						</iframe>
					</div>
					<div id = "right_pane_right_features">
						<div id = "right_pane_right_features_right">
							<div class = "right_pane_right_features_boxes">
							
								<div class = "right_pane_right_features_boxes_hd"></div>
							</div>
							<div class = "right_pane_right_features_boxes">
								<div class = "right_pane_right_features_boxes_hd"></div></div>
						</div>
						<div id = "right_pane_right_features_left">
							<div class = "right_pane_right_features_boxes">
								
								<div class = "right_pane_right_features_boxes_hd"></div>
							</div>
							<div class = "right_pane_right_features_boxes">
								
								<div class = "right_pane_right_features_boxes_hd"></div>
							</div>
							<div class = "right_pane_right_features_boxes">
								
								<div class = "right_pane_right_features_boxes_hd"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>		