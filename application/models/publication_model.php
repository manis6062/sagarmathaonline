<?php
class Publication_model extends CI_Model
{
    
     function __construct()
       {
            parent::__construct();
            // Your own constructor code
			$this->load->helper('date');
        	$this->load->library('email');
       }
	function countAll($cond)
	{
		$this->db->where($cond);
		$query = $this->db->get("nc_publication");
		
		return $query->num_rows();
	}
	function getAllPaginate($cond,$perPage,$offset)
	{
		
		$this->db->select('*');
		$this->db->from('nc_publication');
		//$this->db->join('nc_writer', 'nc_publication.writer_id = nc_writer.writer_id','LEFT');
		
		
		$this->db->where($cond); 
		$this->db->limit($perPage, $offset);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return 0;
	}
    
   
    
    // get the administratro details
    function getAdminDetails($user_id)
    {
    	$query = $this->db->get_where('nc_publication', array('publication_id' => $user_id));
    	
    	if($query->num_rows() == 0)
    	{
    		return 0;
    	}
    	else
    	{
    		return $query->row();
    	}
    }
	
	
	
	function getAllUsers($c="No")
	{
		if($c=="Yes")
			$this->db->where("publication_status","Yes");
		$this->db->order_by("publication_id","DESC");
		//$this->db->limit($perPage,$offset);
		$query = $this->db->get("nc_publication");
		if($query->num_rows() > 0)
			return $query->result();

		return 0;
	}
	function getAllPublicationsByUsers($id,$c="No")
	{
		if($c=="Yes")
			$this->db->where("publication_status","Yes");
			
		$this->db->where("writer_id",$id);
		$this->db->order_by("publication_id","DESC");
		//$this->db->limit($perPage,$offset);
		$query = $this->db->get("nc_publication");
		if($query->num_rows() > 0)
			return $query->result();

		return 0;
	}
	function getRecentPublications()
	{
		$this->db->select("nc_publication.publication_file,
nc_publication.publication_title,
nc_publication.publication_id,
nc_writer.writer_name,
nc_publication.publication_date");
		$this->db->from('nc_publication');
		$this->db->join('nc_writer', 'nc_publication.writer_id = nc_writer.writer_id','LEFT');
		$this->db->where("publication_status","Yes");
		$this->db->order_by("publication_date","DESC");
		$this->db->limit(5,0);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $query->result();

		return 0;
	}
	function getSingleUsers()
	{
		$this->db->where("user_id",$this->session->userdata(ADMIN_AUTH_USERID));
		$this->db->order_by("user_id","DESC");
		//$this->db->limit($perPage,$offset);
		$query = $this->db->get("ah_user");
		if($query->num_rows() > 0)
			return $query->result();

		return 0;
	}
	
	function update($user_id,$ph)
	{
		$today = date("Y-m-d H:i:s");


		$data = array(
                        'publication_title' => $this->input->post('publication_title'),
			'publication_brief' => $this->input->post('publication_brief'),
			'publication_details' => $this->input->post('publication_details'),
			'publication_file' => $ph,
			'publication_date' => ucwords($this->input->post('publication_date')),
			
			'publication_status' => ucwords($this->input->post('publication_status')),
			//'writer_id' => ucwords($this->input->post('writer_id')),
			'writer_id' =>0,
			'publication_category' => ucwords($this->input->post('publication_category')),
			'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID),
			'updt_dt' => $today,
			'updt_cnt' => $this->input->post('updt_cnt')+1
			
			
		);

		$this->db->where("publication_id",$user_id);
		$this->db->update('nc_publication', $this->security->xss_clean($data));
		
		
		
		
           
	}
	
	
	
	function deleteuser($userid)
	{
		$this->db->where('publication_id', $userid);
		$this->db->delete('nc_publication');
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
	}
	
	function updateStatus($id,$value)
	{
		$data = array(
                        'publication_status' =>$value
		);

		$this->db->where("publication_id",$id);
		$this->db->update('nc_publication', $this->security->xss_clean($data));
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
	}
	
	
	function insert($ph)
	{
		
		$today = date("Y-m-d H:i:s");


		$data = array(
                       'publication_title' => $this->input->post('publication_title'),
			'publication_brief' => $this->input->post('publication_brief'),
			'publication_details' => $this->input->post('publication_details'),
			'publication_file' => $ph,
			'publication_date' => ucwords($this->input->post('publication_date')),
			'publication_order' => $this->getMaxNewsOrder()+1,
			'publication_status' => ucwords($this->input->post('publication_status')),
			//'writer_id' => ucwords($this->input->post('writer_id')),
			'writer_id' =>0,
			'publication_category' => ucwords($this->input->post('publication_category')),
			'crtd_by' => $this->session->userdata(ADMIN_AUTH_USERID),
			'crtd_dt' => $today,
			'updt_by'=>0,
			'updt_dt'=>'0000:00:00',
			'updt_cnt'=>0
			
			
			
		);
		$this->db->insert('nc_publication', $this->security->xss_clean($data));
		$userid=$this->db->insert_id();
		
		
		  
		   return $userid;   
	}
	
	
	function changehigherorder($id,$order)
	{
		$query = $this->db->query("UPDATE nc_publication SET
					publication_order =(publication_order + 1)
					WHERE publication_order =".($order-1));
					
		if($query > 0)
		{
			$this->db->query("UPDATE nc_publication SET
					publication_order =(publication_order - 1)
					WHERE publication_id=$id");
		}
	
	}
	function changelowerorder($id,$order)
	{
		
		$query = $this->db->query("UPDATE nc_publication  SET
					publication_order = (publication_order - 1)
					WHERE publication_order = ".($order+1));
		if($query > 0)
		{
		$this->db->query("UPDATE nc_publication  SET
					publication_order = (publication_order + 1)
					WHERE publication_id = $id");
		}
	}
	
	function getMaxNewsOrder()
	{
		$this->db->select_max('publication_order','norder');
		$query = $this->db->get('nc_publication');
		if($query->num_rows() > 0)
			{
				 $row = $query->row(); 
				 return $row->norder;
			}

		return 0;
	}

}
?>