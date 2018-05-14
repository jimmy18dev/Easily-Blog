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
});
</script>
</body>
</html>