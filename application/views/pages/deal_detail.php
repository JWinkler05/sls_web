<div id="cp_main_content" class="grid_<?php echo $main_grid.' '.$main_layout;?>">
	<div class="grid_16 outergray">
		<div class="innerwhite">
			<div class="column grid_4 detail_offset">
				<h2><?php echo $selected->business_name; ?></h2>
				<p><?php echo $selected->description; ?></p>
				<p><?php echo $selected->sms_code; ?></p>
			</div>
			<div class="mainimg grid_8">
				<img width="450" height="328" alt="image" src="<?php echo "/media/ad_images/{$selected->ad_image_name}" ?>">
			</div>
			<div class="columnafter grid_4 detail_offset">
				<p>Offer Details</p>
				<p class="advdeal"><?php echo $selected->detailed_offer; ?></p>
				<p>Regular Price</p>
				<p class="regprice"><?php echo $selected->list_price; ?></p>
				<p>Sale Price</p>
				<p class="saleprice"><?php echo $selected->coupon_price; ?></p>
			
			</div>
		</div>
	</div>
		<?php
/* 
echo '<br/>'.$selected->id;
echo '<br/>'.$selected->ad_type;
echo '<br/>'.$selected->ad_size;
echo '<br/>'.$selected->image_location;
echo '<br/>'.$selected->location_specific;
echo '<br/>'.$selected->location_city;
echo '<br/>'.$selected->business_name;
echo '<br/>'.$selected->offer_in_short;
echo '<br/>'.$selected->list_price;
echo '<br/>'.$selected->coupon_price;
echo '<br/>'.$selected->sms_code;
echo '<br/>'.$selected->category_id;
echo '<br/>'.$selected->specific_category;
echo '<br/>'.$selected->savings;
echo '<br/>'.$selected->expiration;
echo '<br/>'.$selected->description;
echo '<br/>'.$selected->detailed_offer;
echo '<br/>'.$selected->ad_image_name;
echo '<br/>'.$selected->company_logo_image_name;
*/
		?>
<?php foreach ($ads as $ad) {
if ($ad->creative->id != $id){
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
<?php }} ?>
</div>
