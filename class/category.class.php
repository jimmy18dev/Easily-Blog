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
        $this->db->query('SELECT * FROM category ORDER BY position ASC');
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
        $position = $this->lastPosition();
        $this->db->query('INSERT INTO category(title,link,description,icon,position,edit_time) VALUE(:title,:link,:description,:icon,:position,:edit_time)');
        $this->db->bind(':title',       $title);
        $this->db->bind(':link',        $link);
        $this->db->bind(':description', $description);
        $this->db->bind(':position',    ++$position);
        $this->db->bind(':icon',        $icon);
        $this->db->bind(':edit_time',   date('Y-m-d H:i:s'));
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    private function lastPosition(){
        $this->db->query('SELECT MAX(position) max FROM category');
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset['max'];
    }

    public function swap($current,$target){
        $this->db->query('SELECT position FROM category WHERE id = :current');
        $this->db->bind(':current',$current);
        $this->db->execute();
        $dataset = $this->db->single();

        // Get Current position.
        $current_position = $dataset['position'];

        $this->db->query('SELECT position FROM category WHERE id = :target');
        $this->db->bind(':target',$target);
        $this->db->execute();
        $dataset = $this->db->single();

        // Get target position.
        $target_position = $dataset['position'];

        // Update new position.
        $this->db->query('UPDATE category SET position = :target_position WHERE id = :current');
        $this->db->bind(':target_position',$target_position);
        $this->db->bind(':current',$current);
        $this->db->execute();

        $this->db->query('UPDATE category SET position = :current_position WHERE id = :target');
        $this->db->bind(':current_position',$current_position);
        $this->db->bind(':target',$target);
        $this->db->execute();
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

    public function delete($category_id,$new_target){
        // Move all articles to new category
        $this->db->query('UPDATE article SET category_id = :new_target WHERE category_id = :category_id');
        $this->db->bind(':category_id', $category_id);
        $this->db->bind(':new_target', $new_target);
        $this->db->execute();

        // Delete Now!
        $this->db->query('DELETE FROM category WHERE id = :category_id');
        $this->db->bind(':category_id', $category_id);
        $this->db->execute();
    }
}
?>
