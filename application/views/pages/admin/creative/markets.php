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
		echo '<a href="creative_market_delete?market_id= ' .$temp[0].'"> Delete</a> <br />';
		}
?>

<?php echo '<br/>' . $form . '<br />'; ?>
</div>
