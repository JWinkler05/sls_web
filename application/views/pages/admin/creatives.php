<div id="cp_main_content" class="grid_16">
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
		<div class=""><?php echo $count; ?>.) 
			<a href='admin_creative_edit?id=<?php echo $ad->creative->creative_id; ?>'>Edit</a> | 
			<a href='admin_creative_delete?id=<?php echo $ad->creative->creative_id; ?>'>Delete</a>: 
			<?php echo $ad->creative->business_name.' - '.$ad->creative->sms_code; ?>
		</div>
<?php ?>
	</div>
<?php } ?>
	<div class="create_new">
		<a href='admin_creative_add'>Add New Creative</a>
	</div>
</div>
