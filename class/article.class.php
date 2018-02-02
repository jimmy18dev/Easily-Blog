<?php
class Article{
    public $id;
    public $title;
    public $description;
    public $create_time;
    public $edit_time;
    public $published_time;
    public $count_read;
    public $status;
    public $category_id;
    public $category_title;
    public $owner_id;
    public $owner_fname;
    public $owner_lname;
    public $total_contents;
    public $contents;
    public $total_document;
    public $documents;
	
	// Database instance
	private $db;
    public function __construct() {
    	global $wpdb;
    	$this->db = $wpdb;
    }

    /**
    * Article Actions
    */

    // Create new article
    public function create($user_id,$category_id){
        $this->db->query('INSERT INTO article(user_id,category_id,create_time) VALUE(:user_id,:category_id,:create_time)');
        $this->db->bind(':user_id',$user_id);
        $this->db->bind(':category_id',$category_id);
        $this->db->bind(':create_time',date('Y-m-d H:i:s'));
        $this->db->execute();
        return $this->db->lastInsertId();
    }
    // Edit article title.
    public function editTitle($article_id,$title){
        $this->db->query('UPDATE article SET title = :title, edit_time = :edit_time WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':title',$title);
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }
    // Edit article description.
    public function editDescription($article_id,$description){
        $this->db->query('UPDATE article SET description = :description, edit_time = :edit_time WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':description',$description);
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    // Get Article and Contents
    public function get($article_id){
    	$this->db->query('SELECT article.id,article.title,article.description,article.create_time,article.edit_time,article.published_time,article.count_read count_read,article.status,category.title category_title,category.id category_id,user.id owner_id,user.fname owner_fname,user.lname owner_lname FROM article AS article LEFT JOIN category AS category ON article.category_id = category.id LEFT JOIN user AS user ON article.user_id = user.id WHERE article.id = :article_id');
		$this->db->bind(':article_id',$article_id);
		$this->db->execute();
		$dataset = $this->db->single();

        $dataset['id']          = floatval($dataset['id']);
        $dataset['count_read']  = floatval($dataset['count_read']);

        // List all Contents in this Article.
        $contents = $this->listContents($dataset['id']);
        
        $dataset['total_contents'] = count($contents);
        $dataset['contents']    = $contents;

        $documents = $this->listDocument($dataset['id']);
        $dataset['total_document'] = count($documents);
        $dataset['documents']    = $documents;

        $this->id               = $dataset['id'];
        $this->title            = $dataset['title'];
        $this->description      = $dataset['description'];
        $this->create_time      = $dataset['create_time'];
        $this->edit_time        = $dataset['edit_time'];
        $this->published_time   = $dataset['published_time'];
        $this->count_read       = $dataset['count_read'];
        $this->status           = $dataset['status'];
        $this->category_id      = $dataset['category_id'];
        $this->category_title   = $dataset['category_title'];
        $this->owner_id         = $dataset['owner_id'];
        $this->owner_fname      = $dataset['owner_fname'];
        $this->owner_lname      = $dataset['owner_lname'];
        $this->total_contents   = $dataset['total_contents'];
        $this->contents         = $dataset['contents'];
        $this->documents        = $dataset['documents'];

        return $dataset;
    }

    public function listDocument($article_id){
        $this->db->query('SELECT * FROM document WHERE article_id = :article_id ORDER BY create_time DESC');
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['file_type'] = $this->docType($var['file_type']);
            $dataset[$k]['file_size'] = $this->db->formatBytes($var['file_size']);
        }
        return $dataset;
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

    public function listAll($category_id,$page,$keyword,$status,$owner_id){
        $perpage = 50; // Total items per page.
    	
        if(empty($page) || $page < 0)
            $page = 1; // Default Page Number.
    	
        $start = ($perpage * $page) - $perpage;

    	$select = 'SELECT article.id,article.title,article.description,article.create_time,article.edit_time,article.published_time,article.count_read count_read,article.status,category.title category_title,category.id category_id,user.id owner_id,user.fname owner_fname,user.lname owner_lname,(SELECT img_location FROM content AS content WHERE content.article_id = article.id AND content.type = "image" AND content.status = "active" ORDER BY position ASC LIMIT 1) cover_image FROM article AS article LEFT JOIN category AS category ON article.category_id = category.id LEFT JOIN user AS user ON article.user_id = user.id ';
    	$where = 'WHERE 1=1 ';

    	if(!empty($category_id)){
    		$where_category = 'AND article.category_id = :category_id ';
    	}
    	
    	if($status == 'published'){
    		$where_status = 'AND article.status = "published" ';
    	}

    	if(!empty($owner_id)){
    		$where_owner = 'AND article.user_id = :owner_id ';
    	}
    	
    	$order = 'ORDER BY article.create_time DESC ';
        $limit = 'LIMIT '.$start.','.$perpage;

    	$query_string = $select.$where.$where_category.$where_status.$where_owner.$order.$limit;

    	// echo $query_string;

    	$this->db->query($query_string);
		// $this->db->bind(':article_id',$article_id);

		if(!empty($category_id)){
			$this->db->bind(':category_id',$category_id);
    	}
    	if(!empty($owner_id)){
    		$this->db->bind(':owner_id',$owner_id);
    	}
		$this->db->execute();
		$dataset = $this->db->resultset();

		foreach ($dataset as $k => $var) {
			$dataset[$k]['create_time'] = $this->db->date_thaiformat($var['create_time']);
			$dataset[$k]['edit_time'] 	= $this->db->date_thaiformat($var['edit_time']);
			$dataset[$k]['published_time'] 	= $this->db->date_thaiformat($var['published_time']);
		}

		return $dataset;
    }

    public function delete($article_id){
    	$this->db->query('DELETE FROM article WHERE id = :article_id');
		$this->db->bind(':article_id',$article_id);
		$this->db->execute();
    }

    public function changeStatus($article_id,$status){
    	$this->db->query('UPDATE article SET status = :status, update_time = :update_time WHERE id = :article_id');
		$this->db->bind(':article_id',$article_id);
        $this->db->bind(':status',$status);
		$this->db->bind(':update_time',date('Y-m-d H:i:s'));
		$this->db->execute();
    }

    /**
    * Content in Article Actions
    */
    public function getContent($content_id){
        $this->db->query('SELECT * FROM content WHERE id = :content_id');
        $this->db->bind(':content_id',$content_id);
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset;
    }

    public function listContents($article_id){
        $this->db->query('SELECT content.id,content.user_id owner_id,user.fname owner_fname,content.topic,content.body,content.img_location,content.img_alt,content.video_id,content.position,content.create_time,content.type,content.status FROM content AS content LEFT JOIN user AS user ON content.user_id = user.id WHERE content.article_id = :article_id ORDER BY content.position ASC');
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['id']          = floatval($var['id']);
            $dataset[$k]['owner_id']    = floatval($var['owner_id']);
            $dataset[$k]['position']    = floatval($var['position']);
        }
        return $dataset;
    }

    // Edit Content Topic
    public function editTopic($content_id,$article_id,$topic){
        $this->db->query('UPDATE content SET topic = :topic WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':topic',$topic);
        $this->db->execute();
    }

    // Edit Content Body
    public function editBody($content_id,$article_id,$body){
        $this->db->query('UPDATE content SET body = :body WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':body',$body);
        $this->db->execute();
    }

    // Edit Image location.
    public function editImageLocation($content_id,$article_id,$img_location){
        $this->db->query('UPDATE content SET img_location = :img_location WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':img_location',$img_location);
        $this->db->execute();
    }

    // Edit Image Alt
    public function editImageAlt($content_id,$article_id,$img_alt){
        $this->db->query('UPDATE content SET img_alt = :img_alt WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':img_alt',$img_alt);
        $this->db->execute();
    }

    // Video ID
    public function editVideoID($content_id,$article_id,$video_id){
        $this->db->query('UPDATE content SET video_id = :video_id WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':video_id',$video_id);
        $this->db->execute();
    }

    // Edit Document ID
    public function editDocID($content_id,$article_id,$doc_id){
        $this->db->query('UPDATE content SET doc_id = :doc_id WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':doc_id',$doc_id);
        $this->db->execute();
    }

    public function createContent($user_id,$article_id,$type,$before_content_id = 0){

        if($before_content_id == 0){
            $position = $this->lastPosition($article_id);
        }else{
            $data = $this->getContent($before_content_id);
            $position = $data['position'];
            $this->positionShiftDown($article_id,$position);
        }

        $this->db->query('INSERT INTO content(user_id,article_id,position,create_time,type) VALUE(:user_id,:article_id,:position,:create_time,:type)');
        $this->db->bind(':user_id',$user_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':position',++$position);
        $this->db->bind(':create_time',date('Y-m-d H:i:s'));
        $this->db->bind(':type',$type);
        $this->db->execute();
        return $this->db->lastInsertId();
    }

    private function positionShiftDown($article_id,$current_position){
        $this->db->query('UPDATE content SET position = position + 1 WHERE position > :current_position AND article_id = :article_id ORDER BY position DESC');
        $this->db->bind(':current_position',$current_position);
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
    }

    // Find posttion from last content.
    private function lastPosition($article_id){
        $this->db->query('SELECT position FROM content WHERE article_id = :article_id ORDER BY position DESC LIMIT 1');
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset['position'];
    }

    // Delete Content item.
    public function deleteContent($content_id,$article_id){
        $this->db->query('DELETE FROM content WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
    }

    // Swap Between tow Content.
    public function swap($current,$target){
        $this->db->query('SELECT position FROM content WHERE id = :current');
        $this->db->bind(':current',$current);
        $this->db->execute();
        $dataset = $this->db->single();

        // Get Current position.
        $current_position = $dataset['position'];

        $this->db->query('SELECT position FROM content WHERE id = :target');
        $this->db->bind(':target',$target);
        $this->db->execute();
        $dataset = $this->db->single();

        // Get target position.
        $target_position = $dataset['position'];

        // Update new position.
        $this->db->query('UPDATE content SET position = :target_position WHERE id = :current');
        $this->db->bind(':target_position',$target_position);
        $this->db->bind(':current',$current);
        $this->db->execute();

        $this->db->query('UPDATE content SET position = :current_position WHERE id = :target');
        $this->db->bind(':current_position',$current_position);
        $this->db->bind(':target',$target);
        $this->db->execute();
    }

    /**
    * Documents
    */
}
?>
