<?php defined('SYSPATH') or die('No direct script access.');
//TODO::Add back button
//TODO::Add spacing below submit
//TODO::Format page better
//TODO::Add links to top of page (images,markets,tags,categories)
class Controller_Admin_Location_Edit extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		// Grab the querystring and post variables
		$params = $this->request->query();
		$posted = $this->request->post();
		
		// Id of record being edited
		$id = $params['id'];
		
		//Create base location
		
		
		// Retrieve record details by id
		$location_return = $this ->_get_location($id);
		$location = $location_return['results'][0]['location'];
		
		//var_dump($location);die($id);
		// Create Form with record details
		$form = Formo::form()
			->add('location_id',
				array('value'=> $location['location_id'],
					'editable'=>FALSE,
				)
			)
			->add('org_id',
				array('value'=>$location['org_id'],
				    'editable' => FALSE,
				)
			)
			->add('name',
				array('value'=>$location['name'],
				)
			)
			->add('address1',
				array('value'=>$location ['address1'],
				)
			)
			->add('address2',
				array('value'=>$location ['address2'],
				)
			)
			->add('zip',
				array('value'=>$location ['zip'],
				)
			)
			->add('phone1',
				array('value'=>$location ['address1'],
				)
			)
			->add('phone2',
				array('value'=>$location  ['address2'],
				)
			)
			->add('fax',
				array('value'=>$location ['fax'],
				)
			)
			->add('website',
				array('value'=>$location ['website'],
				)
			)
			->add('facebook',
				array('value'=>$location ['facebook'],
				)
			)
			->add('twitter',
				array('value'=>$location ['twitter'],
				)
			)
			->add('submit',
				'submit',
				array('value'=>'Submit Changes',
				)
			);

		// Logic to execute on a successful post
		if ($form->load($_POST)->validate())
		{
			// Remove submit field if present in the post variables
			$fields = array ('fields' => $posted);
			unset($fields['fields']['submit']);
			$website = array('fields' => array("website" => $fields['fields']['website']));
			//var_dump($website);var_dump($fields);
			
			// Execute put request to update record
			$request = Request::factory('http://'.Servers::$api_server."/locations/{$location['location_id']}")
				->method(Request::PUT)
				->body(json_encode($fields))
				->headers('Content-Type', 'application/json');
			$response = $request->execute();
			//var_dump($request);die();
			//var_dump($response);die();
			// Redirect to this page, updates current data, removes chance
			// of double posts as well
			$this->request->redirect($this->request->uri().'?id='.$location['location_id']); 
		}

		// Create view for the edit page
		$view = View::factory('pages/admin/location/edit');

		// Assign variables to be accessed in the view
		$view->form = $form;
		$view->location = $location;
		$view->id = $id; 
		$view->posted = $posted;

		// Set over page title in template
		$this->template->title = __('smartlocalsocial.com: ' . $location['name']);
		
		// Display view in template
		$this->template->content = $view;
	}	
	
	        protected function _get_location($location_id)
        {
            // Execute get to find the categories assigned to a creative
			$request = Request::factory('http://'.Servers::$api_server."/locations/$location_id")
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
		
			return json_decode($request->execute(),true);

        }
}
