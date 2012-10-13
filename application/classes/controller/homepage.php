<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Homepage extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		View::set_global('menu',TRUE);
		$view = View::factory('pages/home');
		$id = $this->request->param('id', NULL);

		$view->title = 'The date is ';
		$view->date = date('m/d/Y');
		$view->id = $id;

		
		//$this->response->body($view);
		$this->template->title = __('Welcome to smartlocalsocial.com');
		
		$this->template->content = $view;
	}
	
	public function action_home()
	{
		$this->template->title = __('Welcome to smartlocalsocial');
		
		$this->template->content = View::factory('pages/home');
	}

	public function action_contact()
	{
		$this->template->title = __('Contact information for smartlocalsocial');

		$this->template->content = View::factory('pages/contact');
	}
}
