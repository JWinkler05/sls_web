<div id="cp_header" class="container_16">
	<div id ="cp_main_logo" class="grid_5"><?php echo View::factory('pages/main_logo')->render(); ?></div>
	<div id = "cp_main_menu" class="grid_11"><?php if ($menu){ echo View::factory('pages/main_menu')->render();} ?></div>
</div>

