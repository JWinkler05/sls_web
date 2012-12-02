<?php
$navigation_links = array(
	'' => 'all deals',
	'?category=nationwide' => 'nationwide deals',
	'?category=entertainment' => 'entertainment',
	'?category=dining%20and%20food' => 'food and dining',
	'?category=health%20and%20beauty' => 'health and beauty',
	'?category=travel%20and%20hotel' => 'travel and hotel',
	'?category=home%20services' => 'home services',
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
