<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userlist extends CI_Controller {
    private $allowed = array();

    public function __construct() {
        parent::__construct();
        checkAdminAuth();
        // Your own constructor code
        $this -> load -> library('form_validation');
        $this -> load -> library('pagination');
        $this -> form_validation -> set_error_delimiters('<div class="red">', '</div>');

        //$this->load->model('auth_master_model');
        //$this->load->model('user_auth_model');
        $this -> allowed = $this -> Auth_master_model -> getAuth();
    }

    public function index() {
        $this -> show($page = '');

    }

    function show($page = '') {
        if (in_array('user_view', $this -> allowed)) {
            $config['total_rows'] = $this -> User_model -> countAll();
            $config['base_url'] = site_url("userlist/show/");
            $config['per_page'] = '10';
            $config['uri_segment'] = '3';
            $offset = $this -> uri -> segment(3, 0);
            $this -> pagination -> initialize($config);
            $data['start'] = $page;
            $data['usersTypes'] = $this -> User_model -> getAllPaginate($config['per_page'], $offset);

            $data['allowed'] = $this -> allowed;
            $data['title'] = "List Users";
            $data['main_content'] = ADMIN_PATH . "userlist_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        } else {
            redirect("admin");
        }
    }

    function changePassword($user_id, $offset="") {
        if (in_array('change_password', $this -> allowed)) {
            $data['values'] = $this -> User_model -> getAdminDetails($user_id);
            $data['title'] = "Change Password";
            $data['offset'] = $offset;
            $data['main_content'] = ADMIN_PATH . "changepassword_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Permission To Delete This Record");
            redirect(ADMIN_PATH . "userlist/index");
        }
    }

    function deleteUser($user_id, $offset) {
        if ($this -> checkBeforeDelete($user_id)) {
            $this -> User_model -> deleteuser($user_id);
            $this -> session -> set_flashdata("su_message", "User Deleted Successfully.");
        } else {
            $this -> session -> set_flashdata("su_message", "<font color=\"#FF0000\">The Selected User Can't Be Deleted.It Is Either Admin User Or Logged In User</font>");
        }
        redirect(ADMIN_PATH . "userlist/show/$offset");
    }

    function checkBeforeDelete($user_id) {
        if ($user_id == $this -> session -> userdata(ADMIN_AUTH_USERID)) {
            return FALSE;
        }
        //		else
        //		{
        //			$details=$this->User_model->getAdminDetails($user_id);
        //			if($details->user_type=='admin')
        //			{
        //				return FALSE;
        //			}
        //			else
        //			{
        return TRUE;
        //			}
        //
        //}

    }

    function addUser() {
        $masterauth = new Auth_master_model();
        $data['mas_auth'] = $masterauth -> getAllAuth();

        $data['title'] = "Add User";
        $data['main_content'] = ADMIN_PATH . "newuser_view";
        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

    function add() {
        if (in_array('user_add', $this -> allowed)) {
            if ($this -> form_validation -> run('user_add') == FALSE) {
                $this -> addUser();
            } else {
                $this -> User_model -> insert();
                ///$userauth=new User_auth_model();
                //$userauth->add($this->input->post('user_id'));

                $this -> session -> set_flashdata("su_message", "User Added Successfully.");
                redirect(ADMIN_PATH . "userlist/index");
            }
        } else {
            redirect("admin");
        }
    }

    function update($offset) {
        if (in_array('user_update', $this -> allowed)) {
            if ($this -> form_validation -> run('user_edit') == FALSE) {
                $this -> updateUser($this -> input -> post('user_id'), $offset);
            } else {
                $this -> User_model -> update($this -> input -> post('user_id'));

                $this -> session -> set_flashdata("su_message", "User Updated Successfully.");
                redirect(ADMIN_PATH . "userlist/show/$offset");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Previleage To Update User");
            redirect(ADMIN_PATH . "userlist/show/$offset");
        }
    }

    function updateprofile() {
        if (in_array('self_update', $this -> allowed)) {
        	
            if ($this -> form_validation -> run('self_edit') == FALSE) {
                $this -> session -> set_flashdata("su_message", "Validation error occured.");
			echo validation_errors(); die('dsfsdfdsfsd');
                redirect("admin/config");
				
            } else {
                $this -> User_model -> updateself($this -> input -> post('user_id'));

                echo "<script>alert('Profile Updated Successfully.')</script>";
                // $this->session->set_flashdata("su_message", "Profile Updated Successfully.");
                redirect("admin");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Previleage To Update Profile");
            redirect("admin");
        }
    }

    function updatePassword($offset='') {
        if ($this -> form_validation -> run('change_password') == FALSE) {
            $this -> changePassword($this -> input -> post('user_id'), $offset);
        } else {
            $this -> User_model -> updatePassword($this -> input -> post('user_id'));

            $this -> session -> set_flashdata("su_message", "Password Updated Successfully.");
            redirect(ADMIN_PATH . "userlist/show/$offset");
        }
    }

    function updateUser($user_id, $offset) {

        $masterauth = new Auth_master_model();

        $data['usersTypes'] = $this -> User_model -> getAdminDetails($user_id);
        $data['title'] = "Update User";
        $data['main_content'] = ADMIN_PATH . "userupdate_view";
        $data['offset'] = $offset;
        $data['mas_auth'] = $masterauth -> getAllAuth();

        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

    function approveOldPassword_check($str) {
        $oldpassword = $this -> input -> post('old');
        $pass = $this -> input -> post('old_password');

        if ($oldpassword != md5($pass)) {
            $this -> form_validation -> set_message('approveOldPassword_check', 'Old Password Did Not Matched');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function changeStatus($id, $value, $offset) {
        $stat = "";
        if ($value == 'yes') {
            $stat = 'no';
        } else {
            $stat = 'yes';
        }

        if ($this -> User_model -> updateStatus($id, $stat)) {
            $this -> session -> set_flashdata("su_message", "Status Updated Successfully.");

        } else {
            $this -> session -> set_flashdata("su_message", "Status Updated Successfully.");

        }
        redirect(ADMIN_PATH . "userlist/show/$offset");
    }

    function uniqueUsername($str) {
        $user_id = $this -> input -> post('user_id');

        if ($this -> User_model -> uniqueUserName($user_id, $this -> input -> post('user_name')) > 0) {
            $this -> form_validation -> set_message('uniqueUsername', 'User Name Must Be Unique');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
?>