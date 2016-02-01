<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends CI_Controller {

    private $errors = "";
    private $allowed = array();

    public function __construct() {
        parent::__construct();
        checkAdminAuth();
        // Your own constructor code
        $this -> load -> library('form_validation');
        $this -> load -> library('pagination');
        $this -> form_validation -> set_error_delimiters('<div class="red">', '</div>');
        $this -> load -> helper(array('form', 'url'));
        $this -> load -> helper('path');
        $this -> allowed = $this -> Auth_master_model -> getAuth();
    }

    public function index() {
        $this -> show($page = '');
    }

    function show($page = '') {
        if (in_array('menu_view', $this -> allowed)) {
            $data['menuList'] = $this -> Menu_model -> getAll();
            $data['title'] = "List Menu";
            $data['main_content'] = ADMIN_PATH . "menulist_view";
            $this -> load -> view(ADMIN_PATH . 'include/template', $data);
        } else {
            redirect("admin");
        }
    }

    function deleteMenu($user_id) {
        if ($this -> Menu_model -> deleteMenu($user_id)) {
            $this -> session -> set_flashdata("su_message", "Menu Deleted Successfully.");
        }else{
            $this -> session -> set_flashdata("su_message", "Some error occured while deleting menu.");
        }
        redirect(ADMIN_PATH . "menu");
    }

    function changeStatus($id, $value) {
        $stat = "";
        if ($value == 'Active') {
            $stat = 'Inactive';
        } else {
            $stat = 'Active';
        }

        if ($this -> Menu_model -> changeStatus($id, $stat)) {
            $this -> session -> set_flashdata("su_message", "Status Updated Successfully.");
        } else {
            $this -> session -> set_flashdata("su_message", "Some error occured while udpating status.");
        }
        redirect(ADMIN_PATH . "menu");
    }

    function updateOrder($id, $order, $low_high) {
        if ($low_high <= 1) {
            $this -> Menu_model -> changehigherorder($id, $order);
        } else {
            $this -> Menu_model -> changelowerorder($id, $order);
        }
        $this -> session -> set_flashdata("su_message", "Order changed successfully");
        redirect(ADMIN_PATH . "menu");
    }
    
    function addAction() {
        $masterauth = new Auth_master_model();
        $data['error'] = $this -> errors;
        $data['mas_auth'] = $masterauth -> getAllAuth();
        $data['title'] = "Add Menu";
        $data['main_content'] = ADMIN_PATH . "menuadd_view";
        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

    function add() {
        if (in_array('menu_add', $this -> allowed)) {
            if ($this -> form_validation -> run('menu_add') == FALSE) {
                $this -> addAction();
            } else {
                if ($this -> Menu_model -> insert() > 0) {
                    $this -> session -> set_flashdata("su_message", "Menu Added Successfully.");
                } else {
                    $this -> session -> set_flashdata("su_message", "Some problem occured while adding menu.");
                }
                redirect(ADMIN_PATH . "menu");
            }
        } else {
            redirect("admin");
        }
    }

    function update() {
        if (in_array('menu_update', $this -> allowed)) {
            if ($this -> form_validation -> run('menu_add') == FALSE) {
                $this -> updateAction($this -> input -> post('id'));
            } else {
                if ($this -> Menu_model -> update($this -> input -> post('id'))) {
                    $this -> session -> set_flashdata("su_message", "Menu Updated Successfully.");
                } else {
                    $this -> session -> set_flashdata("su_message", "Some error occured while udpating menu.");
                }
                redirect(ADMIN_PATH . "menu");
            }
        } else {
            $this -> session -> set_flashdata("su_message", "You Have No Previleage To Update Menu");
            redirect(ADMIN_PATH . "menu");
        }
    }

    function updateAction($user_id) {
        $masterauth = new Auth_master_model();
        $data['menu'] = $this -> Menu_model -> getAdminDetails($user_id);
        $data['title'] = "Update Menu";
        $data['main_content'] = ADMIN_PATH . "menuupdate_view";
        $data['mas_auth'] = $masterauth -> getAllAuth();

        $this -> load -> view(ADMIN_PATH . 'include/template', $data);
    }

}
?>