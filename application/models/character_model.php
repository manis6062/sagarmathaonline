<?php

class Character_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    function countAll() {
        $query = $this->db->get("nc_character");

        return $query->num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

        $this->db->select('*');
        $this->db->from('nc_character');

        $this->db->where($cond);
        $this->db->limit($perPage, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getAll($by = "all", $perpage, $offset) {

        if ($by != "all") {
            $this->db->where('status', "active");
        }
        $this->db->select('*');
        $this->db->from('nc_character');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    function getAllCharacter($perpage, $offset,$by = "all") {
        $query = "";
        if ($by != "all") {
            $query=$this->db->query("SELECT
                                    nc_character.id,
                                    nc_character.character_title,
                                    nc_character.character_image,
                                    nc_character.character_desc,
                                    nc_character.`status`,
                                    date_format(nc_character.created_dt, '%M %d %Y') as created_dt,
                                    nc_character.created_by,
                                    nc_character.updated_dt,
                                    nc_character.updated_by,
                                    nc_character.visited
                                    FROM
                                    nc_character where status = 'active' limit $offset, $perpage
                                    ");
        }else{
            $query=$this->db->query("SELECT
                                    nc_character.id,
                                    nc_character.character_title,
                                    nc_character.character_image,
                                    nc_character.character_desc,
                                    nc_character.`status`,
                                    date_format(nc_character.created_dt, '%M %d %Y') as created_dt,
                                    nc_character.created_by,
                                    nc_character.updated_dt,
                                    nc_character.updated_by,
                                    nc_character.visited
                                    FROM
                                    nc_character limit $offset, $perpage
                                    ");
        }

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getPhotoDetails($id) {
        $query = $this->db->get_where('nc_character', array('id' => $id));

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    function updateVisited($id){
        $data = array(
            'visited' => $this->max_visited($id)+1
        );
        $this->db->where("id", $id);
        $this->db->update('nc_character', $this->security->xss_clean($data));
    }
    
    function max_visited($id){
        $query = $this->db->query('select visited from nc_character where id = '.$id);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->visited;
        }
        return 0;
    }
    
    function update($user_id, $pic) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            //'slider_index' => $this->input->post('slider_index'),
            'character_title' => $this->input->post('character_title'),
            'character_image' => $pic,
            'character_desc' => $this->input->post('character_desc'),
            'status' => $this->input->post('status'),
            'updated_dt' => $today,
            'updated_by' => $this->session->userdata(ADMIN_AUTH_USERNAME)
        );
        $this->db->where("id", $user_id);
        $this->db->update('nc_character', $data);
    }

    function deletePhoto($userid) {
        $this->db->where('id', $userid);
        $this->db->delete('nc_character');
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }
    
    function getMostPopular(){
        $query = $this->db->query("SELECT
                                    c.*
                                    FROM
                                    nc_character as c
                                    ORDER BY visited DESC");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function updateStatus($id, $value) {
        $data = array(
            'status' => $value
        );

        $this->db->where("id", $id);
        $this->db->update('nc_character', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert($ph) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'character_title' => $this->input->post('character_title'),
            'character_image' => $ph,
            'character_desc' => $this->input->post('character_desc'),
            'status' => $this->input->post('status'),
            'created_dt' => $today,
            'created_by' => $this->session->userdata(ADMIN_AUTH_USERNAME),
            'updated_dt' => $today,
            'updated_by' => $this->session->userdata(ADMIN_AUTH_USERNAME)
        );
        $this->db->insert('nc_character', $data);
        $userid = $this->db->insert_id();
        return $userid;
    }

}

?>