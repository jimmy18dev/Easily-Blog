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
</div>

<div class="pagehead">
	<div class="content">
		<h2>แก้ไขโปรไฟล์</h2>
	</div>
</div>

<div class="seo">
	<div class="section">
		<h2>ชื่อที่ใช้แสดง</h2>
		<form class="locationInputWrapper" id="tagForm">
			<i class="fal fa-user" aria-hidden="true"></i>
			<input type="text" id="tag-input" placeholder="ชื่อ-นามสกุล">
		</form>
	</div>

	<div class="section">
		<h2>เกี่ยวกับ</h2>
		<textarea id="bio" placeholder="ไม่เกิน 140 ตัวอักษร"><?php echo $user->bio;?></textarea>
	</div>
</div>

<div id="progressbar"></div>
<div id="overlay" class="overlay"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/tippy.all.min.js"></script>
<script type="text/javascript" src="js/lib/progressbar.js"></script>
<script type="text/javascript" src="js/article.lib.js"></script>
<script type="text/javascript" src="js/editor.option.js"></script>
<script type="text/javascript" src="js/location.js"></script>
</body>
</html>