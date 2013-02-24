<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Deal_Detail extends Controller_Template_Cityscape_Default
{
	public function action_index()
	{
		$params = $this->request->query();
		$id = $params['id'];

		View::set_global('menu',TRUE);
		$view = View::factory('pages/deal_detail');

		$detail_return = json_decode(Request::factory('ads_detail/index')->query('id',$id)->execute());
		$detail = $detail_return->results->creative;
		$view->selected = $detail;

		$image_url = NULL;

		foreach ($detail->images as $image) {
			if ($image->image_type === 'detail') {
				$image_url = $image;
			}
		}
var_dump($image_url);
		$view->detail_image = $image_url;

		$view->id = $id; 
		$ads_primary = json_decode(Request::factory('ads_primary/index')->execute());
		if (!$ads_primary->results) {
			$ads_primary = json_decode(Request::factory('ads_primary/index')->query(array('metro'=>'all'))->execute());
		}
		$view->ads = $ads_primary->results; 
		$view->main_grid = '16';
		$view->main_layout = 'no-sidebar';		
		//$this->response->body($view);
		$this->template->title = __('smartlocalsocial.com: ' . $detail->business_name . $detail->offer_in_short);
		
		$this->template->content = $view;
	}
	
}
