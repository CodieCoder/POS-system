<?php
	if(!isset($sub_app_name))
	{
		$sub_app_name = " ";
	}
?>

<div id = "z_header">
	<div id = "first_head">
		Zephyr Manager
	</div>
	<div id = "sub_app_name">
		<?php
			print "$sub_app_name";
		?>
	</div>
</div>
