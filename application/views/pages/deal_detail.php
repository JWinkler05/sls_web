<div id="cp_main_content" class="grid_<?php echo $main_grid.' '.$main_layout;?>">
	<?php
	// Include the layout for the ad detail
	$view = View::factory('segments/ad/detail');
	$view->detail_image = $detail_image;
	$view->selected = $selected;
	echo $view->render();
	?> 

<?php 
foreach ($ads as $ad) {
	if ($ad->creative->creative_id !== $id){
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
<?php 
	}
} 
?>
</div>
