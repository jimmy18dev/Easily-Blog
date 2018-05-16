<?php
class Location{
    private $db;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
    }

    public function findLocation($keyword){
        $datasets = [];
        // Find District
        $this->db->query('SELECT district_name,amphur_name,province_name,district_id,amphur_id,province_id FROM district LEFT JOIN amphur ON district_amphur_id = amphur_id LEFT JOIN province ON district_province_id = province_id WHERE district_name LIKE :keyword LIMIT 15');
        $this->db->bind(':keyword','%'.$keyword.'%');
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $var) {
            array_push($datasets,array(
                'district_name'     => trim($var['district_name']),
                'amphur_name'       => trim($var['amphur_name']),
                'province_name'     => trim($var['province_name']),
                'district_id'       => floatval($var['district_id']),
                'amphur_id'         => floatval($var['amphur_id']),
                'province_id'       => floatval($var['province_id']),
            ));
        }

        // Find Amphur
        $this->db->query('SELECT province_name,amphur_name,amphur_id,province_id FROM amphur LEFT JOIN province ON amphur_province_id = province_id WHERE amphur_name LIKE :keyword LIMIT 10');
        $this->db->bind(':keyword','%'.$keyword.'%');
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $var) {
            array_push($datasets,array(
                'district_name'     => trim((isset($var['district_name'])?$var['district_name']:'')),
                'amphur_name'       => trim((isset($var['amphur_name'])?$var['amphur_name']:'')),
                'province_name'     => trim((isset($var['province_name'])?$var['province_name']:'')),
                'district_id'       => floatval((isset($var['district_id'])?$var['district_id']:'')),
                'amphur_id'         => floatval((isset($var['amphur_id'])?$var['amphur_id']:'')),
                'province_id'       => floatval((isset($var['province_id'])?$var['province_id']:'')),
            ));
        }

        // Find Province
        $this->db->query('SELECT province_id,province_name FROM province WHERE province_name LIKE :keyword LIMIT 10');
        $this->db->bind(':keyword','%'.$keyword.'%');
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $var) {
            array_push($datasets,array(
                'district_name'     => trim($var['district_name']),
                'amphur_name'       => trim($var['amphur_name']),
                'province_name'     => trim($var['province_name']),
                'district_id'       => floatval($var['district_id']),
                'amphur_id'         => floatval($var['amphur_id']),
                'province_id'       => floatval($var['province_id']),
            ));
        }

        return $datasets;
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
