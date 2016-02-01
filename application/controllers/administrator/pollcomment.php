<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pollcomment extends CI_Controller {

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
        $this->load->helper('string');

        //$this->load->model('auth_master_model');
        //$this->load->model('user_auth_model');
        $this->allowed = $this->Auth_master_model->getAuth();
    }

    public function index() {
        $this->show($page = '');
    }

    function show($page = '') {
        $cond = array();
        $config['total_rows'] = $this->Comment_poll_model->count();
        $config['base_url'] = site_url(ADMIN_PATH . "pollcomment/show/");
        $config['per_page'] = '10';
        $config['uri_segment'] = '4';
        $offset = $this->uri->segment(4, 0);
        $this->pagination->initialize($config);
        $data['start'] = $page;
        $data['commentList'] = $this->Comment_poll_model->getAll($cond);

        $data['title'] = "List Poll Comments";
        $data['main_content'] = ADMIN_PATH . "comment_poll_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }
    
    function changeStatus($id, $value, $offset) {
        $stat = "";
        if ($value == 'Publish') {
            $stat = 'Unpublish';
        } else {
            $stat = 'Publish';
        }

        if ($this->Comment_poll_model->updateStatus($id, $stat)) {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        }
        redirect(ADMIN_PATH . "pollcomment/show/$offset");
    }
}

?>