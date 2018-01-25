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
<div class="header">
	<a class="btn" href="article/<?php echo $article->id?>">Close</a>
</div>
<div class="article">
	<!-- Article Header -->
	<header class="article-header">
		<textarea id="articleTitle" placeholder="Enter title here..."><?php echo $article->title;?></textarea>
		<textarea id="articleDescription" placeholder="enter article description"><?php echo $article->description;?></textarea>
	</header>

	<!-- Contents rendering -->
	<?php foreach ($article->contents as $var) {?>
	<?php if($var['type'] == 'textbox'){?>
	<div class="content" data-content="<?php echo $var['id'];?>">
		<div class="control">
			<button class="btnDeleteContent">Delete</button>
		</div>

		<textarea class="topic-input" placeholder="topic"><?php echo $var['topic'];?></textarea>
		<textarea class="body-input" placeholder="enter story..."><?php echo $var['body'];?></textarea>
	</div>
	<?php }else if($var['type'] == 'image'){?>
	<form action="upload_image.php" class="photoForm" id="imageForm<?php echo $var['id'];?>" data-content="<?php echo $var['id'];?>" method="POST" enctype="multipart/form-data">
		<div class="control">
			<button class="btnDeleteContent">Delete</button>
		</div>

		<div class="preview">
			<div class="imgpreview" id="imagePreview<?php echo $var['id'];?>">
				<?php if(!empty($var['img_location'])){?>
				<img src="image/upload/normal/<?php echo $var['img_location'];?>">
				<?php }else{?>
				<span class="btn-choose-image"><i class="fa fa-picture-o" aria-hidden="true"></i>เลือกไฟล์รูปภาพ</span>
				<?php }?>
			</div>

			<div class="btn-change-image">เลือกภาพใหม่</div>
		</div>

		<div class="uploading" id="loading<?php echo $var['id'];?>">
			<div class="inprogress">
				<div class="bar" id="bar<?php echo $var['id'];?>"></div>
			</div>
		</div>
		
		<input type="text" class="image-alt" placeholder="Image description..." value="<?php echo $var['img_alt'];?>">

		<input type="file" name="image" class="image-file" id="imageFiles<?php echo $var['id'];?>">
		<input type="hidden" name="content_id" value="<?php echo $var['id'];?>">
		<input type="hidden" name="article_id" value="<?php echo $article->id;?>">
	</form>
	<?php }?>
	<div class="control">
		<button class="btnAction" data-action="textbox" data-content="<?php echo $var['id'];?>"><i class="fa fa-font" aria-hidden="true"></i></button>
		<button class="btnAction" data-action="image" data-content="<?php echo $var['id'];?>"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
	</div>
	<?php } ?>

	<div class="control">
		<button class="btnAction" data-action="textbox"><i class="fa fa-font" aria-hidden="true"></i></button>
		<button class="btnAction" data-action="image"><i class="fa fa-picture-o" aria-hidden="true"></i></button>
		<button class="btnAction" data-action="document"><i class="fa fa-paperclip" aria-hidden="true"></i></button>
		<button class="btnAction" data-action="youtube"><i class="fa fa-youtube-play" aria-hidden="true"></i></button>
	</div>

	<input type="hidden" id="article_id" value="<?php echo $article->id;?>">
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/lib/jquery-form.min.js"></script>
<script type="text/javascript" src="js/lib/autosize.js"></script>
<script type="text/javascript" src="js/editor.js"></script>
</body>
</html>