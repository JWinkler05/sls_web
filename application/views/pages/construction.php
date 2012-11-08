<h2>Welcome to smartLOCALsocial.com</h2>
<br/>
<br/>
<h1>Coming Soon!</h1>
<br/>
<br/>
<p>For more information please contact: <?php echo Html::mailto('sales@smartlocalsocial.com'); ?></p>
<br/>
<!-- <?php echo Html::anchor(
	'homepage/contact',
	'Contact Page',
	array(
		'id'=>1,
		'class'=>'style_me',
	)
); ?> -->
<?php
if (Kohana::PRODUCTION) {
echo "
<script>
function Redirect(url)
{
 location.href = url;
}
Redirect ('http://www.getdeals.mobi');
</script>
";
}

