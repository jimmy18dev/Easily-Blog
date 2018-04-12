<?php
include_once'autoload.php';
$article = new Article();
$category = new Category();
$category_id = $_GET['category_id'];
$articles = $article->listAll($category_id,NULL,NULL,'published',NULL);
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

<title>Easily Blog</title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/slideshow.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>
<?php include_once 'header.php';?>

<?php if(empty($category_id)){?>
<div class="cover">
	<img src="image/cover.jpg" alt="">
	<div class="content">
		<h1>อาชีวเวชกรรมและเวชกรรมสิ่งแวดล้อม</h1>
		<p>Occupational and Environmental medicine</p>
		<a href="#" class="btn">บทความล่าสุด</a>
		<a href="#" class="btn btn-ghost">ติดต่อเรา</a>
	</div>
	<div class="filter"></div>
</div>
<?php }?>
<nav class="navigation">
	<?php foreach ($categories as $var) {?>
	<a class="<?php echo ($var['id'] == $category_id?'active':''); ?>" href="topic/<?php echo $var['id'];?><?php echo (!empty($var['link'])?'/'.$var['link']:'');?>"><?php echo $var['title'];?></a>
	<?php } ?>

	<a class="right" href="#">เกี่ยวกับเรา</a>
</nav>

<div class="article-list">
	<h3>บทความ</h3>
	<div>
		<?php if(count($articles) > 0){?>
		<?php foreach ($articles as $var) { include 'template/article.card.php'; } ?>
		<?php }else{?>
		<div class="empty">ไม่พบบทความ</div>
		<?php }?>
	</div>
</div>

<?php if(count($articles)>0){
	include_once 'footer.php';
}?>

<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>