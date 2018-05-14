<?php
class Member{

    private $db;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
    }

    public function listAll(){
        $this->db->query('SELECT * FROM user');
        $this->db->execute();
        $dataset = $this->db->resultset();

        return $dataset;
    }

    public function editType($user_id,$type){
        $this->db->query('UPDATE user SET type = :type WHERE id = :user_id');
        $this->db->bind(':user_id',$user_id);
        $this->db->bind(':type',$type);
        $this->db->execute();
    }
}
?>