<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Publication extends CI_Controller {
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

        $cond = array();
        if ($this -> session -> userdata(ADMIN_AUTH_TYPE) == "user") {
            $userid = $this -> session -> userdata(ADMIN_AUTH_USERID);
            //$cond="where ts_user.branch_id='$branchid'";
            $cond['ah_publication.crtd_by'] = $userid;

        }
        $config['total_rows'] = $this -> Publication_model -> countAll($cond);
        $config['base_url'] = site_url(ADMIN_PATH . "publication/show/");
        $config['per_page'] = '10';
        $config['uri_segment'] = '3';
        $offset = $this -> uri -> segment(3, 0);
        $this -> pagination -> initialize($config);
        $data['start'] = $page;
        $data['usersTypes'] = $this -> Publication_model -> getAllPaginate($cond, $config['per_page'], $offset);

        $data['title'] = "List Publication";
        $data['main_content'] = ADMIN_PATH . "publicationlist_view";
        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

    function deleteAction($user_id, $offset) {
        if (in_array('user_update', $this -> allowed)) {
            //check before delete if it is admin user or currently loggged in user
            $details = $this -> Publication_model -> getAdminDetails($user_id);

            if ($this -> Publication_model -> deleteuser($user_id)) {

                $path = './uploads/publication/';
                $this -> removeFile($details -> publication_file, $path);
                $this -> session -> set_flashdata("su_message", "Publication Deleted Successfully.");
            }

        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }

        redirect(ADMIN_PATH . "publication/show/$offset");
    }

    function addAction() {

        $masterauth = new Auth_master_model();
        $data['error'] = $this -> errors;

        $data['mas_auth'] = $masterauth -> getAllAuth();

        $data['title'] = "Add Publication";
        $data['main_content'] = ADMIN_PATH . "newpublication_view";
        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

    function add() {

        if (in_array('publication_add', $this -> allowed)) {
            if ($this -> form_validation -> run('publication_add') == FALSE) {
                $this -> addAction();
            } else {
                $photo = TRUE;

                $ph = "";

                $path = PUBLICATION_PATH;

                if ($_FILES['publication_file']['name']) {

                    $uploaded_details = $this -> upload('publication_file', "$path");

                    if ($uploaded_details == "") {
                        $error = array('error' => $this -> upload -> display_errors('<p>', '</p>'));
                        //$this->form_validation->set_message('Basic Document', "error");
                        $this -> errors = $error;

                        $photo = false;
                    } else {
                        $ph = $uploaded_details['file_name'];
                    }

                }
                if ($photo) {
                    $this -> Publication_model -> insert($ph);

                    $this -> session -> set_flashdata("su_message", "Publication Added Successfully.");
                    redirect(ADMIN_PATH . "publication/index");
                } else {
                    $this -> addAction();
                }

            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Add New Publication");
            redirect(ADMIN_PATH . "publication/index");
        }

    }

    function update($offset) {
        if (in_array('publication_update', $this -> allowed)) {
            if ($this -> form_validation -> run('publication_edit') == FALSE) {
                $this -> updateAction($this -> input -> post('publication_id'), $offset);
            } else {
                //files validations
                $photo = TRUE;

                $ph = "";
                $oldph = $this -> input -> post('old_image');

                $path = PUBLICATION_PATH;

                if ($_FILES['publication_file']['name']) {
                    $uploaded_details = $this -> upload('publication_file', "$path");

                    if ($uploaded_details == "") {
                        $error = array('error' => $this -> upload -> display_errors('<p>', '</p>'));
                        //$this->form_validation->set_message('Basic Document', "error");
                        $this -> errors = $error;

                        $photo = false;
                    } else {
                        $ph = $uploaded_details['file_name'];
                    }

                }

                if ($photo) {
                    if ($ph != "") {
                        $this -> removeFile($oldph, $path);

                    } else {
                        $ph = $oldph;
                    }

                    $this -> Publication_model -> update($this -> input -> post('publication_id'), $ph);

                    $this -> session -> set_flashdata("su_message", "Publication Updated Successfully.");
                    redirect(ADMIN_PATH . "publication/show/$offset");
                } else {
                    $this -> updateAction($this -> input -> post('publication_id'), $offset);
                }

            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Previleage To Update Publication");
            redirect(ADMIN_PATH . "publication/show/$offset");
        }
    }

    function updateAction($user_id, $offset) {
        $masterauth = new Auth_master_model();
        $data['error'] = $this -> errors;
        $data['usersTypes'] = $this -> Publication_model -> getAdminDetails($user_id);
        $data['title'] = "Update Publication";
        $data['main_content'] = ADMIN_PATH . "publicationupdate_view";
        $data['offset'] = $offset;
        $data['mas_auth'] = $masterauth -> getAllAuth();

        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

    function updateOrder($id, $order, $low_high, $offset) {
        if ($low_high <= 1) {
            $this -> Publication_model -> changehigherorder($id, $order);
        } else {
            $this -> Publication_model -> changelowerorder($id, $order);
        }
        $this -> session -> set_flashdata("su_message", "Order changed successfully");
        redirect(ADMIN_PATH . "publication/show/$offset");
    }

    function changeStatus($id, $value, $offset) {
        $stat = "";
        if ($value == 'Yes') {
            $stat = 'No';
        } else {
            $stat = 'Yes';
        }

        if ($this -> Publication_model -> updateStatus($id, $stat)) {
            $this -> session -> set_flashdata("su_message", "Status Updated Successfully.");

        } else {
            $this -> session -> set_flashdata("su_message", "Status Updated Successfully.");

        }
        redirect(ADMIN_PATH . "publication/show/$offset");
    }

    function ifupoad_check($str) {
        if (!$_FILES['publication_file']['name']) {
            $this -> form_validation -> set_message('ifupoad_check', 'No File Uploaded');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function upload($file, $path) {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '2000';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['encrypt_name'] = true;
        $config['remove_spaces'] = true;

        $this -> load -> library('upload', $config);
        if ($this -> upload -> do_upload($file)) {
            $data = $this -> upload -> data();
        } else {
            $data = "";
        }

        return $data;
    }

    function removeFile($file, $path) {

        if (file_exists($path . $file) && $file != "")
            unlink($path . $file);

    }

}
?>