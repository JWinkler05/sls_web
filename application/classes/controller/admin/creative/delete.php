<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Delete extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		$params = $this->request->query();
		$id = $params['id'];

		View::set_global('menu',TRUE);
		$view = View::factory('pages/deal_detail');

		var_dump($params);
	}
	
}
