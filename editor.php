<?php
include_once'autoload.php';
$article = new Article();

$article_id = $_GET['article_id'];
$article->get($article_id);
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
	<a href="index.php" class="page-icon"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
	<div class="title" id="editorTitle">เขียนบทความ</div>

	<div class="btn btn-profile" id="btnProfile">
		<img src="https://graph.facebook.com/1818320188/picture?type=square" alt="">

		<div class="toggle-panel" id="profilePanel">
			<div class="arrow-up"></div>
			<div class="group">
				<a href="#">บทความของฉัน</a>
			</div>
			<div class="group">
				<a href="#">ตั้งค่า</a>
				<a href="#">วิธีใช้</a>
				<a href="#">ออกจากระบบ</a>
			</div>
		</div>
	</div>
	<div class="btn"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></div>

	<div class="btn active" id="btnPublish">
		<span><?php echo ($article->status!='publish'?'เผยแพร่':'เผยแพร่แล้ว');?></span>
		<i class="fa fa-angle-down" aria-hidden="true"></i>

		<div class="toggle-panel" id="publishPanel">
			<div class="arrow-up"></div>
			<a href="#">Option 1</a>
			<a href="#">Option 2</a>
			<a href="#">Option 3</a>
			<a href="#">Option 4</a>
		</div>
	</div>
</div>
<div class="article editor">
	<!-- Article Header -->
	<header class="article-header">
		<textarea class="article-title autosize" id="articleTitle" placeholder="ตั้งชื่อบทความ"></textarea>
		<input type="hidden" id="realtitle" value="<?php echo $article->title;?>">
		<textarea class="article-desc autosize" id="articleDescription" placeholder="รายละเอียดอย่างย่อ"><?php echo $article->description;?></textarea>
	</header>

	<!-- Contents rendering -->
	<?php foreach ($article->contents as $var) {?>
	<?php if($var['type'] == 'textbox'){?>
	<div class="content textbox" id="content<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>">
		<div class="info">
			<div class="id">#<?php echo $var['id']?></div>
			<div class="time"><?php echo $var['create_time'];?></div>
		</div>

		<div class="control">
			<div class="btn btnDeleteContent"><i class="fa fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap"><i class="fa fa-sort" aria-hidden="true"></i></div>
		</div>

		<input type="text" class="topic-input" placeholder="หัวข้อ..." value="<?php echo $var['topic'];?>">
		<textarea class="body-input autosize" placeholder="เขียนเนื้อหา"><?php echo $var['body'];?></textarea>
	</div>
	<?php }else if($var['type'] == 'qoute'){?>
	<div class="content qoute" id="content<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>">
		<div class="info">
			<div class="id">#<?php echo $var['id']?></div>
			<div class="time"><?php echo $var['create_time'];?></div>
		</div>

		<div class="control">
			<div class="btn btnDeleteContent"><i class="fa fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap"><i class="fa fa-sort" aria-hidden="true"></i></div>
		</div>

		<textarea class="blockquote-input autosize" placeholder="เขียนคำพูดที่นี่..."><?php echo $var['body'];?></textarea>
		<input type="text" class="cite-input" placeholder="อ้างอิงที่มา" value="<?php echo $var['topic'];?>">
	</div>
	<?php }else if($var['type'] == 'image'){?>
	<form action="upload_image.php" class="content photoForm" id="content<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>" method="POST" enctype="multipart/form-data">

		<div class="info">
			<div class="id">#<?php echo $var['id']?></div>
			<div class="time"><?php echo $var['create_time'];?></div>
		</div>

		<div class="control">
			<div class="btn btnDeleteContent"><i class="fa fa-times" aria-hidden="true"></i></div>
			<div class="btn btn-swap"><i class="fa fa-sort" aria-hidden="true"></i></div>
			<div class="btn btn-rotate-image <?php echo (empty($var['img_location'])?'hidden':'');?>"><i class="fa fa-repeat" aria-hidden="true"></i></div>
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
		
		<input type="text" class="image-alt" placeholder="ใส่คำอธิบายภาพ" value="<?php echo $var['img_alt'];?>">

		<input type="file" name="image" class="image-file" id="imageFiles<?php echo $var['id'];?>">
		<input type="hidden" name="content_id" value="<?php echo $var['id'];?>">
		<input type="hidden" name="article_id" value="<?php echo $article->id;?>">
	</form>
	<?php }?>
	<div class="between-option">
		<div class="more-option">
			<div class="btnAction" data-action="textbox" data-content="<?php echo $var['id'];?>">
				<i class="fa fa-font" aria-hidden="true"></i>
				<span>บทความ</span>
			</div>
			<div class="btnAction" data-action="image" data-content="<?php echo $var['id'];?>">
				<i class="fa fa-picture-o" aria-hidden="true"></i>
				<span>รูปภาพ</span>
			</div>
			<div class="btnAction" data-action="document" data-content="<?php echo $var['id'];?>">
				<i class="fa fa-paperclip" aria-hidden="true"></i>
				<span>เอกสาร</span>
			</div>
			<div class="btnAction" data-action="youtube" data-content="<?php echo $var['id'];?>">
				<i class="fa fa-youtube-play" aria-hidden="true"></i>
				<span>YouTube</span>
			</div>
		</div>
	</div>
	<?php } ?>

	<div class="option-control" id="optionControl">
		<div class="btnAction" data-action="textbox"><i class="fa fa-font" aria-hidden="true"></i><span>บทความ</span></div>
		<div class="btnAction" data-action="image"><i class="fa fa-picture-o" aria-hidden="true"></i><span>รูปภาพ</span></div>
		<div class="btnAction" data-action="qoute"><i class="fa fa-quote-right" aria-hidden="true"></i><span>คำพูด</span></div>
		<div class="btnAction" data-action="youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i><span>YouTube</span></div>
		<div class="btnAction" data-action="document"><i class="fa fa-paperclip" aria-hidden="true"></i><span>แนบไฟล์</span></div>
	</div>

	<input type="hidden" id="article_id" value="<?php echo $article->id;?>">
</div>

<div class="swap" id="swap"></div>
<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/jquery.autosize.min.js"></script>
<script type="text/javascript" src="js/lib/smoothscroll.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/editor.js"></script>
</body>
</html>