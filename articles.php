<?php
include_once'autoload.php';
$article = new Article();
$category = new Category();
$category_id = $_GET['category_id'];
$category->get($category_id);
$page = $_GET['page'];
$perpage = 3;

$articles = $article->listAll($category->id,NULL,'published',NULL,0,true,$page,$perpage);
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
<?php include_once 'template/navigation.php'; ?>

<div class="section">
	<div class="lists">
		<?php if(count($articles['items']) > 0){?>
		<?php foreach ($articles['items'] as $var) { include 'template/article.card.php'; } ?>
		<?php }else{?>
		<div class="empty">ไม่พบบทความ</div>
		<?php }?>
	</div>
</div>

<div class="pagination">
	<?php $total_page = ceil($articles['total_items'] / $perpage); ?>
	<?php for($i=1;$i<=$total_page;$i++){ ?>
	<a href="topic/<?php echo $category->id;?>/page/<?php echo $i;?>" class="<?php echo ($page == $i?'active':'');?>"><?php echo $i;?></a>
	<?php }?>
</div>

<?php if(count($articles)>0){
	include_once 'footer.php';
}?>
<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>