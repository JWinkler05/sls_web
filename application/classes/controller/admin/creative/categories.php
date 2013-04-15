<?php defined('SYSPATH') or die('No direct script access.');

//JAW - 4/14/2013 - issue 14 -- Create web controller for the category portion of a creative.
class Controller_Admin_Creative_Categories extends Controller_Template_Cityscape_Default
{
	public function action_index()
		{
		
		$querystring = $this->request->query();
		$creative_id = trim(Arr::get($querystring,'id',NULL));

		// Create view for the edit page
		$view = View::factory('pages/admin/creative/categories');
		$view-> creative_id = $creative_id;
                
		$form = Formo::form();

		$categories_request_byid = $this -> _get_categories_by_creative($creative_id);
                $categories_request = $this -> _get_categories();
		$categoryArr = array();
                $categoryArrAll = array();

		
		if (is_array($categories_request_byid)){
			foreach($categories_request_byid['results'] as $category)
			{
			    $categoryArr[$category['category']['id']] = $category['category']['category_name'];
			}
		}
		
		if (is_array($categories_request)){
			foreach($categories_request['results'] as $category)
			{
			    $categoryArrAll[$category['category']['id']] = $category['category']['category_name'];
			}
		}
                
                //Reset the pointer
                reset($categoryArr);
                reset($categoryArrAll);
		
		if(count($categoryArr) > 0){
			$categoryArrAll = $this -> _adjust_category_list($categoryArrAll, $categoryArr);
		}
		
                $form->add_group('category_select', 'select', $categoryArrAll, key($categoryArrAll), array('label' => 'Category Choice'));
		
		$view-> tblCategory = $categoryArr;
		
		if ($form->load()->validate())
		{
			// Get the category ID they want to change to.
			$category_id = $form-> category_select->val();
			
			if(!key_exists($category_id, $categoryArr))
			{
				$this -> _update_creative_category(array(
				    'creative_id' => $creative_id,
				    'category_id' => $category_id
				));
				//JAW 3/24/2013 - Add redirect
				$this->request->redirect('/admin/creative_categories?id='.$creative_id);
			}
			else
			{
				var_dump($category_id); die('IN - STOP');
			}

		}
                
                $form->add('Update', array('type' => 'submit','css' => array('id' => 'btnUpload')));

		// Assign variables to be accessed in the view
		$view->form = $form;
		//$view->creative = $creative;
		// Set over page title in template
		$this-> template-> title = __('smartlocalsocial.com: Upddate the category for a creative.');
		
		// Display view in template
		$this->template->content = $view;
        }
 
        protected function _get_categories_by_creative($creative_id)
        {
            // Execute get to find the categories assigned to a creative
			$request = Request::factory('http://'.Servers::$api_server."/creatives/$creative_id/categories")
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
		
			return json_decode($request->execute(),true);

        }
	
	protected function _get_categories()
        {
            // Execute request to get all valid markets
			$request = Request::factory('http://'.Servers::$api_server."/categories")
				->method(Request::GET)
				->headers('Content-Type', 'application/json');
			$markets = json_decode($request->execute(),true);
			
			return json_decode($request->execute(),true);
			

        }
	
	protected function _adjust_category_list($baseArr, $fieldArr){
	
		foreach($fieldArr as $tempItem)
		{
			
			if(in_array($tempItem, $baseArr)){
				unset($baseArr[array_search($tempItem, $fieldArr)]);
			}
		}
		return $baseArr;
	}
        
	protected function _update_creative_category($fields)
        {
		$querystring = $this->request->query();
		$creative_id = trim(Arr::get($querystring,'id',$default= NULL));

		// Execute request to get all valid markets
			$request = Request::factory('http://'.Servers::$api_server."/creatives/$creative_id/categories")
				->method(Request::POST)
				->body(json_encode($fields))
				->headers('Content-Type', 'application/json');
		
			$response = $request->execute();
        }
}
