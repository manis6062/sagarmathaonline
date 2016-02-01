<?php
class Auth_master_model extends CI_Model
{
    // get the administratro details
    function getAuthDetails($auth_id)
    {
    	$query = $this->db->get_where('nc_auth_master', array('auth_id' => $auth_id));
    	
    	if($query->num_rows() == 0)
    	{
    		return 0;
    	}
    	else
    	{
    		return $query->row();
    	}
    }
	
	function getAllAuth()
	{
	    $this->db->where("status","Publish");
		$this->db->order_by("auth_name","DESC");
		//$this->db->limit($perPage,$offset);
		$query = $this->db->get("nc_auth_master");
		if($query->num_rows() > 0)
			return $query->result();

		return 0;
	}
	
	function getAuth()
	{
		$data = $this->User_model->getAdminDetails($this->session->userdata(ADMIN_AUTH_USERID));
		$user_type=$data->user_type;
		$allowedarry=array();
        
		// if($user_type=="admin")
		// {
			// $array=$this->getAllAuth();
			// $i=0;
			// foreach($array as $value)
			// {
				// $allowedarry[$i]=$value->auth_name;
				// $i++;
			// }
		// }
		// else if($user_type=="user")
		// {
			$allowed=$data->auth_id;
			$array=explode(',',$allowed);
			$i=0;
			foreach($array as $value)
			{
				$details=$this->getAuthDetails($value);
				$allowedarry[$i]=$details->auth_name;
				$i++;
			}
		//}
		return $allowedarry;
	}

}
?>