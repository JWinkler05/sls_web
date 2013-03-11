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
