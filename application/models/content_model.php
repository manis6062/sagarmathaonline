<?php

class Content_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
        $this->load->library('email');
    }

    function countAll($cond) {
        $this->db->where($cond);
        $query = $this->db->get("nc_content");

        return $query->num_rows();
    }

    function getAll() {

        $this->db->select('*');
        $this->db->from('nc_content');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    function getAllActive() {

        $this->db->select('*');
        $this->db->from('nc_content');
        $this->db->where('content_status', 'Yes');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    // get the administratro details
    function getAdminDetails($user_id) {
        //$query = $this->db->get_where('nc_content', array('content_id' => $user_id));
        $query = $this->db->query("SELECT
                                    c.content_id,
                                    c.content_title,
                                    c.content_description,
                                    c.content_status,
                                    c.crtd_by,
                                    c.crtd_dt,
                                    c.updt_by,
                                    c.updt_dt,
                                    c.content_type,
                                    c.updt_cnt
                                    FROM
                                    nc_content AS c
                                    where c.content_id = ".$user_id
                                    );

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }
    
    function update($user_id) {
        $today = date("Y-m-d H:i:s");


        $data = array(
            'content_title' => $this->input->post('content_title'),
            'content_description' => $this->input->post('content_description'),
            'content_status' => "Yes",
            'crtd_by' => $this->session->userdata(ADMIN_AUTH_USERID),
            'crtd_dt' => $today,
            'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID),
            'content_type' => $this->input->post('type'),
            'updt_dt' => $today,
            'updt_cnt' => $this->input->post('updt_cnt') + 1
        );

        $this->db->where("content_id", $user_id);
        $this->db->update('nc_content', $data);
    }

    function delete($userid) {
        $this->db->where('content_id', $userid);
        $this->db->delete('nc_content');
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function updateStatus($id, $value) {
        $data = array(
            'content_status' => $value
        );

        $this->db->where("content_id", $id);
        $this->db->update('nc_content', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert() {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'content_title' => $this->input->post('content_title'),
            'content_description' => $this->input->post('content_description'),
            'content_status' => "Yes",
            'content_type' => $this->input->post('type'),
            'crtd_by' => $this->session->userdata(ADMIN_AUTH_USERID),
            'crtd_dt' => $today,
            'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID),
            'updt_dt' => $today,
            'updt_cnt' => 0
        );
        $this->db->insert('nc_content', $data);
        $userid = $this->db->insert_id();



        return $userid;
    }
}

?>