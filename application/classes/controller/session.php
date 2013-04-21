<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Example Consumer
 *
 * @package    OAuth2 Example Provider
 * @category   Controller
 * @author     Managed I.T.
 * @copyright  (c) 2011 Managed I.T.
 */
class Controller_Session extends Controller_Template_Cityscape_Default {
	
	public function action_login()
	{
		$error = NULL;
		if ($this->request->method() == Request::POST)
		{
			$success = Auth::instance()->login($this->request->post('email'),$this->request->post('password'),TRUE);
			if ($success) {
				$this->request->redirect(''); // Redirect to homepage...
			} else {
				$error =  "Invalid email or password";
			}
		}

		$view = View::factory('session/login');
		$view->error = $error;

		// Set Page title
		$this->template->title = __('Login to smartlocalsocial.com');
		
		// Render view in template
		$this->template->content = $view;
	}

	public function action_logout()
	{
		if (Auth::instance()->logged_in()) {
			Auth::instance()->logout();
			$this->request->redirect(''); // Redirect to homepage...
		}
	}

	public function action_me()
	{
		$user = Auth::instance()->get_user();

		$this->response->body(json_encode($user));
	}
}
