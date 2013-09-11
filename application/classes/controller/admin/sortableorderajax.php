<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_SortableOrderAjax extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		
            // Execute get to find the organizations
		$request = Request::factory('http://'.Servers::$api_server."/creatives/")
		->method(Request::PUT)
		->body(json_encode($_POST))
		->headers('Content-Type', 'application/json');
		
		$response = $request->execute();
	}
}
