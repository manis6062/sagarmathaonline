<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Advertisement extends CI_Controller {

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
		if (in_array('advertisement_view', $this -> allowed)) {
			$data['photoList'] = $this -> Advertisement_model -> getAll('all');
			$data['allowed'] = $this -> allowed;
			$data['title'] = "Advertisement Image";
			$data['main_content'] = ADMIN_PATH . "advertisementlist_view";
			$this -> load -> view(ADMIN_PATH . 'include/template', $data);
		} else {
			redirect("admin");
		}
	}

	function galleryPhoto($gid) {
		$this -> showGalleryImage();
	}

	function deleteAction($id, $offset) {
		if (in_array('advertisement_delete', $this -> allowed)) {
			//check before delete if it is admin user or currently loggged in user
			$details = $this -> Advertisement_model -> getPhotoDetails($id);
			if ($this -> Advertisement_model -> deletePhoto($id)) {
				$path = ADVERTISEMENT_IMAGE_PATH;

				$this -> removeFile($details -> path, $path);

				$this -> session -> set_flashdata("su_message", "Advertisement Deleted Successfully.");
			} else {
				$this -> session -> set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Advertisement Can't Be Deleted.</font>");
			}
		} else {
			$this -> session -> set_flashdata("su_message", "You Have No Permission To Delete This Advertisement");
		}

		redirect(ADMIN_PATH . "advertisement/show/$offset");
	}

	function deleteAction_Slider($id, $offset) {
		//check before delete if it is admin user or currently loggged in user
		$details = $this -> Advertisement_model -> getSlideImage($id);
		if ($this -> Advertisement_model -> deleteSliderImage($id)) {
			$path = ADVERTISEMENT_IMAGE_PATH;

			$this -> removeFile($details -> path, $path);

			$this -> session -> set_flashdata("su_message", "Advertisement Deleted Successfully.");
		} else {
			$this -> session -> set_flashdata("su_message", "<font color=\"#FF0000\">The Selected Advertisement Can't Be Deleted.</font>");
		}

		redirect(ADMIN_PATH . "advertisement/addAction");
	}

	function addAction() {
		$masterauth = new Auth_master_model();
		$data['sliderList'] = $this -> Advertisement_model -> getAllSlider();

		$data['mas_auth'] = $masterauth -> getAllAuth();
		$data['error'] = $this -> errors;
		$data['title'] = "Add Advertisement";

		$data['main_content'] = ADMIN_PATH . "advertisement_add_view";
		$this -> load -> view(ADMIN_PATH . 'include/template', $data);
	}

	function add() {
		if (in_array('advertisement_add', $this -> allowed)) {
			if ($this -> form_validation -> run('advertisement_add') == FALSE) {
				$this -> addAction();
			} else {
				//files validations
				$photo = TRUE;
				$ph = "";
				$path = "";
				if ($_FILES['path']['name']) {
					$path = ADVERTISEMENT_IMAGE_PATH;

					$uploaded_details = $this -> upload('path', "$path", $this->input->post('size'));

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
					$this -> Advertisement_model -> insert($ph);

					$this -> session -> set_flashdata("su_message", "Image Added Successfully.");
					redirect(ADMIN_PATH . "advertisement/index");
				} else {
					$this -> addAction();
				}
			}
		} else {
			redirect("admin");
		}
	}

	function update($offset) {
		if (in_array('advertisement_update', $this -> allowed)) {
			if ($this -> form_validation -> run('advertisement_update') == FALSE) {
				$this -> updateAction($this -> input -> post('slider_id'), $offset);
			} else {
				//files validations
				$photo = TRUE;

				$ph = "";
				$oldph = $this -> input -> post('old_image');

				$path = "";

				$path = ADVERTISEMENT_IMAGE_PATH;

				if ($_FILES['path']['name']) {

					$uploaded_details = $this -> upload('path', "$path", $this->input->post('size'));

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

					$this -> Advertisement_model -> update($this -> input -> post('slider_id'), $ph);

					$this -> session -> set_flashdata("su_message", "Image Updated Successfully.");
					redirect(ADMIN_PATH . "advertisement/show/$offset");
				} else {
					$this -> updateAction($this -> input -> post('slider_id'), $offset);
				}
			}
		} else {
			$this -> session -> set_flashdata("su_message", "You Have No Permission To Add New Image");
			redirect(ADMIN_PATH . "advertisement/show/$offset");
		}
	}

	function updateAction($id, $offset) {

		$masterauth = new Auth_master_model();
		$data['error'] = $this -> errors;
		$data['photoRecord'] = $this -> Advertisement_model -> getPhotoDetails($id);
		$data['title'] = "Update Advertisement";
		$data['slider_id'] = $id;
		$data['offset'] = $offset;
		$data['main_content'] = ADMIN_PATH . "advertisement_update_view";

		$data['mas_auth'] = $masterauth -> getAllAuth();

		$this -> load -> view(ADMIN_PATH . 'include/template', $data);
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

	function upload($file, $path, $size) {
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size'] = '1024';
		$config['overwrite'] = false;

		if ($size == 'large') {
			$config['max_width'] = '1000';
			$config['max_height'] = '150';
		} elseif ($size == 'medium') {
			$config['max_width'] = '500';
			$config['max_height'] = '150';
		} else {
			$config['max_width'] = '200';
			$config['max_height'] = '100';
		}
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
			$config['width'] = '';
			$config['height'] = '';
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

		if (file_exists($path . $file) && $file != "")
			unlink($path . $file);
	}

	function ifupoad_check($str) {
		if (!$_FILES['path']['name']) {
			$this -> form_validation -> set_message('ifupoad_check', 'No Image Uploaded');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function add_slider() {

		$photo = TRUE;
		$ph = "";
		$path = "";
		if ($_FILES['path']['name']) {
			$path = ADVERTISEMENT_IMAGE_PATH;

			$uploaded_details = $this -> upload('path', "$path");

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
			$this -> Advertisement_model -> insert_caraousel($ph);

			$this -> session -> set_flashdata("su_message", "Image Added Successfully.");
			redirect(ADMIN_PATH . "advertisement/addAction");
		} else {
			$this -> addAction();
		}
	}

}
?>