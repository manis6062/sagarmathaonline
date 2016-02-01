<?php

class Cartoonstrip_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
    }

    function countAll($cond) {
        $this->db->where($cond);
        $query = $this->db->get("nc_cartoon_strip");

        return $query->num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

        $this->db->select('*');
        $this->db->from('nc_cartoon_strip');

        $this->db->where($cond);
        $this->db->limit($perPage, $offset);
        $query = $this->db->get();

        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    // get the administratro details
    function getAdminDetails($id) {
        $query = $this->db->get_where('nc_cartoon_strip', array('id' => $id));

        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    function getAllCartoonStrips($id) {
        $query = $this->db->query("Select id, strip_path, `order`, `status`, (select title from nc_cartoon where id = " . $id . ") as cartoon, cartoon_id, crtd_dt from nc_cartoon_strip where cartoon_id = " . $id . " order by `order` asc");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function getCartoonStrips($id) {
        $query = $this->db->query("Select cs.id, cs.strip_path, cs.order, cs.status, (select title from nc_cartoon where id = cs.cartoon_id) as cartoon, cs.crtd_dt from nc_cartoon_strip as cs where cs.id = " . $id . " order by `order` asc");
        if ($query->num_rows() == 0) {
            return 0;
        } else {
            return $query->row();
        }
    }

    function getSingleCartoon() {
        $this->db->where("id", $this->session->userdata(ADMIN_AUTH_USERID));
        $this->db->order_by("id", "DESC");
        //$this->db->limit($perPage,$offset);
        $query = $this->db->get("nc_cartoon_strip");
        if ($query->num_rows() > 0)
            return $query->result();

        return 0;
    }

    function update($id) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'cartoon_id' => ucwords($this->input->post('cartoon_id')),
            'strip_path' => $this->input->post('strip_path'),
            'status' => $this->input->post('status'),
            'updt_dt' => $today,
            'updt_by' => $this->session->userdata(ADMIN_AUTH_USERID)
        );

        $this->db->where("id", $id);
        $this->db->update('nc_cartoon_strip', $data);
    }

    function deleteCartoonStrip($userid) {
        $this->db->where('id', $userid);
        if ($this->db->delete('nc_cartoon_strip'))
            return true;
        else
            return false;
    }

    function updateStatus($id, $value) {
        $data = array(
            'status' => $value
        );

        $this->db->where("id", $id);
        $this->db->update('nc_cartoon_strip', $this->security->xss_clean($data));
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    function insert($name, $id) {
        $today = date("Y-m-d H:i:s");
        $data = array(
            'cartoon_id' => $id,
            'strip_path' => $name,
            'status' => 'Active',
            'order' => $this->getMaxOrder($id) + 1,
            'crtd_dt' => $today,
            'crtd_by' => $this->session->userdata(ADMIN_AUTH_USERID)
        );
        $this->db->insert('nc_cartoon_strip', $data);
//		$userid=$this->db->insert_id();
//		return $userid;   
    }

    function getMaxOrder($cartoon_id) {
        $this->db->select_max('order', 'norder');
        $this->db->where('cartoon_id', $cartoon_id);
        $query = $this->db->get('nc_cartoon_strip');
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->norder;
        }
        return 0;
    }

}

?>