<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Market_Add extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		// Grab the post variables
		$posted = $this->request->post();

		// Create Blank Ad Object
		$market = new stdClass;
		$market->metro = NULL;
		$market->market_name = NULL;
		$market->state = NULL;
		$market->country = NULL;
		
		// Create Blank Form
		$form = Formo::form()
			->add('market_name')
			->add('state')
			->add('country')
			->add('metro')
			->add('submit','submit',array('value'=>'Submit Changes'));

		// Logic to execute on a successful post
		if ($form->load($_POST)->validate())
		{
			// Remove submit field if present in the post variables
			$fields = array ('fields' => $posted);
			unset($fields['fields']['submit']);
			
			$fields['fields']['ad_size'] = 1;

			// Execute put request to create record
			$request = Request::factory('http://'.Servers::$api_server.'/markets')
				->method(Request::POST)
				->body(json_encode($fields))
				->headers('Content-Type', 'application/json');
		
			$response = $request->execute();
			
			$market = json_decode($response);
			//var_dump($market);die();
			// Parse response for market id
			$market_id = $market->results[1]->id;

			// Redirect to edit page
			$this->request->redirect('/admin_market_edit?id='.$market_id); 
		}

		// Create view for the edit page
		$view = View::factory('pages/admin/market/edit');

		// Assign variables to be accessed in the view
		$view->form = $form;
		$view->market = $market;

		// Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Add a new market');
		
		// Display view in template
		$this->template->content = $view;
	}
	
}
