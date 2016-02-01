<?php

class Likedislike_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('date');
        $this->load->library('email');
    }
    
    function count($id){
        $query = $this->db->query("SELECT
                            IFNULL(Sum(nc_likedislike.`like`), 0) as `like`,
                            IFNULL(Sum(nc_likedislike.dislike), 0) as dislike
                            FROM
                            nc_likedislike
                            WHERE
                            nc_likedislike.comment_id='$id'
                            ");  
        foreach ($query->result() as $row)
        {
           $row->like;
           $row->dislike;
        }
        return $row;
    }
    
    function check($id, $client){
        $query = $this->db->query("SELECT id
                            FROM
                            nc_likedislike
                            WHERE
                            client_id='$client' and comment_id = '$id'
                            ");   
        if ($query->num_rows() > 0)
            return TRUE;

        return FALSE;
    }

    function likedislike($comment_id, $cartoon_id, $client,$flag,$type) {
        $today = date("Y-m-d H:i:s");
        if($flag=='like'){
            $data = array(
                'comment_id' => $comment_id,
                'cartoon_id' => $cartoon_id,
                'client_id' => $client,
                'like' => '1',
                'dislike' => '0',
                'type' => $type
            );
        }elseif ($flag=='dislike') {
            $data = array(
                'comment_id' => $comment_id,
                'cartoon_id' => $cartoon_id,
                'client_id' => $client,
                'like' => '0',
                'dislike' => '1',
                'type' => $type
            );
        }    
        $this->db->insert('nc_likedislike', $this->security->xss_clean($data));
        $userid = $this->db->insert_id();
        return $userid;
    }
}

?>