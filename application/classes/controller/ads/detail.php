<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ads_Detail extends Controller
{
	public function action_index()
	{
		$params = $this->request->query();

		$hmvc = Request::factory('http://'.Servers::$api_server."/creatives/{$params['id']}")
			->execute();

		$this->response->body($hmvc);
	}
	
}
