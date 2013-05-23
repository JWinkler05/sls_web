<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Organizations extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		//if (!Auth::instance()->logged_in('member'))
		if (!Auth::instance()->logged_in('admin')) { 
			$this->request->redirect(''); // Redirect to homepage...
		}
		View::set_global('menu',TRUE);
		$view = View::factory('pages/admin/organizations');

		$tblOrg = $this -> _get_organizations();
		//var_dump($tblOrg['results']);die();
		//$view -> org_id = 1;
		$view-> tblOrg = $tblOrg['results'];
		$view-> email = Auth::instance()->get_user()->email;
		
		//$this->response->body($view);
		$this->template->title = __('Welcome to smartlocalsocial.com');
		
		$this->template->content = $view;
	}

        protected function _get_organizations()
        {
            // Execute get to find the organizations
			$request = Request::factory('http://'.Servers::$api_server.'/organizations/')
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
		
			return json_decode($request->execute(),true);

        }
}
