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
			);

			$scripts_upper = array(
				'http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js',
			    	'http://code.jquery.com/jquery-1.8.2.js',
				'http://code.jquery.com/ui/1.10.3/jquery-ui.js',

			);
			
			$scripts_manual = array(
				"
			var ADAPT_CONFIG = {
			  path: '/media/tpl-cityscape/css/',
			  dynamic: true,
			  range: [
				'0px to 1px = mobile.min.css',
				'2px to 30px = 720.min.css',
				'301px to 2600px = 960.min.css'
			  ]
			};
				",
			);

			$scripts_lower = array(
			);

			$this->template->styles = array_merge( $this->template->styles, $styles );
			$this->template->scripts_upper = array_merge( $this->template->scripts_upper, $scripts_upper );
			$this->template->scripts_manual = array_merge( $this->template->scripts_manual, $scripts_manual );
			$this->template->scripts_lower = array_merge( $this->template->scripts_lower, $scripts_lower );
		}
		parent::after();
	}
}
