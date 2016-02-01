<?php
class Writercategory_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this -> load -> helper('date');
        $this -> load -> library('email');
    }

    function countAll($cond) {
        $this -> db -> where($cond);
        $query = $this -> db -> get("nc_writer_category");

        return $query -> num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {
        $this -> db -> select('*');
        $this -> db -> from('nc_writer_category');

        $this -> db -> where($cond);
        $this -> db -> limit($perPage, $offset);
        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    // get the administratro details
    function getAdminDetails($id) {
        $query = $this -> db -> get_where('nc_writer_category', array('id' => $id));

        if ($query -> num_rows() == 0) {
            return 0;
        } else {
            return $query -> row();
        }
    }

    function getAll() {
        $this -> db -> order_by("id", "ASC");
        //$this->db->limit($perPage,$offset);
        $query = $this -> db -> get("nc_writer_category");
        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function update($id) {
        $today = date("Y-m-d H:i:s");

        $data = array('writer_category' => $this -> input -> post('writer_category'));
        $this -> db -> where("id", $id);
        $this -> db -> update('nc_writer_category', $this -> security -> xss_clean($data));
        if($this->db->affected_rows()>0){
            return TRUE;
        }
        return FALSE;
    }

    function delete($id) {
        $this -> db -> where('id', $id);
        $this -> db -> delete('nc_writer_category');
        if ($this -> db -> affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert() {

        $today = date("Y-m-d H:i:s");

        $data = array('writer_category' => $this -> input -> post('writer_category'));
        $this -> db -> insert('nc_writer_category', $this -> security -> xss_clean($data));
        $userid = $this -> db -> insert_id();

        return $userid;
    }

}
?>