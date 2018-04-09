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

    public function create($title,$link,$description){
        $this->db->query('INSERT INTO category(title,link,description,edit_time) VALUE(:title,:link,:description,:edit_time)');
        $this->db->bind(':title',       $title);
        $this->db->bind(':link',        $link);
        $this->db->bind(':description', $description);
        $this->db->bind(':edit_time',   date('Y-m-d H:i:s'));
        $this->db->execute();
        return $this->db->lastInsertId();
    }
}
?>
