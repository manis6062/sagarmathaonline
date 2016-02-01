<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Writercategory extends CI_Controller {
    private $allowed = array();
    private $errors = "";
    public function __construct() {
        parent::__construct();
        checkAdminAuth();
        // Your own constructor code
        $this -> load -> library('form_validation');
        $this -> load -> library('pagination');
        $this -> form_validation -> set_error_delimiters('<div class="red">', '</div>');
        $this -> load -> helper(array('form', 'url'));
        $this -> load -> helper('path');
        //$this->load->model('auth_master_model');
        //$this->load->model('user_auth_model');
        $this -> allowed = $this -> Auth_master_model -> getAuth();
    }

    public function index() {
        $this -> show($page = '');

    }

    function show($page = '') {
        if (in_array('writercategory_view', $this -> allowed)) {
            $data['categoryList'] = $this -> Writercategory_model -> getAll();
            $data['allowed'] = $this -> allowed;
            $data['error'] = $this -> errors;        
            $data['title1'] = "Add Writer Category";
            $data['title'] = "List Writer Category";
            $data['main_content'] = ADMIN_PATH . "writercategory_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        }    
    }
    
    function deleteAction($user_id) {

        if (in_array('writercategory_delete', $this -> allowed)) {
            if ($this -> Writercategory_model -> delete($user_id)) {
                $this -> session -> set_flashdata("su_message", "Team Category Deleted Successfully.");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }

        redirect(ADMIN_PATH . "writercategory");
    }

    function add() {
        if (in_array('writercategory_add', $this -> allowed)) {
            if ($this -> form_validation -> run('writercategory_add') == FALSE) {
                $this -> show();
            } else {
                    $this -> Writercategory_model -> insert();
                    ///$userauth=new User_auth_model();
                    //$userauth->add($this->input->post('user_id'));

                    $this -> session -> set_flashdata("su_message", "Team Category Added Successfully.");
                    redirect(ADMIN_PATH . "writercategory");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Add New Team Category");
            redirect(ADMIN_PATH . "writercategory");
        }
    }

    function update() {
        if (in_array('writercategory_update', $this -> allowed)) {
            if ($this -> form_validation -> run('writercategory_add') == FALSE) {
                $this -> updateAction($this -> input -> post('id'));
            } else {
                    $this -> Writercategory_model -> update($this -> input -> post('id'));

                    $this -> session -> set_flashdata("su_message", "Team Category Updated Successfully.");
                    redirect(ADMIN_PATH . "writercategory");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Previleage To Update Team Category");
            redirect(ADMIN_PATH . "writercategory");
        }
    }

    function updateAction($user_id) {
        if (in_array('writercategory_update', $this -> allowed)) {
            $data['categoryList'] = $this -> Writercategory_model -> getAll();
            $data['photoRecord'] = $this -> Writercategory_model -> getAdminDetails($user_id);
            $data['allowed'] = $this -> allowed;
            $data['error'] = $this -> errors;        
            $data['title1'] = "Update Writer Category";
            $data['title'] = "List Writer Category";
            $data['main_content'] = ADMIN_PATH . "writercategory_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        }   
    }

}
?>