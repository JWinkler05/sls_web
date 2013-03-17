<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Markets extends Controller_Template_Cityscape_Default
{
	public function action_index()
		{
		
		$querystring = $this->request->query();
		$creative_id = Arr::get($querystring,'id',NULL);

		// Create view for the edit page
		$view = View::factory('pages/admin/markets');
		$view-> creative_id = $creative_id;

		// TODO::need to fix validation of image uploads
		// Rule definitions for image forms
		$rules = array ();
                
		$form = Formo::form();

		$markets_request_byid = $this -> _get_markets_by_creative($creative_id);//json_decode(Request::factory('api_markets_get/index')->query(array('id' => $id))->execute());
                $markets_request = $this -> _get_markets();
		$marketArr = array();
                $marketArrAll = array();
		//var_dump($markets_request);die();
		
		if (is_array($markets_request_byid)){
			foreach($markets_request_byid['results'] as $market)
			{
			    $marketArr[$market['market']['id']] = $market['market']['market_name'];
			}
		}
		
		if (is_array($markets_request)){
			foreach($markets_request['results'] as $market)
			{
				$marketArrAll[$market['market']['id']] = $market['market']['market_name'];
			}
		}
                
                //Reset the pointer
                reset($marketArr);
                reset($marketArrAll);
		
		if(count($marketArr) > 0){
			$marketArrAll = $this -> _adjust_market_list($marketArrAll, $marketArr);
		}
		
                $form->add_group('market_select', 'select', $marketArrAll, key($marketArrAll), array('label' => 'Market Choice'));
		
		$view-> tblMarket = $marketArr;
		
		if ($form->load()->validate())
		{
			// Get the market ID they want to change to.
			$market_id = $form-> market_select->val();
			
			if(!key_exists($market_id, $marketArr))
			{
				//JAW 2/17/2013 - Changed to get array, then parse for file path and full id
				$this -> _update_creative_market($creative_id, $market_id);
				die('DEATH');
				//http_redirect('admin/creative_markets?id='.$creative_id);
			}
			else
			{
				var_dump($market_id); die('IN - STOP');
			}

		}
                
                $form->add('Update', array('type' => 'submit','css' => array('id' => 'btnUpload')));

		// Assign variables to be accessed in the view
		$view->form = $form;
		//$view->creative = $creative;
		// Set over page title in template
		$this-> template-> title = __('smartlocalsocial.com: Upddate the market for a creative.');
		
		// Display view in template
		$this->template->content = $view;
        }
 
        protected function _get_markets_by_creative($creative_id)
        {
            // Execute get to find the markets assigned to a creative
			$request = Request::factory('http://'.Servers::$api_server."/creatives/$creative_id/markets")
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
		
			return json_decode($request->execute(),true);

        }
	
	protected function _get_markets()
        {
            // Execute request to get all valid markets
			$request = Request::factory('http://'.Servers::$api_server."/markets/")
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
			$markets = json_decode($request->execute(),true);
			
			return json_decode($request->execute(),true);
			

        }
	
	protected function _adjust_market_list($baseArr, $fieldArr){
	
		foreach($fieldArr as $tempItem)
		{
			var_dump($tempItem);
			
			if(in_array($tempItem, $baseArr)){
				unset($baseArr[array_search($tempItem, $fieldArr)]);
			}
		}
		return $baseArr;
	}
        
	protected function _update_creative_market($creative_id, $market_id)
        {
		
		// Execute request to get all valid markets
			$request = Request::factory('http://'.Servers::$api_server."/markets/$creative_id/markets/$market_id")
				->method(Request::PUT)
				->headers('Content-Type', 'application/json');
		
			return json_decode($request->execute(),true);
        }
}
