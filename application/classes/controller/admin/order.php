<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Order extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		if (!Auth::instance()->logged_in('admin')) { 
			$this->request->redirect(''); // Redirect to homepage...
		}
		$creatives = NULL;
		View::set_global('menu',TRUE);
		$view = View::factory('pages/admin/order');
		
		$creatives = $this->_get_creatives();
		
		if(!$creatives['results'])
		{
			$view -> creatives = NULL;
		} else {
			$view->creatives = $creatives['results'];
		}

		//$this->response->body($view);
		$this->template->title = __('Welcome to smartlocalsocial.com');
		
		$this->template->content = $view;
	}
	
	        protected function _get_creatives()
        {
            // Execute get to find the organizations
			$request = Request::factory('http://'.Servers::$api_server.'/creatives')
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
		
			return json_decode($request->execute(),true);

        }
	
}
