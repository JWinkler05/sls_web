<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Markets extends Controller_Template_Cityscape_Default
{
	public function action_index()
		{
		
		$querystring = $this->request->query();
		$creative_id = Arr::get($querystring,'id',NULL);

		// Create view for the edit page
		$view = View::factory('pages/admin/markets');
		$view-> creative_id = $creative_id;

		// TODO::need to fix validation of image uploads
		// Rule definitions for image forms
		$rules = array ();
                
		$form = Formo::form();

		$markets_request = $this -> _get_markets($creative_id);//json_decode(Request::factory('api_markets_get/index')->query(array('id' => $id))->execute());
                $marketArr = array();
                
		//var_dump($markets_request);die();
		
                foreach($markets_request['results'] as $market)
                {
                    $marketArr[$market['market']['id']] = $market['market']['market_name'];
                }
                
                //Reset the pointer
                reset($marketArr);
                
                $form->add_group('market_select', 'select', $marketArr, key($marketArr), array('label' => 'Market Choice'));

                
		if ($form->load()->validate())
		{
			// Get the market ID they want to change to.
			$market_id = $form-> market_select->val();
                        die('STOP');
                        //JAW 2/17/2013 - Changed to get array, then parse for file path and full id
			$this -> _update_creative_market($creative_id, $market_id);
                        
			$form = NULL;
		}
                
                $form->add('Update', array('type' => 'submit','css' => array('id' => 'btnUpload')));

		// Assign variables to be accessed in the view
		$view->form = $form;
		//$view->creative = $creative;
		// Set over page title in template
		$this-> template-> title = __('smartlocalsocial.com: Upddate the market for a creative.');
		
		// Display view in template
		$this->template->content = $view;
        }
 
        protected function _get_markets($creative_id)
        {
            // Execute put request to update record
			$request = Request::factory('http://'.Servers::$api_server."/markets/$creative_id")
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
		
			return json_decode($request->execute(),true);

        }
        
	protected function _update_creative_market($creative_id, $market_id)
        {
            return 1;
        }
}