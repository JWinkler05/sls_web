<div class="grid_16 outergray">
	<div class="innerwhite">
		<div class="column grid_4 detail_offset">
			<h2><?php echo $creative->business_name; ?></h2>
			<p><?php echo $creative->description; ?></p>
			<p><?php echo $creative->sms_code; ?></p>
		</div>
		<div class="mainimg grid_8">
			<img width="450" height="328" alt="image" src="<?php echo "/media/ad_images/{$creative->ad_image_name}" ?>">
		</div>
		<div class="columnafter grid_4 detail_offset">
			<p>Offer Details</p>
			<p class="advdeal"><?php echo $creative->detailed_offer; ?></p>
			<p>Regular Price</p>
			<p class="regprice"><?php echo $creative->list_price; ?></p>
			<p>Sale Price</p>
			<p class="saleprice"><?php echo $creative->coupon_price; ?></p>
		
		</div>
	</div>
</div>
