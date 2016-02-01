<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
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
	   
	    function config() {
        $data['usersTypes'] = $this->User_model->getAdminDetails($this->session->userdata(ADMIN_AUTH_USERID));
        $data['title'] = "Update Profile";
        $data['main_content'] = ADMIN_PATH . "config";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

	
	public function index()
	{
		$data['title'] = "Login";
		if($this->session->userdata(ADMIN_AUTH_USERID))
		{
			redirect(ADMIN_PATH.'home');
		}
		else
		{
			$this->load->view(ADMIN_PATH.'welcome_message', $data);
		}
		
	}
	function login_failed()
	{
		$this->session->set_flashdata('message', '<font color="#FF0000">*Invalid Username or Password.</font>');
		redirect('admin');
		//$this->index();
	}


	public function CurlLogin()
	{

$user_id = $this->User_model->login($_POST['username'], $_POST['password']);	
           var_dump($user_id);
           if(!empty($user_id)){
    header("Location: http://localhost/sagarmathaonline/admin");
           }


	}
	function login()
	{
		//$this->load->library('form_validation');
//		$this->form_validation->set_rules('username', 'Username', 'required');
//		$this->form_validation->set_rules('password', 'Password', 'required|md5');
		
		if($this->form_validation->run('login') == FALSE)
		{
			//$this->session->set_flashdata('message', '<font color="#FF0000">Username and Password are required fields</font>');
			//redirect('welcome');
			$this->index();
		}
		else
		{			
			$user_id = $this->User_model->login($this->security->sanitize_filename($this->input->post('username')), $this->security->sanitize_filename($this->input->post('password')));
			
			if($user_id)
			{
				
				$this->session->set_userdata(array(ADMIN_AUTH_USERID => $user_id));
				$data['user_name'] = $this->User_model->getAdminDetails($user_id);
				$this->session->set_userdata(array(ADMIN_AUTH_USERNAME =>$data['user_name']->user_name));
				$this->session->set_userdata(array(ADMIN_AUTH_TYPE =>$data['user_name']->user_type));
				redirect(ADMIN_PATH.'home', 'refresh');
			}
			else
			{
				redirect('admin/login_failed', 'refresh');
			}
		}
	
	}
	
	function logout()
	{
		$user_id = $this->session->userdata(ADMIN_AUTH_USERID);

		//if($user_id > 0)
		//{
			$this->session->unset_userdata(ADMIN_AUTH_USERID);
			$this->session->unset_userdata(ADMIN_AUTH_USERNAME);
			$this->session->unset_userdata(ADMIN_AUTH_TYPE);
			//$this->session->sess_destroy();
		//}

		redirect('admin', 'refresh');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */