<div class="grid_16 outergray">
    <div class="innerwhite">
	<div class="mainimg grid_8">
	    <center><h1 class="buistitle"><?php echo $selected->business_name; ?></h1></center>
	    <?php if($selected->website != NULL) { ?> 
	     <?php if(strtolower(substr($selected->website, 0, 4)) != 'http') {
			echo "<a href=\"http://$selected->website\" alt=\"WebsiteURL\" >";
		} else {
			echo "<a href=\"$selected->website\" alt=\"WebsiteURL\" >" ;
		 }
	     ?>
	     <img width="450" height="328" alt="image" src="<?php echo "/media/ad_images/$detail_image" ?>">
	     <?php if($selected->website != NULL) { ?>
	     </a>
	     <?php } } elseif($selected->facebook != NULL) { ?>
	    <?php if(strtolower(substr($selected->facebook, 0, 4)) != 'http') {
			echo "<a href=\"http://$selected->facebook\" alt=\"WebsiteURL\" >";
		} else {
			echo "<a href=\"$selected->facebook\" alt=\"WebsiteURL\" >" ;
		 }
	     ?>
	     <img width="450" height="328" alt="image" src="<?php echo "/media/ad_images/$detail_image" ?>">
	     <?php if($selected->facebook != NULL) { ?>
	     </a>
	    <?php } } elseif($selected->twitter != NULL) { ?>
	    <?php if(strtolower(substr($selected->twitter, 0, 4)) != 'http') {
			echo "<a href=\"http://$selected->twitter\" alt=\"WebsiteURL\" >";
		} else {
			echo "<a href=\"$selected->twitter\" alt=\"WebsiteURL\" >" ;
		 }
	     ?>
	     <img width="450" height="328" alt="image" src="<?php echo "/media/ad_images/$detail_image" ?>">
	     <?php if($selected->twitter != NULL) { ?>
	     </a>
	    <?php } } else { ?>
	    <img width="450" height="328" alt="image" src="<?php echo "/media/ad_images/$detail_image" ?>">
	    <?php } ?>
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
	    <br />
	    <?php if($selected->facebook != NULL){ ?>
	    <a href="<?php if(strtolower(substr($selected->facebook, 0, 4)) != 'http') {
		    echo "http://" . $selected->facebook; ?>
		    <?php } else {
		    echo $selected->facebook; ?>
			<?php } ?>
		 "alt="Facebook Site">
		 <img src="/media/tpl-cityscape/icons/facebook.png" height ="50" width="50" alt="FacebookPic"> </a>
	    <?php } ?>
		    
	    <?php if($selected->twitter != NULL){ ?>
	    <a href="<?php if(strtolower(substr($selected->twitter, 0, 4)) != 'http') {
		    echo "http://" . $selected->twitter; ?>
		    <?php } else {
		    echo $selected->twitter; ?>
			<?php } ?>
		 "alt="Twitter Site">
		 <img src="media/tpl-cityscape/icons/twitter.png" height ="50" width="50" alt="TwitterPic"> </a>
	    <?php } ?>
	</div>
    </div>
</div>