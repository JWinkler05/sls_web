<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ads_Detail extends Controller
{
	public function action_index()
	{
		if (Kohana::$environment === Kohana::PRODUCTION){
			$api_server = 'api.smartlocalsocial.com';
		}else{
			$api_server = 'devapi.smartlocalsocial.com';
		}
		
		$params = $this->request->query();

		$hmvc = Request::factory("http://$api_server/creatives/get_details_by_id?di={$params['di']}")
			->execute();

		$this->response->body($hmvc);
	}
	
}
