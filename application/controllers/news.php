<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	
	 public function __construct()
       {
            parent::__construct();
			$this->load->helper("url");
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
		$config = array();
	        $config["base_url"] = base_url() . "news/".$id;
	        $config["total_rows"] = $this->News_model->record_count($id);
	        $config["per_page"] = 10;
	        $config["uri_segment"] = 3;
	        $config['full_tag_open'] = '<ul class="pagination" style="float:right;">';
	        $config['full_tag_close'] = '</ul>';
	        $config['first_link'] = false;
	        $config['last_link'] = false;
	        $config['first_tag_open'] = '<li>';
	        $config['first_tag_close'] = '</li>';
	        $config['prev_link'] = '&laquo';
	        $config['prev_tag_open'] = '<li class="prev">';
	        $config['prev_tag_close'] = '</li>';
	        $config['next_link'] = '&raquo';
	        $config['next_tag_open'] = '<li>';
	        $config['next_tag_close'] = '</li>';
	        $config['last_tag_open'] = '<li>';
	        $config['last_tag_close'] = '</li>';
	        $config['cur_tag_open'] = '<li class="active"><a href="#">';
	        $config['cur_tag_close'] = '</a></li>';
	        $config['num_tag_open'] = '<li>';
	        $config['num_tag_close'] = '</li>';
	
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$value = $this->News_model->getcategory($id); 
		$data['news'] =$this->News_model->getNewsByCatlimit($value->category_name,$config["per_page"], $page); 
		$data['newsadd'] = $this -> Advertisement_model -> getsmalladvertisment(4,0);
		$data["links"] = $this->pagination->create_links();
		$data['main_content']='news';
		$this->load->view('includes/secondpage', $data);	
	}
	
	public function details($id){
		$this->News_model->updatehits($id['0']);
		$news = $this->News_model->getNewsDetails($id['0']);
		$data['news'] = $news;
		$news_id = $this->uri->segment(3);
		$value = $this->News_model->getcategory($news->news_category); 
		$data['newsadd'] = $this -> Advertisement_model -> getsmalladvertisment(4,0);
	   $data['userComments'] = $this -> Comment_model -> getUserApprovedComments($news_id);

		$data['main_content']='details';
		$this->load->view('includes/secondpage', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */