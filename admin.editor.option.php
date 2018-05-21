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

// Get Ref
$ref = (isset($_GET['ref'])?$_GET['ref']:'');

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

<?php include'favicon.php';?>

<title>เพิ่มประสิทธิภาพ | <?php echo $article->title;?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/admin.style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body class="paper">

<div class="header">
	<a class="btn-icon right" href="article/<?php echo $article->id;?>/editor<?php echo ($ref=='onsite'?'?ref=onsite':'')?>"><i class="fal fa-times"></i></a>
</div>

<div class="pagehead">
	<div class="head">
		<h1>เพิ่มประสิทธิภาพ</h1>
		<p>การทำ SEO คือ ทำเว็บไซต์ให้ตรงตามเกณฑ์การให้คะแนนของ Search Engine อย่าง Google ให้มากที่สุด เพื่อให้เว็บไซต์ติดอยู่ในผลการค้นหาลำดับแรก</p>
	</div>
</div>

<div class="page-form">
	<div class="section" id="cover">
		<h2>ภาพหน้าปก</h2>
		<p>ภาพนี้จะถูกใช้เป็นภาพประจำบนความบนหน้าเว็บไซต์ และเมื่อแชร์บทความนบน Facebook ภาพนี้จะแสดงเป็นภาพแรก ตรวจสอบด้วย <a href="https://developers.facebook.com/tools/debug/sharing/">Sharing Debugger</a></p>
		<div class="list">
			<?php foreach ($article->contents as $var) {?>
			<?php if(($var['type'] == 'image' || $var['type'] == 'cover') && !empty($var['img_location'])){?>
			<div class=" items cover-items <?php echo ($var['id'] == $article->cover_id?'active':'');?>" data-cover="<?php echo $var['id'];?>" title="เลือกเป็นภาพปก">
				<img src="image/upload/<?php echo $article->id;?>/square/<?php echo $var['img_location'];?>">
			</div>
			<?php }?>
			<?php }?>

			<div class="items btn-add-cover" title="เลือกภาพใหม่"><i class="fal fa-plus"></i></div>
			<form action="upload_image.php" id="coverForm" method="POST" enctype="multipart/form-data">
				<input type="file" name="image" id="coverImageFiles">
				<input type="hidden" name="article_id" value="<?php echo $article->id;?>">
				<input type="hidden" name="type" value="cover">
			</form>
		</div>

		<h2>รายละเอียดอย่างย่อ</h2>
		<p>อธิบายบทความด้วยความยาวไม่เกิน 140 ตัวอักษร ช่วยเพิ่มโอกาสให้ผลการค้นหาใน Google ดียิ่งขึ้น</p>
		<textarea id="description" placeholder="รายละเอียดอย่างย่อไม่เกิน 140 ตัวอักษร"><?php echo $article->description;?></textarea>
	</div>

	<div class="section">
		<h2>URL Friendly</h2>
		<p>ลิ้งค์บทความที่ดูเรียบง่ายและมีความหมาย เป็นอีกปัจจัยสำคัญช่วยให้ Google จัดอันดับบทความบนเว็บของเราในอันดับที่ดีมากยิ่งขึ้น</p>
		<div class="inputWrapper">
			<span class="prefix"><?php echo $article_url;?></span>
			<input type="text" id="articleURL" value="<?php echo $article->url;?>" placeholder="ตั้งชื่อลิงค์ที่นี่...">
		</div>
		<p class="note">* หากต้องการเว้นวรรคใช้เครื่องหมาย - หรือ _ เท่านั้น</p>
	</div>

	<div class="section" id="location">
		<h2>ตำแหน่ง</h2>
		<p>ระบุตำแหน่งที่อยู่ในบทความ ช่วยให้ผู้อ่านสามารถค้นหาเรื่องที่ต้องการได้รวดเร็วยิ่งขึ้น เช่น บทความรีวิวร้านอาหาร ที่พัก สถานที่ท่องเที่ยว เป็นต้น</p>

		<?php if(!empty($article->district_id) || !empty($article->amphur_id) || !empty($article->province_id)){?>
		<div class="location-current">
			<?php echo (!empty($article->district_name)?'ต.'.$article->district_name.' ':'');?>
			<?php echo (!empty($article->amphur_name)?'อ.'.$article->amphur_name.' ':'');?>
			<?php echo (!empty($article->province_name)?'จ.'.$article->province_name:'');?>
			<div class="btn" id="btnClearLocation" title="ลบที่อยู่ปันจุบัน"><i class="fal fa-times" aria-hidden="true"></i></div>
		</div>
		<?php }?>

		<input type="text" id="findLocation" placeholder="ค้นหา ตำบล อำเภอ จังหวัด" autocomplete="off">
		<ul id="locationList"></ul>
	</div>

	<div class="section">
		<h2>คำที่เกี่ยวข้อง</h2>
		<p>กลุ่มคำที่ช่วยให้สามารถจัดกลุ่มบทความในเรื่องเดียวกัน ยกตัวอย่าง เช่น กำหนดคำว่า <strong>โรคเบาหวาน</strong> ในบทความต่างๆ เมื่อผู้อ่านค้นหาบทความเฉพาะคำที่สนใจ ระบบจะแสดงบทความที่เกี่ยวข้องกับ <strong>โรคเบาหวาน</strong> ทั้งหมด</p>
		<form id="tagForm"><input type="text" id="tag-input" placeholder="ใส่คำที่ค้องการ..."></form>
		<p class="note">กด Enter เพิ่มบันทึก</p>

		<div class="tag">
			<?php foreach ($article->tags as $var) {?>
			<div class="tag-items" data-id="<?php echo $var['tag_id'];?>" data-name="<?php echo $var['name'];?>">
				<span class="name"><?php echo $var['name'];?></span>
				<span class="btn-remove-tag"><i class="fal fa-times"></i></span>
			</div>
			<?php }?>
		</div>
	</div>

	<div class="section">
		<h2>ตั้งค่าเพิ่มเติม</h2>

		<div class="toggle-items">
			<div class="caption">บทความที่เกี่ยวข้อง (Related Articles)</div>
			<div class="switch" id="btnToggleRelatedContent"><?php echo ($article->related_content?'<i class="fal fa-toggle-on"></i>':'<i class="fal fa-toggle-off"></i>');?></div>
		</div>
		<div class="toggle-items">
			<div class="caption">กล่องแสดงความคิดเห็น (Facebook Comments)</div>
			<div class="switch" id="btnToggleFbComment"><?php echo ($article->fb_comment?'<i class="fal fa-toggle-on"></i>':'<i class="fal fa-toggle-off"></i>');?></div>
		</div>
		<div class="toggle-items">
			<div class="caption">คิวอาร์โค้ดสำหรับเปิดบทความบนมือถือ</div>
			<div class="switch" id="btnToggleQRCode"><?php echo ($article->qrcode?'<i class="fal fa-toggle-on"></i>':'<i class="fal fa-toggle-off"></i>');?></div>
		</div>
	</div>
</div>

<input type="hidden" id="article_id" value="<?php echo $article->id;?>">

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