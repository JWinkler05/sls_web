<?php defined('SYSPATH') or die('No direct script access.');
//TODO::Add back button
//TODO::Add spacing below submit
//TODO::Format page better
//TODO::Add links to top of page (images,markets,tags,categories)
class Controller_Admin_Creative_Edit extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		// Grab the querystring and post variables
		$params = $this->request->query();
		$posted = $this->request->post();
		
		// Id of record being edited
		$id = $params['id'];

		// Retrieve record details by id
		$detail_return = json_decode(Request::factory('ads_detail/index')->query('id',$id)->execute());

		// Each record is ecapsulated in a creative contain
		$detail = $detail_return->results->creative;

		$ad_image = NULL;
		$detail_image = NULL;
		
		if (isset($detail->images)) {
			foreach ($detail->images as $image){
				switch ($image->image_type) {
					case 'ad':
						$ad_image = $image->local_location;
						break;
					case 'detail':
						$detail_image = $image->local_location;
						break;
				}
			}
		}

		// Create Form with record details
		$form = Formo::form()
			->add('creative_id',
				array('value'=>$detail->creative_id,
					'editable'=>FALSE,
				)
			)
			->add('ad_type',
				array('value'=>$detail->ad_type,
				)
			)
			->add('business_name',
				array('value'=>$detail->business_name,
				)
			)
			->add('offer_in_short',
				array('value'=>$detail->offer_in_short,
				)
			)
			->add('list_price',
				array('value'=>$detail->list_price,
				)
			)
			->add('coupon_price',
				array('value'=>$detail->coupon_price,
				)
			)
			->add('sms_code',
				array('value'=>$detail->sms_code,
				)
			)
			->add('description',
				'textarea',
				array('value'=>$detail->description,
				)
			)
			->add('detailed_offer',
				'textarea',
				array('value'=>$detail->detailed_offer,
				)
			)
			->add('submit',
				'submit',
				array('value'=>'Submit Changes',
				)
			);

		// Logic to execute on a successful post
		if ($form->load($_POST)->validate())
		{
			// Remove submit field if present in the post variables
			$fields = array ('fields' => $posted);
			unset($fields['fields']['submit']);

			// Execute put request to update record
			$request = Request::factory('http://'.Servers::$api_server."/creatives/{$detail->creative_id}")
				->method(Request::PUT)
				->body(json_encode($fields))
				->headers('Content-Type', 'application/json');
		
			$response = $request->execute();

			// Redirect to this page, updates current data, removes chance
			// of double posts as well
			$this->request->redirect($this->request->uri().'?id='.$detail->creative_id); 
		}

		// Create view for the edit page
		$view = View::factory('pages/admin/creative/edit');

		// Assign variables to be accessed in the view
		$view->form = $form;
		$view->creative = $detail;
		$view->id = $id; 
		$view->posted = $posted;
		$view->ad_image = $ad_image;
		$view->detail_image = $detail_image;

		// Set over page title in template
		$this->template->title = __('smartlocalsocial.com: ' . $detail->business_name . $detail->offer_in_short);
		
		// Display view in template
		$this->template->content = $view;
	}
	
}
