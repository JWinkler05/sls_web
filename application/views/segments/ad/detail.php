<div class="grid_16 outergray">
    <div class="innerwhite">
	<div class="mainimg grid_8">
	    <center><h1 class="buistitle"><?php echo $selected->business_name; ?></h1></center>
	     <a href="http://<?php echo $selected->website; ?>" alt="Website URL">
	    <img width="450" height="328" alt="image" src="<?php echo "/media/ad_images/$detail_image" ?>">
	     </a>
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
	    <br/>
<!--	    <p><strong>Website</strong></p>
	    <a href="http://<?php echo $selected->website; ?>" alt="Website URL"><?php echo $selected->website; ?></a>-->
	</div>
    </div>
</div>