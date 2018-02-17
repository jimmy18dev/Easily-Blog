<?php
include_once'autoload.php';

$keyword = trim($_GET['q']);

$article = new Article();
$articles = $article->listAll(NULL,NULL,$keyword,'published',NULL);
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

<title>ค้นหา<?php echo (!empty($keyword)?' "'.$keyword.'"':'');?></title>

<base href="<?php echo DOMAIN;?>">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/slideshow.css"/>
<link rel="stylesheet" type="text/css" href="plugin/font-awesome/css/font-awesome.min.css"/>
</head>
<body>
<header class="header">
	<a href="index.php" class="btn left"><i class="fa fa-arrow-left" aria-hidden="true"></i><span>หน้าแรก</span></a>
</header>

<form action="search" method="GET" class="pagehead margin-zero">
	<input type="text" name="q" placeholder="ค้นหาบทความ..." value="<?php echo $keyword;?>" autofocus>
</form>

<div class="article-list">
	<?php if(count($articles) > 0 && !empty($keyword)){?>
	<?php foreach ($articles as $var) { include 'template/article.card.php'; } ?>
	<?php }else{?>
	<div class="empty">ไม่พบบทความ</div>
	<?php }?>
</div>

<script type="text/javascript" src="js/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</body>
</html>