<?php
include_once'autoload.php';
$article = new Article();
$category = new Category();
$category_id = $_GET['category_id'];
$category->get($category_id);
$page = (!empty($_GET['page'])?$_GET['page']:1);
$perpage = 10;
$articles = $article->listAll($category->id,NULL,'published',NULL,0,true,$page,$perpage);
$current_page = 'articles';
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

<?php include'favicon.php';?>
<?php
$page_title 	= $category->title.' - '.$config['settings']['title'];
$page_desc 		= $config['settings']['description'];
$page_url 		= DOMAIN.'topic/'.$category->id.(!empty($category->link)?'/'.$category->link:'');
$page_image 	= DOMAIN.'/image/cover.png';
?>

<!-- Meta Tag Main -->
<meta name="description" 			content="<?php echo $page_desc;?>"/>
<meta property="og:title" 			content="<?php echo $page_title;?>"/>
<meta property="og:description" 	content="<?php echo $page_desc;?>"/>
<meta property="og:url" 			content="<?php echo $page_url;?>"/>
<meta property="og:image" 			content="<?php echo $page_image;?>"/>
<meta property="og:type" 			content="website"/>
<meta property="og:site_name" 		content="<?php echo $config['settings']['sitename_en'];?>"/>
<meta property="fb:app_id" 			content="<?php echo $config['facebook']['api_id'];?>"/>
<meta property="fb:admins" 			content="<?php echo $config['facebook']['admin_id'];?>"/>

<meta itemprop="name" 				content="<?php echo $page_title;?>">
<meta itemprop="description" 		content="<?php echo $page_desc;?>">
<meta itemprop="image" 				content="<?php echo $page_image;?>">

<title><?php echo $page_title;?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/slideshow.css"/>
<link rel="stylesheet" type="text/css" href="plugin/fontawesome-pro-5.0.9/css/fontawesome-all.min.css"/>
</head>
<body>

<?php include_once 'header.php';?>
<?php include_once 'template/navigation.php'; ?>

<div class="section">
	<div class="head">
		<h3 class="fullsize"><?php echo $category->title;?></h3>
	</div>
	<div class="lists">
		<?php if(count($articles['items']) > 0){?>
		<?php foreach ($articles['items'] as $var) { include 'template/article.card.php'; } ?>
		<?php }else{?>
		<div class="empty">ไม่พบบทความ</div>
		<?php }?>
	</div>
</div>

<?php $total_page = ceil($articles['total_items'] / $perpage); ?>
<?php if($total_page > 1){?>
<div class="pagination">
	<?php for($i=1;$i<=$total_page;$i++){ ?>
	<a href="topic/<?php echo $category->id;?>/page/<?php echo $i;?>" class="<?php echo ($page == $i?'active':'');?>"><?php echo $i;?></a>
	<?php }?>
</div>
<?php }?>

<div id="overlay" class="overlay"></div>

<?php if($articles['total_items'] > 0){
	include_once 'footer.php';
}?>
<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
<script type="text/javascript" src="js/nav.js"></script>
</body>
</html>