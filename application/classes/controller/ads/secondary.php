<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ads_Secondary extends Controller
{
	public function action_index()
	{
		$location = NULL;
		$category = NULL;

		$params = $this->request->query();

		if (isset($params['location'])){
			$location = 'location='.$params['location'];
		}

		if (isset($params['category'])){
			$category = 'category='.$params['category'];
		}

		if (Kohana::$environment === Kohana::PRODUCTION){
			$api_server = 'api.smartlocalsocial.com';
		}else{
			$api_server = 'devapi.smartlocalsocial.com';
		}

		$hmvc = Request::factory("http://$api_server/creatives/get_secondary_by_location?$location&$category")
			->execute();

		$this->response->body($hmvc);
	}
	
}
