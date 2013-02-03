<?php defined('SYSPATH') or die('No direct script access.');
/**
 * The following class generates valid [RFC 4122][ref-rfc-4122] compliant
 * Universally Unique IDentifiers (UUID) version 3, 4 and 5. UUIDs generated
 * validate using OSSP UUID Tool, and output for named-based UUIDs are exactly
 * the same. This is a pure PHP implementation.
 *
 * Adapted from code published by [Andrew Moore][ref-php-94959].
 *
 * [ref-rfc-4122]: http://www.ietf.org/rfc/rfc4122.txt
 * [ref-php-94959]: http://www.php.net/manual/en/function.uniqid.php#94959
 *
 * @package    Kohana
 * @category   Security
 * @author     Andrew Moore
 * @author     Kohana Team
 * @copyright  (c) 2011 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class UNIQ {


	/**
	 * Generates a valid unique id based on PID, server IP, Server request
	 * time, and micro second.
	 *
	 * @return  string
	 */
	public static function gen()
	{
		static $counter = 0;
		static $pid = -1;
		static $addr = -1;

		if ($pid == -1) { $pid = getmypid(); }
		if ($addr == -1) { $addr = ip2long($_SERVER['SERVER_ADDR']); }

		return sha1($addr . $pid . $_SERVER['REQUEST_TIME'] . microtime(true) . ++$counter);
	}

	/**
	 * Generates a valid unique id based on PID, server IP, Server request
	 * time, and micro second with a folder seperator at the desired depth.
	 *
	 * @param   int    depth of the split
	 *
	 * @return  array  an array of the split unique id
	 */
	public static function gen_split($depth = NULL)
	{
		$uniq = self::gen();
		if (is_numeric($depth))
		{
			return array( 
				'part1' => substr($uniq,0,$depth),
				'part2' => substr($uniq,$depth),
				'full' => $uniq
			);
			return $parts;
		} else {
			return array(
				'part1' => $uniq,
				'part2' => NULL,
				'full' => $uniq
			);
		}
	}

	public static function is_sha1($str) {
	    return (bool) preg_match('/^[0-9a-f]{40}$/i', $str);
	}	
} // End UNIQ
