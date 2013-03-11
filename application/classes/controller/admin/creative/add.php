<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Add extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		// Grab the post variables
		$posted = $this->request->post();

		// Create Blank Ad Object
		$creative = new stdClass;
		$creative->ad_type = NULL;
		$creative->ad_size = 1;
		$creative->ad_image_name = NULL;
		$creative->business_name = NULL;
		$creative->offer_in_short = NULL;
		$creative->list_price = NULL;
		$creative->coupon_price = NULL;
		$creative->sms_code = NULL;
		$creative->description = NULL;
		$creative->detailed_offer = NULL;

		// Create Blank Form
		$form = Formo::form()
			->add('ad_type')
			->add('business_name')
			->add('offer_in_short')
			->add('list_price')
			->add('coupon_price')
			->add('sms_code')
			->add('description','textarea')
			->add('detailed_offer','textarea')
			->add('submit','submit',array('value'=>'Submit Changes'));

		// Logic to execute on a successful post
		if ($form->load($_POST)->validate())
		{
			// Remove submit field if present in the post variables
			$fields = array ('fields' => $posted);
			unset($fields['fields']['submit']);

			// Execute put request to create record
			//$request = Request::factory("http://$api_server/creatives/{$detail->creative_id}")
			//	->method(Request::PUT)
			//	->body(json_encode($fields))
			//	->headers('Content-Type', 'application/json');
		
			//$response = $request->execute();

			// Parse response for creative id
			$creative_id = 'abc';

			// Redirect to edit page
			$this->request->redirect('/admin_creative_edit?id='.$creative_id); 
		}

		// Create view for the edit page
		$view = View::factory('pages/admin/creative/edit');

		// Assign variables to be accessed in the view
		$view->form = $form;
		$view->creative = $creative;
		$view->ad_image = NULL;
		$view->detail_image = NULL;

		// Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Add new creative');
		
		// Display view in template
		$this->template->content = $view;
	}
	
}
