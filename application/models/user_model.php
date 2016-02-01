<?php
class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this -> load -> helper('date');
        $this -> load -> library('email');
    }

    function countAll() {
        $query = $this -> db -> get("nc_user");

        return $query -> num_rows();
    }

    function getAllPaginate($perPage, $offset) {

        $this -> db -> select('*');
        $this -> db -> from('nc_user');

        $this -> db -> where('user_type !=', '');
        //$this -> db -> limit($perPage, $offset);
        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function login($username, $password) {
        //if($branch=="")
        //{
        //$this->db->where(array('login_name' => $username, 'login_pwd' => $password,'user_type' =>'admin'));
        //}
        //else
        //{
        $this -> db -> where(array('login_name' => $username, 'login_pwd' => $password, 'status' => 'yes'));
        //}

        $query = $this -> db -> get('nc_user');

        if ($query -> num_rows() == 0) {
            return 0;
        } else {
            $row = $query -> row();

            return $row -> user_id;
        }
    }

    // get the administratro details
    function getAdminDetails($user_id) {
        $query = $this -> db -> get_where('nc_user', array('user_id' => $user_id));

        if ($query -> num_rows() == 0) {
            return 0;
        } else {
            return $query -> row();
        }
    }

    function uniqueUserName($userid, $name) {
        $this -> db -> select('*');
        $this -> db -> from('nc_user');
        $this -> db -> where('user_name', $name);
        $this -> db -> where_not_in('user_id', $userid);

        //$this->db->order_by("company_id","DESC");
        $query = $this -> db -> get();

        return $query -> num_rows();
    }

    function getAllUsers() {
        $this -> db -> order_by("user_id", "DESC");
        //$this->db->limit($perPage,$offset);
        $query = $this -> db -> get("nc_user");
        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function getSingleUsers() {
        $this -> db -> where("user_id", $this -> session -> userdata(ADMIN_AUTH_USERID));
        $this -> db -> order_by("user_id", "DESC");
        //$this->db->limit($perPage,$offset);
        $query = $this -> db -> get("nc_user");
        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function update($user_id) {
        $today = date("Y-m-d H:i:s");

        $data = array('user_name' => $this -> input -> post('user_name'), 'phone' => ucwords($this -> input -> post('phone')), 'cell' => ucwords($this -> input -> post('cell')), 'address' => ucwords($this -> input -> post('address')), 'email' => $this -> input -> post('email'), 'auth_id' => implode(',', $this -> input -> post('auth_id')), 'status' => $this -> input -> post('status'), 'updt_dt' => $today, 'updt_cnt' => $this -> input -> post('updt_cnt') + 1, 'updt_by' => $this -> session -> userdata(ADMIN_AUTH_USERID));

        $this -> db -> where("user_id", $user_id);
        $this -> db -> update('nc_user', $this -> security -> xss_clean($data));
    }

    function updateself($user_id) {
        $today = date("Y-m-d H:i:s");
        $data = array('user_name' => $this -> input -> post('user_name'), 'phone' => ucwords($this -> input -> post('phone')), 'cell' => ucwords($this -> input -> post('cell')), 'address' => ucwords($this -> input -> post('address')), 'email' => $this -> input -> post('email'), 'updt_dt' => $today, 'updt_cnt' => $this -> input -> post('updt_cnt') + 1, 'updt_by' => $this -> session -> userdata(ADMIN_AUTH_USERID));

        $this -> db -> where("user_id", $user_id);
        $this -> db -> update('nc_user', $this -> security -> xss_clean($data));
    }

    function updatePassword($user_id) {
        $data = array('login_pwd' => $this -> input -> post('login_pwd'));

        $this -> db -> where("user_id", $user_id);
        $this -> db -> update('nc_user', $this -> security -> xss_clean($data));

    }

    function deleteuser($userid) {
        $this -> db -> where('user_id', $userid);
        $this -> db -> delete('nc_user');

    }

    function updateStatus($id, $value) {
        $data = array('status' => $value);

        $this -> db -> where("user_id", $id);
        $this -> db -> update('nc_user', $this -> security -> xss_clean($data));
        if ($this -> db -> affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert() {

        $today = date("Y-m-d H:i:s");

        $data = array('user_name' => $this -> input -> post('user_name'), 'login_name' => $this -> input -> post('login_name'), 'login_pwd' => $this -> input -> post('login_pwd'), 'phone' => ucwords($this -> input -> post('phone')), 'cell' => ucwords($this -> input -> post('cell')), 'address' => ucwords($this -> input -> post('address')), 'user_type' => $this -> input -> post('user_type'), 'email' => $this -> input -> post('email'), 'crtd_by' => $this -> session -> userdata(ADMIN_AUTH_USERID), 'status' => $this -> input -> post('status'), 'auth_id' => implode(',', $this -> input -> post('auth_id')), 'crtd_dt' => $today);
        $this -> db -> insert('nc_user', $this -> security -> xss_clean($data));
        $userid = $this -> db -> insert_id();

        return $userid;
    }

}
?>