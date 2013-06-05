<div id="cp_main" class="grid_16">

<br /> <br />
<h3> Current Markets</h3>
<br />
<a href="market_add">Add new a market</a> <br /><br/>

<?php
		foreach($tblMarket as $market)
		{
		$temp = array_keys($tblMarket, $market);
		//var_dump($market['organization']);die();
		$tempURL ='market_edit?id='.$market['market']['id'];
		echo '<a href="' .$tempURL. '"> Edit | </a>';
		$tempURL ='market_delete?id='.$market['market']['id'];
		echo '<a href="' .$tempURL. '" onclick="return confirm(\'Do you really want to delete?\')";> Delete |</a> ';
		echo $market['market']['market_name'].'<br />';
		}
		
//echo '<br/>' . $form . '<br />';
if(count($tblMarket) > 0) { ?>
<br /><a href="market_add"> Add a new market</a>	
<?php } ?>

</div>
