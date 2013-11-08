<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Select controller
 *
 * @package    Smartlocalsocial
 * @category   Controller
 * @author     Thomas Cooper
 * @copyright  (c) 2012-2013 Smart Local Social
 */
class Controller_Select extends Controller {
	
	public function action_index()
	{
		// Get the session instance
		$session = Session::instance();

		// Set metro and market arrays
		$markets = Api_Processor::get('markets');

		foreach ($markets as $market) {
			$metro_list[$market->market->metro] = $market->market->market_name;
			$metro_ids[] = $market->market->metro;
			$market_list['--- '.Lib_Valid::return_full($market->market->state).' ---'][$market->market->metro] = $market->market->market_name;
		}

		// Get metro/city if a session variable is not already set
		$metro_code = $session->get('visitor_metro',NULL);
		$city = $session->get('visitor_city',NULL);

		if (!isset($metro_code)) {
			// Get the IP in long format
			$ip_long    = intval(sprintf("%u", ip2long(Request::$client_ip)));

			// Instanciate the IP models
			$blocks     = new Mongo_Collection('blocks');
			$location   = new Mongo_Collection('location');

			ini_set('mongo.native_long', 1);
			// Get the location ID for this IP
			$block_result       = $blocks->findOne(array('end_ip_number' => array('$gte' => $ip_long)), array('location_id' => 1));

			// Get the location information
			$location_result    = $location->findOne(array('location_id' => $block_result['location_id']), array('city','metro_code'));

			// Set the metro code / city
			$metro_code = $location_result['metro_code'];
			
			if (!in_array($metro_code,$metro_ids)) {
				$metro_code = '535';
			}

			// Set the city and metro to a session variable
			$session->set('visitor_metro',$metro_code);
			$session->set('visitor_city',$metro_list["$metro_code"]);

			// TODO::make select controller load before ads, then remove this hack
			$this->request->redirect(URL::base()); 
		}
		 
		// Create the market select form with dropdown
		$form = Formo::form()
			->add_group('market', 'select', $market_list, $metro_code, array('label' => 'Current Market'));
		$form->market->set('attr',array('onchange'=>'this.form.submit()'));

		// Logic to execute on a successful post
		if ($form->load($_POST)->validate()){
			// Set the city and metro to a session variable
			$session->set('visitor_metro',$_POST['market']);
			$session->set('visitor_city',$metro_list["{$_POST['market']}"]);

			// Redirect to this page, updates current data, removes chance
			// of double posts as well
			$this->request->redirect(URL::base()); 
		}

		// Display the form
		echo $form;

	} // End action_index

} // End controller_select
