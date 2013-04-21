<?php 
if (Auth::instance()->logged_in()) {
	echo HTML::anchor('session/logout','Logout',array('class'=>'status_button status_right'));
	echo 'Welcome '.Auth::instance()->get_user()->email.': '; 
	if (Auth::instance()->logged_in('admin')) { 
		echo HTML::anchor('admin','Control Panel',array('class'=>'status_button'));
	}
} else {
	echo HTML::anchor('session/login','Login',array('class'=>'status_button status_right'));
}
?>
