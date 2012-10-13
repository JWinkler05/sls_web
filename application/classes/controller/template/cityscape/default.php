<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Template_Cityscape_Default extends Controller_Template 
{

	private $template_path = 'template/cityscape/';

	public $template = 'template/cityscape/default';

	/**
	* The before() method is called before your controller action.
	* In our template controller we override this method so that we can
	* set up default values. These variables are then available to our
	* controllers if they need to be modified.
	*/
	public function before()
	{
		parent::before();

		if ($this->auto_render)
		{
			// Initialize empty values
			$this->template->title   = '';
			$this->template->content = '';
				
			$this->template->styles = array();
			$this->template->scripts_upper = array();
			$this->template->scripts_manual = array();
			$this->template->scripts_lower = array();

				
		}
	}

	/**
	* The after() method is called after your controller action.
	* In our template controller we override this method so that we can
	* make any last minute modifications to the template before anything
	* is rendered.
	*/
	public function after()
	{
		if ($this->auto_render)
		{
			$styles = array(
				"media/{$this->template_path}css/screen.css" => 'screen, projection',
				"media/{$this->template_path}css/print.css" => 'print',
				"media/{$this->template_path}css/container.css" => 'all',
				"media/{$this->template_path}css/header.css" => 'all',
				"media/{$this->template_path}css/main_menu.css" => 'all',
				"media/{$this->template_path}css/main_feature.css" => 'all',
			);

			$scripts_upper = array(
				'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js',
			);
			
			$scripts_manual = array(
				"
			var ADAPT_CONFIG = {
			  path: '/media/{$this->template_path}css/',
			  dynamic: true,
			  range: [
				'0px to 760px = mobile.min.css',
				'760px to 980px = 720.min.css',
				'980px to 2600px = 960.min.css'
			  ]
			};
				",
			);

			$scripts_lower = array(
				"media/{$this->template_path}js/adapt.min.js",
			);

			$this->template->styles = array_merge( $this->template->styles, $styles );
			$this->template->scripts_upper = array_merge( $this->template->scripts_upper, $scripts_upper );
			$this->template->scripts_manual = array_merge( $this->template->scripts_manual, $scripts_manual );
			$this->template->scripts_lower = array_merge( $this->template->scripts_lower, $scripts_lower );
		}
		parent::after();
	}
}
