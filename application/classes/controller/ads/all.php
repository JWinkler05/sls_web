<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ads_All extends Controller
{
	public function action_index()
	{
		$params = $this->request->query();
		$org_id = $params['org_id'];
		
		$hmvc = Request::factory('http://'.Servers::$api_server.'/creatives?org_id='.trim($org_id))
			->execute();

		$this->response->body($hmvc);
	}
	
}
