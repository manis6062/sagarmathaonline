<?php

class Cartoon_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
    }

    function countAll($cond) {
        $this->db->where($cond);
        $query = $this->db->get("nc_cartoon");

        return $query->num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

        $this->db->select('*');
        $this->db->from('nc_cartoon');

        $this->db->where($cond);
        $this->db->limit($perPage, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function parentCartoon() {
        $query = $this->db->query("Select id, title from nc_cartoon where has_sequel='Yes'");
        $data = array();
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row) {
                $data[$row['id']] = $row['title'];                
            }
        }
        return ($data);
    }

    function getAll($by = "all", $perPage, $offset) {
        $query = "";
        if ($by != "all") {
            $query = $this->db->query("SELECT
                            c.id,
                            c.title,
                            c.brief_desc,
                            c.has_sequel,
                            c.sequel_of,
                            c.status,
                            c.featured_image,
                            c.banner_image,
                            c.editor_pick,
                            c.order,
                            c.banner_show,
                            c.recent_show,
                            date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                            (Select title from nc_cartoon where id = c.sequel_of) as sequel_parent,
                            (Select count(id) from nc_cartoon where sequel_of = c.id) as total_sequel,
                            (Select count(id) from nc_poll where cartoon_id = c.id) as total_poll,
                            (select name from nc_category where id = c.category_id) as category,
                            ROUND((SELECT (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average FROM nc_rating where cartoon_id = c.id),0) as rate
                            FROM
                            nc_cartoon as c where c.status = 'Active' order by c.crtd_dt");
        } else {
            $query = $this->db->query("SELECT
                            c.id,
                            c.title,
                            c.brief_desc,
                            c.has_sequel,
                            c.sequel_of,
                            c.status,
                            c.featured_image,
                            c.banner_image,
                            c.editor_pick,
                            c.order,
                            c.banner_show,
                            c.recent_show,
                            date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                            (Select title from nc_cartoon where id = c.sequel_of) as sequel_parent,
                            (Select count(id) from nc_cartoon where sequel_of = c.id) as total_sequel,
                            (Select count(id) from nc_poll where cartoon_id = c.id) as total_poll,
                            (select name from nc_category where id = c.category_id) as category,
                            ROUND((SELECT (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average FROM nc_rating where cartoon_id = c.id),0) as rate
                            FROM
                            nc_cartoon as c order by c.crtd_dt");
        }
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getAllByCategory($id, $perpage, $offset, $by = "all") {
        $query = "";
        if ($by != "all") {
            $query = $this->db->query("SELECT
                            c.id,
                            c.title,
                            c.brief_desc,
                            c.has_sequel,
                            c.sequel_of,
                            c.status,
                            c.featured_image,
                            c.banner_image,
                            c.editor_pick,
                            c.order,
                            date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                            (Select title from nc_cartoon where id = c.sequel_of) as sequel_parent,
                            (Select count(id) from nc_cartoon where sequel_of = c.id) as total_sequel,
                            (Select count(id) from nc_poll where cartoon_id = c.id) as total_poll,
                            (select name from nc_category where id = c.category_id) as category,
                            ROUND((SELECT (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average FROM nc_rating where cartoon_id = c.id),0) as rate
                            FROM
                            nc_cartoon as c where c.status = 'Active' and category_id = ".$id." order by c.crtd_dt limit $offset,$perpage");
        } else {
            $query = $this->db->query("SELECT
                            c.id,
                            c.title,
                            c.brief_desc,
                            c.has_sequel,
                            c.sequel_of,
                            c.status,
                            c.featured_image,
                            c.banner_image,
                            c.editor_pick,
                            c.order,
                            date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                            (Select title from nc_cartoon where id = c.sequel_of) as sequel_parent,
                            (Select count(id) from nc_cartoon where sequel_of = c.id) as total_sequel,
                            (Select count(id) from nc_poll where cartoon_id = c.id) as total_poll,
                            (select name from nc_category where id = c.category_id) as category,
                            ROUND((SELECT (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average FROM nc_rating where cartoon_id = c.id),0) as rate
                            FROM
                            nc_cartoon as c where c.status = 'Active' and category_id = ".$id." order by c.crtd_dt limit $offset,$perpage");
        }
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function totalrowsCategory($id) {
        $query = "";
        $query = $this->db->query("SELECT
                            c.id,
                            c.title,
                            c.brief_desc,
                            c.has_sequel,
                            c.sequel_of,
                            c.status,
                            c.featured_image,
                            c.banner_image,
                            c.editor_pick,
                            c.order,
                            date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                            (Select title from nc_cartoon where id = c.sequel_of) as sequel_parent,
                            (Select count(id) from nc_cartoon where sequel_of = c.id) as total_sequel,
                            (Select count(id) from nc_poll where cartoon_id = c.id) as total_poll,
                            (select name from nc_category where id = c.category_id) as category,
                            ROUND((SELECT (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average FROM nc_rating where cartoon_id = c.id),0) as rate
                            FROM
                            nc_cartoon as c where c.status = 'Active' and category_id = ".$id." order by c.crtd_dt");
        return $query->num_rows();
    }
    
    function getAllByDate($date, $perpage, $offset, $by = "all") {
        $query = "";
        $query = $this->db->query("SELECT
                            c.id,
                            c.title,
                            c.brief_desc,
                            c.has_sequel,
                            c.sequel_of,
                            c.status,
                            c.featured_image,
                            c.banner_image,
                            c.editor_pick,
                            c.order,
                            date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                            (Select title from nc_cartoon where id = c.sequel_of) as sequel_parent,
                            (Select count(id) from nc_cartoon where sequel_of = c.id) as total_sequel,
                            (Select count(id) from nc_poll where cartoon_id = c.id) as total_poll,
                            (select name from nc_category where id = c.category_id) as category,
                            ROUND((SELECT (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average FROM nc_rating where cartoon_id = c.id),0) as rate
                            FROM
                            nc_cartoon as c where c.status = 'Active' and c.crtd_dt like '".$date."%' order by c.crtd_dt 
                            limit $offset, $perpage");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function gettotalByDate($date, $by = "all") {
        $query = "";
        $query = $this->db->query("SELECT
                            c.id,
                            c.title,
                            c.brief_desc,
                            c.has_sequel,
                            c.sequel_of,
                            c.status,
                            c.featured_image,
                            c.banner_image,
                            c.editor_pick,
                            c.order,
                            date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                            (Select title from nc_cartoon where id = c.sequel_of) as sequel_parent,
                            (Select count(id) from nc_cartoon where sequel_of = c.id) as total_sequel,
                            (Select count(id) from nc_poll where cartoon_id = c.id) as total_poll,
                            (select name from nc_category where id = c.category_id) as category,
                            ROUND((SELECT (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average FROM nc_rating where cartoon_id = c.id),0) as rate
                            FROM
                            nc_cartoon as c where c.status = 'Active' and c.crtd_dt like '".$date."%' order by c.crtd_dt 
                            ");
        return $query->num_rows();
    }

    function getAllById($id) {
        $query = "";
        $query = $this->db->query("SELECT
                            c.id,
                            c.title,
                            c.brief_desc,
                            c.detail_desc,
                            c.has_sequel,
                            c.sequel_of,
                            c.status,
                            c.featured_image,
                            c.banner_image,
                            c.editor_pick,
                            c.order,
                            date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                            (Select title from nc_cartoon where id = c.sequel_of) as sequel_parent,
                            (Select count(id) from nc_cartoon where sequel_of = c.id) as total_sequel,
                            (Select count(id) from nc_poll where cartoon_id = c.id) as total_poll,
                            (select name from nc_category where id = c.category_id) as category,
                            ROUND((SELECT (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average FROM nc_rating where cartoon_id = c.id),1) as rate
                            FROM
                            nc_cartoon as c where c.status = 'Active' and c.id = ".$id." order by c.crtd_dt");
//        echo $this->db->last_query();
//        die;
        if ($query->num_rows() > 0)
            return $query->row();

        return 0;
    }

    function getRecentStory() {
        $query = $this->db->query("SELECT
                                    c.id,
                                    c.title,
                                    c.brief_desc,
                                    c.detail_desc,
                                    c.has_sequel,
                                    c.sequel_of,
                                    c.status,
                                    c.featured_image,
                                    c.banner_image,
                                    c.editor_pick,
                                    c.order,                                    
                                    date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                                    c.crtd_by,
                                    c.updt_dt,
                                    c.updt_by,
                                    ROUND((SELECT (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average FROM nc_rating where cartoon_id = c.id),0) as rate,
                                    (select COUNT(nc_rating.rate) from nc_rating where cartoon_id = c.id) as rateCount
                                    FROM
                                    nc_cartoon AS c
                                    where c.status='Active' and c.banner_show='Yes'
                                    ORDER BY c.crtd_dt DESC");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getRecent($id) {
        $query = $this->db->query("SELECT
                                    c.id,
                                    c.title,
                                    c.brief_desc,
                                    c.detail_desc,
                                    c.has_sequel,
                                    c.sequel_of,
                                    c.status,
                                    c.featured_image,
                                    c.banner_image,
                                    c.editor_pick,
                                    c.order,
                                    date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                                    c.crtd_by,
                                    c.updt_dt,
                                    c.updt_by,
                                    ROUND((SELECT (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average FROM nc_rating where cartoon_id = c.id),0) as rate
                                    FROM
                                    nc_cartoon AS c
                                    where c.status='Active' and id != '$id' ORDER BY rate DESC");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getSequels($id){
        $query = $this->db->query("SELECT
                                    c.id,
                                    c.title,
                                    c.brief_desc,
                                    c.detail_desc,
                                    c.has_sequel,
                                    c.sequel_of,
                                    c.status,
                                    c.featured_image,
                                    c.banner_image,
                                    c.editor_pick,
                                    c.order,
                                    date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                                    c.crtd_by,
                                    c.updt_dt,
                                    c.updt_by,
                                    ROUND((SELECT (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average FROM nc_rating where cartoon_id = c.id),0) as rate
                                    FROM
                                    nc_cartoon AS c
                                    where c.status='Active' and sequel_of = '.$id.' ORDER BY rate DESC");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    function getParentSequel($id){
        $query = $this->db->query("SELECT
                                    c.id,
                                    c.title,
                                    c.brief_desc,
                                    c.detail_desc,
                                    c.has_sequel,
                                    c.sequel_of,
                                    c.status,
                                    c.featured_image,
                                    c.banner_image,
                                    c.editor_pick,
                                    c.order,
                                    date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                                    c.crtd_by,
                                    c.updt_dt,
                                    c.updt_by,
                                    ROUND((SELECT (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average FROM nc_rating where cartoon_id = c.id),0) as rate
                                    FROM
                                    nc_cartoon AS c
                                    where c.status='Active' and id = '$id' ORDER BY rate DESC");
        if ($query->num_rows() > 0)
            return $query->row();

        return 0;
    }

    function getTopRated() {
        $query = $this->db->query("SELECT
                                    c.id,
                                    c.title,
                                    c.brief_desc,
                                    c.detail_desc,
                                    c.has_sequel,
                                    c.sequel_of,
                                    c.status,
                                    c.featured_image,
                                    c.banner_image,
                                    c.editor_pick,
                                    c.order,
                                    date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                                    c.crtd_by,
                                    c.updt_dt,
                                    c.updt_by,
                                    ROUND((SELECT
                                    (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average
                                    FROM
                                    nc_rating where cartoon_id = c.id),0) as rate,
                                    (select COUNT(nc_rating.rate) from nc_rating where cartoon_id = c.id) as rateCount
                                    FROM
                                    nc_cartoon AS c
                                    where c.status='Active'
                                    ORDER BY rate DESC");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getEditorPick() {
        $query = $this->db->query("SELECT
                                    c.id,
                                    c.title,
                                    c.brief_desc,
                                    c.detail_desc,
                                    c.has_sequel,
                                    c.sequel_of,
                                    c.status,
                                    c.featured_image,
                                    c.banner_image,
                                    c.editor_pick,
                                    c.order,
                                    date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                                    c.crtd_by,
                                    c.updt_dt,
                                    c.updt_by,
                                    ROUND((SELECT
                                    (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average
                                    FROM
                                    nc_rating where cartoon_id = c.id),0) as rate,
                                    (select COUNT(nc_rating.rate) from nc_rating where cartoon_id = c.id) as rateCount
                                    FROM
                                    nc_cartoon AS c
                                    where c.status='Active' and c.editor_pick = 'Yes'
                                    ORDER BY `order` desc");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getMostPopular() {
        $query = $this->db->query("SELECT
                                    c.*
                                    FROM
                                    nc_cartoon as c
                                    ORDER BY visited DESC");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getArchiveMonth() {
        $query = $this->db->query("SELECT MONTHNAME(STR_TO_DATE(Month(crtd_dt), '%m')) as mth, "
                . "Year(crtd_dt) as yr FROM nc_cartoon "
                . "GROUP BY Month(crtd_dt), Year(crtd_dt) "
                . "ORDER BY crtd_dt DESC");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getArchiveYear() {
        $query = $this->db->query("SELECT Year(crtd_dt) as yr FROM nc_cartoon
                                    GROUP BY Year(crtd_dt)
                                    ORDER BY crtd_dt DESC");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getArchiveByYear($year){
        $query = $this->db->query("Select c.id,
                                    c.title,
                                    c.brief_desc,
                                    c.detail_desc,
                                    c.has_sequel,
                                    c.sequel_of,
                                    c.status,
                                    c.featured_image,
                                    c.banner_image,
                                    c.editor_pick,
                                    c.order,
                                    date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                                    c.crtd_by,
                                    c.updt_dt,
                                    c.updt_by, ROUND((SELECT
                                    (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average
                                    FROM
                                    nc_rating where cartoon_id = c.id),0) as rate,
                                    (select COUNT(nc_rating.rate) from nc_rating where cartoon_id = c.id) as rateCount from nc_cartoon as c where c.status = 'Active' and c.crtd_dt like '$year%' order by c.crtd_dt desc");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getArchiveByDateRange($from,$to){
        $query = $this->db->query("Select c.id,
                                    c.title,
                                    c.brief_desc,
                                    c.detail_desc,
                                    c.has_sequel,
                                    c.sequel_of,
                                    c.status,
                                    c.featured_image,
                                    c.banner_image,
                                    c.editor_pick,
                                    c.order,
                                    date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                                    c.crtd_by,
                                    c.updt_dt,
                                    c.updt_by, ROUND((SELECT
                                    (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average
                                    FROM
                                    nc_rating where cartoon_id = c.id),0) as rate,
                                    (select COUNT(nc_rating.rate) from nc_rating where cartoon_id = c.id) as rateCount from nc_cartoon as c where c.status = 'Active' and c.crtd_dt >= '$from' and c.crtd_dt <= '$to' order by c.crtd_dt desc");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    
    function getArchiveByDate($date, $perpage, $offset){
        $query = $this->db->query("Select c.id,
                                    c.title,
                                    c.brief_desc,
                                    c.detail_desc,
                                    c.has_sequel,
                                    c.sequel_of,
                                    c.status,
                                    c.featured_image,
                                    c.banner_image,
                                    c.editor_pick,
                                    c.order,
                                    date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                                    c.crtd_by,
                                    c.updt_dt,
                                    c.updt_by, ROUND((SELECT
                                    (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average
                                    FROM
                                    nc_rating where cartoon_id = c.id),0) as rate,
                                    (select COUNT(nc_rating.rate) from nc_rating where cartoon_id = c.id) as rateCount from nc_cartoon as c 
                                    where c.status = 'Active' and c.recent_show = 'Yes' order by c.crtd_dt desc 
                                    limit $offset,$perpage");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    function totalrows(){
        $query = $this->db->query("Select c.id,
                                    c.title,
                                    c.brief_desc,
                                    c.detail_desc,
                                    c.has_sequel,
                                    c.sequel_of,
                                    c.status,
                                    c.featured_image,
                                    c.banner_image,
                                    c.editor_pick,
                                    c.order,
                                    date_format(c.crtd_dt, '%M %d %Y') as crtd_dt,
                                    c.crtd_by,
                                    c.updt_dt,
                                    c.updt_by, ROUND((SELECT
                                    (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average
                                    FROM
                                    nc_rating where cartoon_id = c.id),0) as rate,
                                    (select COUNT(nc_rating.rate) from nc_rating where cartoon_id = c.id) as rateCount from nc_cartoon as c 
                                    where c.status = 'Active' and c.recent_show = 'Yes' order by c.crtd_dt desc 
                                    ");

        return $query->num_rows();
    }
    
    // get the administratro details
    function getAdminDetails($id) {
        $query = $this->db->get_where('nc_cartoon', array('id' => $id));

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    function getAllCartoon() {
        $this->db->order_by("id", "DESC");
        //$this->db->limit($perPage,$offset);
        $this->db->where("status",'Acitve');
        $query = $this->db->get("nc_cartoon");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getSingleCartoon($id) {
        $this->db->select("title");
        $this->db->where("id", $id);
        $this->db->order_by("id", "DESC");
        //$this->db->limit($perPage,$offset);
        $query = $this->db->get("nc_cartoon");
        if ($query->num_rows() > 0)
            return $query->row();
        return 0;
    }

    function update($id, $ph, $pic) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'title' => ucwords($this->input->post('title')),
            'brief_desc' => $this->input->post('brief_desc'),
            'detail_desc' => '',
            'has_sequel' => $this->input->post('has_sequel'),
            'sequel_of' => $this->input->post('sequel_of'),
            'status' => $this->input->post('status'),
            'editor_pick' => $this->input->post('editor_pick'),
            'featured_image' => $ph,
            'banner_image' => $pic,
            'updt_dt' => $today,
            'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID),
            'category_id' => $this->input->post('category')
        );

        $this->db->where("id", $id);
        $this->db->update('nc_cartoon', $data);
    }

    function deleteCartoon($userid) {
        $query = $this->db->query("select * from nc_cartoon_strip where cartoon_id = ".$userid);
        $this->db->where('id', $userid);
        if($this->db->delete('nc_cartoon')){ 
            if ($query->num_rows() > 0){
                $this->deleteCartoonStrips($userid);            
            }else{
                return true;
            }    
        }
    }

    function deleteCartoonStrips($id){
        $this->db->where('cartoon_id', $id);
        $this->db->delete('nc_cartoon_strip');
    }
    
    function updateStatus($id, $value) {
        $data = array(
            'status' => $value
        );

        $this->db->where("id", $id);
        $this->db->update('nc_cartoon', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }
    
    function updateEditorPick($id, $value) {
        $data = array(
            'editor_pick' => $value
        );

        $this->db->where("id", $id);
        $this->db->update('nc_cartoon', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert($ph, $pic) {
        $today = date("Y-m-d H:i:s");

        $data = array(
            'title' => ucwords($this->input->post('title')),
            'brief_desc' => $this->input->post('brief_desc'),
            'detail_desc' => '',
            'has_sequel' => $this->input->post('has_sequel'),
            'sequel_of' => $this->input->post('sequel_of'),
            'status' => $this->input->post('status'),
            'featured_image' => $ph,
            'banner_image' => $pic,
            'editor_pick' => $this->input->post('editor_pick'),
            'banner_show' => 'Yes',
            'recent_show' => 'Yes',
            'order' => $this->getMaxOrderCartoon()+1,
            'crtd_dt' => $today,
            'crtd_by' => $this->session->userdata(ADMIN_AUTH_USERID),
            'updt_dt' => $today,
            'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID),
            'category_id' => $this->input->post('category')
        );
        $this->db->insert('nc_cartoon', $data);
        $userid = $this->db->insert_id();
        return $userid;
    }
    
    function getMaxOrderCartoon() {
        $this->db->select_max('order', 'norder');
        $query = $this->db->get('nc_cartoon');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->norder;
        }
        return 0;
    }

    function getMaxOrder() {
        $this->db->select_max('order', 'norder');
        $query = $this->db->get('nc_cartoon_strip');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->norder;
        }

        return 0;
    }

    function getPhotoDetails($id) {
        $query = $this->db->get_where('nc_cartoon', array('id' => $id));
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }
    
    function updateVisited($id){
        $data = array(
            'visited' => $this->max_visited($id)+1
        );
        $this->db->where("id", $id);
        $this->db->update('nc_cartoon', $this->security->xss_clean($data));
    }
    
    function max_visited($id){
        $query = $this->db->query('select visited from nc_cartoon where id = '.$id);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->visited;
        }
        return 0;
    }
    
    function getDetailImages($id){
        $query = $this->db->query('select cs.* from nc_cartoon_strip cs where cs.cartoon_id = '.$id.' order by cs.order asc');
        if ($query->num_rows() > 0)
            return $query->result();
        return 0;
    }
    
    function search($data){
        $query = $this->db->query("Select c.*, ROUND((SELECT
                                    (Sum(nc_rating.rate)/COUNT(nc_rating.rate)) as average
                                    FROM
                                    nc_rating where cartoon_id = c.id),0) as rate from nc_cartoon as c where (c.brief_desc like '%".$data."%' or c.detail_desc like '%".$data."%' or c.title like '%".$data."%') and c.status = 'Active'");
        if($query->num_rows()>0)
            return $query->result();
        return 0;
    }   
    function changehigherorder($cartoon_id,$id,$order)
	{
		$query = $this->db->query("UPDATE nc_cartoon_strip SET
					`order` =(`order` + 1)
					WHERE `order` =".($order-1));
					
		if($query > 0)
		{
			$this->db->query("UPDATE nc_cartoon_strip SET
					`order` =(`order` - 1)
					WHERE id=$id");
		}	
	}
	function changelowerorder($cartoon_id,$id,$order)
	{
		
		$query = $this->db->query("UPDATE nc_cartoon_strip  SET
					`order` = (`order` - 1)
					WHERE `order` = ".($order+1));
		if($query > 0)
		{
		$this->db->query("UPDATE nc_cartoon_strip  SET
					`order` = (`order` + 1)
					WHERE id = $id");
		}
	}
        
        function changehigherorderCartoon($id,$order)
	{
		$query = $this->db->query("UPDATE nc_cartoon SET
					`order` =(`order` + 1)
					WHERE `order` =".($order-1));
					
		if($query > 0)
		{
			$this->db->query("UPDATE nc_cartoon SET
					`order` =(`order` - 1)
					WHERE id=$id");
		}	
	}
	function changelowerorderCartoon($id,$order)
	{
		
		$query = $this->db->query("UPDATE nc_cartoon  SET
					`order` = (`order` - 1)
					WHERE `order` = ".($order+1));
		if($query > 0)
		{
		$this->db->query("UPDATE nc_cartoon  SET
					`order` = (`order` + 1)
					WHERE id = $id");
		}
	}
        function updateBannerShow($id, $value) {
            $data = array(
                'banner_show' => $value
            );

            $this->db->where("id", $id);
            $this->db->update('nc_cartoon', $this->security->xss_clean($data));
            if ($this->db->affected_rows() == '1') {
                return TRUE;
            }
            return FALSE;
        }
        function updateRecentShow($id, $value) {
            $data = array(
                'recent_show' => $value
            );

            $this->db->where("id", $id);
            $this->db->update('nc_cartoon', $this->security->xss_clean($data));
            if ($this->db->affected_rows() == '1') {
                return TRUE;
            }
            return FALSE;
        }
}



?>