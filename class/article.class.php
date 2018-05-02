<?php
class Article{
    public $id;
    public $title;
    public $description;
    public $url;
    public $create_time;
    public $edit_time;
    public $published_time;
    public $count_read;
    public $status;
    public $category_id;
    public $category_title;
    public $category_link;
    public $owner_id;
    public $owner_fname;
    public $owner_lname;
    public $owner_displayname;
    public $total_contents;
    public $contents;
    public $total_document;
    public $documents;
    public $tags;

    public $province_id;
    public $province_name;
    public $amphur_id;
    public $amphur_name;
    public $district_id;
    public $district_name;

    public $cover_id;
    public $cover_img;

    public $head_cover_id;
    public $head_cover_img;

    // Options Checking
    public $hasTags;
    public $hasCover;
    public $hasLocation;
    public $hasInfo;
    public $hasURL;
	
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
        $this->db->bind(':title',$this->db->string_cleaner($title));
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }
    // Edit article description.
    public function editDescription($article_id,$description){
        $this->db->query('UPDATE article SET description = :description, edit_time = :edit_time WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':description',$this->db->string_cleaner($description));
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    // Update Article Address
    public function editAddress($article_id,$province_id,$amphur_id,$district_id){
        $this->db->query('UPDATE article SET province_id = :province_id,amphur_id = :amphur_id,district_id = :district_id, edit_time = :edit_time WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':province_id',$province_id);
        $this->db->bind(':amphur_id',$amphur_id);
        $this->db->bind(':district_id',$district_id);
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    // Edit Article URL.
    public function editURL($article_id,$url){

        $url = $this->db->urlFriendly($url);

        $this->db->query('UPDATE article SET url = :url, edit_time = :edit_time WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':url',$url);
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    // Set Article Cover with Image Content.
    public function setCover($article_id,$cover_id){
        $this->db->query('UPDATE article SET cover_id = :cover_id, edit_time = :edit_time WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':cover_id',$cover_id);
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    public function hasCover($article_id){
        $this->db->query('SELECT cover_id FROM article WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $dataset = $this->db->single();

        if(!empty($dataset['cover_id']) && isset($dataset['cover_id']))
            return true;
        else
            return false;
    }

    // Set Head Cover
    public function setHeadCover($article_id,$head_cover_id){
        $this->db->query('UPDATE article SET head_cover_id = :head_cover_id, edit_time = :edit_time WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':head_cover_id',$head_cover_id);
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    public function removeHeadCover($article_id){
        $this->db->query('UPDATE article SET head_cover_id = NULL, edit_time = :edit_time WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    // Get Article and Contents
    public function get($article_id){
    	$this->db->query('SELECT article.id,article.title,article.description,article.url,article.create_time,article.edit_time,article.published_time,article.count_read count_read,article.province_id,province.province_name,article.amphur_id,amphur.amphur_name,article.district_id,district.district_name,article.status,article.create_time,article.edit_time,article.published_time,category.title category_title,category.id category_id,category.link category_link,user.id owner_id,user.fname owner_fname,user.lname owner_lname,user.display owner_displayname,article.cover_id,content.img_location cover_img,article.head_cover_id,head_cover.img_location head_cover_img 
            FROM article AS article 
            LEFT JOIN category AS category ON article.category_id = category.id 
            LEFT JOIN user AS user ON article.user_id = user.id 
            LEFT JOIN content AS content ON article.cover_id = content.id 
            LEFT JOIN content AS head_cover ON article.head_cover_id = head_cover.id 
            LEFT JOIN province AS province ON article.province_id = province.province_id 
            LEFT JOIN amphur AS amphur ON article.amphur_id = amphur.amphur_id 
            LEFT JOIN district AS district ON article.district_id = district.district_id 
            WHERE article.id = :article_id');

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
        $this->url              = $dataset['url'];
        $this->create_time      = $dataset['create_time'];
        $this->edit_time        = $dataset['edit_time'];
        $this->published_time   = $dataset['published_time'];
        $this->count_read       = $dataset['count_read'];
        $this->status           = $dataset['status'];
        $this->category_id      = $dataset['category_id'];
        $this->category_title   = $dataset['category_title'];
        $this->category_link    = $dataset['category_link'];
        $this->owner_id         = $dataset['owner_id'];
        $this->owner_displayname = $dataset['owner_displayname'];
        $this->owner_fname      = $dataset['owner_fname'];
        $this->owner_lname      = $dataset['owner_lname'];
        $this->total_contents   = $dataset['total_contents'];

        $this->province_id      = $dataset['province_id'];
        $this->amphur_id        = $dataset['amphur_id'];
        $this->district_id      = $dataset['district_id'];
        $this->province_name    = $dataset['province_name'];
        $this->amphur_name      = $dataset['amphur_name'];
        $this->district_name    = $dataset['district_name'];

        $this->create_time      = $this->db->datetimeformat($dataset['create_time'],$option = 'fulldate');
        $this->edit_time        = $this->db->datetimeformat($dataset['edit_time'],$option = 'fulldate');
        $this->published_time   = $this->db->datetimeformat($dataset['published_time'],$option = 'fulldate');

        $this->contents         = $dataset['contents'];
        $this->documents        = $dataset['documents'];
        $this->tags             = $this->listTags($this->id);

        $this->cover_id         = $dataset['cover_id'];
        $this->cover_img        = $dataset['cover_img'];
        $this->head_cover_id    = $dataset['head_cover_id'];
        $this->head_cover_img   = $dataset['head_cover_img'];

        $this->hasCover         = (!empty($this->cover_id) ? true:false);
        $this->hasURL           = (!empty($this->url) && isset($this->url) ? true:false);
        $this->hasInfo          = (!empty($this->description) ? true:false);
        $this->hasLocation      = (!empty($this->amphur_id) || !empty($this->district_id) ? true:false);
        $this->hasTags          = (count($this->tags) > 0 ? true:false);

        return $dataset;
    }

    public function listDocument($article_id){
        $this->db->query('SELECT * FROM document WHERE article_id = :article_id ORDER BY create_time DESC');
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['file_type']   = $this->docType($var['file_type']);
            $dataset[$k]['file_size']   = $this->db->formatBytes($var['file_size']);
        }
        return $dataset;
    }

    private function nl2br($var){
        $var = str_replace(array('\\r\\n','\r\\n','r\\n','\r\n', '\n', '\r'), '<br/>', nl2br($var));
        $var = str_replace('<br />','<br>',$var);
        // $var = htmlentities($var, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        // $var = htmlspecialchars($var);
        return $var;
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

    public function listAll($category_id,$keyword,$status,$owner_id,$limit,$sticky,$page,$perpage){    	
        if(empty($page) || $page < 0)
            $page = 1; // Default Page Number.
    	
        $start = ($perpage * $page) - $perpage;

    	$select = 'SELECT article.id,article.title,article.description,article.url,article.highlight,article.create_time,article.edit_time,article.published_time,article.count_read count_read,article.status,article.sticky,category.title category_title,category.id category_id,user.id owner_id,user.display author_name,article.cover_id,content.img_location cover_img,content.img_type cover_type 
        FROM article AS article 
        LEFT JOIN category AS category ON article.category_id = category.id 
        LEFT JOIN user AS user ON article.user_id = user.id 
        LEFT JOIN content AS content ON article.cover_id = content.id ';
    	$where = 'WHERE 1=1 ';

    	if(!empty($category_id)){
    		$where_category = 'AND article.category_id = :category_id ';
    	}

        // Article Status
    	if($status == 'published'){
    		$where_status = 'AND article.status = "published" ';
    	}else if($status == 'draft'){
            $where_status = 'AND article.status = "draft" ';
        }else if($status == 'author'){
            $where_status = 'AND (article.status = "published" OR article.status = "draft") ';
        }else if($status == 'sticky'){
            $where_status = 'AND article.status = "published" AND article.sticky = 1 ';
        }

        // With Owner
    	if(!empty($owner_id)){
    		$where_owner = 'AND article.user_id = :owner_id ';
    	}

        // Searching
        if(!empty($keyword)){
            $where_search = 'AND (article.title LIKE :keyword OR article.description LIKE :keyword) ';
        }

        if(!$sticky){
            $where_sticky = 'AND sticky = 0 ';
        }
    	
    	$order = 'ORDER BY article.id DESC ';

        if($limit > 0){
            $limit = 'LIMIT '.$limit;
        }else{
            $limit = 'LIMIT '.$start.','.$perpage;
        }

    	$query_string = $select.$where.$where_category.$where_status.$where_owner.$where_search.$where_sticky.$order.$limit;

    	// echo $query_string;

    	$this->db->query($query_string);

		if(!empty($category_id)) $this->db->bind(':category_id',$category_id);
    	if(!empty($owner_id)) $this->db->bind(':owner_id',$owner_id);
        if(!empty($keyword)) $this->db->bind(':keyword','%'.$keyword.'%');

		$this->db->execute();
		$dataset = $this->db->resultset();

		foreach ($dataset as $k => $var) {
			$dataset[$k]['create_time'] = $this->db->datetimeformat($var['create_time']);
			$dataset[$k]['edit_time'] 	= $this->db->datetimeformat($var['edit_time']);
			$dataset[$k]['published_time'] 	= $this->db->datetimeformat($var['published_time']);
		}

        // Get Total Articles
        $select = 'SELECT COUNT(article.id) total FROM article AS article ';
        $query_counter = $select.$where.$where_category.$where_status.$where_owner.$where_search;
        
        $this->db->query($query_counter);
        if(!empty($category_id)) $this->db->bind(':category_id',$category_id);
        if(!empty($owner_id)) $this->db->bind(':owner_id',$owner_id);
        if(!empty($keyword)) $this->db->bind(':keyword','%'.$keyword.'%');
        
        $this->db->execute();
        $counter = $this->db->single();

		return array(
            'total_items' => $counter['total'],
            'items' => $dataset,
        );
    }

    public function next($article_id,$category_id){
        // Next Content.
        $this->db->query('SELECT article.id,article.title,article.description,article.url,article.highlight,article.create_time,article.edit_time,article.published_time,article.count_read count_read,article.status,article.sticky,category.title category_title,category.id category_id,user.display author_name,user.id author_id,user.lname owner_lname,article.cover_id,content.img_location cover_img,content.img_type cover_type 
            FROM article AS article 
            LEFT JOIN category AS category ON article.category_id = category.id 
            LEFT JOIN user AS user ON article.user_id = user.id 
            LEFT JOIN content AS content ON article.cover_id = content.id 
            WHERE article.status = "published" AND article.category_id = :category_id AND article.id > :article_id 
            ORDER BY article.id ASC LIMIT 1');

        $this->db->bind(':category_id',$category_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['create_time'] = $this->db->datetimeformat($var['create_time']);
            $dataset[$k]['edit_time']   = $this->db->datetimeformat($var['edit_time']);
            $dataset[$k]['published_time']  = $this->db->datetimeformat($var['published_time']);
        }

        return $dataset;
    }

    public function prev($article_id,$category_id){
        // Prev Content.
        $this->db->query('SELECT article.id,article.title,article.description,article.url,article.highlight,article.create_time,article.edit_time,article.published_time,article.count_read count_read,article.status,article.sticky,category.title category_title,category.id category_id,user.display author_name,user.id author_id,user.lname owner_lname,article.cover_id,content.img_location cover_img,content.img_type cover_type 
            FROM article AS article 
            LEFT JOIN category AS category ON article.category_id = category.id 
            LEFT JOIN user AS user ON article.user_id = user.id 
            LEFT JOIN content AS content ON article.cover_id = content.id 
            WHERE article.status = "published" AND article.category_id = :category_id AND article.id < :article_id 
            ORDER BY article.id DESC LIMIT 1');

        $this->db->bind(':category_id',$category_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['create_time'] = $this->db->datetimeformat($var['create_time']);
            $dataset[$k]['edit_time']   = $this->db->datetimeformat($var['edit_time']);
            $dataset[$k]['published_time']  = $this->db->datetimeformat($var['published_time']);
        }

        return $dataset;
    }

    public function relatedSticky($article_id){
        // Sticky Content.
        $this->db->query('SELECT article.id,article.title,article.description,article.url,article.highlight,article.create_time,article.edit_time,article.published_time,article.count_read count_read,article.status,article.sticky,category.title category_title,category.id category_id,user.display author_name,user.id author_id,user.lname owner_lname,article.cover_id,content.img_location cover_img,content.img_type cover_type 
            FROM article AS article 
            LEFT JOIN category AS category ON article.category_id = category.id 
            LEFT JOIN user AS user ON article.user_id = user.id 
            LEFT JOIN content AS content ON article.cover_id = content.id 
            WHERE article.status = "published" AND article.sticky = 1 AND article.id NOT IN (:article_id) 
            ORDER BY article.id DESC LIMIT 1');

        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['create_time'] = $this->db->datetimeformat($var['create_time']);
            $dataset[$k]['edit_time']   = $this->db->datetimeformat($var['edit_time']);
            $dataset[$k]['published_time']  = $this->db->datetimeformat($var['published_time']);
        }

        return $dataset;
    }

    public function related($article_id){
        $response = [];
        
        // Get category_id
        $this->db->query('SELECT category_id FROM article WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $data = $this->db->single();
        $category_id = $data['category_id'];

        // Next Contents
        foreach ($this->next($article_id,$category_id) as $var)
            array_push($response,$var);

        // Prev Contents
        foreach ($this->prev($article_id,$category_id) as $var)
            array_push($response,$var);

        // Sticky Contents
        foreach ($this->relatedSticky($article_id) as $var)
            array_push($response,$var);

        return $response;
    }

    public function listSticky(){
        $this->db->query('SELECT article.id,article.title,article.description,article.url,article.highlight,article.create_time,article.edit_time,article.published_time,article.count_read count_read,article.status,article.sticky,category.title category_title,category.id category_id,user.display author_name,user.id author_id,user.lname owner_lname,article.cover_id,content.img_location cover_img,content.img_type cover_type 
            FROM article AS article 
            LEFT JOIN category AS category ON article.category_id = category.id 
            LEFT JOIN user AS user ON article.user_id = user.id 
            LEFT JOIN content AS content ON article.cover_id = content.id 
            WHERE article.status = "published" AND article.sticky = 1 
            ORDER BY article.published_time DESC,article.create_time DESC');

        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['create_time'] = $this->db->datetimeformat($var['create_time']);
            $dataset[$k]['edit_time']   = $this->db->datetimeformat($var['edit_time']);
            $dataset[$k]['published_time']  = $this->db->datetimeformat($var['published_time']);
        }

        return $dataset;
    }

    public function published($article_id){
        $this->db->query('SELECT status FROM article WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $data = $this->db->single();

        $status = ($data['status'] == 'published' ? 'draft' : 'published');

        // Enable sticky content with article id.
        $this->db->query('UPDATE article SET status = :status,published_time = :published_time WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':status',$status);
        $this->db->bind(':published_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    // Article Sticky Toggle.
    public function sticky($article_id){
        $this->db->query('SELECT sticky FROM article WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $data = $this->db->single();

        $sticky = ($data['sticky']==1 ? 0 : 1);

        // Enable sticky content with article id.
        $this->db->query('UPDATE article SET sticky = :sticky WHERE id = :article_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':sticky',$sticky);
        $this->db->execute();
    }

    public function listWithTag($tag_id){
        $this->db->query('SELECT article.id,article.title,article.description,article.url,article.highlight,article.create_time,article.edit_time,article.published_time,article.count_read count_read,article.status,category.title category_title,category.id category_id,user.id owner_id,user.fname owner_fname,user.lname owner_lname,article.cover_id,content.img_location cover_img,content.img_type cover_type FROM article_tags AS article_tags LEFT JOIN article AS article ON article_tags.article_id = article.id LEFT JOIN category AS category ON article.category_id = category.id LEFT JOIN user AS user ON article.user_id = user.id LEFT JOIN content AS content ON article.cover_id = content.id WHERE tag_id = :tag_id AND article.status = "published" ORDER BY article.published_time DESC,article.create_time DESC');
        
        $this->db->bind(':tag_id',$tag_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['create_time'] = $this->db->datetimeformat($var['create_time']);
            $dataset[$k]['edit_time']   = $this->db->datetimeformat($var['edit_time']);
            $dataset[$k]['published_time']  = $this->db->datetimeformat($var['published_time']);
        }
        return $dataset;
    }

    public function delete($article_id){
    	$this->db->query('DELETE FROM article WHERE id = :article_id');
		$this->db->bind(':article_id',$article_id);
		$this->db->execute();
    }

    // Count articles with Owner ID
    public function counter($owner_id){
        $this->db->query('SELECT status FROM article WHERE user_id = :owner_id');
        $this->db->bind(':owner_id',$owner_id);
        $this->db->execute();
        $dataset = $this->db->resultset();
        
        $dataset = array_map(function($var){
            return $var['status'];
        },$dataset);

        $dataset = array_count_values($dataset);
        
        return $dataset;
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
        $this->db->query('SELECT content.id,content.user_id owner_id,user.fname owner_fname,content.topic,content.body,content.img_location,content.alt,content.lat,content.lng,content.video_id,content.position,content.create_time,content.edit_time,content.type,content.status FROM content AS content LEFT JOIN user AS user ON content.user_id = user.id WHERE content.article_id = :article_id ORDER BY content.position ASC');
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            $dataset[$k]['id']          = floatval($var['id']);
            $dataset[$k]['bodytext']    = $this->nl2br($var['body']);
            $dataset[$k]['owner_id']    = floatval($var['owner_id']);
            $dataset[$k]['position']    = floatval($var['position']);
            $dataset[$k]['created']     = $this->db->datetimeformat($var['create_time'],'facebook');
            $dataset[$k]['edited']      = $this->db->datetimeformat($var['edit_time'],'facebook');
        }
        return $dataset;
    }

    public function paragraphs($text){
        $result = '';
        
        $newarr = explode("\n",$text);
        foreach($newarr as $str) {
            if(!empty(trim($str)))
                $result.= '<p>'.trim($str).'</p>';
        }
        return $result;
    }

    // Edit Content Topic
    public function editTopic($content_id,$article_id,$topic){
        $this->db->query('UPDATE content SET topic = :topic,edit_time = :edit_time WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':topic',$this->db->string_cleaner($topic));
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    // Edit Content Body
    public function editBody($content_id,$article_id,$body){
        $this->db->query('UPDATE content SET body = :body,edit_time = :edit_time WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':body',$this->db->string_cleaner($body,'body'));
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    // Edit Image location.
    public function editImageLocation($content_id,$article_id,$img_location,$img_type){
        $this->db->query('UPDATE content SET img_location = :img_location,img_type = :img_type,edit_time = :edit_time WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':img_location',$img_location);
        $this->db->bind(':img_type',$img_type);
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    // Edit Image Alt
    public function editAlt($content_id,$article_id,$alt){
        $this->db->query('UPDATE content SET alt = :alt,edit_time = :edit_time WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':alt',$this->db->string_cleaner($alt));
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    // Edit Google Map Location
    public function editMapLocation($content_id,$article_id,$lat,$lng){
        $this->db->query('UPDATE content SET lat = :lat,lng = :lng,edit_time = :edit_time WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':lat',$lat);
        $this->db->bind(':lng',$lng);
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
        $this->db->execute();
    }

    // Video ID
    public function editVideoID($content_id,$article_id,$video_id){
        $this->db->query('UPDATE content SET video_id = :video_id,edit_time = :edit_time WHERE (id = :content_id AND article_id = :article_id)');
        $this->db->bind(':content_id',$content_id);
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':video_id',$video_id);
        $this->db->bind(':edit_time',date('Y-m-d H:i:s'));
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
    * Tags
    */

    // Add article tag.
    public function addTag($article_id,$tag){

        // Tag name validate
        $tag = trim(preg_replace('#[^-ก-๙a-zA-Z0-9]#u','', $tag));

        if(strlen($tag) < 3) return false;

        $tag_id = $this->getTagID($tag);

        $this->db->query('SELECT id FROM article_tags WHERE article_id = :article_id AND tag_id = :tag_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':tag_id',$tag_id);
        $this->db->execute();
        $dataset = $this->db->single();

        if(empty($dataset['id'])){
            $this->db->query('INSERT INTO article_tags(article_id,tag_id,created) VALUE(:article_id,:tag_id,:created)');
            $this->db->bind(':article_id',$article_id);
            $this->db->bind(':tag_id',$tag_id);
            $this->db->bind(':created',date('Y-m-d H:i:s'));
            $this->db->execute();
            return $this->db->lastInsertId();
        }else{
            return $dataset['id'];
        }
    }

    private function getTagID($name){
        $this->db->query('SELECT id FROM tag WHERE name = :name');
        $this->db->bind(':name',$name);
        $this->db->execute();
        $dataset = $this->db->single();

        if(empty($dataset['id'])){
            $this->db->query('INSERT INTO tag(name,created) VALUE(:name,:created)');
            $this->db->bind(':name',$name);
            $this->db->bind(':created',date('Y-m-d H:i:s'));
            $this->db->execute();
            return $this->db->lastInsertId();
        }else{
            return $dataset['id'];
        }
    }

    public function removeTag($article_id,$tag_id){
        $this->db->query('DELETE FROM article_tags WHERE article_id = :article_id AND tag_id = :tag_id');
        $this->db->bind(':article_id',$article_id);
        $this->db->bind(':tag_id',$tag_id);
        $this->db->execute();
    }

    public function listTags($article_id){
        $this->db->query('SELECT article_tags.tag_id,tag.name FROM article_tags AS article_tags LEFT JOIN tag AS tag ON article_tags.tag_id = tag.id WHERE article_tags.article_id = :article_id ORDER BY article_tags.created ASC');
        $this->db->bind(':article_id',$article_id);
        $this->db->execute();
        $dataset = $this->db->resultset();

        foreach ($dataset as $k => $var) {
            // $dataset[$k]['file_type']   = $this->docType($var['file_type']);
            // $dataset[$k]['file_size']   = $this->db->formatBytes($var['file_size']);
        }
        return $dataset;
    }

    public function getTags($tag){
        $this->db->query('SELECT id,name FROM tag WHERE name = :tag');
        $this->db->bind(':tag',$tag);
        $this->db->execute();
        $dataset = $this->db->single();
        return $dataset;
    }
}
?>
