<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cartoon extends CI_Controller {

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
        $data['cartoonList'] = $this->Cartoon_model->getAll('all', $config['per_page'], $offset);

        $data['title'] = "List Cartoon";
        $data['main_content'] = ADMIN_PATH . "cartoonlist_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }
    
    function deleteAction($id, $offset) {
        $details = $this->Cartoon_model->getPhotoDetails($id);
        $title = $details->title;
        if ($this->Cartoon_model->deleteCartoon($id)) {
            $path = CARTOON_IMAGE_PATH;
            $folder = str_replace(' ', '_', $title);
            $dir = $path.$folder;
            $path = $path.$folder."/*";  
            $files = glob($path); // get all file names
            foreach($files as $file){ // iterate files
              if(is_file($file))
                unlink($file); // delete file
            }
            rmdir($dir);
            
            $this->session->set_flashdata("su_message", "Cartoon Deleted Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Cartoon Can't Be Deleted.</font>");
        }

        redirect(ADMIN_PATH . "cartoon/show/$offset");
    }
    
    function deleteStripAction($id, $cid, $offset) {
        $details = $this->Cartoonstrip_model->getCartoonStrips($id);
        print_r($details);
        $title = $details->cartoon;
        if ($this->Cartoonstrip_model->deleteCartoonStrip($id)) {
            $path = CARTOON_IMAGE_PATH;
            $folder = str_replace(' ', '_', $title);
            $dir = $path.$folder;
            $this->removeFile($details->strip_path, $dir."/");
            
            $this->session->set_flashdata("su_message", "Cartoon Strip Deleted Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Cartoon Strip Can't Be Deleted.</font>");
        }
        redirect(ADMIN_PATH . "cartoon/addStory/$cid/$offset");
    }

    function addAction() {
        $masterauth = new Auth_master_model();

        $data['mas_auth'] = $masterauth->getAllAuth();
        $data['error'] = $this->errors;
        $data['title'] = "Add Cartoon";
        $data['parentCartoon'] = $this->Cartoon_model->parentCartoon();
        $data['category'] = $this->Category_model->getAllCategory();

        $data['main_content'] = ADMIN_PATH . "cartoon_add_view";
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
            $path = CARTOON_IMAGE_PATH;
            if (is_dir($path . str_replace(' ', '_', $_POST['title'])) == false) {
                mkdir($path . str_replace(' ', '_', $_POST['title']), 0777);
            }
            $path = $path . str_replace(' ', '_', $_POST['title']) . "/";

            if ($_FILES['featured_image']['name']) {
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
                $this->Cartoon_model->insert($ph, $pic);

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
            $titledata = $this->Cartoon_model->getSingleCartoon($this->input->post('id'));

            //files validations
            $photo = TRUE;

            $phfeat = "";
            $picbanner = "";
            $oldphfeat = $this->input->post('old_featured_image');
            $oldpicbanner = $this->input->post('old_banner_image');

            $path = "";

            $path = CARTOON_IMAGE_PATH;
            if (is_dir($path . str_replace(' ','_',$titledata->title)) == false) {
                mkdir($path . str_replace(' ', '_', $_POST['title']), 0777);
                $path = $path . str_replace(' ', '_', $_POST['title']) . "/";
            } else {
                rename($path . str_replace(' ','_',$titledata->title), $path . str_replace(' ', '_', $_POST['title']));
                $path = $path . str_replace(' ', '_', $_POST['title']) . "/";
            }

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

                $this->Cartoon_model->update($this->input->post('id'), $phfeat, $picbanner);

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
        $data['photoRecord'] = $this->Cartoon_model->getAdminDetails($id);
        $data['parentCartoon'] = $this->Cartoon_model->parentCartoon();
        $data['category'] = $this->Category_model->getAllCategory();
        $data['title'] = "Update Cartoon";
        $data['id'] = $id;
        $data['offset'] = $offset;
        $data['main_content'] = ADMIN_PATH . "cartoon_update_view";


        $data['mas_auth'] = $masterauth->getAllAuth();

        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function addPoll($id) {
        $masterauth = new Auth_master_model();

        $data['mas_auth'] = $masterauth->getAllAuth();
        $data['error'] = $this->errors;
        $data['title'] = "Add Poll";
        $data['cartoon_id'] = $id;

        $data['main_content'] = ADMIN_PATH . "poll_add_view";
        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function insertPoll() {
        if ($this->form_validation->run('poll_add') == FALSE) {
            $this->addPoll($_POST['cartoon_id']);
        } else {
            $photo = TRUE;
            if ($photo) {
                $cartoon_id = $_POST['cartoon_id'];
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
                redirect(ADMIN_PATH . "cartoon/index");
            } else {
                $this->addPoll($_POST['cartoon_id']);
            }
        }
    }

    function updatePoll($id, $offset) {
        $masterauth = new Auth_master_model();
        $data['error'] = $this->errors;
        $data['pollRecord'] = $this->Poll_model->getSinglePoll($id);
        $data['title'] = "Update Poll";
        $data['offset'] = $offset;
        $data['main_content'] = ADMIN_PATH . "poll_update_view";

        $data['mas_auth'] = $masterauth->getAllAuth();

        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }

    function pollupdate($offset) {
        if ($this->form_validation->run('poll_update') == FALSE) {
            $this->updatePoll($this->input->post('id'), $offset);
        } else {
            //files validations
            $photo = TRUE;
            if ($photo) {
                $this->Category_model->update($this->input->post('cat_id'));
                $today = date("Y-m-d H:i:s");
                $maxorder = $this->Menu_model->getMaxOrder();
                $menu_data = array(
                    'menu_name' => ucwords($this->input->post('cat_name')),
                    'menu_type' => 'category',
                    'status' => $this->input->post('status') == 'active' ? 'Active' : 'Inactive',
                    'menu_order' => $maxorder + 1,
                    'rel_id' => $this->input->post('cat_id'),
                    'updt_dt' => $today,
                    'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID)
                );
                $this->Menu_model->update($this->input->post('cat_id'), 'category', $menu_data);
                $this->session->set_flashdata("su_message", "Category Updated Successfully.");
                redirect(ADMIN_PATH . "category/show/$offset");
            } else {
                $this->updateAction($this->input->post('cat_id'), $offset);
            }
        }
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
//            $config['width'] = 660;
//            $config['height'] = 251;
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

        if ($this->Cartoon_model->updateStatus($id, $stat)) {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "Status Updated Successfully.");
        }
        redirect(ADMIN_PATH . "cartoon/show/$offset");
    }
    
    function changeEditorsPick($id, $value, $offset) {
        $stat = "";
        if ($value == 'Yes') {
            $stat = 'No';
        } else {
            $stat = 'Yes';
        }

        if ($this->Cartoon_model->updateEditorPick($id, $stat)) {
            $this->session->set_flashdata("su_message", "Editors Pick Updated Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "Editors Pick Updated Successfully.");
        }
        redirect(ADMIN_PATH . "cartoon/show/$offset");
    }

    function ifupoad_check($str) {
        if (!$_FILES['featured_image']['name']) {
            $this->form_validation->set_message('ifupoad_check', 'No Image Uploaded');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function get_file_extension($file_name) {
	return substr(strrchr($file_name,'.'),1);
    }
    
    function addStory($id, $offset){
        $masterauth = new Auth_master_model();
        $data['error'] = $this->errors;
        $titledata = $this->Cartoon_model->getSingleCartoon($id);
        $data['cartoon']=$titledata->title;
        $data['photoRecord'] = $this->Cartoon_model->getAdminDetails($id);
        $data['photos'] = $this->Cartoonstrip_model->getAllCartoonStrips($id);
        $data['title'] = "Upload Cartoon Story";
        $data['id'] = $id;
        $data['offset'] = $offset;
        $data['main_content'] = ADMIN_PATH . "cartoon_story_view";


        $data['mas_auth'] = $masterauth->getAllAuth();

        $this->load->view(ADMIN_PATH . 'include/template', $data);
    }
    function uploadImage($id, $title){
        if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST"){
            //$titledata = $this->Cartoon_model->getSingleCartoon($this->input->post('cartoon'));
            $file_name = strip_tags($_FILES['upload_file']['name']);
            $file_id = strip_tags($_POST['upload_file_ids']);
            $file_size = $_FILES['upload_file']['size'];
            $path = CARTOON_IMAGE_PATH;
            if (is_dir($path . str_replace(' ', '_', $title)) == false) {
                mkdir($path . str_replace(' ', '_', $title), 0777);
                $path = $path . str_replace(' ', '_', $title) . "/";
            } else {
                rename($path . str_replace(' ', '_', $title), $path . str_replace(' ', '_', $title));
                $path = $path . str_replace(' ', '_', $title) . "/";
            }
            $file_location = $path . $file_name;
            $file_parts = pathinfo($file_name);
            $ext = $file_parts['extension'];
            if($ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='png'){
                if(move_uploaded_file(strip_tags($_FILES['upload_file']['tmp_name']), $file_location)){
                    $this->Cartoonstrip_model->insert($file_name, $id);                
                    echo $file_id;
                }else{
                    echo 'system_error';
                }
            }else{
                echo 'system_error';
            }
        }        
    }
    function updateOrder($cartoon_id,$id, $order, $low_high, $offset) {
        if ($low_high <= 1) {
            $this->Cartoon_model->changehigherorder($cartoon_id, $order);
        } else {
            $this->Cartoon_model->changelowerorder($cartoon_id, $order);
        }
        $this->session->set_flashdata("su_message", "Order changed successfully");
        redirect(ADMIN_PATH . "cartoon/show/$offset");
    }
    function updateOrderCartoon($cartoon_id, $order, $low_high, $offset) {
        if ($low_high <= 1) {
            $this->Cartoon_model->changehigherorderCartoon($cartoon_id, $order);
        } else {
            $this->Cartoon_model->changelowerorderCartoon($cartoon_id, $order);
        }
        $this->session->set_flashdata("su_message", "Order changed successfully");
        redirect(ADMIN_PATH . "cartoon/show/$offset");
    }
    function changeBannerShow($id, $value, $offset) {
        $stat = "";
        if ($value == 'Yes') {
            $stat = 'No';
        } else {
            $stat = 'Yes';
        }

        if ($this->Cartoon_model->updateBannerShow($id, $stat)) {
            $this->session->set_flashdata("su_message", "Banner Show Updated Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "Banner Show Updated Successfully.");
        }
        redirect(ADMIN_PATH . "cartoon/show/$offset");
    }
    function changeRecentShow($id, $value, $offset) {
        $stat = "";
        if ($value == 'Yes') {
            $stat = 'No';
        } else {
            $stat = 'Yes';
        }

        if ($this->Cartoon_model->updateRecentShow($id, $stat)) {
            $this->session->set_flashdata("su_message", "Recent Show Updated Successfully.");
        } else {
            $this->session->set_flashdata("su_message", "Recent Show Updated Successfully.");
        }
        redirect(ADMIN_PATH . "cartoon/show/$offset");
    }
}

?>