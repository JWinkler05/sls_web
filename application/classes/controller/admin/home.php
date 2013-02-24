<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Home extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		if (!Auth::instance()->logged_in('admin')) { 
			$this->request->redirect(''); // Redirect to homepage...
		}
		$full_ads = NULL;
		View::set_global('menu',TRUE);
		$view = View::factory('pages/admin/home');
		$this->template->title = __('Welcome to smartlocalsocial.com');
		
		$this->template->content = $view;
	}
	
}
