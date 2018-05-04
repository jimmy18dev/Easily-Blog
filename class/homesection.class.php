<?php
class HomeSection{

    private $db;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
    }

    public function lists(){
        $this->db->query('SELECT * FROM home_section ORDER BY position ASC');
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }
}
?>
