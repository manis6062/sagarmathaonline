<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News extends CI_Controller {

    private $allowed = array();
	private $errors="";

    public function __construct() {
        parent::__construct();
        checkAdminAuth();
        // Your own constructor code
        $this -> load -> library('form_validation');
        $this -> load -> library('pagination');
        $this -> form_validation -> set_error_delimiters('<div class="red">', '</div>');
        $this -> load -> helper(array('form', 'url'));
        $this -> load -> helper('path');
        $this -> load -> helper('string');

        //$this->load->model('auth_master_model');
        //$this->load->model('user_auth_model');
        $this -> allowed = $this -> Auth_master_model -> getAuth();
    }

    public function index() {

        $this -> show($page = '');

    }

    function show($page = '') {
        if (in_array('news_view', $this -> allowed)) {
            $cond = array();
            if ($this -> session -> userdata(ADMIN_AUTH_TYPE) == "user") {
                $userid = $this -> session -> userdata(ADMIN_AUTH_USERID);
                //$cond="where ts_user.branch_id='$branchid'";
                $cond['nc_news.crtd_by'] = $userid;

            }
            $config['total_rows'] = $this -> News_model -> countAll($cond);
            $config['base_url'] = site_url("news/show/");
            $config['per_page'] = '10';
            $config['uri_segment'] = '3';
            $offset = $this -> uri -> segment(3, 0);
            $this -> pagination -> initialize($config);
            $data['start'] = $page;
            $data['newsList'] = $this -> News_model -> getAllNews();
            $data['allowed'] = $this->allowed;
            $data['title'] = "List News";
            $data['main_content'] = ADMIN_PATH . "news_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        } else {
            redirect("admin");
        }
    }

    function deleteNews($id) {
        if (in_array('news_update', $this -> allowed)) {

            if ($this -> News_model -> deleteNews($id)) {

                $this -> session -> set_flashdata("su_message", "News Deleted Successfully.");

            } else {
                $this -> session -> set_flashdata("su_message", "<font color=\"#FF0000\">The Selected News Can't Be Deleted.</font>");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Delete This Record");
        }

        redirect(ADMIN_PATH . "news");
    }

    function addNews() {

        $masterauth = new Auth_master_model();

        $data['mas_auth'] = $masterauth -> getAllAuth();
		$data['errors'] = $this->errors;

        $data['title'] = "Add News";
        $data['main_content'] = ADMIN_PATH . "news_add_view";
        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

    function add() {
        if (in_array('news_add', $this -> allowed)) {
            if ($this -> form_validation -> run('news_add') == FALSE) {
                $this -> addNews();
            } else {
            	$this->load->helper(array('form', 'url'));
		        $this->load->library('form_validation');
		        $this->form_validation->set_rules('path', 'Imagepath', 'callback_checkrequire');
		
		        if ($this->form_validation->run() == FALSE) {
		        	$this->addNews();
        		} else {
					$photo = TRUE;
	                $ph = "";
	                $path = "";
	                if ($_FILES['path']['name']) {
	                    $path = NEWS_IMAGE_PATH;
	
	                    $uploaded_details = $this->upload('path', "$path");
	
	
	                    if ($uploaded_details == "") {
	                        $error = array('error' => $this->upload->display_errors('<p>', '</p>'));
	                        $this->form_validation->set_message('Basic Document', "error");
	                        $this->errors = $error;
	
	                        $photo = false;
	                    } else {
	                        $ph = $uploaded_details['file_name'];
	                    }
	                }
	
	                if ($photo) {
					
	                	$this -> News_model -> insert($ph);
	
		                $this -> session -> set_flashdata("su_message", "News Added Successfully.");
		                redirect(ADMIN_PATH . "news");
					} else {
	                    $this->addNews();
	                }
	            }
            }
        } else {
            redirect("admin");
        }

    }

	public function checkrequire($str) {
        if ($this->input->post('banner')=='Yes' && $_FILES['path']['name']=='') {
            $this->form_validation->set_message('checkrequire', 'Feature Image is required.');
            return FALSE;
        } else
            return TRUE;
    }

    function update() {
        if (in_array('news_update', $this -> allowed)) {
            if ($this -> form_validation -> run('news_add') == FALSE) {
                $this -> updateNews($this -> input -> post('news_id'));
            } else {
				$photo = TRUE;

                $ph = "";
                $oldph = $this->input->post('old_image');

                $path = "";

                $path = NEWS_IMAGE_PATH;

                if ($_FILES['path']['name']) {


                    $uploaded_details = $this->upload('path', "$path");


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
				
	                $this -> News_model -> update($this -> input -> post('news_id'), $ph);
	
	                $this -> session -> set_flashdata("su_message", "News Updated Successfully.");
	                redirect(ADMIN_PATH . "news");
				} else {
                    $this -> updateNews($this -> input -> post('news_id'));
                }	

            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Update News");
            redirect(ADMIN_PATH . "news");
        }
    }

    function updateStatus($id, $order, $low_high, $category) {
        if ($low_high <= 1) {
            $this -> News_model -> changehigherorder($id, $order, $category);
        } else {
            $this -> News_model -> changelowerorder($id, $order, $category);
        }
        $this -> session -> set_flashdata("su_message", "Order changed successfully");
        redirect(ADMIN_PATH . "news");
    }
	
    function changeFlash($id, $value) {
        $stat = "";
        if ($value == 'Yes') {
            $stat = 'No';
        } else {
            $stat = 'Yes';
        }

        if ($this -> News_model -> updateFlash($id, $stat)) {
            $this -> session -> set_flashdata("su_message", "Flash Updated Successfully.");

        } else {
            $this -> session -> set_flashdata("su_message", "Error while updating Flash.");

        }
        redirect(ADMIN_PATH . "news");
    }
	

	function removeFile($file, $path) {

        if (file_exists($path . $file) && $file != "")
            unlink($path . $file);
    }
	function upload($file, $path) {		
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '1024';
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
	
    function changeStatus($id, $value) {
        $stat = "";
        if ($value == 'Yes') {
            $stat = 'No';
        } else {
            $stat = 'Yes';
        }

        if ($this -> News_model -> updateStatus($id, $stat)) {
            $this -> session -> set_flashdata("su_message", "Status Updated Successfully.");

        } else {
            $this -> session -> set_flashdata("su_message", "Status Updated Successfully.");

        }
        redirect(ADMIN_PATH . "news");
    }

    function updateNews($id) {

        $masterauth = new Auth_master_model();
        $data['newsRecord'] = $this -> News_model -> getNewsDetails($id);
        $data['title'] = "Update News";
        $data['main_content'] = ADMIN_PATH . "news_update_view";

        $data['mas_auth'] = $masterauth -> getAllAuth();

        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

}
?>