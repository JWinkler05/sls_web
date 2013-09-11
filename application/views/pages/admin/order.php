<script src="http://code.jquery.com/jquery-1.8.2.js"></script>  
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script> 
<script language="javascript">
$(document).ready(function(){

var xmlhttp;
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    $('#creativeSort').sortable("enable");
    }
  } 
  
			$('#creativeSort').sortable({
				start: function(e, ui) {
				 // temp attr that holds current index
				$(this).attr('data-prev', ui.item.index());
				},
				update: function(event, ui) {
					var newInd = ui.item.index()+1;
					var oldInd = parseInt($(this).attr('data-prev')) + 1;
					$(this).removeAttr('data-prev');
					data = $(this).sortable("serialize")+ "&old=" + oldInd + "&new=" + newInd;
					$(this).sortable("disable");
					
					xmlhttp.open("POST","sortableorderajax/",true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("old=" + oldInd + "&new=" + newInd);
					}
			});
		});	
</script>

<div id="cp_main" class="grid_16">
<?php 
if (!is_array($creatives)) { 
?>
	<div class="noads">
		<p>Sorry, No records exist for this model</p>
	</div>
<?php } ?>
	<br />
			<ul id="creativeSort" class="sortOrdered">
			<?php
			if($creatives) {
			$i = 1;
			foreach ($creatives as $creative) {	
			 echo "<li id='id_" . $creative['creative']['id'] . "'> $i.) " . $creative['creative']['business_name'] . "</li>";
			 $i++;
			 }} ?>
			</ul>

</div>

