<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Images extends Controller_Template_Cityscape_Default
{
	public function action_index()
		{
		$ad_image = NULL;
		$detail_image = NULL;

		$querystring = $this->request->query();
		$id = Arr::get($querystring,'id',NULL);
                   
		// Create view for the edit page
		$view = View::factory('pages/admin/creative/images');
		$view->ad_image = NULL;
		$view->detail_image = NULL;
                $view->ad_id = NULL;
                $view->detail_id = NULL;
                $view->creative_id = $id;

		// TODO::need to fix validation of image uploads
		// Rule definitions for image forms
		$rules = array (
			'Upload::not_empty' => NULL,
			'Upload::type'      => array(':value', 'JPG, PNG or GIF' => array('jpg', 'png', 'gif')),
			'Upload::size'      => array(':value', '1M')
		);

		$form = Formo::form();

		$images_request = json_decode(Request::factory('api_images_get/index')->query(array('id' => $id))->execute());
                $images = $images_request->results;

		if (!isset($images->message)) {
			foreach ($images as $image) {
				switch ($image->image->image_type) {
					case 'ad':
						$view->ad_image = $image->image->local_location;
                                                $view->ad_id = $image->image->image_id;
						$ad_image = true;
						break;
					case 'detail':
						$view->detail_image = $image->image->local_location;
                                                $view->detail_id = $image->image->image_id;
						$detail_image = true;
						break;
				}	
			}
		}
                
		if (!$ad_image) {

                        $form->add('ad_img_name', array('label' => "Ad Image's Name",'css' => array('id' => 'ad_id')));
			//$form->add('ad_image', array('type' => 'file', 'label' => "Ad's File Location"));
			$form->add('ad_image', 'file');
			//->rules('logo', $rules);
		}
		if (!$detail_image) {
                        $form->add('detail_img_name', array('label' => "Detail Image's Name",'css' => array('id' => 'detail_id')));
			//$form->add('detail_image', array('type' => 'file', 'label' => "Detail's File Location"));
			$form->add('detail_image', 'file');
			//->rules('logo', $rules);
		}
		if (!$ad_image or !$detail_image) {
			$form->add('Upload', array('type' => 'submit','css' => array('id' => 'btnSubmit')));
		}

		if ($form->load()->validate())
		{
                    // JAW 2/24/2013 - Changed flow. Now check for ad_image
                    // if there is no image set, then pull the information for the save.
                    // does this for both ad and detail.
                        if(!$ad_image)
                        {
			// Get each file to be uploaded and upload them
			$ad_image = $form->ad_image->val();
                        
                        //JAW 2/17/2013 - Changed to get array, then parse for file path and full id
			$ad_array = $this->_save_image($ad_image,220,220);
			$ad_filename = $ad_array[0];
                        $ad_full = $ad_array[1];
                        
                        // JAW 2/17/2013- Call the save function
                        $this -> _write_save_final(array(
                            'image_id' => $ad_full, 
                            'image_name' => $form-> ad_img_name -> val(),
                            'image_type' => 'ad',
                            'local_location' => $ad_filename
                        ));
                        
                        //JAW 2/17/2013 - Access the db call to save the item in the db.
			$view->ad_image = $ad_filename;
                        }
                        
                        if(!$detail_image)
                        {
			$detail_image = $form->detail_image->val();
                        //JAW 2/17/2013 - Changed to get array, then parse for file path and full id
			$detail_array = $this->_save_image($detail_image,440,440);
                        $detail_filename = $detail_array[0];
                        $detail_full = $detail_array[1];
                        
                        // JAW 2/17/2013- Call the save function
                        $this -> _write_save_final(array(
                            'image_id' => $detail_full,
                            'image_name' => $form-> detail_img_name -> val() ,
                            'image_type' => 'detail',
                            'local_location' => $detail_filename
                        ));
                        
                        //JAW 2/17/2013 - Access the db call to save the item in the db.
			$view->detail_image = $detail_filename;
                        }
                        
//			// TODO::save to creative
//                        // JAW 2/17/2013- Call the save function
//                        if(!$ad_image){
//                        $this -> _write_save_final(array(
//                            'image_id' => $ad_full, 
//                            'image_name' => $form-> ad_img_name -> val(),
//                            'image_type' => 'ad',
//                            'local_location' => $ad_filename
//                        ));
//                        }
//                        if(!$detail_image)
//                        {
//                        $this -> _write_save_final(array(
//                            'image_id' => $detail_full,
//                            'image_name' => $form-> detail_img_name -> val() ,
//                            'image_type' => 'detail',
//                            'local_location' => $detail_filename
//                        ));
//                        }
//                        
//                        //JAW 2/17/2013 - Access the db call to save the item in the db.
//			$view->ad_image = $ad_filename;
//			$view->detail_image = $detail_filename;

			$form = NULL;
		}


		// Assign variables to be accessed in the view
		$view->form = $form;
		//$view->creative = $creative;

		// Set over page title in template
		$this->template->title = __('smartlocalsocial.com: Add new images to a creative');
		
		// Display view in template
		$this->template->content = $view;
	}

	protected function _save_image($image, $width = 220, $height = 220)
	    {
		if (
		    ! Upload::valid($image) OR
		    ! Upload::not_empty($image) OR
		    ! Upload::type($image, array('jpg', 'jpeg', 'png', 'gif')))
		{
		    return FALSE;
		}

		// Generate unique id for filename spliting off first 3 digits for filename
		$filename_split = UNIQ::gen_split(3);

		$directory = DOCROOT.'media/ad_images/'.strtolower($filename_split['part1']).'/';

		// Check to see if directory exists
		if ( !is_dir($directory))
		{
			// Create the directory
			if ( ! mkdir($directory, 0777, TRUE))
			{
				throw new Kohana_Exception(__METHOD__.' unable to create directory : :directory', array(':directory' => $directory));
			}

			// chmod to solve potential umask issues
			chmod($directory, 0777);
		}

		if ($file = Upload::save($image, NULL, $directory))
		{
                    
		    $filename = strtolower($filename_split['part2']).'.jpg';
	 
		    Image::factory($file)
			->resize($width, $height, Image::AUTO)
			->save($directory.$filename);
	 
		    // Delete the temporary file
		    unlink($file);
                      
                    //JAW 2/17/2013 - Changed to return an array, holding the structured path and id.
                    $arrImgFileInfo = array($filename_split['part1'].'/'. $filename, $filename_split['full']);
		    return $arrImgFileInfo;
		}
	 
		return FALSE;
	    }
            
            //JAW 2-17-2013 -- This function will call the save to the DB of the information.
            protected function _write_save_final($fields)
            {
                $querystring = $this->request->query();
		$id = Arr::get($querystring,'id',NULL);
                
               // Execute put request to update record
               $request = Request::factory('http://'.Servers::$api_server."/creatives/$id/images/")
			->method(Request::POST)
			->body(json_encode($fields))
			->headers('Content-Type', 'application/json');
//		var_dump('http://'.Servers::$api_server."/creatives/$id/images/");
//                var_dump(json_encode($fields));die();
			$response = $request->execute();
                
                        // Redirect to this page, updates current data, removes chance
			// of double posts as well
			//$this->request->redirect($this->request->uri().'?id='.$id);
            }

	
}
