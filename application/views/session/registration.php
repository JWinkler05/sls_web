<div id="cp_main_content" class="grid_16 no-sidebar">
<p>Please enter the required info to register.</p>
<?php $form = Formo::form()
	->add('email')
	->add('password','password')
	->add('phone')
	->add('first_name')
	->add('last_name')
	->add('address1')
	->add('address2')
	->add('city')
	->add('state')
	->add('zip')
	->add('submit','submit',array('value'=>'Register'));
//JAW - 4/29/2013 - issue 19 -- Show above form, easier to read.
if ($error) {
	echo '<span class="error-message">'.$error.'</span>';
}

echo $form;

?>
</div>