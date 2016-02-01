<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newscategory extends CI_Controller {
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
        if (in_array('newscategory_view', $this -> allowed)) {
            $data['categoryList'] = $this -> News_category_model -> getAll();
            $data['allowed'] = $this -> allowed;
            $data['error'] = $this -> errors;        
            $data['title1'] = "Add News Category";
            $data['title'] = "List News Category";
            $data['main_content'] = ADMIN_PATH . "newscategory_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        }    
    }
    
    function deleteAction($user_id) {

        if (in_array('newscategory_delete', $this -> allowed)) {
            if ($this -> News_category_model -> delete($user_id)) {
                $this -> session -> set_flashdata("su_message", "News Category Deleted Successfully.");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }

        redirect(ADMIN_PATH . "newscategory");
    }

    function add() {
        if (in_array('newscategory_add', $this -> allowed)) {
            if ($this -> form_validation -> run('newscategory_add') == FALSE) {
                $this -> show();
            } else {
                    $this -> News_category_model -> insert();
                    ///$userauth=new User_auth_model();
                    //$userauth->add($this->input->post('user_id'));

                    $this -> session -> set_flashdata("su_message", "News Category Added Successfully.");
                    redirect(ADMIN_PATH . "newscategory");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Add New News Category");
            redirect(ADMIN_PATH . "newscategory");
        }
    }

    function update() {
        if (in_array('newscategory_update', $this -> allowed)) {
            if ($this -> form_validation -> run('newscategory_add') == FALSE) {
                $this -> updateAction($this -> input -> post('id'));
            } else {
                    $this -> News_category_model -> update($this -> input -> post('id'));

                    $this -> session -> set_flashdata("su_message", "News Category Updated Successfully.");
                    redirect(ADMIN_PATH . "newscategory");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Previleage To Update News Category");
            redirect(ADMIN_PATH . "newscategory");
        }
    }

    function updateAction($user_id) {
        if (in_array('newscategory_update', $this -> allowed)) {
            $data['categoryList'] = $this -> News_category_model -> getAll();
            $data['photoRecord'] = $this -> News_category_model -> getAdminDetails($user_id);
            $data['allowed'] = $this -> allowed;
            $data['error'] = $this -> errors;        
            $data['title1'] = "Update News Category";
            $data['title'] = "List News Category";
            $data['main_content'] = ADMIN_PATH . "newscategory_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        }   
    }
	
	function updateOrder($id, $order, $low_high) {
        if ($low_high <= 1) {
            $this -> News_category_model -> changehigherorder($id, $order);
        } else {
            $this -> News_category_model -> changelowerorder($id, $order);
        }
        $this -> session -> set_flashdata("su_message", "Order changed successfully");
        redirect(ADMIN_PATH . "newscategory");
    }

}
?>