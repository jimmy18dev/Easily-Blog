<?php
include_once'autoload.php';
$article 	= new Article();
$article_id = $_GET['article_id'];
$article->get($article_id);
$article_url = DOMAIN.'/article/'.$article->id.'/';
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

<title>แก้ไขโปรไฟล์</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/admin.style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>

<div class="header">
	<a class="btn" href="profile"><i class="fal fa-arrow-left"></i></a>
	<div class="center">แกไขโปรไฟล์</div>
</div>

<div class="page-form">
	<div class="items">
		<div class="caption">ชื่อที่ใช้แสดง</div>
		<div class="content">
			<input type="text" id="display" placeholder="ชื่อ-นามสกุล" value="<?php echo $user->display;?>">
		</div>
	</div>

	<div class="items">
		<div class="caption">เกี่ยวกับ</div>
		<div class="content">
			<textarea id="bio" placeholder="ไม่เกิน 140 ตัวอักษร"><?php echo $user->bio;?></textarea>
		</div>
	</div>

	<div class="items">
		<button id="btnSaveProfile">บันทึก</button>
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
    })
});
</script>
</body>
</html>