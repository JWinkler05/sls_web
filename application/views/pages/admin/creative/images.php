<div id="cp_main_content" class="grid_16 no-sidebar">
	<div class="grid_16">
		<p>Edit Details</p><br/>
		<?php
		// Display the edit form (from controller)
		if ($ad_image) { 
			echo '<div>ad_image | <a href="creative_image_delete?id=sdf">Delete</a> | '.HTML::image('/media/ad_images/'.$ad_image).'</div>';
			echo PHP_EOL;
		}
		if ($detail_image) {
			echo '<div>detail_image | <a href="creative_image_delete?id=sdf">Delete</a> | '.HTML::image('/media/ad_images/'.$detail_image).'</div>';
			echo PHP_EOL;
		}
		echo $form;
		?>
	</div>
</div>
