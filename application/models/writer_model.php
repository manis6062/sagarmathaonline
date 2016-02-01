<?php
class Writer_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this -> load -> helper('date');
        $this -> load -> library('email');
    }

    function countAll($cond) {
        $this -> db -> where($cond);
        $query = $this -> db -> get("nc_writer");

        return $query -> num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

        $query = $this -> db -> query("Select w.*, wc.writer_category as category from nc_writer as w inner join nc_writer_category as wc on w.writer_category = wc.id order by wc.writer_category, w.order");

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    // get the administratro details
    function getAdminDetails($user_id) {
        $query = $this -> db -> get_where('nc_writer', array('writer_id' => $user_id));

        if ($query -> num_rows() == 0) {
            return 0;
        } else {
            return $query -> row();
        }
    }

    function getAll() {
        $this -> db -> order_by("writer_id", "ASC");
        //$this->db->limit($perPage,$offset);
        $query = $this -> db -> get("nc_writer");
        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function update($user_id, $ph) {
        $today = date("Y-m-d H:i:s");

        $data = array(
            'writer_name' => $this -> input -> post('writer_name'), 
            'writer_category' => $this->input->post('category'), 
            'writer_gender' => $this->input->post('gender'), 
            'writer_post' => $this -> input -> post('writer_post'), 
            'writer_education' => $this -> input -> post('writer_education'), 
            'writer_image' => $ph, 
            'writer_address' => $this -> input -> post('writer_address'), 
            'writer_email' => $this -> input -> post('writer_email'), 
            'writer_phone' => $this -> input -> post('writer_phone'), 
            'writer_details' => $this -> input -> post('writer_details'), 
            'crtd_by' => $this -> input -> post('crtd_by'), 
            'updt_by' => $this -> session -> userdata(ADMIN_AUTH_USERID), 
            'updt_dt' => $today, 
            'updt_cnt' => $this -> input -> post('updt_cnt') + 1
        );
        $this -> db -> where("writer_id", $user_id);
        $this -> db -> update('nc_writer', $this -> security -> xss_clean($data));
    }

    function deleteuser($userid) {
        $this -> db -> where('writer_id', $userid);
        $this -> db -> delete('nc_writer');
        if ($this -> db -> affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert($ph) {

        $today = date("Y-m-d H:i:s");

        $data = array(
            'writer_name' => $this -> input -> post('writer_name'), 
            'writer_post' => $this -> input -> post('writer_post'), 
            'writer_image' => $ph, 
            'writer_education' => $this -> input -> post('writer_education'), 
            'writer_address' => $this -> input -> post('writer_address'), 
            'writer_category' => $this->input->post('category'), 
            'writer_gender' => $this->input->post('gender'), 
            'writer_email' => $this -> input -> post('writer_email'), 
            'writer_phone' => $this -> input -> post('writer_phone'), 
            'writer_details' => $this -> input -> post('writer_details'), 
            'crtd_by' => $this -> session -> userdata(ADMIN_AUTH_USERID), 
            'crtd_dt' => $today, 
            'updt_by' => $this -> session -> userdata(ADMIN_AUTH_USERID), 
            'updt_dt' => $today, 
            'updt_cnt' => 0,
            'order' => $this->getMaxOrder($this->input->post('category'))+1
        );
        $this -> db -> insert('nc_writer', $this -> security -> xss_clean($data));
        $userid = $this -> db -> insert_id();

        return $userid;
    }

    function getMaxOrder($category){
        $this->db->select_max('order', 'norder');
        $this->db->where('writer_category', $category);
        $query = $this->db->get('nc_writer');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->norder;
        }
        return 0;
    }

    function changehigherorder($id,$order,$category)
    {
        $query = $this->db->query("UPDATE nc_writer SET
                    `order` =(`order` + 1)
                    WHERE `order` =".($order-1)." and writer_category =".$category);
                    
        if($query > 0)
        {
            $this->db->query("UPDATE nc_writer SET
                    `order` =(`order` - 1)
                    WHERE writer_id=$id and writer_category = $category");
        }   
    }
    function changelowerorder($id,$order,$category)
    {
        
        $query = $this->db->query("UPDATE nc_writer  SET
                    `order` = (`order` - 1)
                    WHERE `order` = ".($order+1)." and writer_category =".$category);
        if($query > 0)
        {
        $this->db->query("UPDATE nc_writer  SET
                    `order` = (`order` + 1)
                    WHERE writer_id = $id and writer_category = $category");
        }
    }
}
?>