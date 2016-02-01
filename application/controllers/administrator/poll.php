<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poll extends CI_Controller {

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
        $config['per_page'] = '10';
        $config['uri_segment'] = '4';
        $offset = $this->uri->segment(4, 0);
        $data['pollList'] = $this->Poll_model->getAllPoll($config['per_page'], $offset);

        $data['title'] = "List Polls";
        $data['main_content'] = ADMIN_PATH . "polllist_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function deleteAction($id, $offset) {
        $details = $this->Polldetail_model->getPhotoDetails($id);
        $path = POLL_IMAGE_PATH;
        foreach($details as $data){
            @unlink($path.$data->image);
        }
        if ($this->Poll_model->deletePoll($id)) {
            if($this->Polldetail_model->deletePollDetail($id)){
                $this->session->set_flashdata("su_message", "Poll Deleted Successfully.");
            }
        } else {
            $this->session->set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Poll Can't Be Deleted.</font>");
        }

        redirect(ADMIN_PATH . "poll/show/$offset");
    }

    function viewDetail($id) {
        $data['pollData'] = $this->Poll_model->getData($id);
        $data['pollList'] = $this->Poll_model->getDetail($id);

        $data['title'] = "Poll Detail";
        $data['main_content'] = ADMIN_PATH . "polldetail_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function addAction() {
        $masterauth = new Auth_master_model();

        $data['mas_auth'] = $masterauth->getAllAuth();
        $data['error'] = $this->errors;
        $data['title'] = "Add Poll";
        $data['cartoon_id'] = "";

        $data['main_content'] = ADMIN_PATH . "poll_add_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function add() {
        if ($this->form_validation->run('poll_add') == FALSE) {
            $this->addAction("");
        } else {
            $photo = TRUE;
            if ($photo) {
                $cartoon_id = "";
                $pollid = $this->Poll_model->insert($cartoon_id);
                $i = 1;
                foreach ($_POST['option'] as $key1 => $value) {
                    $values = $value;
                    $i = $key1;                    
                    $img = $_FILES["files"]["name"];
                    foreach ($img as $key => $value) {
                        $j=$key;
                        if ($j==$i) {
                            if($_FILES["files"]["name"][$key]!=""){
                                $name = $_FILES["files"]["name"][$key];
                                $tname = $_FILES["files"]["tmp_name"][$key];
                                $size = $_FILES["files"]["size"][$key];
                                $ext = $this->get_file_extension($name);
                                $name = pathinfo($name, PATHINFO_FILENAME);
                                $name = $name.$pollid.$i;
                                $name = $name.".".$ext;
                                $ph = "";
                                $path = "";
                                $path = POLL_IMAGE_PATH;
                                //@unlink($path.$name.$pollid.$i);
                                if (move_uploaded_file($tname, $path.$name)) {
                                    $ph = $name;
                                    $this->Polldetail_model->insert($pollid, $values, $ph, 0);
                                }
                            }else{
                                $ph = "";
                                    if ($values != "") {
                                        $this->Polldetail_model->insert($pollid, $values, $ph, 0);
                                    }
                            }    
                        }
                    }
                }
                $this->session->set_flashdata("su_message", "Poll Added Successfully.");
                redirect(ADMIN_PATH . "poll/index");
            } else {
                $this->addPoll("");
            }
        }
    }

    function upload($file, $path) {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['overwrite'] = false;

        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['encrypt_name'] = true;
        $config['remove_spaces'] = true;

        $this->load->library('upload', $config);
        if ($this->upload->do_upload($file)) {
            //$data = $this->upload->data();
            //Image Resizing
            $config['image_library'] = 'gd2';
            $config['source_image'] = $this->upload->upload_path . $this->upload->file_name;
            $config['new_image'] = $path;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 660;
            $config['height'] = 251;
            $this->load->library('image_lib', $config);
            if ($this->image_lib->resize()) {
                $data = $this->upload->data();
            } else {
                $data = "";
            }
        } else {
            $data = "";
        }
        return $data;
    }
    
    function get_file_extension($file_name) {
	return substr(strrchr($file_name,'.'),1);
    }

}

?>