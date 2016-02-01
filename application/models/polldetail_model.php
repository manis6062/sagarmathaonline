<?php

class Polldetail_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
    }

    function countAll($cond) {
        $this->db->where($cond);
        $query = $this->db->get("nc_poll_detail");

        return $query->num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {
        $this->db->select('*');
        $this->db->from('nc_poll_detail');

        $this->db->where($cond);
        $this->db->limit($perPage, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getOptions($id) {
        $this->db->select('*');
        $this->db->from('nc_poll_detail');
        $this->db->where('poll_id', $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    // get the administratro details
    function getAdminDetails($id) {
        $query = $this->db->get_where('nc_poll_detail', array('id' => $id));

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    function getAllPollDetail() {
        $this->db->order_by("id", "DESC");
        //$this->db->limit($perPage,$offset);
        $query = $this->db->get("nc_poll_detail");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getSinglePollDetail() {
        $this->db->where("id", $this->session->userdata(ADMIN_AUTH_USERID));
        $this->db->order_by("id", "DESC");
        //$this->db->limit($perPage,$offset);
        $query = $this->db->get("nc_poll_detail");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function update($id, $pollid, $option, $votes) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'option' => $option,
            'cartoon_id' => $pollid,
            'votes' => $votes,
            'updt_dt' => $today
        );

        $this->db->where("id", $id);
        $this->db->update('nc_poll_detail', $this->security->xss_clean($data));
    }

    function deletePollDetail($userid) {
        $this->db->where('id', $userid);
        if($this->db->delete('nc_poll_detail'))
            return TRUE;
        else
            return FALSE;
    }

    function insert($pollid, $option, $pic, $votes) {
        $today = date("Y-m-d H:i:s");

        $data = array(
            'option' => $option,
            'poll_id' => $pollid,
            'image' => $pic,
            'crtd_dt' => $today,
            'updt_dt' => $today
        );
        $this->db->insert('nc_poll_detail', $this->security->xss_clean($data));
        $userid = $this->db->insert_id();
        return $userid;
    }

    function getPhotoDetails($id) {
        $query = $this->db->get_where('nc_poll_detail', array('poll_id' => $id));

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->result();
        }
    }
    
    function checkPollVote($client_id,$poll_id){
        $query = $this->db->query("select * from nc_poll_complete where client_id = $client_id and poll_id = $poll_id");
        if($query->num_rows()==0)
            return 0;
        else
            return $query->row();
    }
    
    function insertPoll($pollid, $client, $id) {
        $today = date("Y-m-d H:i:s");

        $data = array(
            'client_id' => $client,
            'poll_detail_id' => $id,
            'poll_id' => $pollid,
            'voted_dt' => $today,
            'vote' => 1
        );
        $this->db->insert('nc_poll_complete', $this->security->xss_clean($data));
        $userid = $this->db->insert_id();
        return $userid;
    }
    
    function latestPoll($id){
        $query = "";
        if($id!='0'){
            $query = $this->db->query("Select * from nc_poll where id = '$id' and cartoon_id = 0");
        }else{
            $query = $this->db->query("Select * from nc_poll where cartoon_id = 0
                                    ORDER BY
                                    nc_poll.crtd_dt desc
                                    LIMIT 0, 1");
        }
        if($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }
    
    function latestPollWithCartoon($id){
        $query = "";
        if($id!='0'){
            $query = $this->db->query("Select * from nc_poll where id = '$id'");
        }else{
            $query = $this->db->query("Select * from nc_poll where cartoon_id != 0
                                    ORDER BY
                                    nc_poll.crtd_dt ASC
                                    LIMIT 0, 1");
        }
        if($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

}

?>