<?php
require_once '../autoload.php';
require_once '../plugin/phpqrcode/qrlib.php';
header("Content-type: application/json");

$returnObject = array(
	"apiVersion"  	=> 1.0,
	"execute"     	=> floatval(round(microtime(true)-StTime,4)),
	"updated"  		=> time()
);

$signature 	= new Signature();
$article 	= new Article();
$image      = new Image();
$document   = new Document();

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

                $qr_content     = DOMAIN.'/article/'.$article_id;
                $qr_filename    = '../image/qrcode/article_'.$article_id.'.png';

                QRcode::png($qr_content,$qr_filename);

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
            case 'delete':
                $article_id = $_POST['article_id'];

                $article->get($article_id);

                // Delete all Document files
                foreach ($article->documents as $var){
                    $file_location = '../files/'.$var['file_name'];
                    if(file_exists($file_location))
                        unlink($file_location);
                }
                $document->deleteAll($article->id);

                // Delele ORCode
                $qrcode_location = '../image/qrcode/article_'.$article->id.'.png';
                if(file_exists($qrcode_location))
                    unlink($qrcode_location);

                // Delete all Image files and Folder.
                $article->deleteDir('../image/upload/'.$_POST['article_id']);

                // Delete all Contents.
                $article->deleteAllContent($article->id);

                // Delete Article Record
                $article_id = $article->delete($article->id);
                
                $returnObject['message'] = 'Article Deleted';
                break;
            case 'published':
                $article_id = $_POST['article_id'];
                $article_id = $article->published($article_id);
                
                $returnObject['message'] = 'Article published';
                break;
            case 'sticky':
                $article_id = $_POST['article_id'];
                $article_id = $article->sticky($article_id);
                
                $returnObject['message'] = 'Article sticky success.';
                break;
            case 'toggle_facebook_comment':
                $article_id = $_POST['article_id'];
                $article_id = $article->toggleFacebookComment($article_id);
                $returnObject['message'] = 'Article Toggle Facebook Comment';
                break;
            case 'toggle_related_content':
                $article_id = $_POST['article_id'];
                $article_id = $article->toggleRelatedContent($article_id);
                $returnObject['message'] = 'Article Toggle Related Content';
                break;
            case 'toggle_qrcode':
                $article_id = $_POST['article_id'];
                $article_id = $article->toggleQRCode($article_id);
                $returnObject['message'] = 'Article Toggle QR Code';
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
                $article_id     = $content_data['article_id'];

                if(!empty($filename)){
                    $image->rotate('../image/upload/'.$article_id.'/thumbnail/'.$filename);
                    $image->rotate('../image/upload/'.$article_id.'/square/'.$filename);
                    $image->rotate('../image/upload/'.$article_id.'/normal/'.$filename);
                    $image->rotate('../image/upload/'.$article_id.'/large/'.$filename);

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

                    $img_location['thumbnail']  = '../image/upload/'.$article_id.'/thumbnail/'.$content_data['img_location'];
                    $img_location['square']     = '../image/upload/'.$article_id.'/square/'.$content_data['img_location'];
                    $img_location['normal']     = '../image/upload/'.$article_id.'/normal/'.$content_data['img_location'];
                    $img_location['large']      = '../image/upload/'.$article_id.'/large/'.$content_data['img_location'];

                    if(file_exists($img_location['thumbnail']))
                        unlink($img_location['thumbnail']);
                    if(file_exists($img_location['square']))
                        unlink($img_location['square']);
                    if(file_exists($img_location['normal']))
                        unlink($img_location['normal']);
                    if(file_exists($img_location['large']))
                        unlink($img_location['large']);
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