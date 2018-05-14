<?php
include_once'autoload.php';

if(!$user_online){
    header('Location: signin');
    die();
}
if($user->type != 'admin' && $user->type != 'writer'){
    header('Location: permission.php');
    die();
}

$current_page = 'edit';
?>

<!doctype html>
<html lang="en-US" itemscope itemtype="http://schema.org/Blog" prefix="og: http://ogp.me/ns#">
<head>

<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

<!-- Meta Tag -->
<meta charset="utf-8">

<!-- Viewport (Responsive) -->
<meta name="viewport" content="width=device-width">
<meta name="viewport" content="user-scalable=no">
<meta name="viewport" content="initial-scale=1,maximum-scale=1">

<title>นักเขียน | <?php echo $config['settings']['sitename_th'];?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/admin.style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>
<?php include_once 'template/admin.navigation.php'; ?>

<div class="pagehead">
    <div class="head">
        <h1>โปรไฟล์ผู้เขียน</h1>
        <p>คำแนะนำ: การใส่ชื่อผู้เขียนลงในบทความ จะช่วยให้เว็บไซต์มีความน่าเชื่อถือมากยิ่งขึ้น</p>
    </div>
</div>

<div class="page-form">
    <div class="section">
        <h2>ข้อมูลจะแสดงบนเว็บไซต์</h2>

        <p>ภาพโปรไฟล์</p>
        <div class="avatar">
            <div class="pic">
                <img src="image/upload/avatar/<?php echo $user->avatar;?>" alt="">
            </div>

            <div class="action">
                <form action="upload_avatar.php" id="avatarForm" method="POST" enctype="multipart/form-data">
                    <input type="file" name="image" id="avatarFile">
                </form>

                <div class="btn-action" id="btnChooseAvatar"><i class="fa fa-camera"></i>เลือกภาพใหม่</div>
                <div class="btn-action facebook-import" id="btnFacebookImport"><i class="fab fa-facebook"></i>ใช้ภาพจาก Facebook</div>
            </div>
        </div>

        <p>ชื่อ-นามสกุล (แสดงอยู่ในส่วนของผู้เขียน)</p>
        <input type="text" id="display" autocomplete="off" placeholder="ชื่อ-นามสกุล" value="<?php echo $user->display;?>">
        <textarea id="bio" autocomplete="off" placeholder="คำอธิยาบเกี่ยวกับคุณ"><?php echo $user->bio;?></textarea>
        <div class="note">ไม่เกิน 140 ตัวอักษร</div>
    </div>
    <div class="section">
        <button id="btnSaveProfile">บันทึกการเปลี่ยนแปลง</button>
    </div>
</div>

<div id="progressbar"></div>
<div id="overlay" class="overlay"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/tippy.all.min.js"></script>
<script type="text/javascript" src="js/lib/progressbar.js"></script>
<script type="text/javascript">
$(function(){
	$btnSaveProfile = $('#btnSaveProfile');
	var progressbar = $('#progressbar');

    $btnSaveProfile.click(function(){
    	progressbar.Progressbar('70%');
        var display = $('#display').val();
        var bio = $('#bio').val();

        $btnSaveProfile.removeClass('active');

        $.ajax({
            url         :'api/user',
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_info',
                display  	:display,
                bio 		:bio
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
            $btnSaveProfile.removeClass('active');
        });
    });

    $('input,textarea').on('input',function(event) {
    	$btnSaveProfile.addClass('active');
    });

    // Choose cover image.
    $('#btnChooseAvatar').click(function(){
        $('#avatarFile').focus().click();
    });
    $('#avatarFile').change(function(){
        $('#avatarForm').submit()
    });
    $('#avatarForm').ajaxForm({
        beforeSubmit: function(formData, jqForm, options){
            // $('#btnChooseCover').html('กำลังอัพโหลด...')
        },
        uploadProgress: function(event,position,total,percentComplete) {
            var percent = percentComplete;
            percent = (percent * 80) / 100;
            
            console.log('Upload: '+percentComplete+' %')
            progressbar.Progressbar(percentComplete+'%')
        },
        success: function() {
            // $photoLoadingBar.animate({width:'100%'},300);
        },
        complete: function(xhr) {
            progressbar.Progressbar('100%')
            console.log(xhr.responseJSON)
            location.reload();
        }
    });

    $('#btnFacebookImport').click(function(){
        progressbar.Progressbar('70%');

        $.ajax({
            url         :'api/user',
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request :'import_facebook_avatar'
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            console.log(data);
            progressbar.Progressbar('100%');
            location.reload();
        });
    });
});
</script>
</body>
</html>