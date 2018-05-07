<?php
class HomeSection{

    private $db;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
    }

    public function create($category_id,$total_items){
        $position = $this->lastPosition();
        $this->db->query('INSERT INTO home_section(category_id,total_items,position) VALUE(:category_id,:total_items,:position)');
        $this->db->bind(':total_items',$total_items);
        $this->db->bind(':category_id',$category_id);
        $this->db->bind(':position',++$position);
        $this->db->execute();
        return $this->db->lastInsertId();
    }
     private function lastPosition(){
        $this->db->query('SELECT MAX(position) max FROM home_section');
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset['max'];
    }

    public function lists(){
        $this->db->query('SELECT section.id,section.category_id,category.title category_title,section.total_items FROM home_section AS section LEFT JOIN category AS category ON section.category_id = category.id ORDER BY section.position ASC');
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }

    public function delete($section_id){
        $this->db->query('DELETE FROM home_section WHERE id = :section_id');
        $this->db->bind(':section_id',$section_id);
        $this->db->execute();
    }

    public function swap($current,$target){
        $this->db->query('SELECT position FROM home_section WHERE id = :current');
        $this->db->bind(':current',$current);
        $this->db->execute();
        $dataset = $this->db->single();

        // Get Current position.
        $current_position = $dataset['position'];

        $this->db->query('SELECT position FROM home_section WHERE id = :target');
        $this->db->bind(':target',$target);
        $this->db->execute();
        $dataset = $this->db->single();

        // Get target position.
        $target_position = $dataset['position'];

        // Update new position.
        $this->db->query('UPDATE home_section SET position = :target_position WHERE id = :current');
        $this->db->bind(':target_position',$target_position);
        $this->db->bind(':current',$current);
        $this->db->execute();

        $this->db->query('UPDATE home_section SET position = :current_position WHERE id = :target');
        $this->db->bind(':current_position',$current_position);
        $this->db->bind(':target',$target);
        $this->db->execute();
    }
}
?>
