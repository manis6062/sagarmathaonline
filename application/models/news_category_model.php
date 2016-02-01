<?php
class News_category_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this -> load -> helper('date');
        $this -> load -> library('email');
    }

    function countAll($cond) {
        $this -> db -> where($cond);
        $query = $this -> db -> get("nc_news_category");

        return $query -> num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {
        $this -> db -> select('*');
        $this -> db -> from('nc_news_category');

        $this -> db -> where($cond);
        $this -> db -> limit($perPage, $offset);
        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    // get the administratro details
    function getAdminDetails($id) {
        $query = $this -> db -> get_where('nc_news_category', array('id' => $id));

        if ($query -> num_rows() == 0) {
            return 0;
        } else {
            return $query -> row();
        }
    }

    function getAll() {
        $this -> db -> order_by("order", "ASC");
        //$this->db->limit($perPage,$offset);
        $query = $this -> db -> get("nc_news_category");
        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }
	function getAllMenu() {
		$this -> db -> where("is_menu", "Yes");
        $this -> db -> order_by("order", "ASC");
        //$this->db->limit($perPage,$offset);
        $query = $this -> db -> get("nc_news_category");
        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function update($id) {
        $today = date("Y-m-d H:i:s");

        $data = array('category_name' => $this -> input -> post('news_category'), 
        				'is_menu' => $this->input->post('ismenu'));
        $this -> db -> where("id", $id);
        $this -> db -> update('nc_news_category', $this -> security -> xss_clean($data));
        if($this->db->affected_rows()>0){
            return TRUE;
        }
        return FALSE;
    }

    function delete($id) {
        $this -> db -> where('id', $id);
        $this -> db -> delete('nc_news_category');
        if ($this -> db -> affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert() {

        $today = date("Y-m-d H:i:s");

        $data = array('category_name' => $this -> input -> post('news_category'), 
        				'is_menu' => $this->input->post('ismenu'),'order' => $this->getMaxOrder()+1,);
        $this -> db -> insert('nc_news_category', $this -> security -> xss_clean($data));
        $userid = $this -> db -> insert_id();

        return $userid;
    }
	function getMaxOrder() {
        $this->db->select_max('order', 'norder');
        $query = $this->db->get('nc_news_category');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->norder;
        }
        return 0;
    }
	
	function changehigherorder($id,$order)
	{
		$query = $this->db->query("UPDATE nc_news_category SET
					`order` =(`order` + 1)
					WHERE `order` =".($order-1));
					
		if($query > 0)
		{
			$this->db->query("UPDATE nc_news_category SET
					`order` =(`order` - 1)
					WHERE id=$id");
		}	
	}
	function changelowerorder($id,$order)
	{
		
		$query = $this->db->query("UPDATE nc_news_category  SET
					`order` = (`order` - 1)
					WHERE `order` = ".($order+1));
		if($query > 0)
		{
		$this->db->query("UPDATE nc_news_category  SET
					`order` = (`order` + 1)
					WHERE id = $id");
		}
	}
	

}
?>