<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends CI_Controller {
	
	 public function __construct()
       {
            parent::__construct();
			
			$this->load->library('pagination');
			$this->form_validation->set_error_delimiters('<div class="error">* ', '</div>');	
            // if ( $this->input->post( 'remember' ) ) // set sess_expire_on_close to 0 or FALSE when remember me is checked.
            // $this->config->set_item('sess_expire_on_close', '0'); // do change session config
//  
            // $this->load->library('session');		
       }  
	   
	public function _remap($method, $data = 0){
		if($method!='details'){
			$this->index($method);
		}else{
			$this->details($data);
		}	
	}	
	
	public function index($id)
	{
		$data['contentdata'] = $this->Content_model->getAdminDetails($id);
		$data['main_content']='content';
		$this->load->view('includes/secondpage', $data);	
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */