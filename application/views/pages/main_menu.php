<?php
$navigation_links = array(
	'' => 'all deads',
	'homepage/contact' => 'nationwide deals',
	'test/' => 'entertainment',
	'testing/' => 'food and dining',
	'testing2/' => 'health and beauty',
	'testing3/' => 'travel and hotel',
	'testing4/' => 'home services',
);
?>
<ul>
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
