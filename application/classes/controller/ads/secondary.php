<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ads_Secondary extends Controller
{
	public function action_index()
	{
		if (Kohana::$environment === Kohana::PRODUCTION){
			$api_server = 'api.smartlocalsocial.com';
		}else{
			$api_server = 'devapi.smartlocalsocial.com';
		}

		$hmvc = Request::factory("http://$api_server/creatives/get_secondary_by_location")
			->execute();

		$this->response->body($hmvc);
	}
	
}
