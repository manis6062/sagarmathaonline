<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Module extends CI_Controller {

    private $errors = "";
    private $allowed = array();

    public function __construct() {
        parent::__construct();
        checkAdminAuth();
        // Your own constructor code
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->form_validation->set_error_delimiters('<div class="red">', '</div>');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('path');
        //$this->load->model('auth_master_model');
        //$this->load->model('user_auth_model');
        $this->allowed = $this->Auth_master_model->getAuth();
    }

    public function index() {
        $this->show($page = '');
    }

    function show($page = '') {
        $cond = array();
        if (in_array('module_view', $this->allowed)) {
            $data['moduleList'] = $this->Module_model->getAll();
            $data['title'] = "List Module";
            $data['main_content'] = ADMIN_PATH . "module_view";
            $this->load->view(ADMIN_PATH . 'include/template', $data);
        }else{
            redirect(ADMIN_PATH . "admin");
        }     
    }

    function delete($id) {
        if (in_array('module_add', $this->allowed)) {
            if ($this->Module_model->delete($id)) {
                $this->session->set_flashdata("su_message", "Module Deleted Successfully.");
            }
            redirect(ADMIN_PATH . "module");
        }else{
            redirect(ADMIN_PATH . "admin");
        }            
    }

    function addAction() {
        $masterauth = new Auth_master_model();
        $data['mas_auth'] = $masterauth->getAllAuth();
        $data['error'] = $this->errors;

        $data['title'] = "Add Module";
        $data['main_content'] = ADMIN_PATH . "moduleadd_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function add() {
        if (in_array('module_add', $this->allowed)) {
            if ($this->form_validation->run('module_add') == FALSE) {
                $this->addAction();
            } else {
                if($this->Module_model->insert($menu_data)>0){
                    $this->session->set_flashdata("su_message", "Module Addded Successfully.");
                }else{
                    $this->session->set_flashdata("su_message", "Some error occured while adding new module.");
                }    
                redirect(ADMIN_PATH . "module");
            }
        }else{
            redirect(ADMIN_PATH . "admin");
        }   
    }

    function update() {
        if (in_array('module_update', $this->allowed)) {
            if ($this->form_validation->run('module_add') == FALSE) {
                $this->updateAction($this->input->post('id'));
            } else {
                if($this->Module_model->update($this->input->post('id'))){
                    $this->session->set_flashdata("su_message", "Module Updated Successfully.");
                }else{
                    $this->session->set_flashdata("su_message", "Some error occured while updating module.");
                }    
                redirect(ADMIN_PATH . "module");
            }
        }else{
            redirect(ADMIN_PATH . "admin");
        }   
    }

    function updateAction($id) {
        $masterauth = new Auth_master_model();
        $data['error'] = $this->errors;
        $data['modules'] = $this->Module_model->getDetails($id);
        $data['title'] = "Update Module";
        $data['main_content'] = ADMIN_PATH . "moduleupdate_view";
        $data['mas_auth'] = $masterauth->getAllAuth();

        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }
}

?>