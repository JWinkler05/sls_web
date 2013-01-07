<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Deal_Detail extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		$params = $this->request->query();
		$id = $params['id'];

		View::set_global('menu',TRUE);
		$view = View::factory('pages/deal_detail');

		$detail_return = json_decode(Request::factory('ads_detail/index')->query('id',$id)->execute());
		$detail = $detail_return->results['0']->creative;
		$view->selected = $detail;
		$view->id = $id; 
		$ads_primary = json_decode(Request::factory('ads_primary/index')->execute());
		$view->ads = $ads_primary->results; 
		$view->main_grid = '16';
		$view->main_layout = 'no-sidebar';		
		//$this->response->body($view);
		$this->template->title = __('smartlocalsocial.com: ' . $detail->business_name . $detail->offer_in_short);
		
		$this->template->content = $view;
	}
	
}
