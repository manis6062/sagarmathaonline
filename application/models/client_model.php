<?php

class Client_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
        $this->load->library('email');
    }

    function countAll($cond) {
        $this->db->where($cond);
        $query = $this->db->get("nc_client");

        return $query->num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

        $this->db->select('*');
        $this->db->from('nc_client');

        $this->db->where($cond);
        $this->db->limit($perPage, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function clientLogin($username, $password) {
        $this->db->where(array('email' => $username, 'password' => md5($password), 'status' => 'active'));

        $query = $this->db->get('nc_client');
        
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            $row = $query->result();
            return $row;
        }
    }

    // get the administratro details
    function getAdminDetails($id) {
        $query = $this->db->get_where('nc_client', array('id' => $id));

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    function uniqueUserName($userid, $name) {
        $this->db->select('*');
        $this->db->from('nc_client');
        $this->db->where('username', $name);
        $this->db->where_not_in('id', $userid);

        //$this->db->order_by("company_id","DESC");
        $query = $this->db->get();

        return $query->num_rows();
    }

    function getAllUsers() {
        $this->db->order_by("id", "DESC");
        //$this->db->limit($perPage,$offset);
        $query = $this->db->get("nc_client");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getSingleUsers($id) {
        $this->db->where("id", $id);
        $this->db->order_by("id", "DESC");
        //$this->db->limit($perPage,$offset);
        $query = $this->db->get("nc_client");
        if ($query->num_rows() > 0)
            return $query->row();

        return 0;
    }
    
    function checkEmailDuplicate($email){
        $this->db->where('email', $email);
        $query = $this->db->get("nc_client");
        if($query->num_rows()>0)
            return TRUE;
        else 
            return FALSE;
    }
    
    function checkPassword($password, $id){
        $password = md5($password);
        $query=$this->db->query("Select * from nc_client where password = '$password' and id = '$id'");
        if($query->num_rows()>0)
            return TRUE;
        else 
            return FALSE;
    }

    function update($id, $ph) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'client_name' => ucwords($this->input->post('name')),
            'picture' => $ph
        );
        $this->db->where("id", $id);
        $this->db->update('nc_client', $this->security->xss_clean($data));
    }
    
    function passwordcode($email, $code){
        $today = date("Y-m-d H:i:s");
        $data = array(
            'password_request_code' => $code
        );
        $this->db->where("email", $email);
        $this->db->update('nc_client', $this->security->xss_clean($data));
    }

    function checkCodegenerated($email){
        $query = $this->db->query("Select password_request_code from nc_client where email = '$email'");
        if ($query->num_rows() > 0)
            return $query->row();

        return FALSE;   
    }
    
    function updatePassword($id) {
        $data = array(
            'password' => $this->input->post('password')
        );

        $this->db->where("id", $id);
        $this->db->update('nc_client', $this->security->xss_clean($data));
    }
    
    function updatePass(){
        $password = md5($this->input->post('password'));
        $code = $this->input->post('code');
        $this->db->query("Update nc_client set password = '$password' , password_request_code = '' where password_request_code = '$code'");
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }
    
    function passwordupdate($id, $pass){
        $pass = md5($pass);
        $this->db->query("Update nc_client set password = '$pass' where id = '$id'");
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }
    
    function forpasswordchange($code){
        $query = $this->db->query("select * from nc_client where password_request_code = '$code' and status = 'active'");        
        if ($query->num_rows() > 0)
            return true;

        return false;    
    }

    function deleteClient($userid) {
        $this->db->where('id', $userid);
        if($this->db->delete('nc_client'))
            return TRUE;
        else
            return FALSE;
    }

    function updateStatus($id, $value) {
        $data = array(
            'status' => $value
        );

        $this->db->where("id", $id);
        $this->db->update('nc_client', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }
    
    function checkIdandCode($id,$code){
        $query = $this->db->query("Select * from nc_client where id = '$id' and code = '$code'");
        if ($query->num_rows() > 0)
            return $query->row();

        return 0;        
    }

    function insert($ph, $code) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'email' => $this->input->post('email'),
            'status' => 'inactive',
            'date' => $today,
            'client_name' => ucwords($this->input->post('name')),
            'password' => md5($this->input->post('password')),
            'picture' => $ph,
            'code' => $code
        );
        $this->db->insert('nc_client', $this->security->xss_clean($data));
        $userid = $this->db->insert_id();
        return $userid;
    }
    function activateClient($id, $code) {
        $query = $this->db->query("update nc_client set status = 'active' where id = '$id' and code = '$code'");
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

}

?>