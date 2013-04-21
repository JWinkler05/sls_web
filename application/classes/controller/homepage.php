<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Homepage extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		// Get the session instance
		$session = Session::instance();

		// Set default variables
		$full_ads = NULL;
		View::set_global('menu',TRUE);
//		
//		////JAW 4/21/2013 - issue 14 -- Set the category in the session.
		if (isset($_GET['category'])){
			//var_dump(strval($_GET['category']));die();
			$session -> set('visitor_category', strval($_GET['category']));
		}
		else {
			$session -> set('visitor_category', NULL);
		}

		// Define the view
		$view = View::factory('pages/home');

		// Get the querystring parameters
		$params = $this->request->query();

		// Retrieve primary ads by market
		$ads_primary = json_decode(Request::factory('ads_primary/index')->query($params)->execute());
		$view->ads_primary = $ads_primary->results;
		$view->full_ads = NULL;
		
		// If no ads are provided for current category, get all for the market.
		if (!$ads_primary->results and $session->get('visitor_category',NULL)) {
			$session->set('visitor_category',NULL);
			$full_ads = json_decode(Request::factory('ads_primary/index')->execute());
			$view->full_ads = $full_ads->results;
		}

		// If no ads are provided for current market, choose all markets.
		if (!$ads_primary->results and !$full_ads) {
			$full_ads = json_decode(Request::factory('ads_primary/index')->query(array('metro'=>'all'))->execute());
			$view->full_ads = $full_ads->results;
		}

		// Get secondary ads by market
		#$ads_secondary = json_decode(Request::factory('ads_secondary/index')->query($params)->execute());	
		#$view->ads_secondary = $ads_secondary->results;
		$view->ads_secondary = NULL;

		// Set view variables for ad layout
		$view->main_grid = '16';
		$view->main_layout = 'no-sidebar';

		// Pass session to view
		$view->session = $session;

		// If there are secondary ads include sidebar
		if (is_array($view->ads_secondary)) {
			$view->main_grid = '12';
			$view->main_layout = 'sidebar';
		}

		// Set Page title
		$this->template->title = __('Welcome to smartlocalsocial.com');
		
		// Render view in template
		$this->template->content = $view;
	}
	
}
