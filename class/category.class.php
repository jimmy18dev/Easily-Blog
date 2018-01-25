<?php
class Category{
	private $db;

    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    public function listAll(){
    	$this->db->query('SELECT * FROM category');
		$this->db->execute();
		$dataset = $this->db->resultset();
		return $dataset;
    }
}
?>
