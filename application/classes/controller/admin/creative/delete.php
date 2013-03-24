<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Delete extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		$params = $this->request->query();
		$creative_id = $params['id'];
                
                
		View::set_global('menu',TRUE);
		$view = View::factory('pages/admin/creative/delete');
                //var_dump($view);die();
                $view -> creative_id = $creative_id;
                
                //JAW 3/7/2013 -- Call to delete the images associated with a creative.
                $params = $this ->_delete_creatives_images($creative_id);

		if ($params['results']['message'] !== 'no images found') {
			//JAW 3/7/2013 -- Get each of the image Ids, delete the images.
			foreach($params['results'] as $imageArr)
			{
			    $this -> _delete_img_file($imageArr['image']['local_location']);
			    $this -> _delete_image($creative_id, $imageArr['image']['image_id']);
			}
		}
                //var_dump($temp);die();
                //var_dump($params['results'][0]['image']['image_id']);die('prep');
                                
               //JAW 3/5/2013 -- This calls the function to delete the creative.
               $this -> _delete_creative($creative_id);
               
                // Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Delete a creative');
		
		// Display view in template
		$this->template->content = $view;

		
	}
        
        protected function _delete_creative($creative_id){
        // Execute put request to update record
               $request = Request::factory('http://'.Servers::$api_server."/creatives/".$creative_id)
			->method(Request::DELETE)
			->headers('Content-Type', 'application/json');
//		var_dump('http://'.Servers::$api_server."/creatives/$id/images/");
//                var_dump(json_encode($fields));die();
			$response = $request->execute();
                
                        // Redirect to this page, updates current data, removes chance
			// of double posts as well
			//$this->request->redirect($this->request->uri().'?id='.$id);
        }
        
        // JAW 3/7/2013 -- This function will delete the images from the directory that are
        // tied to a creative when that creative is deleted.
        protected function _delete_creatives_images($creative_id)
        {
            // Execute put request to delete record
               $request = Request::factory('http://'.Servers::$api_server."/creatives/".$creative_id."/images")
			->method(Request::GET)
			->headers('Content-Type', 'application/json');
		
		return json_decode($request->execute(),true);  
        }
        
         // JAW 2/26/2013 -- This function will take the path of an image along with its 3
        // character delimeter, and it will find that filein its path and delete it from the server.
        protected function _delete_img_file($image_id){
            $directory = DOCROOT.'media/ad_images/'.strtolower(substr($image_id,0,3)).'/';
            $imageFile = $directory.strtolower(substr($image_id,3));
            
            //var_dump($imageFile);die();
            if (!unlink($imageFile)) {
                echo ("Error deleting $imageFile");
            } 
            else {
             echo ("Deleted $imageFile");
            }
        }
        
                protected function _delete_image($creative_id, $image_id)
        {
            // Execute put request to delete record
               $request = Request::factory('http://'.Servers::$api_server."/creatives/".$creative_id."/images/".$image_id)
			->method(Request::DELETE)
			->headers('Content-Type', 'application/json');
//		
			$response = $request->execute();
        }
	
}
