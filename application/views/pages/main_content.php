<div id="cp_main_content" class="grid_<?php echo $main_grid.' '.$main_layout;?>">
<?php foreach ($ads as $ad) {
	// Set class on each ad based on size 
	switch ($ad->creative->ad_size){
		case 1:
			// 1 column ad
			$ad_class = "grid_4 ad_single";
			break;
		default:
			$ad_class = "";
			break;
	}
?>

	<div class="<?php echo $ad_class; ?>">
		<a href="deal_detail?di=<?php echo $ad->creative->id; ?>">
			<div class="ad_type"><?php echo $ad->creative->ad_type ?></div>
			<img class="ad_image" src="<?php echo "/media/ad_images/{$ad->creative->ad_image_name}" ?>"/>
			<div class="ad_body">
				<div class="ad_business_name"><?php echo $ad->creative->business_name; ?></div>
				<div class="ad_offer_short"><?php echo $ad->creative->offer_in_short; ?></div>
				<div class="ad_list_price"><?php echo $ad->creative->list_price; ?></div>
				<div class="ad_coupon_price"><?php echo $ad->creative->coupon_price; ?></div>
				<div class="ad_sms_code"><?php echo $ad->creative->sms_code; ?></div>
			</div>
		</a>
<?php ?>
	</div>
<?php } ?>
</div>
