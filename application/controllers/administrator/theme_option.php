<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Theme_option extends CI_Controller {
    private $allowed = array();
    private $errors = "";
    public function __construct() {
        parent::__construct();
        checkAdminAuth();
        // Your own constructor code
        $this -> load -> library('form_validation');
		$this -> load -> model('Theme_option_model');
		$this -> load -> library('pagination');
        $this -> form_validation -> set_error_delimiters('<div class="red">', '</div>');
        $this -> load -> helper(array('form', 'url'));
        $this -> load -> helper('path');
        $this -> allowed = $this -> Auth_master_model -> getAuth();
    }

    public function index() {
        $this -> show($page = '');
    }

    function show($page = '') {
        if (in_array('theme_option_update', $this -> allowed)) {
        	$themeoption = $this ->Theme_option_model -> getTotalLists();
            $data['themeoption'] = $themeoption;
            $data['allowed'] = $this -> allowed;
            $data['error'] = $this -> errors;
            $data['title'] = "Youtube Links ";
            $data['main_content'] = ADMIN_PATH."theme_option_lists";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        }    
    }
	
	
	 function editPage($id) {
        if (in_array('theme_option_update', $this -> allowed)) {
        	$themeoption = $this ->Theme_option_model -> getAll($id);
            $data['themeoption'] = $themeoption;
			
            $data['allowed'] = $this -> allowed;
            $data['error'] = $this -> errors;
            $data['title'] = "Youtube Links ";
            $data['main_content'] = ADMIN_PATH."theme_option_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        }    
    }
	 
	 public function deletePage($id)
	 {
		   if (in_array('theme_option_update', $this -> allowed)) {
                    	$this -> Theme_option_model -> delete($id);
                    $this -> session -> set_flashdata("su_message", "Deleted Successfully.");
                    redirect(ADMIN_PATH.'theme_option');
                } else {
                    $this -> show();
                }}
	
    function update() {
        if (in_array('theme_option_update', $this -> allowed)) {
            	
					if($this->input->post('id')){
                    	$this -> Theme_option_model -> update();
					}else{
						$this -> Theme_option_model -> insert();
					}	

                    $this -> session -> set_flashdata("su_message", "Updated Successfully.");
                    redirect(ADMIN_PATH.'theme_option');
                } else {
                    $this -> show();
                }
      
	}
}
?>