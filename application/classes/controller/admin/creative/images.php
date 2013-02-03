<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Creative_Images extends Controller_Template_Cityscape_Default
{
	public function action_index()
		{
		// Create view for the edit page
		$view = View::factory('pages/admin/creative/images');

		// TODO::need to fix validation of image uploads
		$rules = array (
			'Upload::not_empty' => NULL,
			'Upload::type'      => array(':value', 'JPG, PNG or GIF' => array('jpg', 'png', 'gif')),
			'Upload::size'      => array(':value', '1M')
		);

		$form = Formo::form()
			->add('ad_image', 'file')
			->add('detail_image', 'file')
			->add('upload','submit');
			//->rules('logo', $rules);

		if ($form->load()->validate())
		{
			// Get each file to be uploaded and upload them
			$ad_image = $form->ad_image->val();
			$ad_filename = $this->_save_image($ad_image,220,220);
			
			$detail_image = $form->detail_image->val();
			$detail_filename = $this->_save_image($detail_image,440,440);

			// TODO::save to creative
			$view->ad_image = $ad_filename;
			$view->detail_image = $detail_filename;

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
	 
		    return $filename_split['part1'].'/'.$filename;
		}
	 
		return FALSE;
	    }
	
}
