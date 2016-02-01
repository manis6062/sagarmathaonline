<?php
class Category_model extends CI_Model
{
    
     function __construct()
       {
            parent::__construct();
            // Your own constructor code
            $this->load->helper('date');        
       }
	function countAll($cond)
	{
		$this->db->where($cond);
		$query = $this->db->get("nc_category");
		
		return $query->num_rows();
	}
	function getAllPaginate($cond,$perPage,$offset)
	{
		
		$this->db->select('*');
		$this->db->from('nc_category');
		
		$this->db->where($cond); 
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return 0;
	}
    
    // get the administratro details
    function getAdminDetails($id)
    {
    	$query = $this->db->get_where('nc_category', array('id' => $id));
    	
    	if($query->num_rows() == 0)
    	{
    		return 0;
    	}
    	else
    	{
    		return $query->row();
    	}
    }
	function getAllCategory()
	{
		$this->db->order_by("id","DESC");
                $this->db->where("status","active");
		//$this->db->limit($perPage,$offset);
		$query = $this->db->get("nc_category");
		if($query->num_rows() > 0)
			return $query->result();

		return 0;
	}
	function getSingleCategory()
	{
		$this->db->where("id",$this->session->userdata(ADMIN_AUTH_USERID));
		$this->db->order_by("id","DESC");
		//$this->db->limit($perPage,$offset);
		$query = $this->db->get("nc_category");
		if($query->num_rows() > 0)
			return $query->result();

		return 0;
	}
        
        function getCategoryForDelete($id)
	{
		$this->db->where("id",$id);
		$this->db->order_by("id","DESC");
		//$this->db->limit($perPage,$offset);
		$query = $this->db->get("nc_category");
		if($query->num_rows() > 0)
			return $query->row();

		return 0;
	}
	
	function update($id)
	{
		$today = date("Y-m-d H:i:s");
                if($this->input->post('is_menu')==''){
                    $menu_option = 'no';
                }else{
                    $menu_option = $this->input->post('is_menu');
                }
                $data = array(
			'name' => ucwords($this->input->post('cat_name')),
			'status' => $this->input->post('status'),
			'is_menu' => $menu_option,
                        'updt_dt' => $today,
                        'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID)
		);

		$this->db->where("id",$id);
		$this->db->update('nc_category', $this->security->xss_clean($data));
        }
	
	function deleteCategory($userid)
	{
		$this->db->where('id', $userid);
		return $this->db->delete('nc_category');				
	}
	
	function updateStatus($id,$value)
	{
		$data = array(
                        'status' =>$value
		);

		$this->db->where("id",$id);
		$this->db->update('nc_category', $this->security->xss_clean($data));
                if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
	}
	
	
	function insert()
	{
		$today = date("Y-m-d H:i:s");

		$data = array(
                        'name' => ucwords($this->input->post('cat_name')),
			'status' => $this->input->post('status'),
			'is_menu' => $this->input->post('is_menu')==""?'no':$this->input->post('is_menu'),
			'crtd_dt' => $today,
                        'crtd_by' => $this->session->userdata(ADMIN_AUTH_USERID),
                        'updt_dt' => $today,
                        'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID)			
		);
		$this->db->insert('nc_category', $this->security->xss_clean($data));
		$userid=$this->db->insert_id();
		return $userid;   
	}

}
?>