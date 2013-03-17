<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Add extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		// Grab the post variables
		$posted = $this->request->post();

		// Create Blank Ad Object
		$creative = new stdClass;
		$creative->metro = NULL;
		$creative->market_name = NULL;
		$creative->state = NULL;
		$creative->country = NULL;
		
		// Create Blank Form
		$form = Formo::form()
			->add('market_name')
			->add('state')
			->add('offer_in_short')
			->add('list_price')
			->add('submit','submit',array('value'=>'Submit Changes'));

		// Logic to execute on a successful post
		if ($form->load($_POST)->validate())
		{
			// Remove submit field if present in the post variables
			$fields = array ('fields' => $posted);
			unset($fields['fields']['submit']);
			
			$fields['fields']['ad_size'] = 1;

			// Execute put request to create record
			$request = Request::factory('http://'.Servers::$api_server.'/creatives')
				->method(Request::POST)
				->body(json_encode($fields))
				->headers('Content-Type', 'application/json');
		
			$response = $request->execute();
			
			$creative = json_decode($response);

			// Parse response for creative id
			$creative_id = $creative->results->creative->creative_id;

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
