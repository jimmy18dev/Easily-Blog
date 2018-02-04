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
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<?php include_once 'header.php';?>
<nav class="category">
	<?php foreach ($categories as $var) {?>
	<a href="index.php?category_id=<?php echo $var['id'];?>"><?php echo $var['title'];?></a>
	<?php } ?>
</nav>

<div class="article-list">
	<?php foreach ($articles as $var) {?>
	<article class="items <?php echo ($var['highlight']?'highlight':'');?>">
		<?php if(!empty($var['cover_id'])){?>
		<figure>
			<a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>">
			<img src="image/upload/normal/<?php echo $var['cover_img'];?>" alt="">
			</a>
		</figure>
		<?php }?>
		
		<header>
			<a href="#"><?php echo $var['category_title'];?></a>
			<h2><a href="article/<?php echo $var['id'];?>/<?php echo $var['url'];?>"><?php echo (!empty($var['title'])?$var['title']:'Untitle');?></a></h2>
			<p class="info"><?php echo (!empty($var['edit_time'])?'Edited '.$var['edit_time']:$var['create_time']);?></p>
		</header>
		<p><?php echo $var['description'];?></p>
	</article>
	<?php } ?>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>