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
		
		$metrolist = $this->get_metro_list();
		
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
	
	private function get_metro_list() {
		// Get metro/city if a session variable is not already set
		$metro_code = $session->get('visitor_metro',NULL);
		$city = $session->get('visitor_city',NULL);

		if (!isset($metro_code)) {
			// Get the IP in long format
			$ip_long    = intval(sprintf("%u", ip2long(Request::$client_ip)));

			// Instantiate the IP models
			$blocks     = new Mongo_Collection('blocks');
			$location   = new Mongo_Collection('location');

			// Get the location ID for this IP
			$block_result       = $blocks->findOne(array('end_ip_number' => array('$gte' => $ip_long)), array('location_id' => 1));

			// Get the location information
			$location_result    = $location->findOne(array('location_id' => $block_result['location_id']), array('city','metro_code'));
			print_r($location_result);die();
			// Set the metro code / city
			//$metro_code = $location_result['metro_code'];
			
			return true;
		}
	}
	
}
