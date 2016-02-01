<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Album extends CI_Controller {

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
        if (in_array('album_view', $this->allowed)) {
            $data['photoList'] = $this->Album_model->getAll();
            $data['allowed'] = $this->allowed;
            $data['title'] = "List Album";
            $data['main_content'] = ADMIN_PATH . "album_view";
            $this->load->view(ADMIN_PATH . 'include/template', $data);
        }else{
            redirect("admin");
        }     
    }

    function galleryPhoto($gid) {
        $this->showGalleryImage();
    }

    function deleteAction($id, $offset) {
        if (in_array('album_delete', $this->allowed)) {
            //check before delete if it is admin user or currently loggged in user
            if ($this->Album_model->deletealbum($id)) {
                $this->session->set_flashdata("su_message", "Album Deleted Successfully.");
            } else {
                $this->session->set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Album Can't Be Deleted.</font>");
            }
        } else {
            $this->session->set_flashdata("su_message", "You Have No Permission To Delete This Album");
        }

        redirect(ADMIN_PATH . "album");
    }

    function addAction() {
        $masterauth = new Auth_master_model();

        $data['mas_auth'] = $masterauth->getAllAuth();
        $data['error'] = $this->errors;
        $data['title'] = "Add Album";

        $data['main_content'] = ADMIN_PATH . "album_add_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function add() {
    	
        if (in_array('album_add', $this->allowed)) {
            if ($this->form_validation->run('album_add') == FALSE) {
                $this->addAction();
            } else {
                    $this->Album_model->insert();

                    $this->session->set_flashdata("su_message", "Album Added Successfully.");
                    redirect(ADMIN_PATH . "album");
            }
        } else {
            redirect("admin");
        }
    }

    function update() {
        if (in_array('album_update', $this->allowed)) {
            if ($this->form_validation->run('album_update') == FALSE) {
                $this->updateAction($this->input->post('album_id'));
            } else {
                //files validations
                    $this->Album_model->update($this->input->post('album_id'));

                    $this->session->set_flashdata("su_message", "Album Updated Successfully.");
                    redirect(ADMIN_PATH . "album");
            }
        } else {
            redirect(ADMIN_PATH . "album");
        }
    }

    function updateAction($id) {

        $masterauth = new Auth_master_model();
        $data['error'] = $this->errors;
        $data['photoRecord'] = $this->Album_model->getDetails($id);
        $data['title'] = "Update Album";
        $data['album_id'] = $id;
        $data['main_content'] = ADMIN_PATH . "albumupdate_view";


        $data['mas_auth'] = $masterauth->getAllAuth();

        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function uniquePhotoname($str) {
        $id = $this->input->post('photo_id');



        if ($this->Photo_model->uniquePhotoName($id, $this->input->post('photo_name')) > 0) {
            $this->form_validation->set_message('uniquePhotoname', 'Photo Name Must Be Unique');
            return FALSE;
        } else {
            return TRUE;
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

    function removeFile($file, $path) {

        if (file_exists($path . $file) && $file != "")
            unlink($path . $file);
    }

    function updateOrder($gid, $id, $order, $low_high, $offset) {
        if ($low_high <= 1) {
            $this->Photo_model->changehigherorder($gid, $id, $order);
        } else {
            $this->Photo_model->changelowerorder($gid, $id, $order);
        }
        $this->session->set_flashdata("su_message", "Order changed successfully");
        redirect("galleryphoto/show/$gid/$offset");
    }

    function changeStatus($id, $value, $offset) {
        $stat = "";
        if ($value == 'Active') {
            $stat = 'Inactive';
        } else {
            $stat = 'Active';
        }

        if ($this->Album_model->updateStatus($id, $stat)) {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        }
        redirect(ADMIN_PATH . "album/show/$offset");
    }

    function ifupoad_check($str) {
        if (!$_FILES['path']['name']) {
            $this->form_validation->set_message('ifupoad_check', 'No Image Uploaded');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

?>