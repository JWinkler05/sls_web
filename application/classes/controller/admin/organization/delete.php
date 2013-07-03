<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Organization_Delete extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		$params = $this->request->query();
		$org_id = trim(arr::get($params, 'org_id', $default = NULL));

		View::set_global('menu',TRUE);
		$view = View::factory('pages/admin/organization/delete');

		//This will call the function to delete the market from the creative
		//var_dump($org_id);die();
               $result = $this -> _delete_organization($org_id);
               
	       $view -> result = $result;
                // Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Delete an Organization');
		
		// Display view in template
		$this->template->content = $view;
	}
        
        protected function _delete_organization($org_id)
        {
		////var_dump($creative_id . ":" . $market_id);
            // Execute delete request to delete record
               $request = Request::factory('http://'.Servers::$api_server."/organizations/".$org_id)
			->method(Request::DELETE)
			->headers('Content-Type', 'application/json');
		//var_dump('http://'.Servers::$api_server."/creatives/".$creative_id."/markets/".$market_id);
		//var_dump($request);die();
			$response = $request->execute();
			$body = json_decode($response);
			
			$results = $body->results;
			$goodDel = true;
			
			foreach($results as $image_id) {
				//Delete the image
				$this->_delete_img_file($image_id);
				//Set file directory
				$directory = DOCROOT.'media/ad_images/'.strtolower(substr($image_id,0,3)).'/';
				$imageFile = $directory.strtolower(substr($image_id,3)).'.jpg';
				//Check if the file exists
				if(file_exists($imageFile)) {
					$goodDel = false;
				}
			}
			
			if($goodDel == true) {
				return "The organization was deleted successfully.";
			} else {
				return "There was an error deleteing the images.";
			}
	}
       
	
	        // JWinkelr 6/25/2013 -- This function will take the path of an image along with its 3
        // character delimeter, and it will find that filein its path and delete it from the server.
        protected function _delete_img_file($image_id){
        
            $directory = DOCROOT.'media/ad_images/'.strtolower(substr($image_id,0,3)).'/';
            $imageFile = $directory.strtolower(substr($image_id,3)).'.jpg';
            
            //var_dump($imageFile);die();
            if (!unlink($imageFile)) {
                echo ("Error deleting $imageFile");
            } 
            else {
             echo ("Deleted $imageFile");
            }
        }
	
}
