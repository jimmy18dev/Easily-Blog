<?php
class Category{
    public $id;
    public $title;
    public $description;
    public $icon;
    public $link;

    private $db;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
    }

    public function listAll(){
        $this->db->query('SELECT * FROM category ORDER BY sort ASC');
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }

    public function get($category_id){
        $this->db->query('SELECT * FROM category WHERE id = :category_id');
        $this->db->bind(':category_id',$category_id);
        $this->db->execute();
        $dataset = $this->db->single();

        $this->id           = $dataset['id'];
        $this->title        = $dataset['title'];
        $this->description  = $dataset['description'];
        $this->icon         = $dataset['icon'];
        $this->link         = $dataset['link'];
        return $dataset;
    }

    public function create($title,$description,$link,$icon){
        $this->db->query('INSERT INTO category(title,link,description,icon,edit_time) VALUE(:title,:link,:description,:icon,:edit_time)');
        $this->db->bind(':title',       $title);
        $this->db->bind(':link',        $link);
        $this->db->bind(':description', $description);
        $this->db->bind(':icon'         ,$icon);
        $this->db->bind(':edit_time',   date('Y-m-d H:i:s'));
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function edit($category_id,$title,$description,$link,$icon){
        $this->db->query('UPDATE category SET title = :title,link = :link,description = :description,icon = :icon,edit_time = :edit_time WHERE id = :category_id');
        $this->db->bind(':category_id', $category_id);
        $this->db->bind(':title',       $title);
        $this->db->bind(':link',        $link);
        $this->db->bind(':description', $description);
        $this->db->bind(':icon'         ,$icon);
        $this->db->bind(':edit_time',   date('Y-m-d H:i:s'));
        $this->db->execute();
        return $this->db->lastInsertId();
    }
}
?>
