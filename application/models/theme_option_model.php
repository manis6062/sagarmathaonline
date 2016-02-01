<?php
class Theme_option_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
    }

    function countAll($cond) {
        $this -> db -> where($cond);
        $this->db->where('crtd_by', $this -> session -> userdata(ADMIN_AUTH_USERID));
        $query = $this -> db -> get("nc_theme_option");
        return $query -> num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) 
    {
        $this -> db -> select('*');
        $this -> db -> from('nc_theme_option');     
        $this -> db -> where($cond);
        $this->db->where('crtd_by', $this -> session -> userdata(ADMIN_AUTH_USERID));
        $this -> db -> limit($perPage, $offset);
        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function getAll($id) {
        $query = $this->db->query("Select * from nc_theme_option where id = $id");
        if ($query -> num_rows() > 0)
            return $query -> row();

        return 0;
    }
    
     function getAllLists() {
        $query = $this->db->query("Select * from nc_theme_option order by id DESC limit 4");
        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }
    
	
    function getTotalLists() {
        $query = $this->db->query("Select * from nc_theme_option");
        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }
    
    function update() {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'title' => $this->input->post('title'), 
            'theme_video' => $this -> input -> post('theme_video'),
          
        );
        $this->db->where('id', $this->input->post('id'));
        $this -> db -> update('nc_theme_option', $data);
        if($this->db->affected_rows()>0){
            return TRUE;
        }
        return FALSE;
    }
    
    function insert() {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'title' => $this->input->post('title'), 
           'theme_video' => $this -> input -> post('theme_video'),
            
            // 'crtd_by' => $this -> session -> userdata(ADMIN_AUTH_USERID)
        );

        $this -> db -> insert('nc_theme_option', $data);
        if($this->db->affected_rows()>0){
            return TRUE;
        }
        return FALSE;

    }
	
	  function delete($id) {
         $this->db->where('id', $id);
        if($this->db->delete('nc_theme_option'))
            return TRUE;
        else
            return FALSE;
    }

   
}
?>