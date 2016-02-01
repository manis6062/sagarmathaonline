<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webserve extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();			
    }    
	
	public function index(){
		$result = $this->News_category_model->getAll();
		if(!empty($result)){
			/* create one master array of the records */
			$posts = array();
				foreach($result as $post) {
					$posts[] = array('post'=>$post);
				}
			header('Content-type: application/json');
			echo json_encode(array('posts'=>$posts));
		}else{
			$posts = array();
			echo json_encode(array('posts'=>$posts));
		}	
	}
	
	public function news($category_id, $least_value, $final_value){
		$result = $this->News_model->getNewsbyCategory($category_id, $least_value, $final_value);
		if(!empty($result)){
	
			/* create one master array of the records */
			$posts = array();
				foreach($result as $post) {
					$posts[] = array('post'=>$post);
				}
			header('Content-type: application/json');
			echo json_encode(array('posts'=>$posts));
		}else{
			$posts = array();
			echo json_encode(array('posts'=>$posts));
		}		
	}
	public function newsdetails($news_id){
		$result = $this->News_model->getNewsDetails($news_id);
		if(!empty($result)){
	
			/* create one master array of the records */
			$posts = array();
			header('Content-type: application/json');
			echo json_encode(array('posts'=>$result));
		}else{
			$posts = array();
			echo json_encode(array('posts'=>$posts));
		}		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */