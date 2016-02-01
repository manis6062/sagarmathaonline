<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Team extends CI_Controller {
    private $allowed = array();
    private $errors = "";
    public function __construct() {
        parent::__construct();
        checkAdminAuth();
        // Your own constructor code
        $this -> load -> library('form_validation');
		$this -> load -> model('Team_model');
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
       
        	$team = $this ->Team_model -> getAllTeams();
            $data['teamLists'] = $team;
            $data['error'] = $this -> errors;
            $data['title'] = "Teams ";
            $data['main_content'] = ADMIN_PATH."team_lists";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
  
    }
	
	
	 function editPage($id) {
 
        	$team = $this ->Team_model -> getAll($id);
            $data['team'] = $team;
            $data['error'] = $this -> errors;
            $data['title'] = "Update Team";
            $data['main_content'] = ADMIN_PATH."team_view.php";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data); 
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

    var_dump($_POST['id']);   

    $id = $this->input->post('id');
                    if($id){
                        $this -> Team_model -> update($id);
                    }else{
                        $this -> Team_model -> insert();
                    }   

                    $this -> session -> set_flashdata("su_message", "Updated Successfully.");
                    redirect(ADMIN_PATH.'team');
               
      
    }
}
?>