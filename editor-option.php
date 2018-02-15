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

<div class="header">
	<a href="article/<?php echo $article->id;?>/editor" class="btn">
		<i class="fa fa-angle-right" aria-hidden="true"></i>
		<span>บันทึก</span>
	</a>
</div>

<div class="seo">
	<div class="section" id="cover">
		<h2>ภาพหน้าปก (Cover)</h2>
		<div class="list">
			<?php foreach ($article->contents as $var) {?>
			<?php if(($var['type'] == 'image' || $var['type'] == 'cover') && !empty($var['img_location'])){?>
			<div class=" items cover-items <?php echo ($var['id'] == $article->cover_id?'active':'');?>" data-cover="<?php echo $var['id'];?>">
				<img src="image/upload/square/<?php echo $var['img_location'];?>">
			</div>
			<?php }?>
			<?php }?>
			<div class="items btn-add-cover">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</div>

			<form action="upload_image.php" id="coverForm" method="POST" enctype="multipart/form-data">
				<input type="file" name="image" id="coverImageFiles">
				<input type="hidden" name="article_id" value="<?php echo $article->id;?>">
				<input type="hidden" name="type" value="cover">
			</form>
		</div>
	</div>

	<div class="section" id="info">
		<h2>รายละเอียดอย่างย่อ</h2>
		<textarea id="description" placeholder="รายละเอียดอย่างย่อไม่เกิน 140 ตัวอักษร"><?php echo $article->description;?></textarea>
	</div>

	<div class="section" id="url">
		<h2>ลิ้งค์ที่อยู่บทความ (URL Friendly)</h2>
		<div class="inputWrapper">
			<i class="fa fa-link" aria-hidden="true"></i>
			<span class="domain"><?php echo $article_url;?></span>
			<input class="url-input" type="text" id="articleURL" value="<?php echo $article->url;?>" placeholder="ตั้งชื่อลิงค์ที่นี่...">
		</div>
	</div>

	<div class="section" id="location">
		<h2>ที่อยู่</h2>

		<?php if(!empty($article->district_id) || !empty($article->amphur_id) || !empty($article->province_id)){?>
		<div class="location-current">
			<div class="location-items">
				<i class="fa fa-map-marker" aria-hidden="true"></i>
				<span>
					<?php echo (!empty($article->district_name)?'ต.'.$article->district_name.' ':'');?>
					<?php echo (!empty($article->amphur_name)?'อ.'.$article->amphur_name.' ':'');?>
					<?php echo (!empty($article->province_name)?'จ.'.$article->province_name:'');?>
				</span>
				<div class="btn" id="btnClearLocation"><i class="fa fa-close" aria-hidden="true"></i></div>
			</div>
		</div>
		<?php }?>

		<div class="locationInputWrapper">
			<i class="fa fa-search" aria-hidden="true"></i>
			<input type="text" id="findLocation" placeholder="ค้นหา ตำบล อำเภอ จังหวัด..." autocomplete="off">

			<ul id="locationList"></ul>
		</div>
	</div>

	<div class="section" id="tag">
		<h2>คำที่เกี่ยวข้อง</h2>
		<div class="tag">
			<?php foreach ($article->tags as $var) {?>
			<div class="tag-items" data-id="<?php echo $var['tag_id'];?>" data-name="<?php echo $var['name'];?>">
				<span><?php echo $var['name'];?></span>
				<span class="btn-remove-tag"><i class="fa fa-close" aria-hidden="true"></i></span>
			</div>
			<?php }?>
		</div>
		<form class="locationInputWrapper" id="tagForm">
			<i class="fa fa-tags" aria-hidden="true"></i>
			<input type="text" id="tag-input" placeholder="ใส่คำที่ค้องการ...">
			<div class="tip">กด Enter เพิ่มบันทึก</div>
		</form>
	</div>
</div>

<input type="hidden" id="article_id" value="<?php echo $article->id;?>">

<div id="progressbar"></div>
<div id="overlay" class="overlay"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/location.js"></script>
<script type="text/javascript" src="js/seo.js"></script>
</body>
</html>