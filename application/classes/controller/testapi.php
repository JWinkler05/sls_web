<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Select controller
 *
 * @package    Smartlocalsocial
 * @category   Controller
 * @author     Thomas Cooper
 * @copyright  (c) 2012-2013 Smart Local Social
 */
class Controller_Testapi extends Controller {
	
	public function action_index()
	{
		echo 'hello world';
$session = Session::instance();
		$params = array (
			'metro', $session->get('visitor_metro',NULL),
			'type'=>'primary',
			'category'=> $session->get('visitor_category',NULL)
		);
		$test = Api_Processor::request(NULL, 'creatives',$params);
		var_dump($test);
	} // End action_index

} // End controller_select
