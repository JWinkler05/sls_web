<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Market_Delete extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		$params = $this->request->query();
		$market_id = trim(arr::get($params, 'id', $default = NULL));

		View::set_global('menu',TRUE);
		$view = View::factory('pages/admin/market/delete');

		//This will call the function to delete the market from the creative
		//var_dump($org_id);die();
               $result = $this -> _delete_market($market_id);
               
	       $view -> result = $result;
                // Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Delete a market');
		
		// Display view in template
		$this->template->content = $view;
	}
        
        protected function _delete_market($id)
        {
		////var_dump($creative_id . ":" . $market_id);
            // Execute delete request to delete record
               $request = Request::factory('http://'.Servers::$api_server."/markets/".$id)
			->method(Request::DELETE)
			->headers('Content-Type', 'application/json');
		//var_dump('http://'.Servers::$api_server."/creatives/".$creative_id."/markets/".$market_id);
		//var_dump($request);die();
			return $request->execute();
			
        }
	
}
