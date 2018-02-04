<?php
include_once'autoload.php';
$article 	= new Article();
$document 	= new Document();

$article_id = $_GET['article_id'];
$article->get($article_id);
$loop = 1;
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

<title>Edit Article</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<div class="header fixed">
	<a href="index.php" class="page-icon" id="editorIcon"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
	<div class="page-title" id="editorTitle">เขียนบทความ</div>

	<div class="btn-profile" id="btnProfile">
		<img src="https://graph.facebook.com/1818320188/picture?type=square" alt="">

		<div class="toggle-panel" id="profilePanel">
			<div class="popover-arrow"></div>
			<ul>
				<li><a href="#">บทความของฉัน</a></li>
				<li class="separator"></li>
				<li><a href="#">ตั้งค่า</a></li>
				<li><a href="#">วิธีใช้</a></li>
				<li><a href="#" class="logout">ออกจากระบบ</a></li>
			</ul>
		</div>
	</div>
	<div class="btn">
		<i class="fa fa-ellipsis-h" aria-hidden="true"></i>
	</div>

	<div class="btn active">
		<span><?php echo ($article->status!='publish'?'เผยแพร่บทความ':'เผยแพร่แล้ว');?></span>
		<i class="fa fa-angle-right" aria-hidden="true"></i>
	</div>
</div>

<div class="article editor">
	<!-- Article Header -->
	<header class="article-header">
		<textarea class="article-title autosize" id="title" placeholder="ตั้งชื่อบทความ"></textarea>
		<input type="hidden" id="original_title" value="<?php echo $article->title;?>">
		<textarea class="article-desc autosize <?php echo (empty($article->title)?'hidden':'');?>" id="description" placeholder="รายละเอียดอย่างย่อไม่เกิน 140 ตั่วอักษร"><?php echo $article->description;?></textarea>
	</header>

	<!-- Contents rendering -->
	<?php foreach ($article->contents as $var) {?>
	<?php if($var['type'] == 'textbox'){?>
	<div class="content textbox" id="content<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>">
		<div class="control">
			<div class="info">บทความ <?php echo $var['id']?> · <?php echo (!empty($var['edited'])?'แก้ไข '.$var['edited']:$var['created']);?></div>
			<div class="btn btnDeleteContent" title="ลบส่วนนี้"><i class="fa fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap" title="สลับตำแหน่ง้"><i class="fa fa-sort" aria-hidden="true"></i></div>
		</div>

		<input type="text" class="topic textbox-topic" placeholder="หัวข้อ..." value="<?php echo $var['topic'];?>">
		<textarea class="body textbox-body autosize" placeholder="เขียนเนื้อหา"><?php echo $var['body'];?></textarea>
	</div>
	<?php }else if($var['type'] == 'youtube'){?>
	<div class="content youtube" id="content<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>">
		<div class="control">
			<div class="info">YouTube <?php echo $var['id']?> · <?php echo (!empty($var['edited'])?'แก้ไข '.$var['edited']:$var['created']);?></div>
			<div class="btn btnDeleteContent" title="ลบส่วนนี้"><i class="fa fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap" title="สลับตำแหน่ง"><i class="fa fa-sort" aria-hidden="true"></i></div>
		</div>

		<input type="<?php echo (!empty($var['video_id'])?'hidden':'');?>" class="youtube_url" placeholder="YouTube Video URL">
		<input type="hidden" class="youtube_id" value="<?php echo $var['video_id'];?>">

		<div class="videoWrapper <?php echo (empty($var['video_id'])?'hidden':'');?>">
			<iframe src="https://www.youtube.com/embed/<?php echo $var['video_id'];?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		</div>
		<input type="text" class="alt <?php echo (empty($var['video_id'])?'hidden':'');?>" placeholder="ใส่คำอธิบายวิดีโอ" value="<?php echo $var['alt'];?>">
	</div>
	<?php }else if($var['type'] == 'quote'){?>
	<div class="content quote" id="content<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>">
		<div class="control">
			<div class="info">คำพูด <?php echo $var['id']?> · <?php echo (!empty($var['edited'])?'แก้ไข '.$var['edited']:$var['created']);?></div>
			<div class="btn btnDeleteContent" title="ลบส่วนนี้"><i class="fa fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap" title="สลับตำแหน่ง"><i class="fa fa-sort" aria-hidden="true"></i></div>
		</div>

		<i class="fa fa-quote-left" aria-hidden="true"></i>
		<textarea class="body quote-body autosize" placeholder="เขียนคำพูดที่นี่..."><?php echo $var['body'];?></textarea>
		<input type="text" class="topic quote-cite" placeholder="อ้างอิงที่มา" title="อ้างอิงที่มา" value="<?php echo $var['topic'];?>">
		<i class="fa fa-quote-right" aria-hidden="true"></i>
	</div>
	<?php }else if($var['type'] == 'map'){?>
	<div class="content google-map" id="content<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>">
		<div class="control">
			<div class="info">แผนที่ <?php echo $var['id']?> · <?php echo (!empty($var['edited'])?'แก้ไข '.$var['edited']:$var['created']);?></div>
			<div class="btn btnDeleteContent" title="ลบส่วนนี้"><i class="fa fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap" title="สลับตำแหน่ง"><i class="fa fa-sort" aria-hidden="true"></i></div>
		</div>

		<div class="embed-map">
			<div class="loading">Google Map Loading...</div>
		</div>
		<input type="text" class="alt" id="alt<?php echo $var['id'];?>" placeholder="ใส่คำอธิบายแผนที่" value="<?php echo $var['alt'];?>">

		<input type="hidden" class="lat" value="<?php echo $var['lat'];?>" placeholder="Lat">
		<input type="hidden" class="lng" value="<?php echo $var['lng'];?>" placeholder="Ing" >
	</div>
	<?php }else if($var['type'] == 'image'){?>
	<form action="upload_image.php" class="content photoForm" id="content<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>" method="POST" enctype="multipart/form-data">
		<div class="control">
			<div class="info">รูปภาพ <?php echo $var['id']?> · <?php echo (!empty($var['edited'])?'แก้ไข '.$var['edited']:$var['created']);?></div>
			<div class="btn btnDeleteContent" title="ลบส่วนนี้"><i class="fa fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap" title="สลับตำแหน่ง"><i class="fa fa-sort" aria-hidden="true"></i></div>
			<div class="btn btn-rotate-image <?php echo (empty($var['img_location'])?'hidden':'');?>" title="หมุนรูปภาพ"><i class="fa fa-repeat" aria-hidden="true"></i></div>
			<div class="btn btn-change-image <?php echo (empty($var['img_location'])?'hidden':'');?>"><i class="fa fa-upload" aria-hidden="true"></i><span>เลือกภาพใหม่</span></div>
		</div>

		<div class="preview">
			<div class="imgpreview" id="imagePreview<?php echo $var['id'];?>">
				<?php if(!empty($var['img_location'])){?>
				<img src="image/upload/normal/<?php echo $var['img_location'];?>">
				<?php }else{?>
				<div class="btn-choose-image">
					<i class="fa fa-picture-o" aria-hidden="true"></i>
					<span>เลือกไฟล์รูปภาพ</span>
				</div>
				<?php }?>
			</div>
		</div>

		<div class="uploading" id="loading<?php echo $var['id'];?>">
			<div class="inprogress">
				<div class="bar" id="bar<?php echo $var['id'];?>"></div>
			</div>
		</div>
		
		<input type="text" class="alt <?php echo (empty($var['img_location'])?'hidden':'');?>" id="alt<?php echo $var['id'];?>" placeholder="ใส่คำอธิบายภาพ" value="<?php echo $var['alt'];?>">

		<input type="file" name="image" class="image-file" id="imageFiles<?php echo $var['id'];?>">
		<input type="hidden" name="content_id" value="<?php echo $var['id'];?>">
		<input type="hidden" name="article_id" value="<?php echo $article->id;?>">
	</form>
	<?php }?>

	<?php if(($loop) != (int) $article->total_contents){?>
	<div class="between-option" title="แทรกส่วนนี้">
		<div class="more-option">
			<div class="btnAction" data-action="textbox" data-content="<?php echo $var['id'];?>">
				<i class="fa fa-font" aria-hidden="true"></i>
				<span>บทความ</span>
			</div>
			<div class="btnAction" data-action="image" data-content="<?php echo $var['id'];?>">
				<i class="fa fa-picture-o" aria-hidden="true"></i>
				<span>รูปภาพ</span>
			</div>
			<div class="btnAction" data-action="quote" data-content="<?php echo $var['id'];?>">
				<i class="fa fa-quote-right" aria-hidden="true"></i>
				<span>คำพูด</span>
			</div>
			<div class="btnAction" data-action="youtube" data-content="<?php echo $var['id'];?>">
				<i class="fa fa-youtube-play" aria-hidden="true"></i>
				<span>YouTube</span>
			</div>
			<div class="btnAction" data-action="map" data-content="<?php echo $var['id'];?>">
				<i class="fa fa-map-marker" aria-hidden="true"></i>
				<span>แผนที่</span>
			</div>
		</div>
	</div>
	<?php }?>
	<?php $loop++; }?>

	<div class="option-control" id="optionControl">
		<div class="btnAction" data-action="textbox" title="เพิ่มกล่องข้อความ"><i class="fa fa-font" aria-hidden="true"></i><span>ข้อความ</span></div>
		<div class="btnAction" data-action="image" title="อัพโหลดรูปภาพ"><i class="fa fa-picture-o" aria-hidden="true"></i><span>รูปภาพ</span></div>
		<div class="btnAction" data-action="quote" title="กล่องคำพูด"><i class="fa fa-quote-right" aria-hidden="true"></i><span>คำพูด</span></div>
		<div class="btnAction" data-action="youtube" title="คลิปวิดีโอจาก YouTube"><i class="fa fa-youtube-play" aria-hidden="true"></i><span>YouTube</span></div>
		<div class="btnAction" data-action="map" title="แผนที่จาก Google Map"><i class="fa fa-map-marker" aria-hidden="true"></i><span>แผนที่</span></div>

		<div class="btnAction right" id="btnAttachFile" title="แนบไฟล์เอกสาร"><i class="fa fa-paperclip" aria-hidden="true"></i><span>แนบไฟล์</span></div>
	</div>

	<div class="documents">
		<form action="upload_document.php" class="document-items form" id="documentForm" method="POST" enctype="multipart/form-data">
			<div class="icon">
				<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
			</div>
			<div class="detail">
				<div class="name" id="fileName">เลือกไฟล์เอกสารของคุณ</div>
				<div class="progress" id="documentProgress">
					<div class="bar" id="documentProgressBar"></div>
				</div>
			</div>
			
			<input type="file" name="file" class="inputfile" id="file">
			<input type="hidden" name="article_id" value="<?php echo $article->id;?>">
			<input type="hidden" id="maximumSize" value="<?php echo $document->return_bytes(ini_get('post_max_size'));?>">
		</form>
		<?php foreach ($article->documents as $var) {?>
		<div class="document-items" data-file="<?php echo $var['id'];?>">
			<div class="icon"><i class="fa fa-file-excel-o" aria-hidden="true"></i></div>
			<div class="detail">
				<input type="text" class="file_title" title="แก้ไขชื่อเอกสาร" placeholder="ตั้งชื่อไฟล์นี้" value="<?php echo $var['title'];?>">
				<div class="info"><?php echo $var['file_type'];?> ขนาด <?php echo $var['file_size'];?> <?php echo $var['file_name'];?></div>
			</div>
			<div class="btn btn-doc-delete" title="ลบเอกสารนี้"><i class="fa fa-times" aria-hidden="true"></i></div>
		</div>
		<?php }?>
	</div>

	<input type="hidden" id="article_id" value="<?php echo $article->id;?>">
	<input type="hidden" id="maximumSize" value="<?php echo $document->return_bytes(ini_get('post_max_size'));?>">
</div>

<div class="swap" id="swap"></div>
<div id="progressbar"></div>
<div id="overlay" class="overlay"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/jquery.autosize.min.js"></script>
<script type="text/javascript" src="js/lib/tippy.all.min.js"></script>
<script type="text/javascript" src="js/lib/numeral.min.js"></script>
<script type="text/javascript" src="js/lib/smoothscroll.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/editor.js"></script>
<script type="text/javascript" src="js/google-map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4gvNqIKPkhZ8TimA9Mv2_QYhTGk2B-Yw"></script>
</body>
</html>