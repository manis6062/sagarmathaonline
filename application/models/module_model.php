<?php
class Module_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this -> load -> helper('date');
    }

    function countAll() {
        $query = $this -> db -> get("nc_module");

        return $query -> num_rows();
    }

    function getAll() {

        $this -> db -> select('*');
        $this -> db -> from('nc_module');

        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function getDetails($id) {
        $this->db->select('*');
        $this->db->from('nc_module');
        $this -> db -> where('id', $id);
        $query = $this -> db -> get();
        if ($query -> num_rows() > 0)
            return $query -> row();

        return 0;
    }

    function update($id) {
        $data = array('module_name' => ucwords($this -> input -> post('module_name')), 'module_controller' => $this -> input -> post('module_controller'));

        $this -> db -> where("id", $id);
        $this -> db -> update('nc_module', $this -> security -> xss_clean($data));
    }

    function delete($id) {
        $this -> db -> where('id', $id);
        return $this -> db -> delete('nc_module');
    }

    function insert() {
        $data = array('module_name' => ucwords($this -> input -> post('module_name')), 'module_controller' => $this -> input -> post('module_controller'));
        $this -> db -> insert('nc_module', $this -> security -> xss_clean($data));
        $id = $this -> db -> insert_id();
        return $id;
    }

}
?>