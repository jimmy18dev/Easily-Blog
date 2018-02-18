<?php
require_once'autoload.php';
header("Content-type: text/json");

$image      = new Image();
$article    = new Article();

$content_id = $_POST['content_id'];
$article_id = $_POST['article_id'];
$type       = $_POST['type'];

if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    if(isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])){
        $image_name       = $_FILES['image']['name'];
        $image_size       = $_FILES['image']['size'];
        $image_temp       = $_FILES['image']['tmp_name'];
        $image_size_info  = getimagesize($image_temp);

        if($image_size_info){
            $im_width       = $image_size_info[0]; //image width
            $im_height      = $image_size_info[1]; //image height
            $im_type        = $image_size_info['mime']; //image type
            $img_type       = $image->PhotoFormat($im_width,$im_height);

            switch($im_type){
                case 'image/png':
                    $image_res = imagecreatefrompng($image_temp); break;
                case 'image/gif':
                    $image_res = imagecreatefromgif($image_temp); break;
                case 'image/jpeg': case 'image/pjpeg':
                    $image_res = imagecreatefromjpeg($image_temp); break;
                default:
                    $image_res = false;
            }

            if($image_res){
                $image_info             = pathinfo($image_name);
                $image_extension        = strtolower($image_info["extension"]);
                $new_file_name          = 'content_'.md5(time().rand(0,9999999999)).'.'.$image_extension;

                $save_as['thumbnail']   = $destination_folder['thumbnail'].$new_file_name;
                $save_as['square']      = $destination_folder['square'].$new_file_name;
                $save_as['normal']      = $destination_folder['normal'].$new_file_name;
                $save_as['large']       = $destination_folder['large'].$new_file_name;

                $image->resize($image_res,$save_as['normal'],$im_type,$size['normal'],$im_width,$im_height,$quality['normal']);
                $image->resize($image_res,$save_as['large'],$im_type,$size['large'],$im_width,$im_height,$quality['large']);
                $image->square($image_res,$save_as['square'],$im_type,$size['square'],$im_width,$im_height,$quality['square']);
                $image->square($image_res,$save_as['thumbnail'],$im_type,$size['thumbnail'],$im_width,$im_height,$quality['thumbnail']);

                // Content type "Cover" only!
                if(empty($content_id) && ($type == 'cover' || $type == 'head_cover')){
                    
                    // Create new Content ID
                    $content_id = $article->createContent($user->id,$article_id,$type,NULL);

                    if($type == 'cover')
                        $article->setCover($article_id,$content_id); // Set this content to Cover photo
                    else if($type == 'head_cover')
                        $article->setHeadCover($article_id,$content_id);
                }

                // DELETE OLD IMAGE
                $content_data = $article->getContent($content_id);
                if(!empty($content_data['img_location'])){
                    unlink($destination_folder['thumbnail'].$content_data['img_location']);
                    unlink($destination_folder['square'].$content_data['img_location']);
                    unlink($destination_folder['normal'].$content_data['img_location']);
                    unlink($destination_folder['large'].$content_data['img_location']);
                }

                // $content->editImageBox($content_id,$article_id,$new_file_name);
                $article->editImageLocation($content_id,$article_id,$new_file_name,$img_type);

                // This article has cover ?
                $hasArticle = $article->hasCover($article_id);

                if(!$hasArticle){
                    // Set first image to Cover of article.
                    $article->setCover($article_id,$content_id);
                }

                imagedestroy($image_res);
            }
        }
    }
}

$data = array(
    "apiVersion"    => 1.0,
    "message"       => 'Image Upload!',
    "content_id"    => $content_id,
    "image_file"    => $new_file_name,
    "alt"           => $alt,
    "old_file"      => $content->image_file,
    "execute"       => floatval(round(microtime(true)-StTime,4)),
);

echo json_encode($data);
?>