<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery extends CI_Controller {

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

    function _remap($method, $args) {
        if (method_exists($this, $method)) {
            $this -> $method($args);
        } else {
            $this -> index($method, $args);
        }
    }

    public function index($id) {
        $this -> show($id, $page = '');
    }

    function show($id, $page = '') {
        if (in_array('gallery_view', $this -> allowed)) {
            $album_title = $this -> Album_model -> getDetails($id);
            $data['photoList'] = $this -> Gallery_model -> getAllByAlbum($id);
            $data['allowed'] = $this -> allowed;
            $data['albumname'] = $album_title -> album_title;
            $data['photoRecord'] = "";
            $data['albumid'] = $id;
            $data['error'] = $this -> errors;
            $data['title'] = "List Gallery of Album " . $album_title -> album_title;
            $data['title1'] = "Add Gallery Image for album " . $album_title -> album_title;
            $data['main_content'] = ADMIN_PATH . "gallery_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        } else {
            redirect("admin");
        }
    }

    function deleteAction($id) {
        $album_id = array();
        if (in_array('gallery_delete', $this -> allowed)) {
            $album_id = $this -> Gallery_model -> getImageDetail($id['0']);
            $path = GALLERY_IMAGE_PATH . str_replace(' ', '_', $album_id -> album_title . '/');
            //check before delete if it is admin user or currently loggged in user
            if ($this -> Gallery_model -> delete($id['0'])) {
                if ($this -> removeFile($album_id -> gallery_path, $path)) {
                    $this -> session -> set_flashdata("su_message", "Gallery Image Deleted Successfully.");
                }
            } else {
                $this -> session -> set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Image Can't Be Deleted.</font>");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Delete This Image");
        }

        redirect(ADMIN_PATH . "gallery/" . $album_id -> album_id);
    }

    // function addAction($album_id) {
    // $masterauth = new Auth_master_model();
    // $album_title = $this->Album_model->getDetails($album_id['0']);
    // $data['mas_auth'] = $masterauth->getAllAuth();
    // $data['error'] = $this->errors;
    // $data['title'] = "Add Gallery Image for album ".$album_title->album_title;
    // $data['album_id'] = $album_id['0'];
    //
    // $data['main_content'] = ADMIN_PATH . "gallery_add_view";
    // $this->load->view(ADMIN_PATH . 'include/template', $data);
    // }

    function add() {
        if (in_array('gallery_add', $this -> allowed)) {
            if ($this -> form_validation -> run('gallery_add') == FALSE) {
                $this -> index($this -> input -> post('album_id'));
            } else {
                $photo = TRUE;
                $ph = "";
                $path = "";
                $pic = "";
                $path = GALLERY_IMAGE_PATH;
                $folder = $this -> Album_model -> getDetails($this -> input -> post('album_id')) -> album_title;
                if (is_dir($path . str_replace(' ', '_', $folder)) == false) {
                    mkdir($path . str_replace(' ', '_', $folder), 0777);
                }
                $path = $path . str_replace(' ', '_', $folder) . "/";

                if ($_FILES['gallery_path']['name']) {
                    $uploaded_details = $this -> upload('gallery_path', "$path");

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
                    $this -> Gallery_model -> insert($ph);

                    $this -> session -> set_flashdata("su_message", "Gallery Image for album Addded Successfully.");
                    redirect(ADMIN_PATH . "gallery/" . $this -> input -> post('album_id'));
                } else {
                    $this -> index($this -> input -> post('album_id'));
                }
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You don't have the permission to add new gallery image.");
            redirect(ADMIN_PATH . "gallery/" . $this -> input -> post('album_id'));
        }
    }

    function update() {
        if (in_array('gallery_update', $this -> allowed)) {
            if ($this -> form_validation -> run('gallery_add') == FALSE) {
                $this -> updateAction($this -> input -> post('id'));
            } else {
                $photo = TRUE;

                $ph = "";
                $oldph = $this -> input -> post('old_image');
                $path = "";

                $path = GALLERY_IMAGE_PATH;
                $folder = $this -> Album_model -> getDetails($this -> input -> post('album_id')) -> album_title;
                if (is_dir($path . str_replace(' ', '_', $folder)) == false) {
                    mkdir($path . str_replace(' ', '_', $folder), 0777);
                    $path = $path . str_replace(' ', '_', $folder) . "/";
                } else {
                    rename($path . str_replace(' ', '_', $folder), $path . str_replace(' ', '_', $folder));
                    $path = $path . str_replace(' ', '_', $folder) . "/";
                }

                if ($_FILES['gallery_path']['name']) {
                    $uploaded_details = $this -> upload('gallery_path', "$path");

                    if ($uploaded_details == "") {
                        $error = array('error' => $this -> upload -> display_errors('<p>', '</p>'));
                        //$this->form_validation->set_message('Basic Document', "error");
                        $this -> errors = $error;

                        $photo = FALSE;
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
                    $this -> Gallery_model -> update($this -> input -> post('id'), $ph);

                    $this -> session -> set_flashdata("su_message", "Gallery Updated Successfully.");
                    redirect(ADMIN_PATH . "gallery/" . $this -> input -> post('album_id'));
                } else {
                    $this -> updateAction($this -> input -> post('id'));
                }
            }
        } else {
            redirect(ADMIN_PATH . "album");
        }
    }

    function updateAction($gallery_id) {
        if (in_array('gallery_view', $this -> allowed)) {
            $album = $this -> Gallery_model -> getImageDetail($gallery_id['0']);
            $album_title = $this -> Album_model -> getDetails($album -> album_id);
            $data['photoList'] = $this -> Gallery_model -> getAllByAlbum($album -> album_id);
            $data['allowed'] = $this -> allowed;
            $data['albumname'] = $album_title -> album_title;
            $data['photoRecord'] = $album;
            $data['albumid'] = $album -> album_id;
            $data['error'] = $this -> errors;
            $data['title'] = "List Gallery of Album " . $album_title -> album_title;
            $data['title1'] = "Add Gallery Image for album " . $album_title -> album_title;
            $data['main_content'] = ADMIN_PATH . "gallery_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        } else {
            redirect("admin");
        }
    }

    function uniquePhotoname($str) {
        $id = $this -> input -> post('photo_id');

        if ($this -> Photo_model -> uniquePhotoName($id, $this -> input -> post('photo_name')) > 0) {
            $this -> form_validation -> set_message('uniquePhotoname', 'Photo Name Must Be Unique');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function upload($file, $path) {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '1024';
        $config['overwrite'] = false;

        $config['max_width'] = '600';
        $config['max_height'] = '251';
        $config['encrypt_name'] = true;
        $config['remove_spaces'] = true;

        $this -> load -> library('upload', $config);
        if ($this -> upload -> do_upload($file)) {
            //$data = $this->upload->data();
            //Image Resizing
            $config['image_library'] = 'gd2';
            $config['source_image'] = $this -> upload -> upload_path . $this -> upload -> file_name;
            $config['new_image'] = $path;
            $config['maintain_ratio'] = TRUE;
            $this -> load -> library('image_lib', $config);
            if ($this -> image_lib -> resize()) {
                $data = $this -> upload -> data();
            } else {
                $data = "";
            }
        } else {
            $data = "";
        }

        return $data;
    }

    function removeFile($file, $path) {

        if (file_exists($path . $file) && $file != "") {
            if (unlink($path . $file)) {
                return true;
            }
        }
        return FALSE;
    }

    function updateOrder($gid, $id, $order, $low_high, $offset) {
        if ($low_high <= 1) {
            $this -> Photo_model -> changehigherorder($gid, $id, $order);
        } else {
            $this -> Photo_model -> changelowerorder($gid, $id, $order);
        }
        $this -> session -> set_flashdata("su_message", "Order changed successfully");
        redirect("galleryphoto/show/$gid/$offset");
    }

    function changeStatus($id, $value, $offset) {
        $stat = "";
        if ($value == 'Active') {
            $stat = 'Inactive';
        } else {
            $stat = 'Active';
        }

        if ($this -> Album_model -> updateStatus($id, $stat)) {
            $this -> session -> set_flashdata("su_message", "Status Updated Successfully.");
        } else {
            $this -> session -> set_flashdata("su_message", "Status Updated Successfully.");
        }
        redirect(ADMIN_PATH . "album/show/$offset");
    }

    function ifupoad_check($str) {
        if (!$_FILES['path']['name']) {
            $this -> form_validation -> set_message('ifupoad_check', 'No Image Uploaded');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
?>