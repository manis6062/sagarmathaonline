<?php
class Advertisement_model extends CI_Model {

	function __construct() {
		parent::__construct();
		// Your own constructor code
		$this -> load -> helper('date');
		$this -> load -> library('email');
	}

	function countAll($cond) {
		$this -> db -> where($cond);
		$query = $this -> db -> get("nc_advertisement");

		return $query -> num_rows();
	}

	function getAllPaginate($cond, $perPage, $offset) {

		$this -> db -> select('*');
		$this -> db -> from('nc_advertisement');

		$this -> db -> where($cond);
		$this -> db -> limit($perPage, $offset);
		$query = $this -> db -> get();

		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getAll($by = "all") {
		$query = $this -> db -> query("
			Select s.* from nc_advertisement as s order by slider_id desc			
			");

		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getAllSlider() {
		$query = $this -> db -> query("select *  from nc_image_slider 
			order by id desc			
			");

		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}
	
	function getmediumadvertisment(){
		$query = $this -> db -> query("select *  from nc_advertisement where size='medium' and type = 'non-slider' order by slider_id desc			
			");

		if ($query -> num_rows() > 0)
			return $query -> row();

		return 0;
	}
	
	function getsmalladvertisment($limit,$offset){
		$query = $this -> db -> query("select *  from nc_advertisement where size='small' and type = 'non-slider' order by slider_id desc limit $offset, $limit");

		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getSectionAdvertisment($limit,$offset){
		$query = $this -> db -> query("select *  from nc_advertisement where size='large' and type = 'non-slider' order by slider_id desc limit $offset, $limit");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}
	
	function getlargeadvertisment($offset){
		$query = $this -> db -> query("select *  from nc_advertisement where size='large' and type = 'non-slider' order by slider_id desc limit $offset, 1");

		if ($query -> num_rows() > 0)
			return $query -> row();

		return 0;
	}
	
	function getslideradvertisment(){
		$query = $this -> db -> query("select *  from nc_advertisement where type = 'slider' order by slider_id desc");

		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getAllSliderWithLimit() {
		$query = $this -> db -> query("select *  from nc_image_slider 
			order by id desc limit 4
			");

		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getBannerCategory($type) {
		if ($type == '') {
			$query = $this -> db -> query("
				Select s.*, c.category_name from nc_advertisement as s 
				inner join nc_news_category as c on s.slider_category = c.id
				order by slider_id desc			
				");
		} else {
			$query = $this -> db -> query("
				Select s.*, c.category_name from nc_advertisement as s 
				inner join nc_news_category as c on s.slider_category = c.id
				where slider_category = $type
				order by slider_id desc			
				");
		}

		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getPhotoDetails($id) {
		$query = $this -> db -> get_where('nc_advertisement', array('slider_id' => $id));

		if ($query -> num_rows() == 0) {
			return 0;
		} else {
			return $query -> row();
		}
	}

	function getSlideImage($id) {
		$query = $this -> db -> get_where('nc_image_slider', array('id' => $id));

		if ($query -> num_rows() == 0) {
			return 0;
		} else {
			return $query -> row();
		}
	}

	function update($user_id, $pic) {
		$today = date("Y-m-d H:i:s");

		$data = array(

		//'slider_index' => $this->input->post('slider_index'),
		'path' => $pic, 'size' => $this -> input -> post('size'), 'crtd_dt' => $today, 'crtd_by' => $this -> session -> userdata(ADMIN_AUTH_USERID), 'updt_dt' => $today, 'updt_cnt' => $this -> input -> post('updt_cnt') + 1, 'type' => $this -> input -> post('type'), 'link' => $this -> input -> post('link'));

		$this -> db -> where("slider_id", $user_id);
		$this -> db -> update('nc_advertisement', $data);

	}

	function deletePhoto($userid) {
		$this -> db -> where('slider_id', $userid);
		$this -> db -> delete('nc_advertisement');
		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;

	}

	function deleteSliderImage($userid) {
		$this -> db -> where('id', $userid);
		$this -> db -> delete('nc_image_slider');
		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;

	}

	function updateStatus($id, $value) {
		$data = array('publish' => $value);

		$this -> db -> where("slider_id", $id);
		$this -> db -> update('nc_advertisement', $this -> security -> xss_clean($data));
		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;
	}

	function insert($ph) {

		$today = date("Y-m-d H:i:s");

		$data = array('size' => $this -> input -> post('size'), 'path' => $ph, 'crtd_dt' => $today, 'crtd_by' => $this -> session -> userdata(ADMIN_AUTH_USERID), 'updt_dt' => $today, 'updt_cnt' => $this -> input -> post('updt_cnt') + 1, 'type' => $this -> input -> post('type'), 'link' => $this -> input -> post('link'));
		$this -> db -> insert('nc_advertisement', $data);
		$userid = $this -> db -> insert_id();

		return $userid;
	}

	function changehigherorder($id, $order) {
		$query = $this -> db -> query("UPDATE nc_advertisement SET
					slider_index =(slider_index + 1)
					WHERE slider_index =" . ($order - 1));

		if ($query > 0) {
			$this -> db -> query("UPDATE nc_advertisement SET
					slider_index =(slider_index - 1)
					WHERE slider_id=$id");
		}

	}

	function changelowerorder($id, $order) {

		$query = $this -> db -> query("UPDATE nc_advertisement  SET
					slider_index = (slider_index - 1)
					WHERE slider_index = " . ($order + 1));
		if ($query > 0) {
			$this -> db -> query("UPDATE nc_advertisement  SET
					slider_index = (slider_index + 1)
					WHERE slider_id = $id");
		}
	}

	function getMaxBannerOrder() {
		$this -> db -> select_max('slider_index', 'norder');
		$query = $this -> db -> get('nc_advertisement');
		if ($query -> num_rows() > 0) {
			$row = $query -> row();
			return $row -> norder;
		}

		return 0;
	}

	function getImageForHomePage($pid) {
		$this -> db -> where("gal_pro_id", $pid);
		$this -> db -> order_by("gal_id", "RANDOM");
		$this -> db -> group_by("gal_pro_id");
		$this -> db -> limit(1);
		//$this->db->limit($perPage,$offset);
		$query = $this -> db -> get("ah_products_gallery");
		if ($query -> num_rows() > 0)
			return $query -> row();

		return 0;
	}

	function insert_caraousel($ph) {

		$today = date("Y-m-d H:i:s");

		$data = array('path' => $ph, );
		$this -> db -> insert('nc_image_slider', $data);
		$userid = $this -> db -> insert_id();

		return $userid;
	}

}
?>