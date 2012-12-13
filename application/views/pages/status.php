<?php
if (Auth::instance()->logged_in()) { ?>
Welcome <?php echo Auth::instance()->get_user()->user.' '; 
	if (Auth::instance()->logged_in('admin')) { ?>
* You have admin access *
<?php	}
echo HTML::anchor('admin','Control Panel'). ' - ';
echo HTML::anchor('session/logout','Logout');
} else {
echo HTML::anchor('session/login','Login');
}
?>
