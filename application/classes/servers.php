<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Example
 *
 * @package    Server Controller
 * @category   Custom
 * @author     smartLOCALsocial
 * @copyright  (c) 2012-2013 smartLOCALsocial.
 */
class Servers
{
	// Environments default to development
	public static $api_server = 'devapi.smartlocalsocial.com';
	public static $www_server = 'devwww.smartlocalsocial.com';
	
	public function __construct()
	{
		if (Kohana::$environment === Kohana::PRODUCTION){
			self::$api_server = 'api.smartlocalsocial.com';
			self::$www_server = 'www.smartlocalsocial.com';
		}
	}
}
