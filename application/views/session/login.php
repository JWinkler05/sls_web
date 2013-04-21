<div id="cp_main_content" class="grid_16 no-sidebar">
<p>Enter your email and password to login</p>
<?php $form = Formo::form()
	->add('email')
	->add('password','password')
	->add('submit','submit',array('value'=>'Login'));
echo $form;
if ($error) {
	echo '<span class="error-message">'.$error.'</span>';
}
?>
</div>
