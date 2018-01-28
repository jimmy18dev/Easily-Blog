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
    			$user_id 		= 1;

    			$article_id = $article->create($user_id,$category_id);

                $article->createContent($user_id,$article_id,'image',NULL);
                $article->createContent($user_id,$article_id,'textbox',NULL);

    			$returnObject['article_id'] = floatval($article_id);
    			$returnObject['message'] 	= 'New Article created';
    			break;
    		case 'edit_title':
    			$article_id = $_POST['article_id'];
    			$title 		= $_POST['title'];
    			$article_id = $article->editTitle($article_id,$title);

    			$returnObject['message'] = 'Title edited';
    			break;
    		case 'edit_description':
    			$article_id = $_POST['article_id'];
    			$description = $_POST['description'];
    			$article_id = $article->editDescription($article_id,$description);
    			
    			$returnObject['message'] = 'Description edited';
    			break;
            case 'change_status':
                $article_id = $_POST['article_id'];
                $status     = $_POST['status'];
                $article_id = $article->changeStatus($article_id,$status);
                
                $returnObject['message'] = 'Status changed';
                break;

    		// Content Actions
    		case 'create_content':
    			$article_id 	= $_POST['article_id'];
    			$type 			= $_POST['type'];
                $content_id     = $_POST['content_id']; // Create Content Between!
    			$user_id 		= 1;
    			$content_id 	= $article->createContent($user_id,$article_id,$type,$content_id);

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
                $content_id     = $article->editImageAlt($content_id,$article_id,$img_alt);
                $returnObject['message'] = 'Image Alt edited';
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
			default:
				$returnObject['message'] = 'POST API Not found!';
			break;
		}
    	break;
    default:
    	$returnObject['message'] = 'METHOD API Not found!';
    	break;
}

echo json_encode($returnObject);
exit();
?>