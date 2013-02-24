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
               $this -> _delete_image($id, $image_id);

                // Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Delete images on a creative');
		
		// Display view in template
		$this->template->content = $view;
	}
        
        protected function _delete_image($creative_id, $image_id)
        {
            // Execute put request to update record
               $request = Request::factory('http://'.Servers::$api_server."/creatives/".$creative_id."/images/".$image_id)
			->method(Request::DELETE)
			->headers('Content-Type', 'application/json');
//		var_dump('http://'.Servers::$api_server."/creatives/$id/images/");
//                var_dump(json_encode($fields));die();
			$response = $request->execute();
                
                        // Redirect to this page, updates current data, removes chance
			// of double posts as well
			//$this->request->redirect($this->request->uri().'?id='.$id);
        }
	
}
