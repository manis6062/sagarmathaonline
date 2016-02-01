<?php

class Team_model extends CI_Model {

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
	
	function getAllTeams() {

        $query = $this->db->query('select t.* , t_g.* from nc_team t inner join nc_team_category t_g on t.team_category_id = t_g.id');
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
	
	
   function getAll($id) {
        $query = $this->db->query("Select t.* , t_g.* from nc_team t left join nc_team_category t_g on t.team_category_id = t_g.id where t.id = $id");
        if ($query -> num_rows() > 0)
            return $query -> row();

        return 0;
    }

  
    
    function update($id) {
         $data= array(
            'name' => $this -> input -> post('name'),          
        );

        $this->db->where('team_category_id', $id);
        $this -> db -> update('nc_team', $data);

        $this->updateCategory($id);

        if($this->db->affected_rows()>0){
            return TRUE;
        }
        return FALSE;
    }


      function updateCategory($id) {
        $data = array(
            'category_name' => $this->input->post('category_name'), 
          
        );

        $this->db->where('id', $id);
        $this -> db -> update('nc_team_category', $data);
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