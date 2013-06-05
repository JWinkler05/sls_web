<div id="cp_main" class="grid_16">
<!--	<ul>
		li><a href="admin/markets/metrolist">List all metros</a></li>
	</ul>-->
<br /> <br />
<h3> Current Market's For Creative</h3>
<br />

<?php 
		foreach($tblMarket as $market)
		{
		$temp = array_keys($tblMarket, $market);
		echo $market;
		$tempURL ='creative_market_delete?creative_id= ' .$creative_id. '&market_id= ' .$temp[0];
		echo '<a href="' .$tempURL. '" onclick="return confirm(\'Do you really want to delete?\')";> Delete</a> ';
		}
?>

<?php echo '<br/>' . $form . '<br />'; ?>
</div>
