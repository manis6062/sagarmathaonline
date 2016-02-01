<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Content extends CI_Controller {

    private $errors = "";
    private $allowed = array();

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
        if (in_array('content_view', $this -> allowed)) {
            $data['usersTypes'] = $this -> Content_model -> getAll();
            $data['title'] = "List Content";
            $data['main_content'] = ADMIN_PATH . "contentlist_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        } else {
            redirect("admin");
        }
    }

    function deleteAction($user_id) {
        if (in_array('user_update', $this -> allowed)) {
            if ($this -> Content_model -> delete($user_id)) {
                $this -> session -> set_flashdata("su_message", "Content Deleted Successfully.");
            } else {
                $this -> session -> set_flashdata("su_message", "Some error occured while deleting content.");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }
        redirect(ADMIN_PATH . "content");
    }

    function addAction() {

        $masterauth = new Auth_master_model();
        $data['error'] = $this -> errors;
        $data['mas_auth'] = $masterauth -> getAllAuth();
        $data['title'] = "Add Content";
        $data['main_content'] = ADMIN_PATH . "contentadd_view";
        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

    function add() {
        if (in_array('content_add', $this -> allowed)) {
            if ($this -> form_validation -> run('content_add') == FALSE) {
                $this -> addAction();
            } else {
                if ($this -> Content_model -> insert() > 0) {
                    $this -> session -> set_flashdata("su_message", "Content Added Successfully.");
                } else {
                    $this -> session -> set_flashdata("su_message", "Some problem occured while adding content.");
                }
                redirect(ADMIN_PATH . "content");
            }
        } else {
            redirect("admin");
        }
    }

    function update() {
        if (in_array('content_update', $this -> allowed)) {
            if ($this -> form_validation -> run('content_add') == FALSE) {
                $this -> updateAction($this -> input -> post('content_id'));
            } else {
                if ($this -> Content_model -> update($this -> input -> post('content_id'))) {
                    $this -> session -> set_flashdata("su_message", "Content Updated Successfully.");
                } else {
                    $this -> session -> set_flashdata("su_message", "Some error occured while udpating content.");
                }
                redirect(ADMIN_PATH . "content");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Previleage To Update Content");
            redirect(ADMIN_PATH . "content");
        }
    }

    function updateAction($user_id) {
        $masterauth = new Auth_master_model();
        $data['usersTypes'] = $this -> Content_model -> getAdminDetails($user_id);
        $data['title'] = "Update Content";
        $data['main_content'] = ADMIN_PATH . "contentupdate_view";
        $data['mas_auth'] = $masterauth -> getAllAuth();

        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

    function changeStatus($id, $value) {
        $stat = "";
        if ($value == 'Yes') {
            $stat = 'No';
        } else {
            $stat = 'Yes';
        }

        if ($this -> Content_model -> updateStatus($id, $stat)) {
            $this -> session -> set_flashdata("su_message", "Status Updated Successfully.");
        } else {
            $this -> session -> set_flashdata("su_message", "Some error occured while updating status.");
        }
        redirect(ADMIN_PATH . "content");
    }

}
?>