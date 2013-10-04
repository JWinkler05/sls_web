<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------


// Load the core Kohana class
require SYSPATH.'classes/kohana/core'.EXT;

if (is_file(APPPATH.'classes/kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('America/New_York');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'en_US.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('en-us');

Cookie::$salt = 'sls_web1';
/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}
/**
 * Instanciate servers object
 */
new Servers();
/**
 * Set the environment string by the domain (defaults to 'development').
 */
#$development_web_servers = array (
#	'dev.smartlocalsocial.com',
#	'devwww.smartlocalsocial.com',
#);
#Kohana::$environment = (!in_array($_SERVER['SERVER_NAME'],$development_web_servers)) ? Kohana::PRODUCTION : Kohana::DEVELOPMENT;

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
Kohana::init(array(
	'base_url'   => '/',
	'index_file' => FALSE,
	'profile'    => Kohana::$environment !== Kohana::PRODUCTION,
	'caching'    => Kohana::$environment === Kohana::PRODUCTION,
	'errors'     => TRUE,
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'auth'		=> MODPATH.'auth',		// Basic authentication
	'oauth2'	=> MODPATH.'oauth2',		// Basic authentication
	'cache'		=> MODPATH.'cache',		// Caching with multiple backends
	'formo'		=> MODPATH.'formo',		// Formo form generation
	// 'codebench'	=> MODPATH.'codebench',		// Benchmarking tool
	// 'database'	=> MODPATH.'database', 		// Database access
	'image'		=> MODPATH.'image',		// Image manipulation
	// 'orm'	=> MODPATH.'orm',		// Object Relationship Mapping
	// 'unittest'	=> MODPATH.'unittest',		// Unit testing
	'userguide'	=> MODPATH.'userguide',		// User guide and API documentation
	'storage'	=> MODPATH.'storage',		// Storage Driver (rackspace)
	'minify'	=> MODPATH.'minify',		// Minifier
	'cityscape'	=> MODPATH.'tpl-cityscape',	// TEMPLATE: cityscape
	'uniq'		=> MODPATH.'uniq',		// Unique ID generator
	'hotfixes'	=> MODPATH.'hotfixes',		// Hotfixes to used repos
	'mongodb'	=> MODPATH.'mongodb',		// MongoDB wrapper

	));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
#Route::set('default', '(<controller>(/<action>(/<id>)))')
#	->defaults(array(
#		'controller' => 'welcome',
#		'action'     => 'index',
#	));


Route::set('dev', 'dev(/<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'homepage',
		'action'     => 'index',
	));
Route::set('admincreative', 'admin/creative(/<controller>(/<action>(/<id>)))')
	->defaults(array(
		'directory'  => 'admin/creative',
		'controller' => 'home',
		'action'     => 'index',
	));
Route::set('admin', 'admin(/<controller>(/<action>(/<id>)))')
	->defaults(array(
		'directory'  => 'admin',
		'controller' => 'home',
		'action'     => 'index',
	));
Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'homepage',
		'action'     => 'index',
	));
