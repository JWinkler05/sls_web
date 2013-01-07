<div id="cp_main_content" class="grid_16 no-sidebar">
	<div class="grid_6">
		<p>Edit Details</p><br/>
<?php
$attr = array('width' => '23px');
echo $form = Formo::form()
	->add(
		'creative_id',
		array(
			'value'=>$selected->creative_id,
			'editable'=>FALSE,
			$attr
		)
	)
	->add(
		'ad_type',
		array(
			'value'=>$selected->ad_type,
			$attr
		)
	)
	->add(
		'business_name',
		array(
			'value'=>$selected->business_name,
			$attr
		)
	)
	->add(
		'offer_in_short',
		array(
			'value'=>$selected->offer_in_short,
			$attr
		)
	)
	->add(
		'list_price',
		array(
			'value'=>$selected->list_price,
			$attr
		)
	)
	->add(
		'coupon_price',
		array(
			'value'=>$selected->coupon_price,
			$attr
		)
	)
	->add(
		'sms_code',
		array(
			'value'=>$selected->sms_code,
			$attr
		)
	)
	->add(
		'description',
		'textarea',
		array(
			'value'=>$selected->description,
			$attr
		)
	)
	->add(
		'detailed_offer',
		'textarea',
		array(
			'value'=>$selected->detailed_offer,
			$attr
		)
	)
	->add(
		'submit',
		'submit',
		array(
			'value'=>'Submit Changes',
			$attr
		)
	);
	if ($form->load($_POST)->validate())
	{
		$fields = array ('fields' => $posted);
		unset($fields['fields']['submit']);
		if (Kohana::$environment === Kohana::PRODUCTION){
			$api_server = 'api.smartlocalsocial.com';
			$web_server = 'www.smartlocalsocial.com';
		}else{
			$api_server = 'devapi.smartlocalsocial.com';
			$web_server = 'devwww.smartlocalsocial.com';
		}
		$request = Request::factory("http://$api_server/creatives/{$selected->creative_id}")
			->method(Request::PUT)
			->body(json_encode($fields))
			->headers('Content-Type', 'application/json');

		$response = $request->execute();
		sleep(1);
?>
<script type="text/javascript">
<!--
window.location = "<?php echo "http://$web_server/admin_creative_edit?id={$selected->creative_id}?updated"?>"
//-->
</script>
<?php
	}
?>
	</div>
	<p>Single Column Ad preview</p>
	<div class="grid_4 ad_single">
		<div class="ad_type"><?php echo $selected->ad_type ?></div>
		<img class="ad_image" src="<?php echo "/media/ad_images/{$selected->ad_image_name}" ?>"/>
		<div class="ad_body">
			<div class="ad_business_name"><?php echo $selected->business_name; ?></div>
			<div class="ad_offer_short"><?php echo $selected->offer_in_short; ?></div>
			<div class="ad_list_price"><?php echo $selected->list_price; ?></div>
			<div class="ad_coupon_price"><?php echo $selected->coupon_price; ?></div>
			<div class="ad_sms_code"><?php echo $selected->sms_code; ?></div>
		</div>
	</div>
	<div class="grid_16 outergray">
	<p>Full Size Detail preview</p>
		<div class="innerwhite">
			<div class="column grid_4 detail_offset">
				<h2><?php echo $selected->business_name; ?></h2>
				<p><?php echo $selected->description; ?></p>
				<p><?php echo $selected->sms_code; ?></p>
			</div>
			<div class="mainimg grid_8">
				<img width="450" height="328" alt="image" src="<?php echo "/media/ad_images/{$selected->ad_image_name}" ?>">
			</div>
			<div class="columnafter grid_4 detail_offset">
				<p>Offer Details</p>
				<p class="advdeal"><?php echo $selected->detailed_offer; ?></p>
				<p>Regular Price</p>
				<p class="regprice"><?php echo $selected->list_price; ?></p>
				<p>Sale Price</p>
				<p class="saleprice"><?php echo $selected->coupon_price; ?></p>
			
			</div>
		</div>
	</div>
		<?php
/* 
echo '<br/>'.$selected->id;
echo '<br/>'.$selected->ad_type;
echo '<br/>'.$selected->ad_size;
echo '<br/>'.$selected->image_location;
echo '<br/>'.$selected->location_specific;
echo '<br/>'.$selected->location_city;
echo '<br/>'.$selected->business_name;
echo '<br/>'.$selected->offer_in_short;
echo '<br/>'.$selected->list_price;
echo '<br/>'.$selected->coupon_price;
echo '<br/>'.$selected->sms_code;
echo '<br/>'.$selected->category_id;
echo '<br/>'.$selected->specific_category;
echo '<br/>'.$selected->savings;
echo '<br/>'.$selected->expiration;
echo '<br/>'.$selected->description;
echo '<br/>'.$selected->detailed_offer;
echo '<br/>'.$selected->ad_image_name;
echo '<br/>'.$selected->company_logo_image_name;
*/
		?>

</div>
