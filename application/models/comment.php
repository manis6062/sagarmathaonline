<?php

class Comment_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
        $this->load->library('email');
    }

       function insert() {

        $today = date("Y-m-d H:i:s");
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'description' => $this->input->post('description'),
            'news_id' => $this->input->post('news_id'),

            'date' => $today
        );
        $this->db->insert('nc_comment', $data);
        $comment_id = $this->db->insert_id();

var_dump($comment_id);
        return $comment_id;
    }

   

}

?>