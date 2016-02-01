<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client extends CI_Controller {

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
        if ($this->session->userdata(ADMIN_AUTH_TYPE) == "user") {
            $userid = $this->session->userdata(ADMIN_AUTH_USERID);
            //$cond="where ts_user.branch_id='$branchid'";
            //$cond['nc_client.id']=$userid;
        }
        $config['total_rows'] = $this->Client_model->countAll($cond);
        $config['base_url'] = site_url(ADMIN_PATH . "client/show/");
        $config['per_page'] = '10';
        $config['uri_segment'] = '4';
        $offset = $this->uri->segment(4, 0);
        $this->pagination->initialize($config);
        $data['start'] = $page;
        $data['clientList'] = $this->Client_model->getAllUsers();


        $data['title'] = "List Clients";
        $data['main_content'] = ADMIN_PATH . "client_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function deleteClient($id, $offset) {
        $data = $this->Client_model->getSingleUsers($id);
        $picture = $data->picture;

        if ($this->Client_model->deleteClient($id)) {
            $path = CLIENT_IMAGE_PATH;
            @unlink($path . $picture);
            $this->session->set_flashdata("su_message", "Client Deleted Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Client Can't Be Deleted.</font>");
        }
        redirect(ADMIN_PATH . "client/show/$offset");
    }

    function update($offset) {
        if (in_array('news_update', $this->allowed)) {
            if ($this->form_validation->run('news_add') == FALSE) {
                $this->updateNews($this->input->post('news_id'), $offset);
            } else {

                $this->Client_model->update($this->input->post('news_id'));

                $this->session->set_flashdata("su_message", "News Updated Successfully.");
                redirect(ADMIN_PATH . "news/show/$offset");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Permission To Update News");
            redirect(ADMIN_PATH . "news/show/$offset");
        }
    }

    function updateStatus($id, $order, $low_high, $offset) {
        if ($low_high <= 1) {
            $this->Client_model->changehigherorder($id, $order);
        } else {
            $this->Client_model->changelowerorder($id, $order);
        }
        $this->session->set_flashdata("su_message", "Order changed successfully");
        redirect(ADMIN_PATH . "client/show/$offset");
    }

    function changeStatus($id, $value, $offset) {
        $stat = "";
        if ($value == 'active') {
            $stat = 'Inactive';
        } else {
            $stat = 'active';
        }

        if ($this->Client_model->updateStatus($id, $stat)) {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        }
        redirect(ADMIN_PATH . "client/show/$offset");
    }

    function updateClient($id, $offset) {


        $masterauth = new Auth_master_model();
        $data['newsRecord'] = $this->Client_model->getNewsDetails($id);
        $data['title'] = "Update News";
        $data['main_content'] = ADMIN_PATH . "news_update_view";
        $data['offset'] = $offset;

        $data['mas_auth'] = $masterauth->getAllAuth();

        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

}

?>