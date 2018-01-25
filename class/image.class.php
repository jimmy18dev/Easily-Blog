<?php
class Image{

    // private $db;

    // public function __construct() {
    //     global $wpdb;
    //     $this->db = $wpdb;
    // }
    
    public function changePosition($image_id,$post_id,$event){
        $current_data       = parent::getByID($image_id);
        $currentPostion     = $current_data['sort'];
        $currentID          = $current_data['id'];

        $target_data        = parent::getBySort($currentPostion,$post_id,$event);
        $targetPosition     = $target_data['sort'];
        $targetID           = $target_data['id'];

        $callback['state'] = false;

        // echo'current: '.$currentPostion.' target: '.$targetPosition.'<br>';

        if(empty($targetPosition)){
            return $callback;
        }else{
            // Update current id
            parent::updatePosition($currentID,$targetPosition);

            // Update target id
            parent::updatePosition($targetID,$currentPostion);

            $callback['state'] = true;
            $callback['target'] = $targetID;

            return $callback;
        }
     }

    public function PhotoFormat($width,$height){
        if($width > $height){
            return 'vertical';
        }
        else if($width < $height){
            return 'horizontal';
        }
        else if($width == $height){
            return 'square';
        }
        else{
            return 'n/a';
        }
    }

    //////////////////////////////////////
    // Lib Image function ////////////////
    //////////////////////////////////////
    public function resize($source, $destination,$image_type,$max_size, $image_width, $image_height, $quality){
        if($image_width <= 0 || $image_height <= 0){
            return false;
        } //return false if nothing to resize

        //do not resize if image is smaller than max size
        if($image_width <= $max_size && $image_height <= $max_size){
            if($this->save_image($source, $destination, $image_type, $quality)){
                return true;
            }
        }

        //Construct a proportional size of new image
        $image_scale    = min($max_size/$image_width, $max_size/$image_height);
        $new_width      = ceil($image_scale * $image_width);
        $new_height     = ceil($image_scale * $image_height);

        $new_canvas     = imagecreatetruecolor($new_width, $new_height); //Create a new true color image

        //Copy and resize part of an image with resampling
        if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
            $this->save_image($new_canvas, $destination, $image_type, $quality); //save resized image
        }

        return true;
    }

    public function square($source, $destination, $image_type, $square_size, $image_width, $image_height, $quality){
        if($image_width <= 0 || $image_height <= 0){
            return false;
        }

        if( $image_width > $image_height){
            $y_offset = 0;
            $x_offset = ($image_width - $image_height) / 2;
            $s_size     = $image_width - ($x_offset * 2);
        }
        else{
            $x_offset = 0;
            $y_offset = ($image_height - $image_width) / 2;
            $s_size = $image_height - ($y_offset * 2);
        }

        $new_canvas = imagecreatetruecolor( $square_size, $square_size);

        if(imagecopyresampled($new_canvas,$source,0,0,$x_offset,$y_offset,$square_size,$square_size,$s_size,$s_size)){
            $this->save_image($new_canvas,$destination,$image_type,$quality);
        }

        return true;
    }

    public function rotate($filename){

        if(!empty($filename)){
            $image_size_info  = getimagesize($filename);

            if($image_size_info){
                $im_type = $image_size_info['mime'];

                switch($im_type){
                    case 'image/png': $image_res = imagecreatefrompng($filename); break;
                    case 'image/gif': $image_res = imagecreatefromgif($filename); break;
                    case 'image/jpeg': case 'image/pjpeg': $image_res = imagecreatefromjpeg($filename); break;
                    default: $image_res = false;
                }

                $rotate = imagerotate($image_res,-90,0);
                $this->save_image($rotate,$filename,$im_type,100);

                imagedestroy($image_res);
                imagedestroy($rotate);

                return true;
            }
        }else{
            return false;
        }
    }
    private function save_image($source,$destination,$image_type,$quality){
        switch(strtolower($image_type)){
            case 'image/png':
                imagepng($source,$destination); return true;
                break;
            case 'image/gif':
                imagegif($source,$destination); return true;
                break;
            case 'image/jpeg': case 'image/pjpeg':
                imagejpeg($source,$destination,$quality); return true;
                break;
            default: return false;
        }
    }
}
?>
