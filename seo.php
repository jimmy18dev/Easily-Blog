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

<title><?php echo $article->title;?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>

<div class="header fixed">
	<a href="article/<?php echo $article->id;?>/editor" class="btn left">
		<i class="fa fa-arrow-left" aria-hidden="true"></i>
		<span>แก้ไขบทความ</span>
	</a>

	<div class="btn-profile" id="btnProfile">
		<img src="https://graph.facebook.com/1818320188/picture?type=square" alt="">

		<div class="toggle-panel" id="profilePanel">
			<div class="popover-arrow"></div>
			<ul>
				<li><a href="profile">บทความของฉัน</a></li>
				<li class="separator"></li>
				<li><a href="#">ตั้งค่า</a></li>
				<li><a href="#">วิธีใช้</a></li>
				<li><a href="#" class="logout">ออกจากระบบ</a></li>
			</ul>
		</div>
	</div>

	<div class="btn" id="btn-publish">
		<span>เผยแพร่</span>
		<i class="fa fa-angle-right" aria-hidden="true"></i>
	</div>
</div>

<div class="seo">
	<div class="section">
		<h2>1. ภาพหน้าปก (Cover)</h2>
		<div class="list">
			<?php foreach ($article->contents as $var) {?>
			<?php if($var['type'] == 'image'){?>
			<div class="cover-items <?php echo ($var['id'] == $article->cover_id?'active':'');?>" data-cover="<?php echo $var['id'];?>">
				<img src="image/upload/square/<?php echo $var['img_location'];?>">
			</div>
			<?php }?>
			<?php }?>
		</div>
	</div>

	<div class="section">
		<h2>2. ลิ้งค์ที่อยู่บทความ (URL Friendly)</h2>
		<div class="inputWrapper">
			<span class="domain"><?php echo $article_url;?></span>
			<input class="url-input" type="text" id="articleURL" value="<?php echo $article->url;?>" placeholder="ตั้งชื่อลิงค์ที่นี่...">
		</div>
	</div>

	<div class="section">
		<h2>3. ที่อยู่</h2>
		<div class="location">
			<h3>อำเภอ:</h3>
			<div class="address-list" id="amphur-list"></div>
		</div>
		<div class="location">
			<h3>ตำบล:</h3>
			<div class="address-list" id="district-list"></div>
		</div>

		<div class="btn" id="btnClearLocation">ลบที่อยู่ออก</div>
	</div>

	<div class="section">
		<h2>4. คำที่เกี่ยวข้อง</h2>
		<div class="tag">
			<?php foreach ($article->tags as $var) {?>
			<div class="tag-items" data-id="<?php echo $var['tag_id'];?>" data-name="<?php echo $var['name'];?>">
				<span><?php echo $var['name'];?></span>
				<span class="btn-remove-tag"><i class="fa fa-close" aria-hidden="true"></i></span>
			</div>
			<?php }?>
		</div>
		<form id="tagForm">
			<input type="text" id="tag-input" class="input-tag" placeholder="Enter tag...">
		</form>
	</div>
</div>

<input type="hidden" id="article_id" value="<?php echo $article->id;?>">
<input type="text" id="province_id" value="<?php echo $article->province_id;?>">
<input type="text" id="amphur_id" value="<?php echo $article->amphur_id;?>">
<input type="text" id="district_id" value="<?php echo $article->district_id;?>">

<div id="progressbar"></div>
<div id="overlay" class="overlay"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/location.js"></script>
<script type="text/javascript" src="js/seo.js"></script>
</body>
</html>