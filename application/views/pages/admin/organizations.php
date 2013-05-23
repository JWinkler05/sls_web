<div id="cp_main" class="grid_16">

<br /> <br />
<h3> Current Organizations</h3>
<br />
<a href="organization_add">Add new organization</a> <br /><br />

<?php
		foreach($tblOrg as $org)
		{
		$temp = array_keys($tblOrg, $org);
		//var_dump($org['organization']);die();
		$tempURL ='organization_edit?org_id='.$org['organization']['org_id'];
		echo '<a href="' .$tempURL. '"> Edit | </a>';
		$tempURL ='organization_delete?org_id='.$org['organization']['org_id'];
		echo '<a href="' .$tempURL. '" onclick="return confirm(\'Do you really want to delete?\')";> Delete |</a> ';
		$tempURL ='/admin/creatives?org_id= '.$org['organization']['id'];
		echo '<a href="' .$tempURL. '"> Creatives  |</a>';
		$tempURL ='/admin/locations?org_id= '.$org['organization']['id'];
		echo '<a href="' .$tempURL. '"> Locations </a>: ';
		echo $org['organization']['org_name'].'<br />';
		}
		
?>

<?php 
//echo '<br/>' . $form . '<br />'; ?>
<br /> <a href="organization_add">Add new organization</a>

</div>
