<?php
require_once'autoload.php';
header("Content-type: application/json");

$document       = new Document;

$article_id     = $_POST['article_id'];

if(isset($_FILES['file'])){
    $errors     = array();
    $file_name  = $_FILES['file']['name'];
    $file_size  = $_FILES['file']['size'];
    $file_tmp   = $_FILES['file']['tmp_name'];
    $file_type  = $_FILES['file']['type'];
    $file_ext   = pathinfo($file_name);
    $expensions = array('pdf','xls','xlsx','doc','docx','txt','ppt','pptx','zip');

    if(in_array($file_ext['extension'],$expensions) === false){
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > $document->return_bytes(ini_get('post_max_size')) || $file_siz > $document->return_bytes(ini_get('upload_max_filesize'))){
        $errors[] = 'File size must be excately '.ini_get('post_max_size').' MB';
    }

    if(empty($errors) == true){
        $filename   = $document->string_cleaner($file_ext['filename']);

        $new_filename   = $filename.'-'.substr(md5(time().rand(0,2147483647)),6,6);
        $full_filename  = $new_filename.'.'.$file_ext['extension'];
        move_uploaded_file($file_tmp,'files/'.$full_filename);

        // File Extension Validate
        if($file_ext['extension'] == 'pdf')
            $file_extension = 'pdf';
        else if($file_ext['extension'] == 'xls' || $file_ext['extension'] == 'xlsx')
            $file_extension = 'excel';
        else if($file_ext['extension'] == 'doc' || $file_ext['extension'] == 'docx')
            $file_extension = 'excel';
        else if($file_ext['extension'] == 'ppt' || $file_ext['extension'] == 'pptx')
            $file_extension = 'excel';
        else if($file_ext['extension'] == 'zip')
            $file_extension = 'archive';
        else
            $file_extension = 'alt';

        $file_id = $document->create(1,$article_id,$filename,$description,$full_filename,$file_extension,$file_size);
    }else{
        // print_r($errors);
        $file_id = -1;
    }
}

$data = array(
    "apiVersion"    => 1.0,
    "message"       => 'File upload Successed!',
    "file_id"       => floatval($file_id),
    "filename"      => $new_filename,
    "fileinfo"      => $pathinfo,
    "execute"       => floatval(round(microtime(true)-StTime,4))
);

echo json_encode($data);
?>