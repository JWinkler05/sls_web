<?php defined('SYSPATH') or die('No direct script access.');

class Api_Processor
{

	public static function request($auth,$method = 'GET', $resource, $params,$body = NULL,$headers = NULL, $protocol = 'http', $api_server = NULL)
	{
		$api_server = $api_server ?: Servers::$api_server;

		$params = http_build_query($params);
		
		// Generate API request
		$api_request = Request::factory("$protocol://$api_server/$resource?$params");

		switch ($method) {
			case 'PUT':
				$api_request->method(Request::PUT);
				break;
			case 'POST':
				$api_request->method(Request::POST);
				break;
			case 'DELETE':
				$api_request->method(Request::DELETE);
				break;
			case 'GET':
				$api_request->method(Request::GET);
				break;
		}
		if ($body) {
			$api_request->body($body);
		}

		if ($headers) {
			foreach ($headers as $key => $value) {
				$api_request->headers($key,$value);
			}
		}
		
		$api_request->execute();

		// Set return response
		return $api_request;
	}
	
}
