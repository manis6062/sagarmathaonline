<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cartoonstrip extends CI_Controller {

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

        $data['cartoonstoryList'] = $this->Cartoonstrip_model->getAll('all');

        $data['title'] = "List Cartoon Story";
        $data['main_content'] = ADMIN_PATH . "cartoonstorylist_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function deleteAction($id, $offset) {
        $details = $this->Cartoonstrip_model->getPhotoDetails($id);
        if ($this->Cartoonstrip_model->deletePhoto($id)) {
            $path = CARTOON_IMAGE_PATH;

            $this->removeFile($details->path, $path);

            $this->session->set_flashdata("su_message", "Cartoon Story Deleted Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Cartoon Story Can't Be Deleted.</font>");
        }

        redirect(ADMIN_PATH . "cartoonstrip/show/$offset");
    }

    function addAction() {
        $masterauth = new Auth_master_model();

        $data['mas_auth'] = $masterauth->getAllAuth();
        $data['error'] = $this->errors;
        $data['title'] = "Add Cartoon Story";

        $data['main_content'] = ADMIN_PATH . "cartoonstory_add_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function add() {
        if ($this->form_validation->run('cartoon_add') == FALSE) {
            $this->addAction();
        } else {
            //files validations
            $photo = TRUE;
            $ph = "";
            $path = "";
            $pic = "";
            if ($_FILES['featured_image']['name']) {
                $path = CARTOON_IMAGE_PATH;

                $uploaded_details = $this->upload('featured_image', "$path");


                if ($uploaded_details == "") {
                    $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                    //$this->form_validation->set_message('Basic Document', "error");
                    $this->errors = $error;

                    $photo = false;
                } else {
                    $ph = $uploaded_details['file_name'];
                }
            }
            if ($_FILES['banner_image']['name']) {
                $path = CARTOON_IMAGE_PATH;

                $uploaded_details = $this->upload('banner_image', "$path");


                if ($uploaded_details == "") {
                    $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                    //$this->form_validation->set_message('Basic Document', "error");
                    $this->errors = $error;

                    $photo = false;
                } else {
                    $pic = $uploaded_details['file_name'];
                }
            }
            if ($photo) {
                $this->Cartoonstrip_model->insert($ph, $pic);

                $this->session->set_flashdata("su_message", "Cartoon Addded Successfully.");
                redirect(ADMIN_PATH . "cartoon/index");
            } else {
                $this->addAction();
            }
        }
    }

    function update($offset) {
        if ($this->form_validation->run('cartoon_update') == FALSE) {
            $this->updateAction($this->input->post('id'), $offset);
        } else {
            //files validations
            $photo = TRUE;

            $phfeat = "";
            $picbanner = "";            
            $oldphfeat = $this->input->post('old_image_featured');
            $oldpicbanner = $this->input->post('old_image_banner');

            $path = "";

            $path = SOCIAL_IMAGE_PATH;

            if ($_FILES['featured_image']['name']) {


                $uploaded_details = $this->upload('featured_image', "$path");


                if ($uploaded_details == "") {
                    $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                    //$this->form_validation->set_message('Basic Document', "error");
                    $this->errors = $error;

                    $photo = FALSE;
                } else {
                    $phfeat = $uploaded_details['file_name'];
                }
            }
            if ($_FILES['banner_image']['name']) {


                $uploaded_details = $this->upload('banner_image', "$path");


                if ($uploaded_details == "") {
                    $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
                    //$this->form_validation->set_message('Basic Document', "error");
                    $this->errors = $error;

                    $photo = FALSE;
                } else {
                    $picbanner = $uploaded_details['file_name'];
                }
            }

            if ($photo) {

                if ($phfeat != "") {
                    $this->removeFile($oldphfeat, $path);
                } else {
                    $phfeat = $oldphfeat;                    
                }
                if ($picbanner != "") {
                    $this->removeFile($oldpicbanner, $path);
                } else {
                    $picbanner = $oldpicbanner;                    
                }

                $this->Cartoonstrip_model->update($this->input->post('id'), $ph);

                $this->session->set_flashdata("su_message", "Cartoon Updated Successfully.");
                redirect(ADMIN_PATH . "cartoon/show/$offset");
            } else {
                $this->updateAction($this->input->post('id'), $offset);
            }
        }
    }

    function updateAction($id, $offset) {

        $masterauth = new Auth_master_model();
        $data['error'] = $this->errors;
        $data['photoRecord'] = $this->Cartoonstrip_model->getPhotoDetails($id);
        $data['title'] = "Update Cartoon";
        $data['id'] = $id;
        $data['offset'] = $offset;
        $data['main_content'] = ADMIN_PATH . "cartoon_update_view";


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

    function changeStatus($id, $value, $offset) {
        $stat = "";
        if ($value == 'Active') {
            $stat = 'Inactive';
        } else {
            $stat = 'Active';
        }

        if ($this->Cartoonstrip_model->updateStatus($id, $stat)) {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        }
        redirect(ADMIN_PATH . "cartoonstrip/show/$offset");
    }
}

?>