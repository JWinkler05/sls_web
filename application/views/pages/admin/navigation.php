
<div id="cp_main" class="grid_16">
	<br/>
	<ul>
		<!-- JAW 4/7/2013 - Navigation -->
		<?php
		if (isset($_GET['id']))
			{
			$creative_id = $_GET['id'];
		echo '<li><div>';
		echo	'<div class="">' ; 
		echo	"<a href='creative_edit?id=$creative_id'>Edit</a> |"; 
		echo	"<a href='creative_images?id=$creative_id'>Images</a> |"; 
		echo	"<a href='creative_markets?id=$creative_id'>Markets</a> |"; 
		echo	"<a href='creative_categories?id=$creative_id'>Categories</a> | ";
		echo	"<a href='creative_tags?id=$creative_id'>Tags</a> | ";
		echo	"<a href='creative_delete?id=$creative_id'>Delete</a> ";
		echo	'</div>';
		echo '</div></li>'; 
		
		echo '<li><a href="/admin/Creatives">Go Back To Creatives</a></li>';	
		}
		?>
		<li><a href="/admin/">Main Menu</a></li>
	</ul>
	<br/>
</div>