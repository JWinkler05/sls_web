<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Example Consumer
 *
 * @package    OAuth2 Example Provider
 * @category   Controller
 * @author     Managed I.T.
 * @copyright  (c) 2011 Managed I.T.
 */
class Controller_Session extends Controller {
	
	public function action_login()
	{
		if ($this->request->method() == Request::POST)
		{
			$success = Auth::instance()->login($this->request->post('username'),$this->request->post('password'),TRUE);
			if ($success) {
				$this->request->redirect(''); // Redirect to homepage...
			} else {
				echo "Invalid username or password";
			}
		}

		$this->response->body(View::factory('session/login'));
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
