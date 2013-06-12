<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Location_Add extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		// Grab the post variables
		$posted = $this->request->post();
		$params = $this -> request -> query();
		
		$org_id = $params['org_id'];
		
		// Create Blank Form
		$form = Formo::form()
			->add('name')
			->add('org_id',
				array('value'=>$org_id,
				    'editable' => FALSE,
				))
			->add('address1')
			->add('address2')
			->add('zip')
			->add('phone1')
			->add('phone2')
			->add('fax')
			->add('website')
			->add('facebook')
			->add('twitter')
			->add('youtube')
			->add('submit', 'submit', array('value'=>'Add',));

		// Logic to execute on a successful post
		if ($form->load($_POST)->validate())
		{
			// Remove submit field if present in the post variables
			$fields = array ('fields' => $posted);
			unset($fields['fields']['submit']);
			$fields['fields']['org_id'] = $org_id;
			//var_dump($fields);die();
			// Execute post request to create record
			$request = Request::factory('http://'.Servers::$api_server.'/locations')
				->method(Request::POST)
				->body(json_encode($fields['fields']))
				->headers('Content-Type', 'application/json');
		
			$response = $request->execute();
			
			$loc = json_decode($response);
			//var_dump($org);die('gg');
			// Redirect to edit page
			$this->request->redirect('/admin/locations?org_id='.$org_id); 
		}

		// Create view for the add page
		$view = View::factory('pages/admin/location/add');

		// Assign variables to be accessed in the view
		$view->form = $form;

		// Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Add new location');
		
		// Display view in template
		$this->template->content = $view;
	}
	
}
