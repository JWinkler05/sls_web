<div id="cp_main_content" class="grid_16 no-sidebar">
	<div class="grid_6">
		<p>Edit Details</p><br/>
		<?php
		// Display the edit form (from controller) 
		if ($form) {
			echo $form;
		} else {
			echo HTML::image('/media/ad_images/'.$ad_image);
			echo PHP_EOL;
			echo HTML::image('/media/ad_images/'.$detail_image);
		}; 
		?>
	</div>
</div>
