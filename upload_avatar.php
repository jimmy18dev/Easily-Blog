<?php
require_once'autoload.php';
header("Content-type: text/json");

$image = new Image();

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

                $new_file_name          = 'avatar_'.substr(md5(time().rand(0,2147483647)),6,6).'.'.$image_extension;

                // Folder Creating
                $img_folder = 'image/upload/avatar/';

                if (!is_dir($img_folder)) {

                    // Craete Avatar Folder.
                    mkdir($img_folder, 0777, true);
                }
                $save_as['square'] = $img_folder.$new_file_name;

                $image->square($image_res,$save_as['square'],$im_type,$size['square'],$im_width,$im_height,$quality['square']);

                // Delte Old Image.
                if(!empty($user->avatar) && file_exists($img_folder.$user->avatar)){
                    unlink($img_folder.$user->avatar);
                }
                // Update Avatar
                $user->updateAvatar($user->id,$new_file_name);

                imagedestroy($image_res);
            }
        }
    }
}

$data = array(
    "apiVersion"    => 1.0,
    "message"       => 'Avatar Upload!',
    "image_file"    => $new_file_name,
    "execute"       => floatval(round(microtime(true)-StTime,4)),
);

echo json_encode($data);
?>