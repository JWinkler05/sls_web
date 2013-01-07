<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ads_All extends Controller
{
	public function action_index()
	{
		$params = $this->request->query();

		if (Kohana::$environment === Kohana::PRODUCTION){
			$api_server = 'api.smartlocalsocial.com';
		}else{
			$api_server = 'devapi.smartlocalsocial.com';
		}

		$hmvc = Request::factory("http://$api_server/creatives/get_all_creatives")
			->execute();

		$this->response->body($hmvc);
	}
	
}
