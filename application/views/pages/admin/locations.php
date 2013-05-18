<div id="cp_main" class="grid_16">
<?php 
if (!is_array($locations)) { 
?>
	<div class="noads">
		<p>Sorry, No records exist for this model</p>
	</div>
<?php }
$count = 0;
?>
	<div class="create_new">
		<a href='location_add?org_id=<?php echo trim($org_id) ?>'>Add New Location</a>
		<br /><br />
	</div>
<?php
if($locations) {
foreach ($locations as $loc) {
$count++;
?>

	<div class="row_<?php echo $loc['location']['id']; ?>">
		<div class=""><?php echo sprintf('%02u', $count); ?>.) 
			<a href='location_edit?id=<?php echo $loc['location']['location_id']; ?>'>Edit</a> | 
			<a href='location_delete?id=<?php echo $loc['location']['location_id']; ?>' onclick="return confirm('Do you really want to delete?');">Delete</a>:
			<?php echo $loc['location']['name']; ?>
		</div>
	</div>
	
<?php }} ?>
	<div class="create_new">
		<br />
		<a href='location_add?org_id=<?php echo trim($org_id) ?>'>Add New Location</a>
	</div>
</div>
