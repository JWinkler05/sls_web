<div id="cp_main" class="grid_16">
<?php 
if (!is_array($ads)) { 
	$ads  = $full_ads;
?>
	<div class="noads">
		<p>Sorry, No records exist for this model</p>
	</div>
<?php }
$count = 0;
?>
	<div class="create_new">
		<a href='admin_creative_add'>Add New Creative</a>
	</div>
<?php
foreach ($ads as $ad) {
$count++;
?>

	<div class="row_<?php echo $ad->creative->creative_id; ?>">
		<div class=""><?php echo sprintf('%02u', $count); ?>.) 
			<a href='creative_edit?id=<?php echo $ad->creative->creative_id; ?>'>Edit</a> | 
			<a href='creative_images?id=<?php echo $ad->creative->creative_id; ?>'>Images</a> | 
			<a href='creative_markets?id=<?php echo $ad->creative->creative_id; ?>'>Markets</a> | 
			<a href='creative_categories?id=<?php echo $ad->creative->creative_id; ?>'>Categories</a> | 
			<a href='creative_tags?id=<?php echo $ad->creative->creative_id; ?>'>Tags</a> | 
			<a href='creative_delete?id=<?php echo $ad->creative->creative_id; ?>'>Delete</a>: 
			<?php echo $ad->creative->business_name.' - '.$ad->creative->sms_code; ?>
		</div>
	</div>
<?php } ?>
	<div class="create_new">
		<a href='creative_add'>Add New Creative</a>
	</div>
</div>
