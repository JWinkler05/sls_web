<div id="cp_main_content" class="grid_12"> 
<?php foreach ($ads as $ad) { ?>
	<div class="grid_4 ad_single"><?php 
echo '<br/>'.$ad->creative->id;
echo '<br/>'.$ad->creative->ad_type;
echo '<br/>'.$ad->creative->ad_size;
echo '<br/>'.$ad->creative->image_location;
echo '<br/>'.$ad->creative->location_specific;
echo '<br/>'.$ad->creative->location_city;
echo '<br/>'.$ad->creative->business_name;
echo '<br/>'.$ad->creative->offer_in_short;
echo '<br/>'.$ad->creative->list_price;
echo '<br/>'.$ad->creative->coupon_price;
echo '<br/>'.$ad->creative->sms_code;
echo '<br/>'.$ad->creative->category_id;
echo '<br/>'.$ad->creative->specific_category;
echo '<br/>'.$ad->creative->savings;
echo '<br/>'.$ad->creative->expiration;
echo '<br/>'.$ad->creative->description;
echo '<br/>'.$ad->creative->detailed_offer;
	?></div>
<?php } ?>
</div>
