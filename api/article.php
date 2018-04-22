<?php
require_once '../autoload.php';
header("Content-type: application/json");

$returnObject = array(
	"apiVersion"  	=> 1.0,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
	"updated"  		=> time()
);

$signature 	= new Signature();
$article 	= new Article();
$image      = new Image();

switch ($_SERVER['REQUEST_METHOD']){
	case 'GET':
		switch ($_GET['request']){
			case 'get':
				$article_id = $_GET['article_id'];
				$dataset 	= $article->get($article_id);
				$returnObject['dataset'] = $dataset;
				$returnObject['message'] = 'Get an Article and Contents';
				break;
			default:
				$returnObject['message'] = 'GET API Not found!';
			break;
		}
    	break;
    case 'POST':
    	switch ($_POST['request']){

    		// Article Actions
    		case 'create':
    			$category_id 	= $_POST['category_id'];
    			$article_id = $article->create($user->id,$category_id);

                // $article->createContent($user->id,$article_id,'image',NULL);
                $article->createContent($user->id,$article_id,'textbox',NULL);

    			$returnObject['article_id'] = floatval($article_id);
    			$returnObject['message'] 	= 'New Article created';
    			break;
    		case 'edit_title':
    			$article_id = $_POST['article_id'];
    			$title 		= $_POST['title'];
    			$article_id = $article->editTitle($article_id,$title);

    			$returnObject['message'] = 'Title edited';
    			break;
            case 'edit_address':
                $article_id     = $_POST['article_id'];
                $province_id    = $_POST['province_id'];
                $amphur_id      = $_POST['amphur_id'];
                $district_id    = $_POST['district_id'];
                
                $article_id = $article->editAddress($article_id,$province_id,$amphur_id,$district_id);

                $returnObject['message'] = 'Address edited';
                break;
    		case 'edit_description':
    			$article_id = $_POST['article_id'];
    			$description = $_POST['description'];
    			$article_id = $article->editDescription($article_id,$description);
    			
    			$returnObject['message'] = 'Description edited';
    			break;
            case 'edit_url':
                $article_id = $_POST['article_id'];
                $url = (!empty($_POST['url'])?$_POST['url']:NULL);
                $article_id = $article->editURL($article_id,$url);
                
                $returnObject['message'] = 'URL edited';
                break;
            case 'set_cover':
                $article_id = $_POST['article_id'];
                $cover_id   = $_POST['cover_id'];
                $article_id = $article->setCover($article_id,$cover_id);
                
                $returnObject['message'] = 'Article Cover updated';
                break;
            case 'remove_head_cover':
                $article_id = $_POST['article_id'];
                $article->removeHeadCover($article_id);
                $returnObject['message'] = 'Article Head Cover Removed';
                break;
            case 'change_status':
                $article_id = $_POST['article_id'];
                $status     = $_POST['status'];
                $article_id = $article->changeStatus($article_id,$status);
                
                $returnObject['message'] = 'Status changed';
                break;
            case 'sticky':
                $article_id = $_POST['article_id'];
                $article_id = $article->sticky($article_id);
                
                $returnObject['message'] = 'Article sticky success.';
                break;

    		// Content Actions
    		case 'create_content':
    			$article_id 	= $_POST['article_id'];
    			$type 			= $_POST['type'];
                $content_id     = $_POST['content_id']; // Create Content Between!
    			$content_id 	= $article->createContent($user->id,$article_id,$type,$content_id);

    			$returnObject['content_id'] = floatval($content_id);
    			$returnObject['message'] 	= 'New Content created';
    			break;
            case 'edit_topic':
                $article_id     = $_POST['article_id'];
                $content_id     = $_POST['content_id'];
                $topic          = $_POST['topic'];
                $content_id     = $article->editTopic($content_id,$article_id,$topic);
                $returnObject['message'] = 'Topic edited';
                break;
            case 'edit_body':
                $article_id     = $_POST['article_id'];
                $content_id     = $_POST['content_id'];
                $body           = $_POST['body'];
                $content_id     = $article->editBody($content_id,$article_id,$body);
                $returnObject['message'] = 'Body edited';
                break;
            case 'edit_img_alt':
                $article_id     = $_POST['article_id'];
                $content_id     = $_POST['content_id'];
                $img_alt        = $_POST['img_alt'];
                $content_id     = $article->editAlt($content_id,$article_id,$img_alt);
                $returnObject['message'] = 'Image Alt edited';
                break;
            case 'edit_video_id':
                $article_id     = $_POST['article_id'];
                $content_id     = $_POST['content_id'];
                $video_id       = $_POST['video_id'];
                $content_id     = $article->editVideoID($content_id,$article_id,$video_id);
                $returnObject['message'] = 'Video ID edited';
                break;
            case 'edit_map_location':
                $article_id     = $_POST['article_id'];
                $content_id     = $_POST['content_id'];
                $lat            = $_POST['lat'];
                $lng            = $_POST['lng'];

                $article->editMapLocation($content_id,$article_id,$lat,$lng);
                $returnObject['message'] = 'Map location edited '.$content_id.' ('.$lat.','.$lng.')';
                break;
            case 'swap_content':
                $current_id     = $_POST['current_id'];
                $target_id      = $_POST['target_id'];
                
                $article->swap($current_id,$target_id);
                $returnObject['message'] = 'Content Swap';
                break;
            case 'rotate_image':
                $content_id     = $_POST['content_id'];
                $content_data   = $article->getContent($content_id);
                $filename       = $content_data['img_location'];

                if(!empty($filename)){
                    $image->rotate('../'.$destination_folder['thumbnail'].$filename);
                    $image->rotate('../'.$destination_folder['square'].$filename);
                    $image->rotate('../'.$destination_folder['normal'].$filename);
                    $image->rotate('../'.$destination_folder['large'].$filename);

                    $returnObject['message'] = 'Image Rotete Done';
                }else{
                    $returnObject['message'] = 'Image not found!';
                }
                break;
            case 'delete_content':
                $article_id     = $_POST['article_id'];
                $content_id     = $_POST['content_id'];
                $content_data   = $article->getContent($content_id);

                // Delete content image file
                if($content_data['type'] == 'image' && !empty($content_data['img_location'])){
                    unlink('../'.$destination_folder['thumbnail'].$content_data['img_location']);
                    unlink('../'.$destination_folder['square'].$content_data['img_location']);
                    unlink('../'.$destination_folder['normal'].$content_data['img_location']);
                    unlink('../'.$destination_folder['large'].$content_data['img_location']);
                }

                $article->deleteContent($content_id,$article_id);
                $returnObject['message'] = 'Content deleted';
                break;

            // Tag
            case 'add_tag':
                $article_id     = $_POST['article_id'];
                $tags            = array_filter(explode(' ',$_POST['tag']));

                foreach ($tags as $tag){
                    $article->addTag($article_id,$tag);
                }

                $returnObject['message'] = 'New tag created #';
                $returnObject['data'] = $tags;
                break;
            case 'remove_tag':
                $article_id     = $_POST['article_id'];
                $tag_id         = $_POST['tag_id'];

                $article->removeTag($article_id,$tag_id);

                $returnObject['message'] = 'Tag removed';
                break;
			default:
				$returnObject['message'] = 'POST API Not found!';
			break;
		}
    	break;
    default:
    	$returnObject['message'] = 'METHOD API Not found!!! - '.$_SERVER['REQUEST_METHOD'];
    	break;
}

echo json_encode($returnObject);
exit();
?>