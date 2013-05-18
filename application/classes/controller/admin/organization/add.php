<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Organization_Add extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		// Grab the post variables
		$posted = $this->request->post();

		// Create Blank Form
		$form = Formo::form()
			->add('org_name')
			->add('org_addr')
			->add('org_city')
			->add('org_state')
			->add('org_zip')
			->add('submit','submit',array('value'=>'Add'));

		// Logic to execute on a successful post
		if ($form->load($_POST)->validate())
		{
			// Remove submit field if present in the post variables
			$fields = array ('fields' => $posted);
			unset($fields['fields']['submit']);

			// Execute put request to create record
			$request = Request::factory('http://'.Servers::$api_server.'/organizations')
				->method(Request::POST)
				->body(json_encode($fields['fields']))
				->headers('Content-Type', 'application/json');
		
			$response = $request->execute();
			
			$org = json_decode($response);
			//var_dump($org);die('gg');
			// Redirect to edit page
			$this->request->redirect('/admin/organizations'); 
		}

		// Create view for the add page
		$view = View::factory('pages/admin/organization/add');

		// Assign variables to be accessed in the view
		$view->form = $form;

		// Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Add new organization');
		
		// Display view in template
		$this->template->content = $view;
	}
	
}
