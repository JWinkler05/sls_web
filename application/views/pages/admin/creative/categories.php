<div id="cp_main" class="grid_16">

<br /> <br />
<h3> Current Categories For Creative</h3>
<br />

<?php 
		foreach($tblCategory as $Category)
		{
		$temp = array_keys($tblCategory, $Category);
		echo $Category;
		$tempURL ='creative_category_delete?creative_id= ' .$creative_id. '&category_id= ' .$temp[0];
		echo '<a href="' .$tempURL. '" onclick="return confirm(\'Do you really want to delete?\')";> Delete </a> ';
		}
?>

<?php echo '<br/>' . $form . '<br />'; ?>
</div>
