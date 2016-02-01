<?php

class Comment_poll_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
        $this->load->library('email');
    }

    function countAll($cond) {
        $query = $this->db->query("Select * from nc_comments_poll where poll_id = '$cond' and status = 'Publish'");

        return $query->num_rows();
    }
    
    function count() {
        $query = $this->db->get("nc_comments_poll");

        return $query->num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

//        $this->db->select('*');
//        $this->db->from('nc_comments');
//
//        $this->db->where($cond);
//        $this->db->limit($perPage, $offset);
        $query = $this->db->query("SELECT
                                    c.id,
                                    c.comment,
                                    c.flag,
                                    (select client_name from nc_client where id = c.client_id) as client,
                                    (select topic from nc_poll where id = c.poll_id) as poll,
                                    c.comment_dt,
                                    c.status
                                    FROM
                                    nc_comments_poll as c 
                                    ORDER BY c.comment_dt desc limit $offset,$perPage");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getAllPaginatefront($id, $perPage, $offset) {

//        $this->db->select('*');
//        $this->db->from('nc_comments');
//
//        $this->db->where($cond);
//        $this->db->limit($perPage, $offset);
        $query = $this->db->query("SELECT
                                    c.id,
                                    c.comment,
                                    c.poll_id,
                                    c.flag,
                                    (select client_name from nc_client where id = c.client_id) as client,
                                    (select picture from nc_client where id = c.client_id) as picture,
                                    (select topic from nc_poll where id = c.poll_id) as poll,
                                    date_format(c.comment_dt, '%M %d %Y') as crtd_dt,
                                    c.comment_dt,
                                    c.status
                                    FROM
                                    nc_comments_poll as c where c.poll_id = '$id' and status = 'Publish' 
                                    ORDER BY c.comment_dt desc
                                    limit 0,$perPage");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function updateStatus($id, $value) {
        $data = array(
            'status' => $value
        );

        $this->db->where("id", $id);
        $this->db->update('nc_comments_poll', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert($pollid, $client_id, $comment) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'poll_id' => $pollid,
            'status' => 'Publish',
            'comment_dt' => $today,
            'client_id' => $client_id,
            'flag' => 'clean',
            'comment' => $comment
        );
        $this->db->insert('nc_comments_poll', $this->security->xss_clean($data));
        $userid = $this->db->insert_id();
        return $userid;
    }
    
    function getAll($id) {

//        $this->db->select('*');
//        $this->db->from('nc_comments');
//
//        $this->db->where($cond);
//        $this->db->limit($perPage, $offset);
        $query = $this->db->query("SELECT
                                    c.id,
                                    c.comment,
                                    c.poll_id,
                                    c.flag,
                                    (select client_name from nc_client where id = c.client_id) as client,
                                    (select picture from nc_client where id = c.client_id) as picture,
                                    (select topic from nc_poll where id = c.poll_id) as poll,
                                    date_format(c.comment_dt, '%M %d %Y') as crtd_dt,
                                    c.comment_dt,
                                    c.status
                                    FROM
                                    nc_comments_poll as c 
                                    ORDER BY c.comment_dt desc");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function update($id) {
        $data = array(
            'flag' => 'flaged'
        );

        $this->db->where("id", $id);
        $this->db->update('nc_comments_poll', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }
}

?>