<?php
include_once'autoload.php';
$article = new Article();

if(!empty($_GET['status'])){
	$status = $_GET['status'];
}else{
	$status = 'published';
}

$articles 			= $article->listAll(NULL,NULL,NULL,$status,$user->id);
$article_counter 	= $article->counter($user->id);
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
<div class="navigation">
	<h2><?php echo $user->fullname;?></h2>
	<a href="profile?status=published">แผยแพร่แล้ว (<?php echo $article_counter['published'];?>)</a>
	<a href="profile?status=draft">ฉบับร่าง (<?php echo $article_counter['draft'];?>)</a>

	<a href="article/create" class="btn-create"><i class="fa fa-pencil" aria-hidden="true"></i>เขียนบทความ</a>
</div>

<div class="article-list">
	<?php if(count($articles) > 0){?>
	<?php foreach ($articles as $var) { include 'template/article.card.php'; } ?>
	<?php }else{?>
	<div class="empty">ไม่พบบทความ</div>
	<?php }?>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
</body>
</html>