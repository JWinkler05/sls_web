<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Locations extends Controller_Template_Cityscape_Default
{
	public function action_index()
		{
		
		$session = Session::instance();

		$querystring = $this->request->query();
		$creative_id = trim(Arr::get($querystring,'id',NULL));

		// Create view for the edit page
		$view = View::factory('pages/admin/creative/locations');
		$view-> creative_id = $creative_id;

		$rules = array ();
                
		$org_id = $session->get('org_id',NULL);

		$form = Formo::form();

		$locations_request_byid = $this -> _get_locations_by_creative($creative_id);//json_decode(Request::factory('api_markets_get/index')->query(array('id' => $id))->execute());
                $locations_request = $this -> _get_locations($org_id);
		$locationArr = array();
                $locationArrAll = array();
		//var_dump($locations_request_byid);die();
		
		if (is_array($locations_request_byid)){
			foreach($locations_request_byid['results'] as $location)
			{
			    $locationArr[$location['location']['id']] = $location['location']['name'];
			}
		}
		
		if (is_array($locations_request) && $locations_request['results'] != null){
			foreach($locations_request['results'] as $location)
			{
				$locationArrAll[$location['location']['id']] = $location['location']['name'];
			}
		}
                
                //Reset the pointer
                reset($locationArr);
                reset($locationArrAll);
		
		if(count($locationArr) > 0){
			$locationArrAll = $this -> _adjust_location_list($locationArrAll, $locationArr);
		}
		
                $form->add_group('location_select', 'select', $locationArrAll, key($locationArrAll), array('label' => 'Location Choice'));
		
		$view-> tblLocation = $locationArr;
		
		if ($form->load()->validate())
		{
			// Get the location ID they want to change to.
			$location_id = $form-> location_select->val();
			//var_dump($location_id);die();
			if(!key_exists($location_id, $locationArr))
			{
				//JAW 3/17/2013 - Changed to get array, then parse for file path and full id
				$this -> _update_creative_location(array(
				    'creative_id' => $creative_id,
				    'location_id' => $location_id
				));
				//http_redirect('admin/creative_locations?id='.$creative_id);
				//JAW 3/24/2013 - Add redirect
				$this->request->redirect('/admin/creative_locations?id='.$creative_id);
			}
			else
			{
				var_dump($location_id); die('IN - STOP');
			}

		}
                
                $form->add('Update', array('type' => 'submit','css' => array('id' => 'btnUpload')));

		// Assign variables to be accessed in the view
		$view->form = $form;
		//$view->creative = $creative;
		// Set over page title in template
		$this-> template-> title = __('smartlocalsocial.com: Upddate the location for a creative.');
		
		// Display view in template
		$this->template->content = $view;
        }
 
        protected function _get_locations_by_creative($creative_id)
        {
            // Execute get to find the locations assigned to a creative
			$request = Request::factory('http://'.Servers::$api_server."/creatives/$creative_id/locations")
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
		
			return json_decode($request->execute(),true);

        }
	
	protected function _get_locations($org_id)
        {
            // Execute request to get all valid locations
			$request = Request::factory('http://'.Servers::$api_server."/locations?org_id=$org_id")
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
			$markets = json_decode($request->execute(),true);
			
			return json_decode($request->execute(),true);
			

        }
	
	protected function _adjust_location_list($baseArr, $fieldArr){
	
		foreach($fieldArr as $tempItem)
		{
			
			if(in_array($tempItem, $baseArr)){
				unset($baseArr[array_search($tempItem, $fieldArr)]);
			}
		}
		return $baseArr;
	}
        
	protected function _update_creative_location($fields)
        {
		$querystring = $this->request->query();
		$creative_id = trim(Arr::get($querystring,'id',$default= NULL));
		//var_dump("Creative ID: " . $creative_id);
		//var_dump($fields);die();
		// Execute request to update creative's location
			$request = Request::factory('http://'.Servers::$api_server."/creatives/$creative_id/locations")
				->method(Request::POST)
				->body(json_encode($fields))
				->headers('Content-Type', 'application/json');
		
			$response = $request->execute();
			//var_dump($request);die();
        }
}
