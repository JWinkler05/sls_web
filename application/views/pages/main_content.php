<div id="cp_main_content" class="grid_<?php echo $main_grid.' '.$main_layout;?>">
<?php 
if (!is_array($ads)) { 
	$ads  = $full_ads;
?>
	<div class="noads">
		<p>Sorry, No ads exist for this category</p>
	</div>
<?php }
foreach ($ads as $ad) {
?>
	<a href="deal_detail?id=<?php echo $ad->creative->creative_id; ?>">
		<?php
		// Include the layout for a single ad
		$view = View::factory('segments/ad/single');
		$view->creative = $ad->creative;
		$view->ad_image = $ad->creative->ad_image_name;
		echo $view->render();
		?> 
	</a>
<?php } ?>
</div>
