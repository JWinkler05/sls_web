<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Categories extends Controller_Template_Cityscape_Default
{
	public function action_index()
		{
		
		$querystring = $this->request->query();
		$creative_id = trim(Arr::get($querystring,'id',NULL));

		// Create view for the edit page
		$view = View::factory('pages/admin/creative/categories');

		// TODO::need to fix validation of image uploads
		// Rule definitions for image forms
		$rules = array ();
                
		$this-> template-> title = __('smartlocalsocial.com: Upddate the category for a creative.');
		
		// Display view in template
		$this->template->content = $view;
        }
}