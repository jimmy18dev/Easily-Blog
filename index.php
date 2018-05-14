<?php
include_once'autoload.php';

$article = new Article();
$category = new Category();
$homesection = new HomeSection();

$sectionitems = $homesection->lists();
$article_sticky = $article->listSticky();
$categories = $category->listAll();
$current_page = 'home';
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

<title><?php echo $config['settings']['title'];?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/slideshow.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>

<?php include_once 'header.php';?>
<?php include_once 'template/navigation.php'; ?>

<div class="cover">
	<picture>
		<source srcset="image/cover_sq.jpg" media="(min-width:0px) and (max-width :519px)">
		<source srcset="image/cover.jpg">
		<img srcset="image/cover.jpg" alt="My default image">
	</picture>
	<div class="content">
		<h1>อาชีวเวชกรรมและเวชกรรมสิ่งแวดล้อม</h1>
		<p>Occupational and Environmental medicine</p>
		<!-- <p>โรงพยาบาลเจ้าพระยาอภัยภูเบศร ปราจีนบุรี</p> -->
	</div>
	<div class="filter"></div>
</div>

<?php if(count($article_sticky) > 0){?>
<div class="section">
	<h3><i class="fa fa-star"></i>บทความแนะนำ</h3>
	<?php foreach ($article_sticky as $var) { include 'template/article.sticky.php'; } ?>
</div>
<?php }?>

<?php foreach ($sectionitems as $key) {?>
<div class="section">
	<?php
	$dataset = $article->listAll($key['category_id'],NULL,'published',NULL,$key['total_items'],false,NULL,NULL);
	$category_data = $category->get($key['category_id']);
	?>
	<h3><i class="fal fa-<?php echo (!empty($category_data['icon'])?$category_data['icon']:'folder');?>"></i><?php echo $category_data['title'];?></h3>
	<div class="lists">
		<?php if(count($dataset['items']) > 0){?>
		<?php foreach ($dataset['items'] as $var) { include 'template/article.card.php'; } ?>
		<?php }else{?>
		<div class="empty">ไม่พบบทความ</div>
		<?php }?>
	</div>
	
	<?php if($dataset['total_items'] > $key['total_items']){?>
	<a class="read-more" href="topic/<?php echo $category_data['id'];?><?php echo (!empty($category_data['link'])?'/'.$category_data['link']:'');?>#navi">ดูเพิ่มเติม<i class="fal fa-angle-right"></i></a>
	<?php }?>
</div>
<?php }?>

<div class="overlay"></div>

<?php include_once 'footer.php'; ?>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/nav.js"></script>
</body>
</html>