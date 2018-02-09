<?php
include_once'autoload.php';
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

<title>เลือกประเภทบทความ</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/slideshow.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<header class="header">
	<a href="index.php" class="btn left"><i class="fa fa-arrow-left" aria-hidden="true"></i><span>ยกเลิก</span></a>
</header>

<div class="pagehead center">
	<h2>เลือกประเภทบทความ...</h2>
</div>
<div class="choose">
	<div class="list">
		<?php foreach ($categories as $var) {?>
		<div class="choose-category" data-id="<?php echo $var['id'];?>">
			<div class="icon"><i class="fa fa-folder-o" aria-hidden="true"></i></div>
			<div class="name"><?php echo $var['title'];?></div>
		</div>
		<?php } ?>
	</div>
	<div class="control">
		<div class="btn" id="btnStartWrite">เริ่มเขียน<i class="fa fa-arrow-right" aria-hidden="true"></i></div>
	</div>
</div>


<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/article.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>