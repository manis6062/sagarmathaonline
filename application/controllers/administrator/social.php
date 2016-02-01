<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Social extends CI_Controller {

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
        $data['socialList'] = $this -> Social_model -> getAll();
        $data['title'] = "List Social Media";
        $data['main_content'] = ADMIN_PATH . "socialmedia_view";
        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

    function update() {
        $data = $this->input->post('social_link');
        foreach($data as $key=>$value){
                $this -> Social_model -> update($value, $key);                     
        }
        $this -> session -> set_flashdata("su_message", "Social Media Updated Successfully.");
        redirect(ADMIN_PATH . "social");
    }

}
?>