<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Character extends CI_Controller {

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
        $data['characterList'] = $this->Character_model->getAll('all', $config['per_page'], $offset);

        $data['title'] = "List Character";
        $data['main_content'] = ADMIN_PATH . "character_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function galleryPhoto($gid) {
        $this->showGalleryImage();
    }

    function deleteAction($id, $offset) {
        $details = $this->Character_model->getPhotoDetails($id);
        if ($this->Character_model->deletePhoto($id)) {
            $path = CHARACTER_IMAGE_PATH;

            $this->removeFile($details->character_image, $path);

            $this->session->set_flashdata("su_message", "Character Deleted Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Character Can't Be Deleted.</font>");
        }

        redirect(ADMIN_PATH . "character/show/$offset");
    }

    function addAction() {
        $masterauth = new Auth_master_model();

        $data['mas_auth'] = $masterauth->getAllAuth();
        $data['error'] = $this->errors;
        $data['title'] = "Add Character";

        $data['main_content'] = ADMIN_PATH . "character_add_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function add() {

        if ($this->form_validation->run('character_add') == FALSE) {
            $this->addAction();
        } else {
            //files validations
            $photo = TRUE;
            $ph = "";
            $path = "";
            if ($_FILES['character_image']['name']) {
                $path = CHARACTER_IMAGE_PATH;

                $uploaded_details = $this->upload('character_image', "$path");


                if ($uploaded_details == "") {
                    $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                    //$this->form_validation->set_message('Basic Document', "error");
                    $this->errors = $error;

                    $photo = false;
                } else {
                    $ph = $uploaded_details['file_name'];
                }
            }

            if ($photo) {
                $this->Character_model->insert($ph);

                $this->session->set_flashdata("su_message", "Character Addded Successfully.");
                redirect(ADMIN_PATH . "character/index");
            } else {
                $this->addAction();
            }
        }
    }

    function update($offset) {
        if ($this->form_validation->run('character_update') == FALSE) {
            $this->updateAction($this->input->post('id'), $offset);
        } else {
            //files validations
            $photo = TRUE;

            $ph = "";
            $oldph = $this->input->post('old_image');

            $path = "";

            $path = CHARACTER_IMAGE_PATH;

            if ($_FILES['character_image']['name']) {


                $uploaded_details = $this->upload('character_image', "$path");


                if ($uploaded_details == "") {
                    $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                    //$this->form_validation->set_message('Basic Document', "error");
                    $this->errors = $error;

                    $photo = FALSE;
                } else {
                    $ph = $uploaded_details['file_name'];
                }
            }

            if ($photo) {

                if ($ph != "") {

                    $this->removeFile($oldph, $path);
                } else {
                    $ph = $oldph;
                }

                $this->Character_model->update($this->input->post('id'), $ph);

                $this->session->set_flashdata("su_message", "Character Updated Successfully.");
                redirect(ADMIN_PATH . "character/show/$offset");
            } else {
                $this->updateAction($this->input->post('id'), $offset);
            }
        }
    }

    function updateAction($id, $offset) {

        $masterauth = new Auth_master_model();
        $data['error'] = $this->errors;
        $data['photoRecord'] = $this->Character_model->getPhotoDetails($id);
        $data['title'] = "Update Character";
        $data['id'] = $id;
        $data['offset'] = $offset;
        $data['main_content'] = ADMIN_PATH . "character_update_view";


        $data['mas_auth'] = $masterauth->getAllAuth();

        $this->load->view(ADMIN_PATH . 'include/template', $data);
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

    function changeStatus($id, $value, $offset) {
        $stat = "";
        if ($value == 'active') {
            $stat = 'inactive';
        } else {
            $stat = 'active';
        }

        if ($this->Character_model->updateStatus($id, $stat)) {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        }
        redirect(ADMIN_PATH . "character/show/$offset");
    }

    function ifupoad_check($str) {
        if (!$_FILES['character_image']['name']) {
            $this->form_validation->set_message('ifupoad_check', 'No Image Uploaded');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}

?>