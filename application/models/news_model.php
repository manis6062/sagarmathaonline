<?php
class News_model extends CI_Model {

	function __construct() {
		parent::__construct();
		// Your own constructor code
		$this -> load -> helper('date');
		$this -> load -> library('email');
	}

	function countAll($cond) {
		$this -> db -> where($cond);
		$query = $this -> db -> get("nc_news");

		return $query -> num_rows();
	}

	function getAllPaginate($cond, $perPage, $offset) {

		$this -> db -> select('*');
		$this -> db -> from('nc_news');

		$this -> db -> where($cond);
		$this -> db -> order_by("news_order", "DESC");
		$this -> db -> limit($perPage, $offset);
		$query = $this -> db -> get();

		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getAllBanner() {
		$query = $this -> db -> query("Select * from nc_news where banner='Yes' order by news_date desc limit 0,5");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function record_count($id) {
		$this -> db -> where('news_category', $id);
		$query = $this -> db -> get("nc_news");
		
		return $query -> num_rows();
	}

	function getnews($flag) {
		$query = "";
		if ($flag == 'main') {
			$query = $this -> db -> query("Select * from nc_news where news_category = 2 order by news_id desc limit 0,3");
		} elseif ($flag == 'latest') {
			$query = $this -> db -> query("Select * from nc_news order by news_id desc limit 0,8");
		} else {
			$query = $this -> db -> query("Select * from nc_news order by hits desc limit 0,8");
		}
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	// get the administratro details
	function getNewsDetails($id) {
		$query = $this -> db -> get_where('nc_news', array('news_id' => $id));

		if ($query -> num_rows() == 0) {
			return 0;
		} else {
			return $query -> row();
		}
	}

	function getNewsType($flag, $limit) {
		$query = $this -> db -> query("Select n.* from nc_news as n inner join nc_news_category as c on n.news_category = c.id where c.category_name = '$flag' order by news_id desc limit 0,$limit");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

function getNewsTypeTitle($flag, $limit) {
		$query = $this -> db -> query("Select n.* from nc_news as n inner join nc_news_category as c on n.news_category = c.id where c.category_name = '$flag' order by news_id desc limit 5,$limit");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	
	function getNewsTypebyoffset($flag, $offset, $limit) {
		$query = $this -> db -> query("Select n.* from nc_news as n inner join nc_news_category as c on n.news_category = c.id where c.category_name = '$flag' order by news_id desc limit $offset, $limit");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}
	

	function getNewsTypePopular($flag, $limit) {
		$query = $this -> db -> query("Select n.* from nc_news as n inner join nc_news_category as c on n.news_category = c.id where c.category_name = '$flag' order by news_id desc limit 0,$limit");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getAdvertiseType($flag, $limit) {
		$query = $this -> db -> query("Select s.* from nc_advertisement as s inner join nc_news_category as c on s.slider_category = c.id where c.category_name = '$flag' limit 0,$limit");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getHeaderAdvertiseType($flag, $limit) {
		$query = $this -> db -> query("Select s.* from nc_advertisement as s inner join nc_news_category as c on s.slider_category = c.id where s.position = '$flag' limit 0,$limit");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function uniqueUserName($userid, $name) {
		$this -> db -> select('*');
		$this -> db -> from('ah_user');
		$this -> db -> where('user_name', $name);
		$this -> db -> where_not_in('user_id', $userid);

		//$this->db->order_by("company_id","DESC");
		$query = $this -> db -> get();

		return $query -> num_rows();
	}

	function getAllNews() {
		$query = $this -> db -> query("
					Select n.*, nc.category_name from nc_news as n inner join nc_news_category as nc
					on n.news_category = nc.id order by n.flash desc , n.news_id desc
					");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getLatestNews() {

		$this -> db -> where('news_status', 'yes');

		$this -> db -> order_by("news_id", "DESC");
		$this -> db -> limit(5, 0);
		$query = $this -> db -> get("nc_news");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function update($id, $ph) {
		$today = date("Y-m-d");

		$data = array('news_title' => $this -> input -> post('news_title'), 'news_details' => $this -> input -> post('news_details'), 'news_date' => $today, //$this->input->post('news_date'),
		//'news_order' => $this->input->post('news_order'),
		'news_status' => $this -> input -> post('news_status'), 'updt_by' => $this -> session -> userdata(ADMIN_AUTH_USERID), 'updt_dt' => $today, 'updt_cnt' => $this -> input -> post('updt_cnt') + 1, 'news_category' => $this -> input -> post('category'),
		// 'news_type' => $this->input->post('type'),
		'feature_image' => $ph, 'banner' => $this -> input -> post('banner'));

		$this -> db -> where("news_id", $id);
		$this -> db -> update('nc_news', $data);

	}

	function deleteNews($id) {
		$this -> db -> where('news_id', $id);
		$this -> db -> delete('nc_news');
		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;

	}

	function insert($ph) {

		$today = date("Y-m-d");

		$data = array('news_title' => $this -> input -> post('news_title'), 'news_details' => $this -> input -> post('news_details'), 'news_date' => $today, //$this->input->post('news_date'),
		'news_order' => $this -> getMaxNewsOrder($this -> input -> post('category')) + 1, 'news_status' => $this -> input -> post('news_status'), 'crtd_by' => $this -> session -> userdata(ADMIN_AUTH_USERID), 'crtd_dt' => $today, 'news_category' => $this -> input -> post('category'),
		// 'news_type' => $this->input->post('type'),
		'feature_image' => $ph, 'banner' => $this -> input -> post('banner'));
		$this -> db -> insert('nc_news', $data);
		$id = $this -> db -> insert_id();

		return $id;
	}

	function changehigherorder($id, $order, $category) {
		$query = $this -> db -> query("UPDATE nc_news SET
					news_order =(news_order + 1)
					WHERE news_order =" . ($order - 1) . " and news_category= $category");

		if ($query > 0) {
			$this -> db -> query("UPDATE nc_news SET
					news_order =(news_order - 1)
					WHERE news_id=$id and news_category= $category");
		}

	}

	function changelowerorder($id, $order, $category) {

		$query = $this -> db -> query("UPDATE nc_news  SET
					news_order = (news_order - 1)
					WHERE news_order = " . ($order + 1) . " and news_category= $category");
		if ($query > 0) {
			$this -> db -> query("UPDATE nc_news  SET
					news_order = (news_order + 1)
					WHERE news_id = $id and news_category= $category");
		}
	}

	function getMaxNewsOrder($category) {
		$this -> db -> select_max('news_order', 'norder');
		$this -> db -> where('news_category', $category);
		$query = $this -> db -> get('nc_news');
		if ($query -> num_rows() > 0) {
			$row = $query -> row();
			return $row -> norder;
		}

		return 0;
	}

	function updateStatus($id, $value) {
		$data = array('news_status' => $value);

		$this -> db -> where("news_id", $id);
		$this -> db -> update('nc_news', $this -> security -> xss_clean($data));
		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;
	}

	function updateFlash($id, $value) {
		$data = array('flash' => $value);
		if ($value == 'Yes') {
			$this -> db -> query("update nc_news set flash = 'No'");
		}
		$this -> db -> where("news_id", $id);
		$this -> db -> update('nc_news', $this -> security -> xss_clean($data));
		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;
	}

	function getNewsbyCategory($cat_id, $least_value, $final_value) {
		$query = $this -> db -> query("
					Select n.*, nc.category_name from nc_news as n inner join nc_news_category as nc
					on n.news_category = nc.id where news_category = $cat_id order by n.news_id desc limit $least_value, $final_value
					");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getNewsByCat($flag) {
		$query = $this -> db -> query("Select n.* from nc_news as n inner join nc_news_category as c on n.news_category = c.id where c.category_name = '$flag' order by news_id desc");
		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getNewsByCatlimit($flag, $limit, $start) {
		$query = $this -> db -> query("Select n.* from nc_news as n inner join nc_news_category as c on n.news_category = c.id where c.category_name = '$flag' order by news_id desc LIMIT $start, $limit");
		// echo $this->db->last_query();
		// die;

		if ($query -> num_rows() > 0)
			return $query -> result();

		return 0;
	}

	function getcategory($id) {
		$query = $this -> db -> query("
					Select nc.category_name
					from nc_news_category as nc where id = $id
					");
		if ($query -> num_rows() > 0)
			return $query -> row();

		return 0;
	}

	function updatehits($id) {
		$this -> db -> query("update nc_news set hits = hits+1 where news_id = $id");

		if ($this -> db -> affected_rows() == '1') {
			return TRUE;
		}
		return FALSE;
	}

	function getFlashnews() {
		$query = $this -> db -> query("Select * from nc_news where flash = 'Yes'");
		if ($query -> num_rows() > 0) {
			return $query -> row();
		}
		return 0;
	}

}
?>