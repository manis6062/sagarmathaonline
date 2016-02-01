<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



// check for authenticated user[administrator]
function checkAdminAuth()
{	
	$CI =& get_instance();
	//echo $CI->session->userdata(ADMIN_AUTH_USERID); exit;
	if(!$CI->session->userdata(ADMIN_AUTH_USERID))
	{
		//redirect('welcome', 'refresh');	
		redirect('admin', 'refresh');
	}
}

function checkLoggedIn()
{
	$CI =& get_instance();
	//echo $CI->session->userdata(ADMIN_AUTH_USERID); exit;
	if($CI->session->userdata(ADMIN_AUTH_USERID))
	{
		redirect('home', 'refresh');	
		
	}
	
}


function currentDateTimeStamp()
{
	$site_info = getSiteInfo();
	
	$gm_hour = $site_info->gmt_hour;
	$gm_minute = $site_info->gmt_minute;
	
	$today = strtotime(gmdate('Y-m-d H:i:s'));
	$year = gmdate("Y");
	$month = gmdate("m");
	$day = gmdate("d");
	$hour = gmdate("H") +$gm_hour;
	$min = gmdate("i") + $gm_minute;
	$sec = gmdate("s");
	
	$today = mktime($hour,$min,$sec,$month,$day,$year);
	
	return $today;
}

// returns the shipping price based on the weight of the product
function getShippingPrice($weight,$newshippingId)
{
	$price = 0;
	$CI =& get_instance();
	
	$sql = "SELECT shipping_price FROM tbl_weights WHERE $weight>=min_weight AND $weight<=max_weight and shipping_type=$newshippingId LIMIT 1";
	$query = $CI->db->query($sql);	
	
	if($query->num_rows() > 0)
	{
		$result = $query->row();
		$price = $result->shipping_price;
	}
		
	return $price;
}

function getCountryList()
{
	$CI =& get_instance();
	$CI->db->order_by("countries_name","ASC");
	$query = $CI->db->get("tbl_countries");	
	
	if($query->num_rows()>0)
		return $query->result();
	
	return 0;
}

function shippaddById($shippaddId)
{
	$CI =& get_instance();
	$CI->db->where("shipping_id",$shippaddId);
	
	$query = $CI->db->get("tbl_shippingaddress");	
	
	if($query->num_rows()>0)
		return $query->row();
	
	return 0;
}
function getCountryByCode($code)
{
    $CI =& get_instance();
    $CI->db->where("countries_iso_code_2",$code);

    $query = $CI->db->get("tbl_countries");

    if($query->num_rows()>0)
    {
        $data =  $query->row();
        return $data->countries_name;
    }

    return;
}
function getDBDate()
{
    $CI =& get_instance();
    $query = $CI->db->query('SELECT now() as mtime');

    if($query->num_rows()>0)
    {
        $data =  $query->row();
        $row = explode(" ", $data->mtime);
		return $row[0];
    }
    return;
}

function getMaxId($table,$field)
	{
		 $CI =& get_instance();
		$CI->db->select_max($field,'norder');
		$query = $CI->db->get($table);
		if($query->num_rows() > 0)
			{
				 $row = $query->row(); 
				 return $row->norder;
			}

		return 0;
	}