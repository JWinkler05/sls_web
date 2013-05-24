<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creatives extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		if (!Auth::instance()->logged_in('admin')) { 
			$this->request->redirect(''); // Redirect to homepage...
		}
		$session = Session::instance();

		$full_ads = NULL;
		View::set_global('menu',TRUE);
		$view = View::factory('pages/admin/creatives');
		$params = $this->request->query();
		$org_id = $params['org_id'];
		$session->set('org_id',trim($org_id));
		$view -> org_id = $org_id;
		//var_dump($params);die();
		$ads_all = json_decode(Request::factory('ads_all/index?org_id='. trim($org_id))->execute());
		//var_dump($ads_all);die();
		$view->ads = $ads_all->results;
		if(!$ads_all->results)
		{
			$view -> full_ads = NULL;
		}

		//$this->response->body($view);
		$this->template->title = __('Welcome to smartlocalsocial.com');
		
		$this->template->content = $view;
	}
	
}
