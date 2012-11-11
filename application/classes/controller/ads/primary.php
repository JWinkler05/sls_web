<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ads_Primary extends Controller
{
	public function action_index()
	{

		$hmvc = Request::factory('http://api.smartlocalsocial.com/creatives/get_primary_by_location')
			->execute();

		$this->response->body($hmvc);
	}
	
}
