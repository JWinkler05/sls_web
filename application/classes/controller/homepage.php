<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Homepage extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		// Get the session instance
		$session = Session::instance();
		$full_ads = NULL;
		View::set_global('menu',TRUE);
		$view = View::factory('pages/home');
		$params = $this->request->query();
		$ads_primary = json_decode(Request::factory('ads_primary/index')->query($params)->execute());
		$view->ads_primary = $ads_primary->results;
		if (!is_array($ads_primary)) {
			$full_ads = json_decode(Request::factory('ads_primary/index')->execute());
		}
		$ads_secondary = json_decode(Request::factory('ads_secondary/index')->query($params)->execute());	

		// Set view variables for ad results and layout
		$view->full_ads = $full_ads->results;
		$view->ads_secondary = $ads_secondary->results;
		$view->main_grid = '16';
		$view->main_layout = 'no-sidebar';

		// Pass session to view
		$view->session = $session;
		if (is_array($view->ads_secondary)) {
			$view->main_grid = '12';
			$view->main_layout = 'sidebar';
		}

		//$this->response->body($view);
		$this->template->title = __('Welcome to smartlocalsocial.com');
		
		$this->template->content = $view;
	}
	
}
