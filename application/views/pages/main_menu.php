<?php
$navigation_links = array(
	'' => 'all deals',
	'?category=nationwide' => 'nationwide deals',
	'?category=entertainment' => 'entertainment',
	'?category=dining%20and%20food' => 'food and dining',
	'?category=Health%20and%20Beauty' => 'health and beauty',
	'?category=Collectibles' => 'travel and hotel',
	'?category=Personal%20Care' => 'home services',
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
