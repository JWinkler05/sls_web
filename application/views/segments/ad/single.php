<?php
// Set class on each ad based on size 
switch ($creative->ad_size){
	case 1:
		// 1 column ad
		$ad_class = "grid_4 ad_single";
		break;
	default:
		$ad_class = "";
		break;
}
?>
<div class="grid_4 ad_single">
	<div class="ad_type"><?php echo $creative->ad_type ?></div>
	<img class="ad_image" src="<?php echo "/media/ad_images/$ad_image" ?>"/>
	<div class="ad_body">
		<div class="ad_business_name"><?php echo $creative->business_name; ?></div>
		<div class="ad_offer_short"><?php echo $creative->offer_in_short; ?></div>
		<?php if($creative->list_price != NULL && $creative->list_price != '' && $creative->list_price > 0) { ?>
		<div class="ad_list_price">$<?php echo $creative->list_price; ?></div>
		<?php }
		if($creative->coupon_price != NULL && $creative->coupon_price != '' && $creative->coupon_price > 0) { ?>
		<div class="ad_coupon_price">$<?php echo $creative->coupon_price; ?></div>
		<?php } elseif(strpos(strtolower($creative->offer_in_short), 'free') !== FALSE) { ?>
		<div class="ad_coupon_price"><?php echo 'FREE'; ?></div>
		<?php } ?>
		<div class="ad_sms_code"><?php echo $creative->sms_code; ?></div>
	</div>
</div>
