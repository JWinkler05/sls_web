<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ads_Primary extends Controller
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
		$metro = '';
		$category = '';

		// Get metro from session
		if ($this->session->get('visitor_metro',NULL)) {
			$metro = '&metro='.$this->session->get('visitor_metro',NULL);
		}

		// Overide metro to blank if all is provided 
		if (isset($this->querystring['metro'])) {
			if ($this->querystring['metro'] === 'all') {
				$metro = '';
			}
		}

		// Get catetory from session
		if ($this->session->get('visitor_category',NULL)) {
			$category = '&category='.$this->session->get('visitor_category',NULL);
		}

		// Generate API request
		$api_request = Request::factory('http://'.Servers::$api_server."/creatives?type=primary$metro$category")
			->execute();

		// Set return response
		$this->response->body($api_request);
	}
	
}
