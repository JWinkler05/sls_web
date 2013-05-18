<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Organization_Edit extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		// Grab the post variables
		$params = $this->request->query();
		$posted = $this->request->post();
		$id = $params['org_id'];
		
		$orgs = $this-> _get_organizations($id);
		$org = $orgs['results'][0]['organization'];
		//var_dump($org['org_id']);die();
		
		// Create Blank Form
		$form = Formo::form()
			->add('org_id',
				array('value' => $org['org_id'],
				    'editable' => FALSE,)
				)
			->add('org_name',
				array('value' => $org['org_name'],)
				)
			->add('org_addr',
				array('value' => $org['org_addr'],)
				)
			->add('org_city',
				array('value' => $org['org_city'],)
				)
			->add('org_state',
				array('value' => $org['org_state'],)
				)
			->add('org_zip',
				array('value' => $org['org_zip'],)
				)
			->add('submit','submit',array('value'=>'Save'));

		// Logic to execute on a successful post
		if ($form->load($_POST)->validate())
		{
			// Remove submit field if present in the post variables
			$fields = array ('fields' => $posted);
			unset($fields['fields']['submit']);

			// Execute put request to create record
			$request = Request::factory('http://'.Servers::$api_server.'/organizations/'.trim($id))
				->method(Request::PUT)
				->body(json_encode($fields['fields']))
				->headers('Content-Type', 'application/json');
		
			$response = $request->execute();
			//var_dump($response);die();
			$org = json_decode($response);
			//var_dump($org);die('gg');
			// Redirect to edit page
			$this->request->redirect('/admin/organizations'); 
		}

		// Create view for the add page
		$view = View::factory('pages/admin/organization/edit');

		// Assign variables to be accessed in the view
		$view->form = $form;

		// Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Edit an organization');
		
		// Display view in template
		$this->template->content = $view;
	}
	
	 protected function _get_organizations($id)
         {
            // Execute get to find the organizations
			$request = Request::factory('http://'.Servers::$api_server.'/organizations/'.trim($id))
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
		
			return json_decode($request->execute(),true);

         }
}
