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
	
	//JAW 4/29/2013 - issue 19 -- This function will cover the action of registering
	// a new user to our site. It will auto assign a new user to have basic login
	// access.
	public function action_registration()
	{
		$error = NULL;
		
		if ($this->request->method() == Request::POST)
		{
			//Get the fields
			$fields = array('email' => $this->request->post('email'),
						'password' => Auth::instance()-> hash($this->request->post('password')),
						'phone' => $this->request->post('phone'),
						'first_name' => $this->request->post('first_name'),
						'last_name' => $this->request->post('last_name'),
						'address1' => $this->request->post('address1'),
						'address2' => $this->request->post('address2'),
						'city' => $this->request->post('city'),
						'state' => $this->request->post('state'),
						'zip' => $this->request->post('zip'));
			//Make the post call
			$request = Request::factory('http://'.Servers::$api_server."/users/")
				->method(Request::POST)
				->body(json_encode($fields))
				->headers('Content-Type', 'application/json');
			//Get the response from the call
			$response = $request->execute();
			//var_dump($response);die('death');
			
			//DEcode the response and get the results
			$decodeResponse = json_decode($response)-> results;
			//var_dump($decodeResponse -> message);die('death');
			
			//Check if there is a duplicate entry.
			if ($decodeResponse -> message == 'Duplicate Entry')
				$error = $decodeResponse -> error;
			else
				$this-> request-> redirect('');
		}

		$view = View::factory('session/registration');
		$view-> error = $error;

		// Set Page title
		$this->template->title = __('Register at SmartLocalSocial');
		
		// Render view in template
		$this->template->content = $view;
	}
}
