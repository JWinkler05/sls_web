<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ads_Primary extends Controller
{
	private $session;

	public function before() {
		parent::before();

		// Grab session instance set to variable
		$this->session = Session::instance();
	}

	public function action_index()
	{
		// If rand cookie is not present set cookie and apply rand
		//if (!Cookie::get('sls_a',NULL)) {
		//	$rand = 'rand=1';
		//	Cookie::$expiration = Date::DAY;
		//	Cookie::set('sls_a', UNIQ::gen());
		//}else{
			$rand = 'rand=0';
		//}
		
		$metro = 'metro='.$this->session->get('visitor_metro',NULL);
		$category = 'category='.$this->session->get('visitor_category',NULL);

		if (Kohana::$environment === Kohana::PRODUCTION){
			$api_server = 'api.smartlocalsocial.com';
		}else{
			$api_server = 'devapi.smartlocalsocial.com';
		}

		$hmvc = Request::factory("http://$api_server/creatives?$metro&$category&type=primary&$rand")
			->execute();

		$this->response->body($hmvc);
	}
	
}
