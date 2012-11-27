<?php 
	$view = View::factory('pages/main_content');
	$view->ads = $ads_primary;
	$view->main_grid = $main_grid;
	$view->main_layout = $main_layout;
	echo $view->render(); 

	$sb_view = View::factory('pages/side_content');
	$sb_view->ads = $ads_secondary;
	echo $sb_view->render();
?>

