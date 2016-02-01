<?php

class Poll_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
    }

    function countAll($cond) {
        $this->db->where($cond);
        $query = $this->db->get("nc_poll");

        return $query->num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

        $this->db->select('*');
        $this->db->from('nc_poll');

        $this->db->where($cond);
        $this->db->limit($perPage, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    // get the administratro details
    function getAdminDetails($id, $poll, $story) {
        $query = $this->db->get_where('nc_poll', array('id' => $id));
        
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }
    
    function getSinglePoll($id) {
        $query = $this->db->get_where('nc_poll', array('cartoon_id' => $id));
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }
    function getPollSingle($id) {
        $query = $this->db->get_where('nc_poll', array('id' => $id));
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    function getAllPoll($perpage, $offset) {
        $query = $this->db->query("SELECT                                    
                                    p.id,
                                    p.topic,
                                    p.crtd_dt,
                                    p.updt_dt,
                                    (select count(id) from nc_poll_detail where poll_id = p.id) as total_options,
                                    (select SUM(vote) from nc_poll_complete where poll_id = p.id) as total_votes,
                                    (select title from nc_cartoon where id = p.cartoon_id) as title,
                                    (select MAX(voted_dt) from nc_poll_complete where poll_id = p.id) as last_voted_date
                                    FROM
                                    nc_poll as p
                                    ");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    
    function getAll() {
        $query = $this->db->query("SELECT
                                    p.id,
                                    p.topic,
                                    date_format(p.crtd_dt, '%M %d %Y') as crtd_dt,
                                    p.updt_dt
                                    FROM
                                    nc_poll as p where p.cartoon_id=0
                                    ");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getDetail($id) {
        
        $query = $this->db->query("SELECT
                                    pd.option,
                                    pd.image,
                                    (select count(id) from nc_poll_complete where poll_detail_id = pd.id) as total_votes
                                    FROM
                                    nc_poll_detail as pd
                                    where pd.poll_id = ".$id."
                                    GROUP BY pd.id order by pd.id
                                    ");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getArchiveMonth(){
        $query = $this->db->query("SELECT MONTHNAME(STR_TO_DATE(Month(crtd_dt), '%m')) as mth, "
                                    . "Year(crtd_dt) as yr FROM nc_poll "
                                    . "GROUP BY Month(crtd_dt), Year(crtd_dt) "
                                    . "ORDER BY crtd_dt DESC");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    
    function getData($id) {
        
        $query = $this->db->query("SELECT
                                    (select title from nc_cartoon where id = p.cartoon_id) as title,
                                    p.topic, 
                                    (select count(vote) from nc_poll_complete where poll_id=p.id) as total_votes
                                    FROM
                                    nc_poll AS p
                                    where p.id=".$id."
                                    ");
        if ($query->num_rows() > 0)
            return $query->row();

        return 0;
    }
    
    function getBrief($id){
        $query = $this->db->query("SELECT
                                    count(p.vote) as total_votes from nc_poll_complete as p
                                    where p.poll_id=".$id."
                                    ");
        if ($query->num_rows() > 0){
            $row = $query->row();
            return $row->total_votes;            
        }    

        return 0;
    }

    function update($id) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'topic' => ucwords($this->input->post('topic')),
            'cartoon_id' => $this->input->post('cartoon'),
            'updt_dt' => $today,
            'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID)
        );

        $this->db->where("id", $id);
        $this->db->update('nc_poll', $this->security->xss_clean($data));
    }

    function deletePoll($userid) {
        $this->db->where('id', $userid);
        if($this->db->delete('nc_poll'))
            return TRUE;
        else
            return FALSE;
    }

    function insert($id) {
        $today = date("Y-m-d H:i:s");

        $data = array(
            'topic' => ucwords($this->input->post('topic')),
            'cartoon_id' => $id,
            'crtd_dt' => $today,
            'crtd_by' => $this->session->userdata(ADMIN_AUTH_USERID),
            'updt_dt' => $today,
            'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID)
        );
        $this->db->insert('nc_poll', $this->security->xss_clean($data));
        $userid = $this->db->insert_id();
        return $userid;
    }
    
    function getAllByDate($date, $by = "all") {
        $query = "";
        $query = $this->db->query("SELECT
                            * 
                            FROM
                            nc_poll as p where p.crtd_dt like '".$date."%' and p.cartoon_id = 0 order by p.crtd_dt");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

}

?>