<?php 
if (Auth::instance()->logged_in()) {
	echo HTML::anchor('session/logout','Logout',array('class'=>'status_button status_right'));
	echo 'Welcome '.Auth::instance()->get_user()->email.': '; 
	if (Auth::instance()->logged_in('admin')) { 
		echo HTML::anchor('admin','Control Panel',array('class'=>'status_button'));
	}
} else {
	//JAW 4/21/2013 - issue 19 -- Add register button.
	echo HTML::anchor('session/registration','Register',array('class'=>'status_button status_right'));
	echo HTML::anchor('session/login','Login',array('class'=>'status_button status_right'));
}
?>
