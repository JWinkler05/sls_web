<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Category_Delete extends Controller_Template_Cityscape_Default
{
	//JAW 4/14/2013 - issue 14 -- Controller for web to delete a category from a creative.
	public function action_index()
	{
		$params = $this->request->query();
		$id = trim(arr::get($params, 'creative_id', $default = NULL));
		$category_id = trim(arr::get($params, 'category_id', $default = NULL));
		$category_name = trim(arr::get($params, 'category_name', $default = NULL));

		View::set_global('menu',TRUE);
		$view = View::factory('pages/admin/creative/category/delete');
                $view-> category_id = $category_id;
		$view-> creative_id = $id;
		$view-> category_name = $category_name;

		//This will call the function to delete the category from the creative
               $this ->_delete_category($id, $category_id);
               

                // Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Delete a Category');
		
		// Display view in template
		$this->template->content = $view;
	}
        
	//JAW 4/14/2013 - issue 14 -- Function to delete the category from a creative.
        protected function _delete_category($creative_id, $category_id)
        {
		////var_dump($creative_id . ":" . $market_id);
            // Execute delete request to delete record
               $request = Request::factory('http://'.Servers::$api_server."/creatives/".$creative_id."/categories/".$category_id)
			->method(Request::DELETE)
			->headers('Content-Type', 'application/json');
		//var_dump('http://'.Servers::$api_server."/creatives/".$creative_id."/categories/".$category_id);
		//var_dump($request);die();
			$response = $request->execute();
        }
	
}
