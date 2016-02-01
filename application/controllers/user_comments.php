<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_comments extends CI_Controller {
	
	 public function __construct()
       {
            parent::__construct();
          
			
       }    

       public function index() {
       
    }
	 

	
	function insert($news_id){
		  $this->load->model('comment_model');
        $this->Comment_model->insertUserComment();
         
        redirect( base_url().'news/details' .'/'. $news_id );
    }

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */