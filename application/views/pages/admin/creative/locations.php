<div id="cp_main" class="grid_16">
<!--	<ul>
		li><a href="admin/locations">List all locations</a></li>
	</ul>-->
<br /> <br />
<h3> Current Locations For Creative</h3>
<br />

<?php 
		foreach($tblLocation as $location)
		{
		$temp = array_keys($tblLocation, $location);
		echo $location;
		$tempURL ='creative_location_delete?creative_id=' .$creative_id. '&location_id= ' .$temp[0];
		echo '<a href="' .$tempURL. '"> Delete </a> <br />';
		}
?>

<?php if(!$tblLocation) { echo '<br/>' . $form . '<br />'; } ?>
</div>
