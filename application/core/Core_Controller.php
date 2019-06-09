<?php

/* ===== Documentation ===== 
Name: Core_Controller
Description: Core_Controller Class is the super class that holds protected objects accessible to the regular controller and model classes. This class extends the main CI controller and acts as parent to the regular controllers.
Contributors: [Nwankwo Ikemefuna]
Date Created: 17th April, 2018
Date Modified: 1st June, 2019
*/


class Core_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();

		//site details
		$this->site_name = 'CI Events Calendar';

		//get current controller class 
		$this->c_controller = $this->router->fetch_class();
	}
	
	
	/**
	* Site Header
	*/
	protected function site_header($page_title) {
		$data['page_title'] = $page_title;
		return $this->load->view('layout/site_header', $data);
	}
	

	/**
	* Site Footer
	*/
	protected function site_footer() {
		return $this->load->view('layout/site_footer');
	}
	
}