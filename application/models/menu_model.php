<?php

class Menu_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    function countAll($cond) {
        $this->db->where($cond);
        $query = $this->db->get("nc_menu");

        return $query->num_rows();
    }

    function getAll() {
        $this->db->select('*');
        $this->db->from('nc_menu');
		$this->db->order_by('menu_order','asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
	function getAllMenu($place) {
        // $this->db->where('menu_type', $place);
        // $this->db->select('*');
        // $this->db->from('nc_menu');
		// $this->db->order_by('menu_order','asc');
        $query = $this->db->query("Select m.*, mo.module_controller from nc_menu as m inner join nc_module as mo on m.menu_module=mo.id where m.menu_type='$place' order by m.menu_order asc");

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
	
	function getallActive(){
		$query = $this->db->query("SELECT
								mo.module_controller,
								m.id,
								m.menu_name,
								m.menu_type,
								m.`status`,
								m.menu_order,
								m.crtd_dt,
								m.crtd_by,
								m.updt_dt,
								m.updt_by,
								m.content_id,
								m.menu_parent,
								m.menu_module
								FROM
								nc_menu AS m
								INNER JOIN nc_module AS mo ON mo.id = m.menu_module
								WHERE
								m.menu_parent = 0
								");
		
		if ($query->num_rows() > 0)
            return $query->result();

        return 0;
	}
    
    function getAdminDetails($id) {
        //$query = $this->db->get_where('nc_content', array('content_id' => $user_id));
        $query = $this->db->query("SELECT
                                    m.*
                                    FROM
                                    nc_menu AS m
                                    where m.id = ".$id
                                    );

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }
    
    function getsubmenu($id) {
        $this->db->where('menu_parent', $id);
        $this->db->select('*');
        $this->db->from('nc_menu');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getAllsubmenu($id){
    	$query = $this->db->query("SELECT
								mo.module_controller,
								m.id,
								m.menu_name,
								m.menu_type,
								m.`status`,
								m.menu_order,
								m.crtd_dt,
								m.crtd_by,
								m.updt_dt,
								m.updt_by,
								m.content_id,
								m.menu_parent,
								m.menu_module
								FROM
								nc_menu AS m
								INNER JOIN nc_module AS mo ON mo.id = m.menu_module
								WHERE
								m.menu_parent = $id
								");
		
		if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getAllByType($type) {
        $this->db->select('*');
        $this->db->from('nc_menu');
        $array = array('menu_type' => $type, 'status' => 'Active');
        $this->db->where($array);
        $this->db->order_by("menu_order", "asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    function update($id) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'menu_name' => $this->input->post('menu_name'),
            'menu_type' => $this->input->post('menu_type'),
            'status' => $this->input->post('status'),
            'content_id' => $this->input->post('content'),
            // 'menu_parent' => $this->input->post('parent'),
            'menu_module' => $this->input->post('module'),
            'updt_dt' => $today,
            'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID)
        );
        $array = array('id' => $id);
        $this->db->where($array);
        $this->db->update('nc_menu', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function updateStatus($id, $value) {
        $data = array(
            'status' => $value
        );
        $array = array('id' => $id);
        $this->db->where($array);
        $this->db->update('nc_menu', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function changeStatus($id, $value) {
        $data = array(
            'status' => $value
        );
        //$array = array('rel_id' => $id, 'menu_type' => $type);
        $this->db->where("id", $id);
        $this->db->update('nc_menu', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert($data) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'menu_name' => $this->input->post('menu_name'),
            'menu_type' => $this->input->post('menu_type'),
            'status' => $this->input->post('status'),
            'menu_order' => $this->getMaxOrder()+1,
            'content_id' => $this->input->post('content'),
            // 'menu_parent' => $this->input->post('parent'),
            'menu_module' => $this->input->post('module'),
            'crtd_dt' => $today,
            'crtd_by' => $this->session->userdata(ADMIN_AUTH_USERID),
            'updt_dt' => $today,
            'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID)
        );
        $this->db->insert('nc_menu', $this->security->xss_clean($data));
        $userid = $this->db->insert_id();
        return $userid;
    }

    function deleteMenu($userid) {
        $this->db->where('id', $userid);
        $this->db->delete('nc_menu');
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function delete($userid) {
        $array = array('id' => $userid);
        $query =  $this->db->query("delete from nc_menu where id = ".$userid);        
    }

    function getMaxOrder() {
        $this->db->select_max('menu_order', 'norder');
        $query = $this->db->get('nc_menu');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->norder;
        }
        return 0;
    }
    function changehigherorder($id,$order)
	{
		$query = $this->db->query("UPDATE nc_menu SET
					menu_order =(menu_order + 1)
					WHERE menu_order =".($order-1));
					
		if($query > 0)
		{
			$this->db->query("UPDATE nc_menu SET
					menu_order =(menu_order - 1)
					WHERE id=$id");
		}	
	}
	function changelowerorder($id,$order)
	{
		
		$query = $this->db->query("UPDATE nc_menu  SET
					menu_order = (menu_order - 1)
					WHERE menu_order = ".($order+1));
		if($query > 0)
		{
		$this->db->query("UPDATE nc_menu  SET
					menu_order = (menu_order + 1)
					WHERE id = $id");
		}
	}

}

?>