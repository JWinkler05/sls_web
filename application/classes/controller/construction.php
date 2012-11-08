<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Construction extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		//$result = FALSE;
		View::set_global('menu',FALSE);
		$view = View::factory('pages/construction');
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
