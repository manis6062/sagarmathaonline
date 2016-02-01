<?php

class Album_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
        $this->load->library('email');
    }

    function countAll($cond) {
        $this->db->where($cond);
        $query = $this->db->get("nc_album");

        return $query->num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

        $this->db->select('*');
        $this->db->from('nc_album');
        //$this->db->join('nc_writer', 'nc_content.writer_id = nc_writer.writer_id','LEFT');


        $this->db->where($cond);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
	
	function getAll() {

        $this->db->select('*');
        $this->db->from('nc_album');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
	
    // get the administratro details
    function getDetails($user_id) {
        //$query = $this->db->get_where('nc_album', array('album_id' => $user_id));
        $query = $this->db->query("SELECT
                                    a.album_id,
                                    a.album_title,
                                    a.album_descript,
                                    a.album_status,
                                    a.album_date
                                FROM
                                    nc_album AS a
                                    where a.album_id = ".$user_id
                                    );

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }
	
    function getAllUsers($c = "No") {
        if ($c == "Yes")
            $this->db->where("album_status", "Yes");
        $this->db->order_by("album_id", "DESC");
        //$this->db->limit($perPage,$offset);
        $query = $this->db->get("nc_album");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function update($user_id) {
        $today = date("Y-m-d H:i:s");
		$data = array(
            'album_title' => $this->input->post('album_title'),
            'album_descript' => $this->input->post('album_descript'),
            'album_status' => $this->input->post('album_status'),
            'album_date' => $today
        );

        $this->db->where("album_id", $user_id);
        $this->db->update('nc_album', $data);
    }

    function deletealbum($albumid) {
        $this->db->where('album_id', $albumid);
        $this->db->delete('nc_album');
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function updateStatus($id, $value) {
        $data = array(
            'album_status' => $value
        );

        $this->db->where("album_id", $id);
        $this->db->update('nc_album', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert() {

        $today = date("Y-m-d H:i:s");


        $data = array(
            'album_title' => $this->input->post('album_title'),
            'album_descript' => $this->input->post('album_descript'),
            'album_status' => $this->input->post('album_status'),
            'album_date' => $today
        );
        $this->db->insert('nc_album', $data);
        $albumid = $this->db->insert_id();



        return $albumid;
    }

}

?>