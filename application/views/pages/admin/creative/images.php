<div id="cp_main_content" class="grid_16 no-sidebar">
	<div class="grid_16">
		<p>Edit Details</p><br/>
		<?php
		// Display the edit form (from controller)
		if ($ad_image) { 
			echo '<div>Ad Image | <a href="creative_image_delete?creative_id=' .$creative_id. '& image_id='.$ad_id.'"> Delete</a> | <br />'.HTML::image('/media/ad_images/'.$ad_image).'<br /><br /></div>';
			echo PHP_EOL;
		}
		if ($detail_image) {
			echo '<div>Detail Image | <a href="creative_image_delete?creative_id=' .$creative_id. '& image_id='.$detail_id.'">Delete</a> | <br /> '.HTML::image('/media/ad_images/'.$detail_image).'</div>';
			echo PHP_EOL;
		}
		echo $form;
		?>
	</div>
</div>
