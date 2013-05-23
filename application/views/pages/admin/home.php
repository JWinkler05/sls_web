<div id="cp_main_content" class="grid_16 no-sidebar">
<h1>Models</h1>

<?php
if (Auth::instance()->logged_in('admin')){ 
?>
<ul>
	<li><a href='/admin/organizations'>Organizations</a></li>
	<li><a href='/admin/markets'>Markets</a></li>
	<!--<li><a href='/admin/creatives'>Creatives</a></li>-->
</ul>
<?php 
}
else if(Auth::instance() -> logged_in('member')) { 	
?>
<ul>
	<!--<li><a href='/admin/organizations'>Organizations</a></li>
	<li><a href='/admin/creatives'>Creatives</a></li> !-->
</ul>
<br /><br />
<?php 
		echo 'Test: ' . Auth::instance()->get_user()->email;	
}
else
	$this->request->redirect(''); // Redirect to homepage...
	?>
</div>
