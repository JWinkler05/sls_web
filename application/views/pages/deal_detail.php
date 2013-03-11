<div id="cp_main_content" class="grid_<?php echo $main_grid.' '.$main_layout;?>">
	<div class="grid_16 outergray">
            <div class="innerwhite">
                <div class="mainimg grid_8">
                    <center><h1 class="buistitle"><?php echo $selected->business_name; ?></h1></center>
                    <img width="450" height="328" alt="image" src="<?php echo "/media/ad_images/{$detail_image->local_location}" ?>">
                </div>
                <div class="column grid_4 detail_offset">
                    <p align="center"><?php echo $selected->description; ?></p>
                    <p class="sms_blurb"><br /><?php echo "For more great deals from " . $selected->business_name . ", "; ?></p>
                    <p class ="sms_code"><?php echo $selected->sms_code; ?></p>
                    <br/>
                    <p><strong>Offer Details</strong></p>
                    <p class="advdeal"><?php echo $selected->detailed_offer; ?></p>
                </div>
                <div class="columnafter grid_4 detail_offset">
                    <p><strong>Regular Price</strong></p>
                    <p class="regprice"><?php echo "$" . $selected->list_price; ?></p>
                    <br/>
                    <p><strong>Sale Price</strong></p>
                    <p class="saleprice"><?php echo "$" . $selected->coupon_price; ?></p>

                </div>
            </div>

	</div>
		<?php
		?>
<?php foreach ($ads as $ad) {
if ($ad->creative->creative_id !== $id){
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
		<a href="deal_detail?id=<?php echo $ad->creative->creative_id; ?>">
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
<?php }} ?>
</div>
