<?php
		$sub_app_client_title = "Company Name";
	if(!isset($sub_app_name))
	{
		$sub_app_name = " ";
	}
?>

<div id = "z_header">
	<div id = "first_head">
		<img src = "../icon/z_only_icon.PNG" height = "40em" width = "50em" id = "z_icon_head" align="left">Zephyr manager
	</div>
<div id = "sub_app_div">
	<div id = "sub_app_name">
		<?php
			echo "<span id = 'sub_app_client_title'>".$sub_app_client_title."</span><span id = 'sub_app_client_app'>[$sub_app_name]</span>";
		?>
		</div>
		<div id = "sub_app_date">
			<?php  echo date("jS, l M Y ");?>
		</div>
	</div>
</div>
