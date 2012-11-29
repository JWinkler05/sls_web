<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Homepage extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		View::set_global('menu',TRUE);
		$view = View::factory('pages/home');

		$ads_primary = json_decode(Request::factory('ads_primary/index')->execute());
		$view->ads_primary = $ads_primary->results;
		$ads_secondary = json_decode(Request::factory('ads_secondary/index')->execute());	
		$view->ads_secondary = $ads_secondary->results;

		$view->main_grid = '16';
		$view->main_layout = 'no-sidebar';

		if (is_array($view->ads_secondary)) {
			$view->main_grid = '12';
			$view->main_layout = 'sidebar';
		}

		//$this->response->body($view);
		$this->template->title = __('Welcome to smartlocalsocial.com');
		
		$this->template->content = $view;
	}
	
	public function action_deal()
	{
		View::set_global('menu',TRUE);
		$view = View::factory('pages/home');

		$view->ads_primary = json_decode(Request::factory('ads_primary/index')->execute());
		$view->ads_secondary = json_decode(Request::factory('ads_secondary/index')->execute());	

		$view->main_grid = '16';
		$view->main_layout = 'no-sidebar';

		if (is_array($view->ads_secondary)) {
			$view->main_grid = '12';
			$view->main_layout = 'sidebar';
		}

		//$this->response->body($view);
		$this->template->title = __('Welcome to smartlocalsocial.com');
		
		$this->template->content = $view;
	}
}
