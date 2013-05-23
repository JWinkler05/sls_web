<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Locations extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		if (!Auth::instance()->logged_in('admin')) { 
			$this->request->redirect(''); // Redirect to homepage...
		}
		$locations = NULL;
		View::set_global('menu',TRUE);
		$view = View::factory('pages/admin/locations');
		
		$params = $this->request->query();
		$org_id = $params['org_id'];
		$view -> org_id = $org_id;
		//var_dump($params);die();
		
		$locations = $this->_get_locations($org_id);
		//var_dump($locations['results']);die();
		$view->locations = $locations['results'];
		if(!$locations['results'])
		{
			$view -> locations = NULL;
		}

		//$this->response->body($view);
		$this->template->title = __('Welcome to smartlocalsocial.com');
		
		$this->template->content = $view;
	}
	
	        protected function _get_locations($org_id)
        {
            // Execute get to find the organizations
			$request = Request::factory('http://'.Servers::$api_server.'/locations?org_id='.$org_id)
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
		
			return json_decode($request->execute(),true);

        }
	
}
