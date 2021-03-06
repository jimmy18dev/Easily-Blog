<?php
include_once'autoload.php';

if(!$user_online){
	header('Location: '.DOMAIN.'/signin');
    die();
}
if($user->type != 'admin' && $user->type != 'writer'){
    header('Location: '.DOMAIN.'/permission.php');
    die();
}

$category = new Category();
$categories = $category->listAll();
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

<?php include'favicon.php';?>

<title>เลือกประเภทบทความใหม่ | <?php echo $config['settings']['sitename_th'];?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/admin.style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>
<div class="header">
	<a class="btn-icon right" href="profile"><i class="fal fa-times"></i></a>
</div>

<!-- <div class="pagehead">
	<div class="content">
		<h2>เลือกประเภทบทความ</h2>
		<p>คลิกเลือกที่คุณต้องการ</p>
	</div>
</div> -->

<div class="pagehead">
	<div class="head fullsize">
		<h1>เลือกประเภทบทความ</h1>
		<p>หลังจากที่คุณสร้างบทความไปแล้ว จะไม่สามารถเปลี่ยนหมวดหมู่ได้อีก</p>
	</div>
</div>

<div class="lists">
	<?php foreach ($categories as $var) {?>
	<div class="list-items choose-category btn-1" data-id="<?php echo $var['id'];?>">
		<div class="icon">
			<?php echo(!empty($var['icon'])?'<i class="fal fa-'.$var['icon'].'"></i>':'<i class="fal fa-folder"></i>')?>
		</div>
		<div class="detail">
			<div class="title"><?php echo $var['title'];?></div>
			<?php if(!empty($var['description'])){?>
			<div class="desc"><?php echo $var['description'];?></div>
			<?php }?>
		</div>
		<div class="icon-select"><i class="fal fa-check"></i></div>
	</div>
	<?php } ?>
</div>

<div class="filter bottom">
    <button class="btn-create right" id="btnStartWrite">เขียนบทความ</button>
</div>

<div id="progressbar"></div>
<div id="overlay" class="overlay"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/progressbar.js"></script>
<script type="text/javascript" src="js/article.lib.js"></script>
<script type="text/javascript" src="js/article.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>