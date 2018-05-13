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

$article 	= new Article();
$document 	= new Document();

$article_id = $_GET['article_id'];
$article->get($article_id);
$loop = 1;

// Get Ref
$ref = (isset($_GET['ref'])?$_GET['ref']:'');

if($article->owner_id != $user->id){
	header('Location: '.DOMAIN.'/error/NotOwner');
	die();
}
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
<link rel="stylesheet" type="text/css" href="css/admin.style.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body class="paper">
<div class="header">
	<div class="status" id="editor-status"></div>

	<?php if($ref == 'onsite'){?>
	<a class="btn-icon right" href="article/<?php echo $article->id;?>" title="ออกจากหน้านี้"><i class="fal fa-times"></i></a>
	<?php }else{?>
	<a class="btn-icon right" href="profile#<?php echo $article->id;?>" title="ออกจากหน้านี้"><i class="fal fa-times"></i></a>
	<?php }?>

	<a class="btn-icon right" href="article/<?php echo $article->id;?>" target="_blank" title="ดูตัวอย่างแท็บใหม่"><i class="fa fa-eye"></i></a>
	<?php if($article->status!='published'){?>
	<div class="btn right active" id="btn-publish" title="เผยแพร่">เผยแพร่</div>
	<?php }?>
	<a class="btn-icon right" href="article/<?php echo $article->id;?>/option" title="ตั้งค่า"><i class="fa fa-cog"></i></a>
	<a class="btn-icon right" id="btn-remove" title="ลบ"><i class="fa fa-trash"></i></a>
</div>

<div class="editor">
	<!-- Article Header -->
	<header class="article-header <?php echo (!empty($article->head_cover_img)?'with-cover':'');?>">
		
		<?php if(!empty($article->head_cover_img)){?>
		<img src="image/upload/<?php echo $article->id;?>/large/<?php echo $article->head_cover_img;?>" alt="">
		<?php }?>

		<span>
			<?php if(!empty($article->head_cover_img)){?>
			<div class="btn btn-remove" id="btnRemoveCover" title="ลบภาพปก"><i class="fal fa-times" aria-hidden="true"></i></div>
			<div class="btn" id="btnChooseCover" title="เปลี่ยนภาพปก"><i class="fa fa-camera" aria-hidden="true"></i></div>
			<?php }else{?>
			<div class="btn" id="btnChooseCover" title="เลือกภาพปก"><i class="fa fa-camera" aria-hidden="true"></i></div>
			<?php }?>

			<textarea class="autosize" id="title" placeholder="ชื่อบทความ"></textarea>
			<input type="hidden" id="original_title" value="<?php echo $article->title;?>">

			<form action="upload_image.php" id="coverForm" method="POST" enctype="multipart/form-data">
				<input type="file" name="image" id="coverImageFiles">
				<input type="hidden" name="article_id" value="<?php echo $article->id;?>">
				<input type="hidden" name="type" value="head_cover">
			</form>
		</span>
	</header>

	<!-- Contents rendering -->
	<?php foreach ($article->contents as $var) {?>
	<?php if($var['type'] == 'textbox'){?>
	<div class="content textbox" id="content<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>">
		<div class="control">
			<div class="info"><?php echo (!empty($var['edited'])?'แก้ไข '.$var['edited']:$var['created']);?></div>
			<div class="btn btnDeleteContent" title="ลบส่วนนี้"><i class="fal fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap" title="สลับตำแหน่ง"><i class="fal fa-list" aria-hidden="true"></i></div>
		</div>

		<input type="text" class="topic textbox-topic" placeholder="หัวข้อ" value="<?php echo $var['topic'];?>">
		<textarea class="body textbox-body autosize" placeholder="เขียนเนื้อหา..."><?php echo $var['body'];?></textarea>
	</div>
	<?php }else if($var['type'] == 'youtube'){?>
	<div class="content youtube" id="content<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>">
		<div class="control">
			<div class="info"><?php echo (!empty($var['edited'])?'แก้ไข '.$var['edited']:$var['created']);?></div>
			<div class="btn btnDeleteContent" title="ลบส่วนนี้"><i class="fal fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap" title="สลับตำแหน่ง"><i class="fal fa-list" aria-hidden="true"></i></div>
		</div>

		<div class="input-wrapper <?php echo (!empty($var['video_id'])?'hidden':'');?>">
			<span><i class="fab fa-youtube"></i></span>
			<input type="<?php echo (!empty($var['video_id'])?'hidden':'text');?>" class="youtube_url" placeholder="YouTube Video URL">
		</div>

		<input type="hidden" class="youtube_id" value="<?php echo $var['video_id'];?>">

		<div class="videoWrapper <?php echo (empty($var['video_id'])?'hidden':'');?>">
			<iframe src="https://www.youtube.com/embed/<?php echo $var['video_id'];?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		</div>
		<input type="text" class="alt <?php echo (empty($var['video_id'])?'hidden':'');?>" placeholder="ใส่คำอธิบายวิดีโอ" value="<?php echo $var['alt'];?>">
	</div>
	<?php }else if($var['type'] == 'quote'){?>
	<div class="content quote" id="content<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>">
		<div class="control">
			<div class="info"><?php echo (!empty($var['edited'])?'แก้ไข '.$var['edited']:$var['created']);?></div>
			<div class="btn btnDeleteContent" title="ลบส่วนนี้"><i class="fal fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap" title="สลับตำแหน่ง"><i class="fal fa-list" aria-hidden="true"></i></div>
		</div>

		<i class="fa fa-quote-left"></i>
		<textarea class="body quote-body autosize" placeholder="เขียนคำพูดที่นี่..."><?php echo $var['body'];?></textarea>
		<input type="text" class="topic quote-cite" placeholder="อ้างอิงที่มา" title="อ้างอิงที่มา" value="<?php echo $var['topic'];?>">
		<i class="fa fa-quote-right"></i>
	</div>
	<?php }else if($var['type'] == 'map'){?>
	<div class="content google-map" id="content<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>">
		<div class="control">
			<div class="info"><?php echo (!empty($var['edited'])?'แก้ไข '.$var['edited']:$var['created']);?></div>
			<div class="btn btnDeleteContent" title="ลบส่วนนี้"><i class="fal fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap" title="สลับตำแหน่ง"><i class="fal fa-list" aria-hidden="true"></i></div>
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
			<div class="info"><?php echo (!empty($var['edited'])?'แก้ไข '.$var['edited']:$var['created']);?></div>
			<div class="btn btnDeleteContent" title="ลบส่วนนี้"><i class="fal fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap" title="สลับตำแหน่ง"><i class="fal fa-list" aria-hidden="true"></i></div>
			<div class="btn btn-rotate-image <?php echo (empty($var['img_location'])?'hidden':'');?>" title="หมุนรูปภาพ"><i class="fa fa-redo" aria-hidden="true"></i></div>
			<div class="btn btn-change-image <?php echo (empty($var['img_location'])?'hidden':'');?>"><span>เลือกภาพใหม่</span></div>
		</div>

		<div class="preview">
			<div class="imgpreview" id="imagePreview<?php echo $var['id'];?>">
				<?php if(!empty($var['img_location'])){?>
				<img src="image/upload/<?php echo $article->id;?>/normal/<?php echo $var['img_location'];?>">
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
				<i class="fa fa-font"></i>
				<span>บทความ</span>
			</div>
			<div class="btnAction" data-action="image" data-content="<?php echo $var['id'];?>">
				<i class="fa fa-camera"></i>
				<span>รูปภาพ</span>
			</div>
			<div class="btnAction" data-action="quote" data-content="<?php echo $var['id'];?>">
				<i class="fa fa-quote-right"></i>
				<span>คำพูด</span>
			</div>
			<div class="btnAction" data-action="youtube" data-content="<?php echo $var['id'];?>">
				<i class="fab fa-youtube"></i>
				<span>YouTube</span>
			</div>
			<div class="btnAction" data-action="map" data-content="<?php echo $var['id'];?>">
				<i class="fa fa-map"></i>
				<span>แผนที่</span>
			</div>
		</div>
	</div>
	<?php }?>
	<?php $loop++; }?>

	<div class="tools-bar">
		<span class="btn-tool btnAction" data-action="textbox" title="เพิ่มกล่องข้อความ"><i class="fa fa-font"></i></span>
		<span class="btn-tool" id="btnMultipleImages" title="อัพโหลดภาพ"><i class="fa fa-camera"></i></span>
		<span class="btn-tool btnAction" data-action="quote" title="กล่องคำพูด"><i class="fa fa-quote-right"></i></span>
		<span class="btn-tool btnAction" data-action="youtube" title="คลิป YouTube"><i class="fab fa-youtube"></i></span>
		<span class="btn-tool btnAction" data-action="map" title="แผนที่ Google Map"><i class="fa fa-map"></i></span>
		<span class="btn-tool btnAction" id="btnAttachFile" title="แนบไฟล์"><i class="fa fa-paperclip"></i></span>
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
			<div class="icon"><i class="fa fa-file"></i></div>
			<div class="detail">
				<input type="text" class="file_title" title="แก้ไขชื่อเอกสาร" placeholder="ตั้งชื่อไฟล์นี้" value="<?php echo $var['title'];?>">
				<div class="info"><?php echo $var['file_type'];?> ขนาด <?php echo $var['file_size'];?> <?php echo $var['file_name'];?></div>
			</div>
			<div class="btn btn-doc-delete" title="ลบเอกสารนี้"><i class="fal fa-times" aria-hidden="true"></i></div>
		</div>
		<?php }?>
	</div>

	<input type="hidden" id="article_id" value="<?php echo $article->id;?>">
	<input type="hidden" id="maximumSize" value="<?php echo $document->return_bytes(ini_get('post_max_size'));?>">

	<form action="upload_images.php" id="multipleImagesForm" method="POST" enctype="multipart/form-data">
		<input type="file" name="images[]" id="multipleImageFiles" multiple>
		<input type="hidden" name="article_id" value="<?php echo $article->id;?>">
		<input type="hidden" name="type" value="image">
	</form>
</div>

<div class="swap" id="swap"></div>
<div id="overlay" class="overlay"></div>
<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/jquery.autosize.min.js"></script>
<script type="text/javascript" src="js/lib/tippy.all.min.js"></script>
<script type="text/javascript" src="js/lib/numeral.min.js"></script>
<script type="text/javascript" src="js/lib/smoothscroll.min.js"></script>
<script type="text/javascript" src="js/lib/progressbar.js"></script>

<script type="text/javascript" src="js/article.lib.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/editor.js"></script>
<script type="text/javascript" src="js/google-map.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4gvNqIKPkhZ8TimA9Mv2_QYhTGk2B-Yw"></script>
</body>
</html>