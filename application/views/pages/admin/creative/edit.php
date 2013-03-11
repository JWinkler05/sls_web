<div id="cp_main_content" class="grid_16 no-sidebar">
	<div class="grid_6">
		<p>Edit Details</p><br/>
		<?php
		// Display the edit form (from controller) 
		echo $form; 
		?>
	</div>

	<p>Single Column Ad preview</p>
	<?php
	// Include the layout for a single ad
	$view = View::factory('segments/ad/single');
	$view->creative = $creative;
	echo $view->render();
	?> 

	<p class='grid_16'>Full Size Detail preview</p>
	<?php
	// Include the layout for the ad detail
	$view = View::factory('segments/ad/detail');
	$view->creative = $creative;
	echo $view->render();
	?> 
</div>
