<?php
class Slider_model extends CI_Model
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
		$query = $this->db->get("nc_homepage_slider");
		
		return $query->num_rows();
	}
	function getAllPaginate($cond,$perPage,$offset)
	{
		
		$this->db->select('*');
		$this->db->from('nc_homepage_slider');
		
		$this->db->where($cond); 
		$this->db->limit($perPage, $offset);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return 0;
	}
	function getAll($by="all")
	{	
		$query = $this->db->query("
			Select s.* from nc_homepage_slider as s 
			order by slider_id desc			
			");
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return 0;
	}

		function getAllSlider()
	{	
		$query = $this->db->query("select *  from nc_image_slider 
			order by id desc			
			");
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return 0;
	}
	

	function getAllSliderWithLimit()
	{	
		$query = $this->db->query("select *  from nc_image_slider 
			order by id desc limit 4
			");
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return 0;
	}


	function getBannerCategory($type){
		if($type==''){
			$query = $this->db->query("
				Select s.*, c.category_name from nc_homepage_slider as s 
				inner join nc_news_category as c on s.slider_category = c.id
				order by slider_id desc			
				");
		}else{
			$query = $this->db->query("
				Select s.*, c.category_name from nc_homepage_slider as s 
				inner join nc_news_category as c on s.slider_category = c.id
				where slider_category = $type
				order by slider_id desc			
				");
		}			
		
		if($query->num_rows() > 0)
			return $query->result();
		
		return 0;
	}
	
   
   
	
	function getPhotoDetails($id)
	{
		$query = $this->db->get_where('nc_homepage_slider', array('slider_id' => $id));
    	
    	if($query->num_rows() == 0)
    	{
    		return 0;
    	}
    	else
    	{
    		return $query->row();
    	}
	}


	function getSlideImage($id)
	{
		$query = $this->db->get_where('nc_image_slider', array('id' => $id));
    	
    	if($query->num_rows() == 0)
    	{
    		return 0;
    	}
    	else
    	{
    		return $query->row();
    	}
	}
	
	
	
	
	
	function update($user_id,$pic)
	{
		$today = date("Y-m-d H:i:s");


		$data = array(
                        
			//'slider_index' => $this->input->post('slider_index'),
			'path' => $pic,
			'crtd_dt' => $today,
			'crtd_by' => $this->session->userdata(ADMIN_AUTH_USERID),
			'updt_dt' =>  $today,
			'updt_cnt' => $this->input->post('updt_cnt')+1,
			'description' => $this->input->post('description'),
			'publish' => $this->input->post('publish'),
			'link' => $this->input->post('link')
		);

		$this->db->where("slider_id",$user_id);
		$this->db->update('nc_homepage_slider', $data);
		           
	}
	
	
	
	function deletePhoto($userid)
	{
		$this->db->where('slider_id', $userid);
		$this->db->delete('nc_homepage_slider');
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
		
	}


	function deleteSliderImage($userid)
	{
		$this->db->where('id', $userid);
		$this->db->delete('nc_image_slider');
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
		
	}
	
	function updateStatus($id,$value)
	{
		$data = array(
                        'publish' =>$value
		);

		$this->db->where("slider_id",$id);
		$this->db->update('nc_homepage_slider', $this->security->xss_clean($data));
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
			'path' => $ph,
			'crtd_dt' => $today,
			'crtd_by' => $this->session->userdata(ADMIN_AUTH_USERID),
			'updt_dt' =>  $today,
			'updt_cnt' => $this->input->post('updt_cnt')+1,
			'description' => $this->input->post('description'),
			'publish' => $this->input->post('publish'),
			'link' => $this->input->post('link')
		);
		$this->db->insert('nc_homepage_slider', $data);
		$userid=$this->db->insert_id();
		  
		   return $userid;   
	}
	
	function changehigherorder($id,$order)
	{
		$query = $this->db->query("UPDATE nc_homepage_slider SET
					slider_index =(slider_index + 1)
					WHERE slider_index =".($order-1));
					
		if($query > 0)
		{
			$this->db->query("UPDATE nc_homepage_slider SET
					slider_index =(slider_index - 1)
					WHERE slider_id=$id");
		}
	
	}
	function changelowerorder($id,$order)
	{
		
		$query = $this->db->query("UPDATE nc_homepage_slider  SET
					slider_index = (slider_index - 1)
					WHERE slider_index = ".($order+1));
		if($query > 0)
		{
		$this->db->query("UPDATE nc_homepage_slider  SET
					slider_index = (slider_index + 1)
					WHERE slider_id = $id");
		}
	}
	function getMaxBannerOrder()
	{
		$this->db->select_max('slider_index','norder');
		$query = $this->db->get('nc_homepage_slider');
		if($query->num_rows() > 0)
			{
				 $row = $query->row(); 
				 return $row->norder;
			}

		return 0;
	}
	
	
	
	function getImageForHomePage($pid)
	
	{
		$this->db->where("gal_pro_id",$pid);
		$this->db->order_by("gal_id", "RANDOM");
		$this->db->group_by("gal_pro_id");
		$this->db->limit(1);
		//$this->db->limit($perPage,$offset);
		$query = $this->db->get("ah_products_gallery");
		if($query->num_rows() > 0)
			return $query->row();

		return 0;
	}
}
?>