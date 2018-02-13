<?php
include_once'autoload.php';
$article 	= new Article();
$tags 		= $article->getTags($_GET['name']);
$articles 	= $article->listWithTag($tags['id']);
$c_article 	= $article->counter($user->id);
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

<title><?php echo $user->fullname;?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/slideshow.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<?php include_once 'header.php';?>

<div class="pagehead">
	<h2>#<?php echo $tags['name'];?></h2>
</div>

<div class="article-list">
	<?php if(count($articles) > 0){?>
	<?php foreach ($articles as $var) { include 'template/article.card.php'; } ?>
	<?php }else{?>
	<div class="empty">ไม่พบบทความ</div>
	<?php }?>
</div>

<?php if(count($articles)>0){
	include_once 'footer.php';
}?>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>