<?php
include_once'autoload.php';
$article = new Article();
$category = new Category();
$category_id = $_GET['category_id'];
$articles = $article->listAll($category_id,NULL,NULL,'published',NULL);
$article_sticky = $article->listSticky();
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
<div class="cover">
	<img src="image/cover.jpg" alt="">
	<div class="content">
		<h1>อาชีวเวชกรรมและเวชกรรมสิ่งแวดล้อม</h1>
		<p>Occupational and Environmental medicine</p>
	</div>
	<div class="filter"></div>
</div>

<?php if(count($article_sticky) > 0){?>
<div class="section">
	<h3>ปักหมุด</h3>
	<?php foreach ($article_sticky as $var) { include 'template/article.sticky.php'; } ?>
</div>
<?php }?>

<div class="section">
	<?php $dataset = $article->listCategory(2); ?>
	<h3><?php echo $dataset['category']['title'];?></h3>
	<div class="lists">
		<?php if(count($dataset['articles']) > 0){?>
		<?php foreach ($dataset['articles'] as $var) { include 'template/article.card.php'; } ?>
		<?php }else{?>
		<div class="empty">ไม่พบบทความ</div>
		<?php }?>
	</div>

	<?php if($dataset['category']['total'] > 6){?>
	<a class="read-more" href="topic/<?php echo $dataset['category']['id'];?><?php echo (!empty($dataset['category']['link'])?'/'.$dataset['category']['link']:'');?>">บทความเพิ่มเติม<i class="fal fa-angle-right"></i></a>
	<?php }?>
</div>

<div class="section">
	<?php $dataset = $article->listCategory(4); ?>
	<h3><?php echo $dataset['category']['title'];?></h3>
	<div class="lists">
		<?php if(count($dataset['articles']) > 0){?>
		<?php foreach ($dataset['articles'] as $var) { include 'template/article.card.php'; } ?>
		<?php }else{?>
		<div class="empty">ไม่พบบทความ</div>
		<?php }?>
	</div>
	<?php if($dataset['category']['total'] > 6){?>
	<a class="read-more" href="topic/<?php echo $dataset['category']['id'];?><?php echo (!empty($dataset['category']['link'])?'/'.$dataset['category']['link']:'');?>">บทความเพิ่มเติม<i class="fal fa-angle-right"></i></a>
	<?php }?>
</div>

<div class="section">
	<?php $dataset = $article->listCategory(1); ?>
	<h3><?php echo $dataset['category']['title'];?></h3>
	<div class="lists">
		<?php if(count($dataset['articles']) > 0){?>
		<?php foreach ($dataset['articles'] as $var) { include 'template/article.card.php'; } ?>
		<?php }else{?>
		<div class="empty">ไม่พบบทความ</div>
		<?php }?>
	</div>
	<?php if($dataset['category']['total'] > 6){?>
	<a class="read-more" href="topic/<?php echo $dataset['category']['id'];?><?php echo (!empty($dataset['category']['link'])?'/'.$dataset['category']['link']:'');?>">บทความเพิ่มเติม<i class="fal fa-angle-right"></i></a>
	<?php }?>
</div>

<?php if(count($articles)>0){
	include_once 'footer.php';
}?>

<div id="progressbar"></div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>