<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Writer extends CI_Controller {
    private $allowed = array();
    private $errors = "";
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
        if (in_array('writer_view', $this -> allowed)) {
            $cond = array();
            $config['total_rows'] = $this -> Writer_model -> countAll($cond);
            $config['base_url'] = site_url(ADMIN_PATH . "writer/show/");
            $config['per_page'] = '10';
            $config['uri_segment'] = '4';
            $offset = $this -> uri -> segment(4, 0);
            $this -> pagination -> initialize($config);
            $data['start'] = $page;
            $data['usersTypes'] = $this -> Writer_model -> getAllPaginate($cond, $config['per_page'], $offset);

            $data['title'] = "List Team";
            $data['main_content'] = ADMIN_PATH . "writerlist_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        } else {
            redirect(ADMIN_PATH . "home");
        }
    }

    function deleteAction($user_id) {

        if (in_array('writer_delete', $this -> allowed)) {
            $details = $this -> Writer_model -> getAdminDetails($user_id);
            if ($this -> Writer_model -> deleteuser($user_id)) {
                $path = TEAM_PATH;
                $this -> removeFile($details -> writer_image, $path);
                $this -> session -> set_flashdata("su_message", "Team Member Deleted Successfully.");
            }

        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }

        redirect(ADMIN_PATH . "writer");
    }

    function checkBeforeDelete($user_id) {
        if ($user_id == $this -> session -> userdata(ADMIN_AUTH_USERID)) {
            return FALSE;
        } else {
            $details = $this -> User_model -> getAdminDetails($user_id);
            if ($details -> user_type == 'admin') {
                return FALSE;
            } else {
                return TRUE;
            }

        }

    }

    function addAction() {
        $masterauth = new Auth_master_model();
        $data['error'] = $this -> errors;
        $data['mas_auth'] = $masterauth -> getAllAuth();
        $data['title'] = "Add Team";
        $data['main_content'] = ADMIN_PATH . "newwriter_view";
        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

    function add() {
        if (in_array('writer_add', $this -> allowed)) {
            if ($this -> form_validation -> run('writer_add') == FALSE) {
                $this -> addAction();
            } else {
                $photo = TRUE;

                $ph = "";

                $path = TEAM_PATH;

                if ($_FILES['writer_image']['name']) {
                    $uploaded_details = $this -> upload('writer_image', "$path");

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
                    $this -> Writer_model -> insert($ph);
                    ///$userauth=new User_auth_model();
                    //$userauth->add($this->input->post('user_id'));

                    $this -> session -> set_flashdata("su_message", "Team Member Added Successfully.");
                    redirect(ADMIN_PATH . "writer");
                } else {
                    $this -> addAction();
                }

            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Add New Team Member");
            redirect(ADMIN_PATH . "writer");
        }

    }

    function update() {
        if (in_array('writer_update', $this -> allowed)) {
            if ($this -> form_validation -> run('writer_add') == FALSE) {
                $this -> updateAction($this -> input -> post('writer_id'));
            } else {
                //files validations
                $photo = TRUE;

                $ph = "";
                $oldph = $this -> input -> post('old_image');

                $path = TEAM_PATH;

                if ($_FILES['writer_image']['name']) {

                    $uploaded_details = $this -> upload('writer_image', "$path");

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

                    $this -> Writer_model -> update($this -> input -> post('writer_id'), $ph);

                    $this -> session -> set_flashdata("su_message", "Team Member Updated Successfully.");
                    redirect(ADMIN_PATH . "writer");
                } else {
                    $this -> updateAction($this -> input -> post('writer_id'));
                }

            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Previleage To Update Team Member");
            redirect(ADMIN_PATH . "writer");
        }
    }

    function updateAction($user_id) {
        $masterauth = new Auth_master_model();
        $data['error'] = $this -> errors;
        $data['usersTypes'] = $this -> Writer_model -> getAdminDetails($user_id);
        $data['title'] = "Update Team";
        $data['main_content'] = ADMIN_PATH . "writerupdate_view";
        $data['mas_auth'] = $masterauth -> getAllAuth();

        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

    function ifupoad_check($str) {
        if (!$_FILES['writer_image']['name']) {
            $this -> form_validation -> set_message('ifupoad_check', 'No Image Uploaded');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function upload($file, $path) {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
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
    
    function updateOrder($id, $order, $low_high, $category) {
        if ($low_high <= 1) {
            $this -> Writer_model -> changehigherorder($id, $order, $category);
        } else {
            $this -> Writer_model -> changelowerorder($id, $order, $category);
        }
        $this -> session -> set_flashdata("su_message", "Order changed successfully");
        redirect(ADMIN_PATH . "writer");
    }

}
?>