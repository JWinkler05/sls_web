<?php
$navigation_links = array(
	'' => 'Home',
	'homepage/contact' => 'Contact Us',
	'test/' => 'Option 3',
	'testing/' => 'Option 4',
);
?>
<ul id="main_menu">
<?php
foreach ($navigation_links as $link => $label) 
{
	$class = '';
	if ($link === Request::current()->uri())
	{
		$class = ' class="selected"';
	}
	if ($link === '' AND  Request::current()->uri() === '/') 
	{
		$class = ' class="selected"';
	}
		
	echo "<li{$class}><a href=\"/{$link}\">{$label}</a></li>" . PHP_EOL;
}
?>
</ul>
