<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Markets extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		//if (!Auth::instance()->logged_in('member'))
		if (!Auth::instance()->logged_in('admin')) { 
			$this->request->redirect(''); // Redirect to homepage...
		}
		View::set_global('menu',TRUE);
		$view = View::factory('pages/admin/markets');

		$tblMarket = $this -> _get_markets();
		
		$view-> tblMarket = $tblMarket['results'];
		$view-> email = Auth::instance()->get_user()->email;
		
		//$this->response->body($view);
		$this->template->title = __('Welcome to smartlocalsocial.com');
		
		$this->template->content = $view;
	}

        protected function _get_markets()
        {
            // Execute get to find the organizations
			$request = Request::factory('http://'.Servers::$api_server.'/markets/')
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
		
			return json_decode($request->execute(),true);

        }
}
