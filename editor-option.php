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
<link rel="stylesheet" type="text/css" href="css/admin.style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>

<div class="header">
	<a class="btn" href="article/<?php echo $article->id;?>/editor"><i class="fal fa-arrow-left"></i></a>
</div>

<div class="seo">
	<div class="section" id="cover">
		<h2>1. ภาพหน้าปก (Cover)</h2>
		<div class="list">
			<?php foreach ($article->contents as $var) {?>
			<?php if(($var['type'] == 'image' || $var['type'] == 'cover') && !empty($var['img_location'])){?>
			<div class=" items cover-items <?php echo ($var['id'] == $article->cover_id?'active':'');?>" data-cover="<?php echo $var['id'];?>" title="เลือกเป็นภาพปก">
				<img src="image/upload/<?php echo $article->id;?>/square/<?php echo $var['img_location'];?>">
				<i class="fa fa-check-circle"></i>
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
	</div>

	<div class="section" id="info">
		<h2>2. รายละเอียดอย่างย่อ</h2>
		<textarea id="description" placeholder="รายละเอียดอย่างย่อไม่เกิน 140 ตัวอักษร"><?php echo $article->description;?></textarea>
		<p class="right">ตรวจสอบด้วย <a href="https://developers.facebook.com/tools/debug/sharing/">Sharing Debugger</a></p>
	</div>

	<div class="section" id="url">
		<h2>3. ลิ้งค์ที่อยู่บทความ (URL Friendly)</h2>
		<div class="inputWrapper">
			<i class="fal fa-link" aria-hidden="true"></i>
			<span class="domain"><?php echo $article_url;?></span>
			<input class="url-input" type="text" id="articleURL" value="<?php echo $article->url;?>" placeholder="ตั้งชื่อลิงค์ที่นี่...">
		</div>
	</div>

	<div class="section" id="location">
		<h2>4. ที่อยู่</h2>

		<?php if(!empty($article->district_id) || !empty($article->amphur_id) || !empty($article->province_id)){?>
		<div class="location-current">
			<div class="location-items">
				<i class="fal fa-map-marker" aria-hidden="true"></i>
				<span>
					<?php echo (!empty($article->district_name)?'ต.'.$article->district_name.' ':'');?>
					<?php echo (!empty($article->amphur_name)?'อ.'.$article->amphur_name.' ':'');?>
					<?php echo (!empty($article->province_name)?'จ.'.$article->province_name:'');?>
				</span>
				<div class="btn" id="btnClearLocation" title="ลบที่อยู่ปันจุบัน"><i class="fal fa-times" aria-hidden="true"></i></div>
			</div>
		</div>
		<?php }?>

		<div class="locationInputWrapper">
			<i class="fal fa-search" aria-hidden="true"></i>
			<input type="text" id="findLocation" placeholder="ค้นหา ตำบล อำเภอ จังหวัด..." autocomplete="off">

			<ul id="locationList"></ul>
		</div>
	</div>

	<div class="section" id="tag">
		<h2>5. คำที่เกี่ยวข้อง</h2>
		<div class="tag">
			<?php foreach ($article->tags as $var) {?>
			<div class="tag-items" data-id="<?php echo $var['tag_id'];?>" data-name="<?php echo $var['name'];?>">
				<span class="name"><?php echo $var['name'];?></span>
				<span class="btn-remove-tag"><i class="fal fa-times"></i></span>
			</div>
			<?php }?>
		</div>
		<form class="locationInputWrapper" id="tagForm">
			<i class="fal fa-hashtag" aria-hidden="true"></i>
			<input type="text" id="tag-input" placeholder="ใส่คำที่ค้องการ...">
			<div class="tip">กด Enter เพิ่มบันทึก</div>
		</form>
	</div>

	<div class="section" id="guide">
		<h2>6. SEO On-Page อย่างถูกต้อง</h2>
		<p>Title Tag ควรมี keyword อยู่ด้วย
ส่วนนี้ถือว่าเป็นส่วนที่สำคัญมากของการทำ On-Page SEO และเป็นส่วนที่ควรจะต้องมี keyword ที่เราต้องการทำ SEO อยู่ในส่วนนี้ ถ้าเป็นไปได้ keyword ควรจะเป็นคำแรกของ Title Tag ได้ยิ่งดี สำหรับ CMS ทั่วไปโดยเฉพาะ wordpress ส่วนนี้จะเป็นส่วนเดียวกันกับการตั้งชื่อบทความ (Headline) ดังนั้นการตั้งชื่อบทความจึงเป็นที่ต้องให้ความใส่ใจอย่างมากในการทำ SEO</p>
		<p>อย่าลืมคิดถึง Long Tail keyword 
Long tail keywords คือกลุ่มคำหรือวลีที่มี keyword หลักรวมอยู่กับคำอื่นๆ ซึ่งจะช่วยสร้างความหลากหลายให้กับคีย์เวิร์ด และจะทำให้คีย์เวิร์ดเหล่านี้มีโอกาสติดอันดับสูงๆ ได้ง่ายกว่าคำหลัก เช่น การเพิ่มเติมความว่า “รีวิว” “2016” หรือ “ราคา” รวมกับคีย์เวิร์ดหลักในตอนที่เขียน Title Tag เป็นต้น อ่านเพิ่มเติม Keyword Research ขั้นตอนสำคัญในการทำ SEO</p>
		<p>สร้าง URL ให้ Search Engines และ Users เข้าใจได้ง่าย
ควรหลีกเลี่ยง URL ที่เต็มไปด้วยอักขระที่มีแต่โปรแกรมเมอร์เท่านั้นที่อ่านเข้าใจ URL ที่ดีควรจะมีความหมายซึ่งก็หมายถึงควรจะมีคีย์เวิร์ดรวมอยู่ใน URL ด้วยจะดีมาก เพราะนอกจากจะเป็นการทำ SEO-Friendly URLs แล้วยังถือว่าเป็นการทำ User-Friendly URLs ด้วย</p>
		<p>ให้ความสำคัญกับ Paragraph แรกของเนื้อหา
ในย่อหน้าแรกนั้นโดยเฉพาะ 160 ตัวอักษรแรกควรที่จะมีคีย์เวิร์ดหลักรวมอยู่ด้วย เรื่องนี้ถือว่าเป็นเรื่องที่ควรจำต้องทำให้เป็นประจำสม่ำเสมอเวลาที่เขียนบทความเนื้อหาอะไรก็ตาม เนื่องจากโดยปกติถ้าหาก Google ไม่พบ Meta description แล้ว Google มักจะดึงข้อความในย่อหน้าแรกไปแสดงบนผลการค้นหา ซึ่งการมีคีย์เวิร์ดอยู่ในผลการค้นหาย่อมเป็นสิ่งที่ดี</p>
		<p>ใช้แท็ก alt ในการอธิบายภาพ
Alt แท็กเป็นอีกส่วนหนึ่งที่จะช่วยบอก Google ให้เข้าใจความหมายของรูปภาพได้ดียิ่งขึ้น ดังนั้นควรที่จะต้องใส่คีย์เวิร์ดในส่วนนี้ด้วยเช่นกัน</p>
		<p>เขียนบทความให้มีความยาว
มีผลสำรวจจากเว็บไซต์ต่างประเทศพบว่าเนื้อหาที่มีความยาวมักจะมีอันดับที่ดีกว่าเนื้อหาสั้นๆ ในบทความระบุว่าอันดับหนึ่งถึงสามในผลการค้นหามักจะมีความยาวประมาณ 1,900 – 2000 คำ แต่อย่างไรก็ตามให้ต้องคำนึงถึงคุณภาพของเนื้อหาด้วย ไม่ใช่เน้นที่ความยาวแต่เพียงอย่างเดียว เพราะถ้าเนื้อหาไม่มีคุณภาพแล้ว ความยาวก็ไม่ได้ช่วยอะไร</p>
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