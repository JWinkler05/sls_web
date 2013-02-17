<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Api_Images_Get extends Controller
{
	private $session;
	private $querystring;

	public function before() {
		parent::before();

		// Grab session instance set to variable
		$this->session = Session::instance();

		// Grab querystring params
		$this->querystring = $this->request->query();
	}

	public function action_index()
	{
		$creative_id = Arr::get($this->querystring,'id',NULL);

		$resource = ($creative_id) ? 'creatives/'.$creative_id : NULL;

		// Generate API request
		$api_request = Request::factory('http://'.Servers::$api_server."/{$resource}/images/")
			->execute();

		// Set return response
		$this->response->body($api_request);
	}
	
}
