<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	 public function __construct()
       {
            parent::__construct();
				checkAdminAuth();
            // Your own constructor code
			$this->load->library('form_validation');
			$this->load->library('pagination');
			$this->form_validation->set_error_delimiters('<div class="red">', '</div>');
			$this->load->helper(array('form', 'url'));
			$this->load->helper('path');
			$this->allowed=$this->Auth_master_model->getAuth();
       }
	
	
	
	
	public function index()
	{
		
		$data['title']="Home";
			$data['main_content'] = ADMIN_PATH."home_view";
			$this->load->view(ADMIN_PATH.'include/template', $data);
		
	}
	
	
}

