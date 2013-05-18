<?php 
if (Auth::instance()->logged_in()) {
	echo HTML::anchor('session/logout','Logout',array('class'=>'status_button status_right'));
	echo 'Welcome '.Auth::instance()->get_user()->email.': '; 
	if (Auth::instance()->logged_in('admin')) { 
		echo HTML::anchor('admin','Admin Control Panel',array('class'=>'status_button'));
	}
	//JAW - 5/17/2013 - Comment out until user auth and interface complete.
//	elseif (Auth::instance()->logged_in('member')) { 
//		echo HTML::anchor('admin','My Account',array('class'=>'status_button'));
//	}
} else {
	//JAW 4/21/2013 - issue 19 -- Add register button.
	echo HTML::anchor('session/registration','Register',array('class'=>'status_button status_right'));
	echo HTML::anchor('session/login','Login',array('class'=>'status_button status_right'));
}
?>
