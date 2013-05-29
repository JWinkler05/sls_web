<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Add extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		// Grab the post variables
		$posted = $this->request->post();
		//Get Params
		$params = $this->request->query();
		//var_dump($params);die();
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
		$creative->website = NULL;
		$creative->facebook = NULL;
		$creative->twitter = NULL;
		$creative->org_id = $params['org_id'];

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
//			->add('website')
//			->add('facebook')
//			->add('twitter')
			->add('org_id',
				array('value'=>$params['org_id'],
				    'editable' => FALSE,
				))
			->add('submit','submit',array('value'=>'Submit Changes'));

		// Logic to execute on a successful post
		if ($form->load($_POST)->validate())
		{
			// Remove submit field if present in the post variables
			$fields = array ('fields' => $posted);
			unset($fields['fields']['submit']);
			
//			$website = array('fields' => array("website" => $fields['fields']['website']));
//			//var_dump($website);var_dump($fields);
//			unset($fields['fields']['website']);
			
			$fields['fields']['ad_size'] = 1;
			$fields['fields']['org_id'] = $params['org_id'];
			//var_dump($fields);
			// Execute put request to create record
			$request = Request::factory('http://'.Servers::$api_server.'/creatives')
				->method(Request::POST)
				->body(json_encode($fields))
				->headers('Content-Type', 'application/json');
		
			//var_dump('http://'.Servers::$api_server.'/creatives');
			//var_dump(json_encode($fields));
			$response = $request->execute();
			//var_dump($response);die('HERE');
			$creative = json_decode($response);
			//var_dump($creative);die();
			// Parse response for creative id
			$creative_id = $creative->results->creative->creative_id;
			
//			// Execute put request to update record
//			$request2 = Request::factory('http://'.Servers::$api_server."/locations/{$detail->location_id}")
//				->method(Request::PUT)
//				->body(json_encode($website))
//				->headers('Content-Type', 'application/json');
//		
//			$response2 = $request2->execute();

			// Redirect to edit page
			$this->request->redirect('/admin/creative_edit?id='.$creative_id); 
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
