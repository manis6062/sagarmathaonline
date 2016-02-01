<?php

class Rate_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
    }

    function countAll($cond) {
        $this->db->where($cond);
        $query = $this->db->get("nc_rating");

        return $query->num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

        $this->db->select('*');
        $this->db->from('nc_rating');

        $this->db->where($cond);
        $this->db->limit($perPage, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getAll($perpage, $offset) {
        $query = $this->db->query("SELECT
                                    count(r.rate) as total_rate_count,
                                    round(sum(r.rate)/count(r.rate),0) as average_rate,
                                    c.title as cartoon,
                                    r.cartoon_id,
                                    MAX(r.crtd_dt) as last_rated_date
                                    FROM
                                    nc_rating as r
                                    INNER JOIN nc_cartoon as c ON r.cartoon_id = c.id
                                    GROUP BY c.title ORDER BY r.cartoon_id ASC");

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function insert($id, $rate) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'cartoon_id' => $id,
            'rate' => $rate,
            'crtd_dt' => $today
        );
        $this->db->insert('nc_rating', $this->security->xss_clean($data));
        $userid = $this->db->insert_id();
        return $userid;
    }
    
    function getData($id) {        
        $query = $this->db->query("SELECT
                                    count(r.rate) as total_rate_count,
                                    round(sum(r.rate)/count(r.rate),0) as average_rate,
                                    c.title,
                                    (select count(id) from nc_rating where rate = 1 and cartoon_id = ".$id.") as vote1,
                                    (select count(id) from nc_rating where rate = 2 and cartoon_id = ".$id.") as vote2,
                                    (select count(id) from nc_rating where rate = 3 and cartoon_id = ".$id.") as vote3,
                                    (select count(id) from nc_rating where rate = 4 and cartoon_id = ".$id.") as vote4,
                                    (select count(id) from nc_rating where rate = 5 and cartoon_id = ".$id.") as vote5,
                                    MAX(r.crtd_dt) as last_rated_date
                                    FROM
                                    nc_rating as r
                                    INNER JOIN nc_cartoon as c ON r.cartoon_id = c.id
                                    where cartoon_id = ".$id."
                                    GROUP BY c.title ORDER BY r.cartoon_id ASC
                                    ");
        if ($query->num_rows() > 0)
            return $query->row();

        return 0;
    }
    
    function getDataDetail($id) {        
        $query = $this->db->query("SELECT
                                    c.client_name,
                                    cr.title,
                                    r.rate,
                                    r.crtd_dt
                                    FROM
                                    nc_rating as r
                                    INNER JOIN nc_cartoon as cr ON r.cartoon_id = cr.id
                                    INNER JOIN nc_client as c ON r.client_id = c.id
                                    where r.cartoon_id = ".$id."
                                    ORDER BY r.cartoon_id ASC
                                    ");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }
    function checkRate($client_id,$cartoon_id){
        $query = $this->db->query("select * from nc_rating where client_id = $client_id and cartoon_id = $cartoon_id");
        if($query->num_rows()==0)
            return '0';
        else
            return $query->row();        
    }
    function insertRate($client, $cartoon_id, $rate) {
        $today = date("Y-m-d H:i:s");

        $data = array(
            'client_id' => $client,
            'cartoon_id' => $cartoon_id,
            'crtd_dt' => $today,
            'rate' => $rate
        );
        $this->db->insert('nc_rating', $this->security->xss_clean($data));
        $userid = $this->db->insert_id();
        return $userid;
    }
    function getAverageRate($cartoon_id) {
        $query = $this->db->query("SELECT
                                    round(sum(r.rate)/count(r.rate),1) as average_rate
                                    FROM
                                    nc_rating as r where r.cartoon_id = '$cartoon_id'");

        if ($query->num_rows() > 0)
            return $query->row();

        return 0;
    }

}

?>