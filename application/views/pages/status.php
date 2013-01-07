<?php 
if (Auth::instance()->logged_in()) {
	echo 'Welcome '.Auth::instance()->get_user()->user.' '; 
	if (Auth::instance()->logged_in('admin')) { 
		echo '- You have admin access -';
		echo HTML::anchor('admin','Control Panel'). ' - ';
	}
	echo HTML::anchor('session/logout','Logout');
} else {
	echo HTML::anchor('session/login','Login');
}
?>
