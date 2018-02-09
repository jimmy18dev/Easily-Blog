<?php
class Location{
    private $db;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
    }
    public function listGeography(){
    	$this->db->query('SELECT * FROM geography');
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var){
        	$dataset[$k]['geo_id'] = floatval($var['geo_id']);
        }
        return $dataset;
    }
    public function getGeography($geography_id){
    	$this->db->query('SELECT * FROM geography WHERE geo_id = :geography_id');
    	$this->db->bind(':geography_id',$geography_id);
        $this->db->execute();
        $dataset = $this->db->single();
        $dataset['geo_id'] = floatval($dataset['geo_id']);
        return $dataset;
    }

    public function listProvince($geography_id){
    	$this->db->query('SELECT province_id,province_name FROM province WHERE province_geo_id = :geography_id');
    	$this->db->bind(':geography_id',$geography_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var){
        	$dataset[$k]['province_id'] = floatval($var['province_id']);
        	$dataset[$k]['province_name'] = trim($var['province_name']);
        }

        return $dataset;
    }
    public function getProvince(){}
    public function listAmphur($province_id){
    	$this->db->query('SELECT * FROM amphur WHERE amphur_province_id = :province_id');
    	$this->db->bind(':province_id',$province_id);
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }
    public function getAmphur(){}

    public function listDistrict($amphur_id){
    	$this->db->query('SELECT * FROM district WHERE district_amphur_id = :amphur_id');
    	$this->db->bind(':amphur_id',$amphur_id);
        $this->db->execute();
        $dataset = $this->db->resultset();
        return $dataset;
    }
    public function getDistrict(){}
}
?>
