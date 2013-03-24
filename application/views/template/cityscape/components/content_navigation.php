<div id="cp_admin_navigation" class="grid_16 no-sidebar">
<?php
if (Auth::instance()->logged_in('admin')) { 
	echo View::factory('pages/admin/navigation')->render();
}
?>
</div>