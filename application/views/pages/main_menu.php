<?php
//JAW 4/21/2013 - issue 14 -- Change to match database category names.
$navigation_links = array(
	'' => 'home',
	'?category=Nationwide' => 'nationwide deals',
	'?category=Entertainment' => 'entertainment',
	'?category=Dining%20And%20Food' => 'food and dining',
	'?category=Health%20And%20Beauty' => 'health and beauty',
	'?category=Travel%20And%20Hotel' => 'travel and hotel',
	'?category=Home%20Service' => 'services',
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
