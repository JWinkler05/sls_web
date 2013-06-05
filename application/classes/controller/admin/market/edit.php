<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Market_Edit extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		// Grab the post variables
		$params = $this->request->query();
		$posted = $this->request->post();
		$id = $params['id'];
		
		$market = $this-> _get_market($id);
		
		$market = $market['results'][0]['market'];
		
		// Create Blank Form
		$form = Formo::form()
			->add('market_name',
				array('value' => $market['market_name'],)
				)
			->add('state',
				array('value' => $market['state'],)
				)
			->add('country',
				array('value' => $market['country'],)
				)
			->add('metro',
				array('value' => $market['metro'],)
				)
			->add('submit','submit',array('value'=>'Save'));

		// Logic to execute on a successful post
		if ($form->load($_POST)->validate())
		{
			// Remove submit field if present in the post variables
			$fields = array ('fields' => $posted);
			unset($fields['fields']['submit']);
			
			// Execute put request to create record
			$request = Request::factory('http://'.Servers::$api_server.'/markets/'.$id)
				->method(Request::PUT)
				->body(json_encode($fields['fields']))
				->headers('Content-Type', 'application/json');
			
			$response = $request->execute();
			//var_dump($response);die();
			$market = json_decode($response);

			// Redirect to edit page
			$this->request->redirect('/admin/markets'); 
		}

		// Create view for the add page
		$view = View::factory('pages/admin/market/edit');

		// Assign variables to be accessed in the view
		$view->form = $form;

		// Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Edit a market');
		
		// Display view in template
		$this->template->content = $view;
	}
	
	 protected function _get_market($id)
	 {
            // Execute get to find the market
			$request = Request::factory('http://'.Servers::$api_server.'/markets/'.$id)
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
//			var_dump($request);die();
			$result = json_decode($request->execute(),true);
//			var_dump($result);
			
			return $result;

         }
}
