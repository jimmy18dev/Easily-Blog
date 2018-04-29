<?php
class HomeSection{

    private $db;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
    }

    public function list(){
        $this->db->query('SELECT * FROM home_section ORDER BY position ASC');
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }
}
?>
