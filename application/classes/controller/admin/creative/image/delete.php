<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Image_Delete extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		$params = $this->request->query();
		$id = $params['creative_id'];
                $image_id = $params['image_id'];

		View::set_global('menu',TRUE);
		$view = View::factory('pages/admin/creative/image/delete');
                $view-> image_id = $image_id;
                //var_dump($id." : ".$image_id); die();
               //$this -> _delete_img_file($image_id);
               $this -> _delete_image($id, $image_id);
               
               //JWinkler2/26/2013 -- This calls the function to delete the image file from the directory.
               $this -> _delete_img_file($image_id);

                // Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Delete images on a creative');
		
		// Display view in template
		$this->template->content = $view;
	}
        
        protected function _delete_image($creative_id, $image_id)
        {
            // Execute put request to delete record
               $request = Request::factory('http://'.Servers::$api_server."/creatives/".$creative_id."/images/".$image_id)
			->method(Request::DELETE)
			->headers('Content-Type', 'application/json');
//		
			$response = $request->execute();
                
                        // Redirect to this page, updates current data, removes chance
			// of double posts as well
			//$this->request->redirect($this->request->uri().'?id='.$id);
        }
        
        // JWinkelr 2/26/2013 -- This function will take the path of an image along with its 3
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
