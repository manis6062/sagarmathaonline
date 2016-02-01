<?php
class Gallery_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // Your own constructor code
        $this -> load -> helper('date');
        $this -> load -> library('email');
    }

    function countAll($cond) {
        $this -> db -> where($cond);
        $query = $this -> db -> get("nc_homepage_slider");

        return $query -> num_rows();
    }

    function getAllPaginate($cond, $perPage, $offset) {

        $this -> db -> select('*');
        $this -> db -> from('nc_homepage_slider');

        $this -> db -> where($cond);
        $this -> db -> limit($perPage, $offset);
        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function getAll($by = "all") {

        if ($by != "all") {
            $this -> db -> where('publish', "yes");
        }

        $this -> db -> select('*');
        $this -> db -> from('nc_homepage_slider');
        $this -> db -> order_by("slider_id", "desc");

        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function getAllByAlbum($album_id) {
        $this -> db -> select('*');
        $this -> db -> from('nc_gallery');
        $this -> db -> where('album_id', $album_id);

        $query = $this -> db -> get();

        if ($query -> num_rows() > 0)
            return $query -> result();

        return 0;
    }

    function getImageDetail($gallery_id) {
        $query = $this -> db -> query('select g.*, a.album_title from nc_gallery as g inner join nc_album as a on g.album_id = a.album_id where g.gallery_id = ' . $gallery_id);
        if ($query -> num_rows() > 0)
            return $query -> row();

        return 0;
    }

    function getPhotoDetails($id) {
        $query = $this -> db -> get_where('nc_homepage_slider', array('slider_id' => $id));

        if ($query -> num_rows() == 0) {
            return 0;
        } else {
            return $query -> row();
        }
    }

    function update($user_id, $ph) {
        $today = date("Y-m-d H:i:s");
        $data = array('gallery_title' => $this -> input -> post('gallery_title'), 'album_id' => $this -> input -> post('album_id'), 'gallery_path' => $ph, 'updt_dt' => $today, 'updt_by' => $this -> session -> userdata(ADMIN_AUTH_USERID));

        $this -> db -> where("gallery_id", $user_id);
        $this -> db -> update('nc_gallery', $data);
    }

    function delete($userid) {
        $this -> db -> where('gallery_id', $userid);
        $this -> db -> delete('nc_gallery');
        if ($this -> db -> affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;

    }

    function insert($ph) {
        $today = date("Y-m-d H:i:s");
        $data = array('gallery_title' => $this -> input -> post('gallery_title'), 'album_id' => $this -> input -> post('album_id'), 'gallery_path' => $ph, 'crtd_dt' => $today, 'crtd_by' => $this -> session -> userdata(ADMIN_AUTH_USERID), 'updt_dt' => $today, 'updt_by' => $this -> session -> userdata(ADMIN_AUTH_USERID));
        $this -> db -> insert('nc_gallery', $data);
        $userid = $this -> db -> insert_id();
        return $userid;
    }

}
?>