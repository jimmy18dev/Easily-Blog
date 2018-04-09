<?php
class Document{
    public $id;
    public $owner_id;
    public $owner_name;
    public $title;
    public $description;
    public $file_name;
    public $file_type;
    public $file_size;
    public $create_time;
    public $edit_time;
    public $view;
    public $download;
    public $secret;
    public $status;
    public $privacy;

    private $db;

    public function __construct() {
        global $wpdb;
        $this->db = $wpdb;
    }

    public function string_cleaner($data){
        $data = preg_replace('#[^-ก-๙a-zA-Z0-9]#u','-', $data);
        
        if(substr($data,0,1) == '-')
            $data = substr($data,1);
        if(substr($data,-1) == '-')
            $data = substr($data,0,-1);
        
        $data = urldecode($data);
        $data = str_replace(array('   ','  ',' '),array('-','-','-'),$data);
        $data = str_replace(array('---','--'),array('-','-'),$data);

        return ($data);
    }

    public function docType($type){
        if($type == 'pdf')
            $icon = 'PDF';
        else if($type == 'doc' || $type == 'docx')
            $icon = 'Word';
        else if($type == 'xls' || $type == 'xlsx')
            $icon = 'Excel';
        else if($type == 'ppt' || $type == 'pptx')
            $icon = 'PowerPoint';
        else if($type == 'txt')
            $icon = 'txt';
        else if($type == 'zip')
            $icon = 'Zip';
        else
            $icon = 'n/a';

        return $icon;
    }

    public function get($file_id){
        $this->db->query('SELECT document.id file_id,document.user_id file_owner_id,CONCAT(user.fname," ",user.lname) file_owner_name,document.title file_title,document.description file_description,document.file_name,document.file_type,document.file_size,document.create_time file_create_time,document.edit_time file_edit_time,document.view file_view,document.download file_download,document.secret file_secret,document.privacy file_privacy,document.status file_status 
            FROM document AS document 
            LEFT JOIN user AS user ON document.user_id = user.id WHERE document.id = :file_id');
        $this->db->bind(':file_id',$file_id);
        $this->db->execute();
        $dataset = $this->db->single();

        $this->id               = $dataset['file_id'];
        $this->owner_id         = $dataset['file_owner_id'];
        $this->owner_name       = $dataset['file_owner_name'];
        $this->title            = $dataset['file_title'];
        $this->description      = $dataset['file_description'];
        $this->file_name        = $dataset['file_name'];
        $this->file_type        = $this->docType($dataset['file_type']);
        $this->file_size        = $this->db->formatBytes($dataset['file_size']);
        $this->create_time      = $this->db->datetimeformat($dataset['file_create_time'],'shortdatetime');
        $this->edit_time        = $this->db->datetimeformat($dataset['file_create_time'],'shortdatetime');
        $this->view             = $dataset['file_view'];
        $this->download         = $dataset['file_download'];
        $this->secret           = $dataset['file_secret'];
        $this->status           = $dataset['file_status'];
        $this->privacy          = $dataset['file_privacy'];
    }

    public function listAll($category_id,$user_id,$keyword){
        $select = 'SELECT document.id file_id,document.user_id file_owner_id,CONCAT(user.fname," ",user.lname) file_owner_name,document.category_id file_category_id,category.name file_category_name,document.title file_title,document.description file_description,document.file_name,document.file_type,document.file_size,document.create_time file_create_time,document.edit_time file_edit_time,document.view file_view,document.download file_download,document.privacy file_privacy,document.status file_status 
            FROM document AS document 
            LEFT JOIN user AS user ON document.user_id = user.id 
            LEFT JOIN category AS category ON document.category_id = category.id ';
        $where = 'WHERE 1=1 ';

        $where_user         = '';
        $where_category     = '';
        $where_keyword      = '';

        if(!empty($user_id) && isset($user_id)){
            $where_user = 'AND document.user_id = :user_id ';
        }
        if(!empty($category_id) && isset($category_id)){
            $where_category = 'AND document.category_id = :category_id ';
        }
        if(!empty($keyword) && isset($keyword)){
            $where_keyword = ' AND (document.title LIKE :keyword OR document.description LIKE :keyword) ';
        }

        // $where = 'WHERE document.user_id = :user_id ';
        $order = 'ORDER BY document.create_time DESC';

        $queryString = $select.$where.$where_user.$where_category.$where_keyword.$order;
        $this->db->query($queryString);

        if(!empty($user_id) && isset($user_id)){
            $this->db->bind(':user_id',$user_id);
        }
        if(!empty($category_id) && isset($category_id)){
            $this->db->bind(':category_id',$category_id);
        }
        if(!empty($keyword) && isset($keyword)){
            $this->db->bind(':keyword','%'.$keyword.'%');
        }

        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['file_type']               = $this->docType($var['file_type']);
            $dataset[$k]['file_create_timestamp']   = $this->db->datetimeformat($var['file_create_time'],'timestamp');
            $dataset[$k]['file_edit_timestamp']     = $this->db->datetimeformat($var['file_edit_time'],'timestamp');
            $dataset[$k]['file_create_time']        = $this->db->datetimeformat($var['file_create_time'],'fulldatetime');
            $dataset[$k]['file_edit_time']          = $this->db->datetimeformat($var['file_edit_time'],'fulldatetime');
            $dataset[$k]['file_create_time_fb']     = $this->db->datetimeformat($var['file_create_time'],'facebook');
            $dataset[$k]['file_edit_time_fb']       = $this->db->datetimeformat($var['file_edit_time'],'facebook');
        }
        return $dataset;
    }

    public function delete($file_id){
        $this->db->query('DELETE FROM document WHERE id = :file_id');
        $this->db->bind(':file_id',$file_id);
        $this->db->execute();
    }

    public function editTitle($file_id,$title){
        $this->db->query('UPDATE document SET title = :title,edit_time = :edit_time WHERE id = :file_id');
        $this->db->bind(':file_id',$file_id);
        $this->db->bind(':title',$title);
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    public function create($user_id,$article_id,$title,$description,$file_name,$file_type,$file_size){

        $now = date('Y-m-d H:i:s');
        
        $this->db->query('INSERT INTO document(user_id,article_id,title,description,file_name,file_type,file_size,create_time,edit_time,secret,privacy) VALUE(:user_id,:article_id,:title,:description,:file_name,:file_type,:file_size,:create_time,:edit_time,:secret,:privacy)');
        $this->db->bind(':user_id',$user_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':title',$title);
        $this->db->bind(':description',$description);
        $this->db->bind(':file_name',$file_name);
        $this->db->bind(':file_type',$file_type);
        $this->db->bind(':file_size',$file_size);
        $this->db->bind(':create_time',$now);
        $this->db->bind(':edit_time',$now);
        $this->db->bind(':secret',md5(mt_rand(1,mt_getrandmax())));
        $this->db->bind(':privacy',"public");
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    public function return_bytes($val) {
        $val    = trim($val);
        $last   = strtolower($val[strlen($val)-1]);

        switch($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }

        return $val;
    }
}
?>