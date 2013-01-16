<div class="grid_4 ad_single">
	<div class="ad_type"><?php echo $creative->ad_type ?></div>
	<img class="ad_image" src="<?php echo "/media/ad_images/{$creative->ad_image_name}" ?>"/>
	<div class="ad_body">
		<div class="ad_business_name"><?php echo $creative->business_name; ?></div>
		<div class="ad_offer_short"><?php echo $creative->offer_in_short; ?></div>
		<div class="ad_list_price"><?php echo $creative->list_price; ?></div>
		<div class="ad_coupon_price"><?php echo $creative->coupon_price; ?></div>
		<div class="ad_sms_code"><?php echo $creative->sms_code; ?></div>
	</div>
</div>
