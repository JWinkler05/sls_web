<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creatives extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		$full_ads = NULL;
		View::set_global('menu',TRUE);
		$view = View::factory('pages/admin/creatives');
		$params = $this->request->query();
		$ads_all = json_decode(Request::factory('ads_all/index')->execute());
		$view->ads_primary = $ads_all->results;

		//$this->response->body($view);
		$this->template->title = __('Welcome to smartlocalsocial.com');
		
		$this->template->content = $view;
	}
	
}
