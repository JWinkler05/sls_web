<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Edit extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		$params = $this->request->query();
		$id = $params['id'];

		$view = View::factory('pages/admin/creative/edit');

		$detail_return = json_decode(Request::factory('ads_detail/index')->query('id',$id)->execute());
		$detail = $detail_return->results['0']->creative;
		$view->selected = $detail;
		$view->id = $id; 
		//$this->response->body($view);
		$this->template->title = __('smartlocalsocial.com: ' . $detail->business_name . $detail->offer_in_short);
		
		$this->template->content = $view;
	}
	
}
